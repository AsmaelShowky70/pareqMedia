<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PlatformNotification;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        \App\Support\DatabaseSchemaAligner::alignTasks();

        $user = Auth::user();
        $query = Task::with(['assignee', 'client', 'project', 'creator']);

        // 1. Employee Isolation: Employees ONLY see their own assigned tasks
        if ($user->isEmployee()) {
            $query->where('assigned_to', $user->id);
        }
        // 2. Content Creator Isolation: Content Creators ONLY see tasks of their assigned projects or tasks they created!
        elseif ($user->isContentCreator()) {
            $query->where(function ($q) use ($user) {
                $q->whereHas('project', function ($pq) use ($user) {
                    $pq->where('content_creator_id', $user->id);
                })->orWhere('created_by', $user->id);
            });
        }
        // 3. Admin / General Manager: Sees all, can filter by creator or assignee
        elseif ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%")
                    ->orWhere('location_address', 'like', "%{$search}%");
            });
        }

        $tasks = $query->orderByRaw("CASE status WHEN 'in_progress' THEN 1 WHEN 'not_started' THEN 2 WHEN 'on_leave' THEN 3 WHEN 'completed' THEN 4 ELSE 5 END")
            ->orderBy('delivery_deadline', 'asc')
            ->get();

        // Assignable employees
        $employees = User::where('is_active', true)->where('role', 'employee')->get();
        $clients = Client::orderBy('name')->get();

        // Filter projects by Content Creator isolation
        $projectsQuery = Project::where('status', 'in_progress');
        if ($user->isContentCreator()) {
            $projectsQuery->where('content_creator_id', $user->id);
        }
        $projects = $projectsQuery->orderBy('title')->get();

        $statuses = Task::getStatuses();
        $viewMode = $request->get('view', 'kanban'); // 'kanban' or 'list'

        return view('tasks.index', compact('tasks', 'employees', 'clients', 'projects', 'statuses', 'viewMode', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'department' => 'required|string',
            'status' => 'required|in:not_started,in_progress,completed,cancelled,on_leave',
            'delivery_deadline' => 'nullable|date',
            'daily_delivery_deadline' => 'nullable|string|max:255',
            'material_link' => 'nullable|string',
            'delivery_link' => 'nullable|string',
            'notes' => 'nullable|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            // Photographer Location fields
            'location_address' => 'nullable|string|max:500',
            'location_map_url' => 'nullable|string|max:1000',
            'location_lat' => 'nullable|numeric|between:-90,90',
            'location_lng' => 'nullable|numeric|between:-180,180',
            'geofence_radius_meters' => 'nullable|integer|min:20|max:1000',
        ]);

        // Content creator verification: if project specified, must belong to them
        if ($user->isContentCreator() && ! empty($validated['project_id'])) {
            $proj = Project::findOrFail($validated['project_id']);
            if ($proj->content_creator_id !== $user->id) {
                abort(403, 'غير مصرح لك بإضافة مهام لمشروع غير مسند إليك.');
            }
        }

        $validated['created_by'] = $user->id;

        if ($validated['status'] === Task::STATUS_COMPLETED) {
            $validated['completed_at'] = Carbon::now();
        }

        \App\Support\DatabaseSchemaAligner::alignTasks();
        try {
            $availableCols = \Illuminate\Support\Facades\Schema::getColumnListing('tasks');
            if (!empty($availableCols)) {
                $validated = array_intersect_key($validated, array_flip($availableCols));
            }
        } catch (\Throwable $e) {}

        $task = Task::create($validated);

        // Notify Assigned Employee
        PlatformNotification::send(
            $task->assigned_to,
            'task_assigned',
            "مهمة جديدة: {$task->title}",
            "قام {$user->name} بتكليفك بمهمة جديدة في قسم {$task->department_arabic}",
            'list-check',
            '/dashboard'
        );

        // Always Notify General Manager
        PlatformNotification::notifyGM(
            'task_created',
            "إنشاء مهمة جديدة: {$task->title}",
            "قام {$user->name} بتكليف الموظف ".($task->assignee->name ?? '').' بمهمة جديدة. موعد التسليم: '.($task->delivery_deadline ? $task->delivery_deadline->format('Y-m-d') : 'مفتوح'),
            'list-check',
            '/tasks'
        );

        return back()->with('success', 'تم إنشاء المهمة بنجاح وتعيين الموظف ومواعيد التسليم وإرسال الإشعارات.');
    }

    public function update(Request $request, Task $task)
    {
        $user = Auth::user();

        // Check permission if employee
        if ($user->isEmployee() && $task->assigned_to !== $user->id) {
            abort(403, 'غير مسموح لك بتعديل مهمة غير مسندة إليك.');
        }

        // Check permission if Content Creator
        if ($user->isContentCreator()) {
            $isOwnProject = $task->project && $task->project->content_creator_id === $user->id;
            $isCreator = $task->created_by === $user->id;
            if (! $isOwnProject && ! $isCreator) {
                abort(403, 'غير مسموح لك بتعديل مهام تابعة لصانع محتوى آخر.');
            }
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'assigned_to' => 'sometimes|required|exists:users,id',
            'department' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:not_started,in_progress,completed,cancelled,on_leave',
            'delivery_deadline' => 'nullable|date',
            'daily_delivery_deadline' => 'nullable|string|max:255',
            'material_link' => 'nullable|string',
            'delivery_link' => 'nullable|string',
            'notes' => 'nullable|string',
            'priority' => 'sometimes|required|in:low,medium,high,urgent',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'location_address' => 'nullable|string|max:500',
            'location_map_url' => 'nullable|string|max:1000',
            'location_lat' => 'nullable|numeric|between:-90,90',
            'location_lng' => 'nullable|numeric|between:-180,180',
            'geofence_radius_meters' => 'nullable|integer|min:20|max:1000',
        ]);

        if (isset($validated['status'])) {
            if ($validated['status'] === Task::STATUS_COMPLETED && $task->status !== Task::STATUS_COMPLETED) {
                $validated['completed_at'] = Carbon::now();
            } elseif ($validated['status'] !== Task::STATUS_COMPLETED) {
                $validated['completed_at'] = null;
            }
        }

        \App\Support\DatabaseSchemaAligner::alignTasks();
        try {
            $availableCols = \Illuminate\Support\Facades\Schema::getColumnListing('tasks');
            if (!empty($availableCols)) {
                $validated = array_intersect_key($validated, array_flip($availableCols));
            }
        } catch (\Throwable $e) {}

        $task->update($validated);

        return back()->with('success', 'تم تحديث بيانات المهمة بنجاح.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:not_started,in_progress,completed,cancelled,on_leave',
        ]);

        $completedAt = $validated['status'] === Task::STATUS_COMPLETED ? Carbon::now() : null;

        $task->update([
            'status' => $validated['status'],
            'completed_at' => $completedAt,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $task->status,
                'status_label' => $task->status_label,
            ]);
        }

        return back()->with('success', "تم تغيير حالة المهمة إلى: {$task->status_label}");
    }

    public function deliver(Request $request, Task $task)
    {
        $user = Auth::user();
        if ($user->isEmployee() && $task->assigned_to !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'delivery_link' => 'required|url',
            'notes' => 'nullable|string',
        ]);

        $task->update([
            'delivery_link' => $validated['delivery_link'],
            'notes' => ($task->notes ?? '')."\n[تسليم بواسطة {$user->name} - ".Carbon::now()->format('Y-m-d H:i').']: '.($validated['notes'] ?? 'تم إرفاق رابط التسليم'),
            'status' => Task::STATUS_COMPLETED,
            'completed_at' => Carbon::now(),
        ]);

        // 1. Notify Assigning Content Creator (if exists)
        if ($task->project && $task->project->content_creator_id) {
            PlatformNotification::send(
                $task->project->content_creator_id,
                'task_delivered',
                "تم تسليم المهمة: {$task->title}",
                "قام الموظف {$user->name} بتسليم وإنجاز المهمة وإرفاق الرابط.",
                'cloud-arrow-up',
                '/tasks'
            );
        } elseif ($task->created_by && $task->created_by !== $user->id) {
            PlatformNotification::send(
                $task->created_by,
                'task_delivered',
                "تم تسليم المهمة: {$task->title}",
                "قام الموظف {$user->name} بتسليم المهمة وإرفاق رابط التسليم.",
                'cloud-arrow-up',
                '/tasks'
            );
        }

        // 2. Always Notify General Manager
        PlatformNotification::notifyGM(
            'task_delivered',
            "تسليم مهمة من الموظف {$user->name}",
            "تم تسليم المهمة [{$task->title}] بنجاح، رابط العمل متاح للاعتماد.",
            'circle-check',
            '/tasks'
        );

        return back()->with('success', 'رائع! تم تسليم العمل وإرفاق الرابط واعتماد إنجاز المهمة وإرسال الإشعارات للمدير وصانع المحتوى.');
    }

    // =========================================================================
    // PHOTOGRAPHER FIELD TRACKING & GEOFENCING ATTENDANCE (بصمة حضور المصور)
    // =========================================================================

    /**
     * 1. Photographer accepts task and starts moving to shoot site
     */
    public function photographerAccept(Request $request, Task $task)
    {
        $user = Auth::user();
        if ($task->assigned_to !== $user->id && ! $user->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
        ]);

        $task->update([
            'photographer_accepted_at' => Carbon::now(),
            'photographer_start_lat' => $validated['lat'] ?? null,
            'photographer_start_lng' => $validated['lng'] ?? null,
            'attendance_status' => 'on_the_way',
            'status' => Task::STATUS_IN_PROGRESS,
        ]);

        $locationName = $task->location_address ?? 'الموقع المحدد';

        // Notify Content Creator (if assigned)
        if ($task->project && $task->project->content_creator_id) {
            PlatformNotification::send(
                $task->project->content_creator_id,
                'photographer_started',
                'المصور استلم المهمة وبدأ التحرك',
                "المصور {$user->name} استلم مهمة التصوير [{$task->title}] وبدأ التحرك إلى [{$locationName}].",
                'person-walking',
                '/tasks'
            );
        }

        // Notify General Manager
        PlatformNotification::notifyGM(
            'photographer_started',
            "تحرك المصور: {$user->name}",
            "استلم مهمة التصوير [{$task->title}] وبدأ التحرك إلى [{$locationName}].",
            'person-walking',
            '/tasks'
        );

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم استلام المهمة وبدء التحرك بنجاح، وتم إرسال الإشعار لصانع المحتوى والمدير العام.',
                'status' => 'on_the_way',
            ]);
        }

        return back()->with('success', 'تم استلام المهمة وبدء التحرك بنجاح وتم إشعار الإدارة.');
    }

    /**
     * 2. Geofence Attendance Check-in (بصمة الحضور بالموقع)
     */
    public function photographerCheckin(Request $request, Task $task)
    {
        $user = Auth::user();
        if ($task->assigned_to !== $user->id && ! $user->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'override_reason' => 'nullable|string|max:255',
        ]);

        $currentLat = (float) $validated['lat'];
        $currentLng = (float) $validated['lng'];

        $targetLat = (float) ($task->location_lat ?? 0);
        $targetLng = (float) ($task->location_lng ?? 0);
        $allowedRadius = (int) ($task->geofence_radius_meters ?? 100);

        $distanceMeters = 0;
        $withinGeofence = false;

        if ($targetLat != 0 && $targetLng != 0) {
            $distanceMeters = (int) round($this->calculateHaversineDistance($currentLat, $currentLng, $targetLat, $targetLng));
            $withinGeofence = ($distanceMeters <= $allowedRadius);
        } else {
            // Target coordinates not pre-configured, attendance accepted with current coords
            $withinGeofence = true;
            $distanceMeters = 0;
        }

        // Allow manager override or valid override reason
        if (! $withinGeofence && empty($validated['override_reason']) && ! $user->isAdmin()) {
            $msg = "أنت حالياً على بعد {$distanceMeters} متر من موقع التصوير. يجب أن تكون على مسافة {$allowedRadius} متر أو أقل لتسجيل بصمة الحضور.";
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'distance' => $distanceMeters,
                    'allowed_radius' => $allowedRadius,
                    'message' => $msg,
                ], 422);
            }

            return back()->with('error', $msg);
        }

        $task->update([
            'photographer_arrived_at' => Carbon::now(),
            'photographer_arrival_lat' => $currentLat,
            'photographer_arrival_lng' => $currentLng,
            'photographer_arrival_distance_meters' => $distanceMeters,
            'attendance_status' => 'checked_in',
        ]);

        $locationName = $task->location_address ?? 'الموقع';

        // Notify Content Creator
        if ($task->project && $task->project->content_creator_id) {
            PlatformNotification::send(
                $task->project->content_creator_id,
                'photographer_arrived',
                'بصمة حضور: وصل المصور لموقع التصوير',
                "المصور {$user->name} وصل إلى موقع التصوير [{$locationName}] وسجل بصمة الحضور بنجاح (المسافة: {$distanceMeters} متر).",
                'location-dot',
                '/tasks'
            );
        }

        // Notify General Manager
        PlatformNotification::notifyGM(
            'photographer_arrived',
            "بصمة حضور مصور: {$user->name}",
            "وصل المصور إلى موقع التصوير [{$locationName}] وسجل بصمة الحضور بنجاح (المسافة: {$distanceMeters} متر).",
            'location-dot',
            '/tasks'
        );

        $successMsg = "ممتاز! تم تسجيل بصمة الحضور بنجاح في موقع التصوير (المسافة: {$distanceMeters} متر). ابدأ جلستك الآن بالتوفيق!";

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'distance' => $distanceMeters,
                'message' => $successMsg,
                'status' => 'checked_in',
            ]);
        }

        return back()->with('success', $successMsg);
    }

    /**
     * 3. Photographer delivers shoot footage / photos
     */
    public function photographerDeliver(Request $request, Task $task)
    {
        $user = Auth::user();
        if ($task->assigned_to !== $user->id && ! $user->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'delivery_link' => 'required|url',
            'notes' => 'nullable|string',
        ]);

        $task->update([
            'delivery_link' => $validated['delivery_link'],
            'notes' => ($task->notes ?? '')."\n[تسليم مصور - ".Carbon::now()->format('Y-m-d H:i').']: '.($validated['notes'] ?? 'تم رفع وتسليم ملفات وماتريال جلسة التصوير'),
            'attendance_status' => 'shoot_completed',
            'status' => Task::STATUS_COMPLETED,
            'completed_at' => Carbon::now(),
        ]);

        // Notify Content Creator
        if ($task->project && $task->project->content_creator_id) {
            PlatformNotification::send(
                $task->project->content_creator_id,
                'shoot_completed',
                'تم إنهاء التصوير وتسليم الماتريال',
                "المصور {$user->name} أنهى جلسة التصوير وسلم الماتريال لمهمة [{$task->title}].",
                'camera',
                '/tasks'
            );
        }

        // Notify General Manager
        PlatformNotification::notifyGM(
            'shoot_completed',
            "إنهاء جلسة تصوير: {$user->name}",
            "تم تسليم صور وماتريال المهمة [{$task->title}].",
            'camera',
            '/tasks'
        );

        return back()->with('success', 'رائع جداً! تم تسجيل تسليم جلسة التصوير وإنهاء المهمة وإشعار صانع المحتوى والمدير العام.');
    }

    public function destroy(Task $task)
    {
        if (Auth::user()->isEmployee()) {
            abort(403, 'غير مصرح للموظفين بحذف المهام.');
        }

        if (Auth::user()->isContentCreator()) {
            $isOwn = $task->project && $task->project->content_creator_id === Auth::id();
            if (! $isOwn && $task->created_by !== Auth::id()) {
                abort(403, 'غير مصرح لك بحذف مهام خاصة بصانع محتوى آخر.');
            }
        }

        $task->delete();

        return back()->with('success', 'تم حذف المهمة بنجاح.');
    }

    /**
     * Haversine formula to calculate distance in meters between two lat/lng coordinates.
     */
    private function calculateHaversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000; // in meters

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
