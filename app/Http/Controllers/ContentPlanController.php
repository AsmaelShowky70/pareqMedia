<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ContentPlan;
use App\Models\PlatformNotification;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentPlanController extends Controller
{
    /**
     * Check that only GM (Admin) and Content Creators have access
     */
    protected function authorizeAccess(): void
    {
        abort_unless(
            Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isContentCreator()),
            403,
            'عذراً، هذا القسم مخصص للمدير العام وصناع المحتوى فقط.'
        );
    }

    /**
     * Display the Monthly Content Calendar & Publishing Plans
     */
    public function index(Request $request)
    {
        $this->authorizeAccess();

        $user = Auth::user();

        // 1. Month and Year Filtering (Default: current month)
        $year = (int) $request->input('year', Carbon::now()->year);
        $month = (int) $request->input('month', Carbon::now()->month);

        $selectedDate = Carbon::createFromDate($year, $month, 1);
        $prevMonth = $selectedDate->copy()->subMonth();
        $nextMonth = $selectedDate->copy()->addMonth();

        // 2. View Mode (table, calendar, pipeline)
        $view = $request->input('view', 'table');
        if (! in_array($view, ['table', 'calendar', 'pipeline'])) {
            $view = 'table';
        }

        // 3. Other Filters
        $clientId = $request->input('client_id');
        $creatorId = $request->input('creator_id');
        $type = $request->input('type');
        $status = $request->input('status');
        $search = $request->input('search');

        // Query with eager loading and strict isolation
        $query = ContentPlan::with(['client', 'project', 'contentCreator', 'task'])
            ->accessibleBy($user)
            ->forMonth($year, $month);

        // Apply filters
        if ($clientId) {
            $query->where('client_id', $clientId);
        }

        if ($user->isAdmin() && $creatorId) {
            $query->where('content_creator_id', $creatorId);
        }

        if ($type) {
            $query->where('content_type', $type);
        }

        if ($status) {
            if ($status === 'published') {
                $query->where(function ($q) {
                    $q->where('is_published', true)->orWhere('publishing_status', 'published');
                });
            } elseif ($status === 'overdue') {
                $query->where('is_published', false)
                    ->where('publishing_status', '!=', 'cancelled')
                    ->where('publish_date', '<', Carbon::today());
            } elseif ($status === 'today') {
                $query->where('publish_date', Carbon::today()->format('Y-m-d'));
            } else {
                $query->where('publishing_status', $status);
            }
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('caption', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%")
                    ->orWhereHas('client', function ($cq) use ($search) {
                        $cq->where('name', 'like', "%{$search}%")
                            ->orWhere('brand_name', 'like', "%{$search}%");
                    });
            });
        }

        // Get sorted records
        $contentPlans = $query->orderBy('publish_date', 'asc')
            ->orderBy('publish_time', 'asc')
            ->get();

        // 4. Calculate KPIs for selected month & filters
        $totalMonthlyQuery = ContentPlan::accessibleBy($user)->forMonth($year, $month);
        if ($clientId) {
            $totalMonthlyQuery->where('client_id', $clientId);
        }
        if ($user->isAdmin() && $creatorId) {
            $totalMonthlyQuery->where('content_creator_id', $creatorId);
        }

        $allMonthlyItems = $totalMonthlyQuery->get();
        $totalCount = $allMonthlyItems->count();
        $publishedCount = $allMonthlyItems->filter(fn ($p) => $p->is_published || $p->publishing_status === 'published')->count();
        $readyCount = $allMonthlyItems->filter(fn ($p) => (! $p->is_published && $p->publishing_status !== 'published') && $p->production_status === 'ready_to_publish')->count();
        $inProductionCount = $allMonthlyItems->filter(fn ($p) => in_array($p->production_status, ['in_production', 'idea']))->count();
        $overdueCount = $allMonthlyItems->filter(fn ($p) => $p->is_overdue)->count();
        $todayCount = $allMonthlyItems->filter(fn ($p) => $p->publish_date && $p->publish_date->isToday())->count();
        $reelsCount = $allMonthlyItems->filter(fn ($p) => $p->content_type === 'reel')->count();
        $postsCount = $allMonthlyItems->filter(fn ($p) => in_array($p->content_type, ['post', 'carousel']))->count();

        $completionRate = $totalCount > 0 ? round(($publishedCount / $totalCount) * 100) : 0;

        // 5. Data for Calendar View
        $plansByDate = [];
        if ($view === 'calendar') {
            $plansByDate = $contentPlans->groupBy(function ($item) {
                return $item->publish_date ? $item->publish_date->format('Y-m-d') : '';
            });
        }

        // 6. Clients and Creators for filter dropdowns
        $clients = Client::orderBy('name')->get();
        $creators = User::where('role', User::ROLE_CONTENT_CREATOR)->orderBy('name')->get();

        // Accessible projects for the modal
        $projectsQuery = Project::query();
        if ($user->isContentCreator()) {
            $projectsQuery->where('content_creator_id', $user->id);
        }
        $projects = $projectsQuery->orderBy('title')->get();

        return view('content-plans.index', compact(
            'contentPlans',
            'year',
            'month',
            'selectedDate',
            'prevMonth',
            'nextMonth',
            'view',
            'clientId',
            'creatorId',
            'type',
            'status',
            'search',
            'totalCount',
            'publishedCount',
            'readyCount',
            'inProductionCount',
            'overdueCount',
            'todayCount',
            'reelsCount',
            'postsCount',
            'completionRate',
            'plansByDate',
            'clients',
            'creators',
            'projects'
        ));
    }

    /**
     * Store a new content plan
     */
    public function store(Request $request)
    {
        $this->authorizeAccess();

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:255',
            'content_type' => 'required|string|in:reel,carousel,post,story,video,tiktok,other',
            'platforms' => 'nullable|array',
            'publish_date' => 'required|date',
            'publish_time' => 'nullable|string|max:10',
            'client_delivery_deadline' => 'nullable|date',
            'content_url' => 'nullable|string',
            'caption' => 'nullable|string',
            'production_status' => 'required|string|in:idea,in_production,client_review,ready_to_publish',
            'publishing_status' => 'required|string|in:scheduled,published,postponed,cancelled',
            'notes' => 'nullable|string',
            'content_creator_id' => 'nullable|exists:users,id',
        ]);

        $user = Auth::user();

        // Enforce creator assignment
        if ($user->isContentCreator()) {
            $validated['content_creator_id'] = $user->id;
        } elseif (empty($validated['content_creator_id'])) {
            // If project is selected, derive from project
            if (! empty($validated['project_id'])) {
                $project = Project::find($validated['project_id']);
                $validated['content_creator_id'] = $project?->content_creator_id ?? $user->id;
            } else {
                $validated['content_creator_id'] = $user->id;
            }
        }

        $validated['created_by'] = $user->id;

        // Auto sync is_published
        if ($validated['publishing_status'] === 'published') {
            $validated['is_published'] = true;
            $validated['published_at'] = now();
        } else {
            $validated['is_published'] = false;
            $validated['published_at'] = null;
        }

        $plan = ContentPlan::create($validated);

        // Notify GM if created by Content Creator
        if ($user->isContentCreator()) {
            PlatformNotification::notifyGM(
                'content_plan_created',
                'جدولة محتوى جديدة في خطة النشر',
                "قام صانع المحتوى {$user->name} بإضافة منشور جديد '{$plan->title}' للعميل {$plan->client->name} مقرر نشره في {$plan->publish_date->format('Y-m-d')}.",
                'calendar-plus',
                route('content-plans.index', ['year' => $plan->publish_date->year, 'month' => $plan->publish_date->month, 'client_id' => $plan->client_id])
            );
        }

        return redirect()->back()->with('success', "تم إضافة منشور '{$plan->title}' إلى خطة النشر بنجاح!");
    }

    /**
     * Update an existing content plan
     */
    public function update(Request $request, ContentPlan $contentPlan)
    {
        $this->authorizeAccess();

        $user = Auth::user();
        if ($user->isContentCreator() && $contentPlan->content_creator_id !== $user->id && $contentPlan->created_by !== $user->id) {
            abort(403, 'غير مصرح لك بتعديل خطة نشر خاصة بصانع محتوى آخر.');
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:255',
            'content_type' => 'required|string|in:reel,carousel,post,story,video,tiktok,other',
            'platforms' => 'nullable|array',
            'publish_date' => 'required|date',
            'publish_time' => 'nullable|string|max:10',
            'client_delivery_deadline' => 'nullable|date',
            'content_url' => 'nullable|string',
            'caption' => 'nullable|string',
            'production_status' => 'required|string|in:idea,in_production,client_review,ready_to_publish',
            'publishing_status' => 'required|string|in:scheduled,published,postponed,cancelled',
            'notes' => 'nullable|string',
            'content_creator_id' => 'nullable|exists:users,id',
        ]);

        if ($user->isContentCreator()) {
            unset($validated['content_creator_id']);
        }

        // Check if status changed to published
        if ($validated['publishing_status'] === 'published' && ! $contentPlan->is_published) {
            $validated['is_published'] = true;
            $validated['published_at'] = now();
        } elseif ($validated['publishing_status'] !== 'published') {
            $validated['is_published'] = false;
            $validated['published_at'] = null;
        }

        $contentPlan->update($validated);

        return redirect()->back()->with('success', "تم تحديث المنشور '{$contentPlan->title}' بنجاح!");
    }

    /**
     * Toggle Published status in one click
     */
    public function togglePublish(Request $request, ContentPlan $contentPlan)
    {
        $this->authorizeAccess();

        $user = Auth::user();
        if ($user->isContentCreator() && $contentPlan->content_creator_id != $user->id && $contentPlan->created_by != $user->id) {
            abort(403, 'غير مصرح لك بتحديث هذا المنشور.');
        }

        $contentPlan->togglePublished();

        $statusText = $contentPlan->is_published ? 'تم النشر بنجاح' : 'تمت الإعادة إلى مجدول للنشر';

        // Notify GM if published by creator
        if ($contentPlan->is_published && $user->isContentCreator()) {
            PlatformNotification::notifyGM(
                'content_published',
                'تم نشر محتوى للعميل',
                "قام صانع المحتوى {$user->name} بتأكيد نشر '{$contentPlan->title}' للعميل {$contentPlan->client->name}.",
                'circle-check',
                route('content-plans.index', ['year' => $contentPlan->publish_date->year, 'month' => $contentPlan->publish_date->month, 'client_id' => $contentPlan->client_id])
            );
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_published' => $contentPlan->is_published,
                'message' => $statusText,
                'badge' => $contentPlan->publishing_status_badge,
            ]);
        }

        return redirect()->back()->with('success', "{$statusText} للمنشور: '{$contentPlan->title}'");
    }

    /**
     * Delete a content plan item
     */
    public function destroy(ContentPlan $contentPlan)
    {
        $this->authorizeAccess();

        $user = Auth::user();
        if ($user->isContentCreator() && $contentPlan->content_creator_id !== $user->id && $contentPlan->created_by !== $user->id) {
            abort(403, 'غير مصرح لك بحذف هذا المنشور.');
        }

        $title = $contentPlan->title;
        $contentPlan->delete();

        return redirect()->back()->with('success', "تم حذف المنشور '{$title}' من خطة النشر.");
    }
}
