<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PlatformNotification;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Strict isolation: Content Creators only see their own projects, Admins see all
        $query = Project::accessibleBy($user)
            ->with(['client', 'contentCreator'])
            ->withCount(['tasks']);

        if ($request->filled('content_creator_id') && $user->isAdmin()) {
            $query->where('content_creator_id', $request->content_creator_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $projects = $query->latest()->paginate(15);

        $clients = Client::orderBy('name')->get();
        $contentCreators = User::whereIn('role', [User::ROLE_CONTENT_CREATOR, User::ROLE_MANAGER])
            ->where('is_active', true)
            ->get();

        return view('projects.index', compact('projects', 'clients', 'contentCreators', 'user'));
    }

    public function show(Project $project)
    {
        $user = Auth::user();

        // Strict isolation authorization
        if ($user->isContentCreator() && $project->content_creator_id !== $user->id) {
            abort(403, 'غير مصرح لك بمشاهدة تفاصيل مشروع يخص صانع محتوى آخر.');
        }

        $project->load(['client', 'contentCreator', 'tasks.assignee', 'payments', 'expenses', 'installments']);
        $employees = User::where('is_active', true)->where('role', 'employee')->get();
        $contentCreators = User::whereIn('role', [User::ROLE_CONTENT_CREATOR, User::ROLE_MANAGER])->get();

        return view('projects.show', compact('project', 'employees', 'contentCreators', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'content_creator_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'total_budget' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'status' => 'required|in:planning,in_progress,review,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        // If creator creates project, auto-assign to self
        if ($user->isContentCreator()) {
            $validated['content_creator_id'] = $user->id;
        }

        $project = Project::create($validated);

        // If assigned to a content creator, notify them
        if (! empty($validated['content_creator_id']) && $validated['content_creator_id'] !== $user->id) {
            PlatformNotification::send(
                (int) $validated['content_creator_id'],
                'project_assigned',
                "مشروع جديد مسند إليك: {$project->title}",
                'قام المدير العام بإسناد مشروع جديد إليك لتوزيع المهام على فريقك ومتابعته.',
                'folder-plus',
                "/projects/{$project->id}"
            );
        }

        // Notify GM if created by Content Creator
        if ($user->isContentCreator()) {
            PlatformNotification::notifyGM(
                'project_created',
                "مشروع جديد من صانع المحتوى: {$user->name}",
                "قام {$user->name} بإنشاء مشروع جديد [{$project->title}] لمتابعة مهامه.",
                'folder-plus',
                "/projects/{$project->id}"
            );
        }

        return back()->with('success', 'تم إنشاء المشروع بنجاح وتعيين صانع المحتوى المسؤول.');
    }

    public function update(Request $request, Project $project)
    {
        $user = Auth::user();

        // Strict isolation
        if ($user->isContentCreator() && $project->content_creator_id !== $user->id) {
            abort(403, 'غير مصرح لك بتعديل مشروع لا يخصك.');
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'content_creator_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'total_budget' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'status' => 'required|in:planning,in_progress,review,delivered,completed,cancelled',
            'description' => 'nullable|string',
        ]);

        // Keep content_creator_id if creator updates
        if ($user->isContentCreator()) {
            unset($validated['content_creator_id']);
        }

        $previousCreatorId = $project->content_creator_id;
        $project->update($validated);

        // If newly assigned to another creator, notify them
        if (! empty($validated['content_creator_id']) && $validated['content_creator_id'] != $previousCreatorId) {
            PlatformNotification::send(
                (int) $validated['content_creator_id'],
                'project_assigned',
                "إسناد مشروع إليك: {$project->title}",
                'قام المدير العام بنقل وإسناد المشروع إليك لمتابعته وإدارته.',
                'folder-tree',
                "/projects/{$project->id}"
            );
        }

        return back()->with('success', 'تم تحديث بيانات المشروع بنجاح.');
    }

    /**
     * Content Creator submits / delivers the project to the General Manager for final approval.
     */
    public function deliverToGM(Request $request, Project $project)
    {
        $user = Auth::user();

        if ($user->isContentCreator() && $project->content_creator_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'delivery_notes' => 'required|string|max:1000',
        ]);

        $project->update([
            'status' => 'delivered',
            'submitted_to_gm_at' => Carbon::now(),
            'gm_approval_status' => 'pending',
            'delivery_notes' => $validated['delivery_notes'],
        ]);

        // Notify General Manager
        PlatformNotification::notifyGM(
            'project_delivered_to_gm',
            "تسليم مشروع من صانع المحتوى {$user->name}",
            "قام صانع المحتوى {$user->name} بتسليم المشروع [{$project->title}] للمدير العام للاعتماد النهائي. ملاحظات: {$validated['delivery_notes']}",
            'flag-checkered',
            "/projects/{$project->id}"
        );

        return back()->with('success', 'تم تسليم المشروع للمدير العام بنجاح وفي انتظار الاعتماد النهائي.');
    }

    /**
     * General Manager makes approval / revision decision on delivered project.
     */
    public function gmDecision(Request $request, Project $project)
    {
        $user = Auth::user();
        if (! $user->isAdmin()) {
            abort(403, 'صلاحية اعتماد المشاريع مقتصرة على المدير العام فقط.');
        }

        $validated = $request->validate([
            'decision' => 'required|in:approved,revisions_needed',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validated['decision'] === 'approved') {
            $project->update([
                'status' => 'completed',
                'gm_approval_status' => 'approved',
                'delivery_notes' => ($project->delivery_notes ?? '')."\n[اعتماد المدير العام]: تم الاعتماد بنجاح. ".($validated['notes'] ?? ''),
            ]);

            if ($project->content_creator_id) {
                PlatformNotification::send(
                    $project->content_creator_id,
                    'project_approved',
                    "تهانينا! تم اعتماد تسليم مشروعك [{$project->title}]",
                    'قام المدير العام باعتماد تسليم المشروع واكتماله بنجاح! '.($validated['notes'] ?? ''),
                    'trophy',
                    "/projects/{$project->id}"
                );
            }

            return back()->with('success', 'تم اعتماد المشروع واكتماله بنجاح وإشعار صانع المحتوى.');
        } else {
            $project->update([
                'status' => 'in_progress',
                'gm_approval_status' => 'revisions_needed',
                'delivery_notes' => ($project->delivery_notes ?? '')."\n[ملاحظات المدير العام للتعديل]: ".($validated['notes'] ?? ''),
            ]);

            if ($project->content_creator_id) {
                PlatformNotification::send(
                    $project->content_creator_id,
                    'project_revisions_needed',
                    "طلب تعديلات من المدير العام على مشروع [{$project->title}]",
                    'الملاحظات: '.($validated['notes'] ?? 'يرجى مراجعة التفاصيل وإعادة التسليم.'),
                    'rotate-left',
                    "/projects/{$project->id}"
                );
            }

            return back()->with('success', 'تم إرسال طلب التعديلات لصانع المحتوى لإعادة العمل.');
        }
    }

    public function destroy(Project $project)
    {
        if (Auth::user()->isEmployee()) {
            abort(403);
        }

        if (Auth::user()->isContentCreator() && $project->content_creator_id !== Auth::id()) {
            abort(403);
        }

        $project->delete();

        return back()->with('success', 'تم حذف المشروع بنجاح.');
    }
}
