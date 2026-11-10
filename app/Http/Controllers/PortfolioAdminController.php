<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Partner;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioAdminController extends Controller
{
    public function index()
    {
        \App\Support\DatabaseSchemaAligner::align();

        $services = Service::orderBy('sort_order')->latest()->get();
        $portfolioItems = PortfolioItem::with('service')->orderBy('sort_order')->latest()->get();
        $inquiries = Inquiry::latest()->paginate(15);
        $serviceCategories = Service::getCategories();

        try {
            $partners = Partner::orderBy('sort_order')->latest()->get();
        } catch (\Throwable $e) {
            $partners = collect();
        }

        try {
            $testimonials = Testimonial::orderBy('sort_order')->latest()->get();
        } catch (\Throwable $e) {
            $testimonials = collect();
        }

        try {
            $teamMembers = TeamMember::orderBy('sort_order')->get();
        } catch (\Throwable $e) {
            $teamMembers = collect();
        }

        $stats = SiteSetting::getFrontendStats();

        return view('cms.index', compact('services', 'portfolioItems', 'inquiries', 'serviceCategories', 'partners', 'testimonials', 'teamMembers', 'stats'));
    }

    public function storeService(Request $request)
    {
        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'required|string',
            'icon' => 'required|string',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'starting_price' => 'nullable|numeric|min:0',
        ]);

        // Auto generate slug
        $baseSlug = ! empty($validated['title_en']) ? Str::slug($validated['title_en']) : 'service';
        $slug = $baseSlug.'-'.time();
        $validated['slug'] = $slug;
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = Service::count() + 1;

        Service::create($validated);

        return back()->with('success', 'تمت إضافة الخدمة الجديدة بنجاح وربطها بنوعها في الموقع.');
    }

    public function updateService(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'category' => 'required|string',
            'icon' => 'required|string',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'starting_price' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return back()->with('success', 'تم تعديل وتحديث بيانات الخدمة بنجاح.');
    }

    public function destroyService(Service $service)
    {
        $service->delete();

        return back()->with('success', 'تم حذف الخدمة بنجاح.');
    }

    public function storePortfolioItem(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'client_name' => 'nullable|string',
            'client_country' => 'nullable|string',
            'category' => 'required|string',
            'video_url' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:12288',
            'video_file' => 'nullable|mimes:mp4,webm,mov,ogg|max:51200',
            'metrics' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // Handle uploaded image file
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $uploadPath = public_path('uploads/portfolio');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['thumbnail'] = '/uploads/portfolio/' . $filename;
        }

        // Handle uploaded video file
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $uploadPath = public_path('uploads/videos');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['video_url'] = '/uploads/videos/' . $filename;
        }

        // Auto convert Google Drive thumbnail links to direct viewable image URLs
        if (!empty($validated['thumbnail']) && str_contains($validated['thumbnail'], 'drive.google.com')) {
            if (preg_match('/(?:file\/d\/|id=)([a-zA-Z0-9_-]+)/', $validated['thumbnail'], $matches)) {
                $validated['thumbnail'] = 'https://lh3.googleusercontent.com/d/' . $matches[1];
            }
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['thumbnail'] = $validated['thumbnail'] ?? '/images/portfolio/social_1.webp';
        $validated['media_url'] = $validated['video_url'] ?? $validated['thumbnail'];
        $validated['thumbnail_url'] = $validated['thumbnail'];
        $validated['media_type'] = !empty($validated['video_url']) ? 'video' : 'image';
        $validated['sort_order'] = PortfolioItem::count() + 1;

        \App\Support\DatabaseSchemaAligner::alignPortfolioItems();
        try {
            $availableCols = \Illuminate\Support\Facades\Schema::getColumnListing('portfolio_items');
            if (!empty($availableCols)) {
                $validated = array_intersect_key($validated, array_flip($availableCols));
            }
        } catch (\Throwable $e) {}

        PortfolioItem::create($validated);

        return back()->with('success', 'تمت إضافة العمل إلى معرض أعمال الموقع بنجاح ويظهر الآن للزوار فوراً.');
    }

    public function updatePortfolioItem(Request $request, PortfolioItem $portfolioItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'client_name' => 'nullable|string',
            'client_country' => 'nullable|string',
            'category' => 'required|string',
            'video_url' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:12288',
            'video_file' => 'nullable|mimes:mp4,webm,mov,ogg|max:51200',
            'metrics' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // Handle uploaded image file
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $uploadPath = public_path('uploads/portfolio');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['thumbnail'] = '/uploads/portfolio/' . $filename;
            $validated['thumbnail_url'] = $validated['thumbnail'];
        }

        // Handle uploaded video file
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $uploadPath = public_path('uploads/videos');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['video_url'] = '/uploads/videos/' . $filename;
            $validated['media_url'] = $validated['video_url'];
        }

        // Auto convert Google Drive thumbnail links to direct viewable image URLs
        if (!empty($validated['thumbnail']) && str_contains($validated['thumbnail'], 'drive.google.com')) {
            if (preg_match('/(?:file\/d\/|id=)([a-zA-Z0-9_-]+)/', $validated['thumbnail'], $matches)) {
                $validated['thumbnail'] = 'https://lh3.googleusercontent.com/d/' . $matches[1];
                $validated['thumbnail_url'] = $validated['thumbnail'];
            }
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        if (isset($validated['video_url'])) {
            $validated['media_type'] = !empty($validated['video_url']) ? 'video' : 'image';
            $validated['media_url'] = $validated['video_url'] ?? ($validated['thumbnail'] ?? $portfolioItem->thumbnail);
        }

        try {
            $availableCols = \Illuminate\Support\Facades\Schema::getColumnListing('portfolio_items');
            if (!empty($availableCols)) {
                $validated = array_intersect_key($validated, array_flip($availableCols));
            }
        } catch (\Throwable $e) {}

        $portfolioItem->update($validated);

        return back()->with('success', 'تم تحديث بيانات العمل في معرض الموقع بنجاح.');
    }

    public function destroyPortfolioItem(PortfolioItem $portfolioItem)
    {
        $portfolioItem->delete();

        return back()->with('success', 'تم حذف العمل من المعرض بنجاح.');
    }

    public function updateInquiryStatus(Request $request, Inquiry $inquiry)
    {
        $inquiry->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'تم تحديث حالة طلب الاستشارة.');
    }

    // =========================================================================
    // PARTNERS CRUD (شركاء النجاح والعلامات التجارية)
    // =========================================================================
    public function storePartner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'logo_url' => 'nullable|string',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:10240',
        ]);

        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $uploadPath = public_path('uploads/partners');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['logo_url'] = '/uploads/partners/' . $filename;
        }

        \App\Support\DatabaseSchemaAligner::alignPartners();

        $validated['is_active'] = $request->boolean('is_active', true);
        try {
            $validated['sort_order'] = Partner::count() + 1;
        } catch (\Throwable $e) {
            \App\Support\DatabaseSchemaAligner::alignPartners();
            $validated['sort_order'] = 1;
        }

        Partner::create($validated);

        return back()->with('success', 'تمت إضافة الشريك أو العلامة التجارية بنجاح وتظهر في الموقع الرئيسي فوراً.');
    }

    public function updatePartner(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'logo_url' => 'nullable|string',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:10240',
        ]);

        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $uploadPath = public_path('uploads/partners');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['logo_url'] = '/uploads/partners/' . $filename;
        }

        $validated['is_active'] = $request->boolean('is_active');

        $partner->update($validated);

        return back()->with('success', 'تم تعديل بيانات الشريك بنجاح.');
    }

    public function destroyPartner(Partner $partner)
    {
        $partner->delete();

        return back()->with('success', 'تم حذف الشريك بنجاح.');
    }

    // =========================================================================
    // TESTIMONIALS CRUD (آراء العملاء وفيديوهات الفيدباك)
    // =========================================================================
    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'client_country' => 'nullable|string|max:255',
            'type' => 'required|string|in:video_reel,image_review,text_review',
            'content' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'media_url' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'video_file' => 'nullable|mimes:mp4,webm,mov|max:51200',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $uploadPath = public_path('uploads/testimonials');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['thumbnail'] = '/uploads/testimonials/' . $filename;
        }

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $uploadPath = public_path('uploads/testimonials/videos');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['media_url'] = '/uploads/testimonials/videos/' . $filename;
        }

        \App\Support\DatabaseSchemaAligner::alignTestimonials();

        $validated['rating'] = $validated['rating'] ?? 5;
        $validated['is_active'] = $request->boolean('is_active', true);
        try {
            $validated['sort_order'] = Testimonial::count() + 1;
        } catch (\Throwable $e) {
            \App\Support\DatabaseSchemaAligner::alignTestimonials();
            $validated['sort_order'] = 1;
        }

        Testimonial::create($validated);

        return back()->with('success', 'تمت إضافة رأي/فيديو الفيدباك بنجاح ويظهر في الموقع فوراً.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'client_country' => 'nullable|string|max:255',
            'type' => 'required|string|in:video_reel,image_review,text_review',
            'content' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'media_url' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'video_file' => 'nullable|mimes:mp4,webm,mov|max:51200',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $uploadPath = public_path('uploads/testimonials');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['thumbnail'] = '/uploads/testimonials/' . $filename;
        }

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $uploadPath = public_path('uploads/testimonials/videos');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['media_url'] = '/uploads/testimonials/videos/' . $filename;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $testimonial->update($validated);

        return back()->with('success', 'تم تعديل بيانات الفيدباك بنجاح.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'تم حذف الفيدباك بنجاح.');
    }

    public function updateStats(Request $request)
    {
        $validated = $request->validate([
            'stat_sync_mode' => 'required|in:custom,live',
            'stat_projects_count' => 'required|numeric|min:0',
            'stat_projects_label' => 'required|string|max:255',
            'stat_clients_count' => 'required|numeric|min:0',
            'stat_clients_label' => 'required|string|max:255',
            'stat_years_count' => 'required|numeric|min:0',
            'stat_years_label' => 'required|string|max:255',
            'stat_team_count' => 'required|numeric|min:0',
            'stat_team_label' => 'required|string|max:255',
        ]);

        \App\Support\DatabaseSchemaAligner::alignSiteSettings();

        foreach ($validated as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return back()->with('success', 'تم حفظ وتحديث إحصائيات المنصة ومؤشرات النجاح المعروضة في الموقع بنجاح.');
    }

    public function storeTeamMember(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'dept' => 'nullable|string|max:255',
            'quote' => 'nullable|string',
            'image_url' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:10240',
            'icon' => 'nullable|string|max:100',
            'gradient' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $uploadPath = public_path('uploads/team');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['image_url'] = '/uploads/team/' . $filename;
        }

        // Auto convert Google Drive image link to direct CDN image URL
        if (!empty($validated['image_url']) && str_contains($validated['image_url'], 'drive.google.com')) {
            if (preg_match('/(?:file\/d\/|id=)([a-zA-Z0-9_-]+)/', $validated['image_url'], $matches)) {
                $validated['image_url'] = 'https://lh3.googleusercontent.com/d/' . $matches[1];
            }
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? (TeamMember::count() + 1);
        $validated['letter'] = mb_substr($validated['name'], 0, 1, 'UTF-8');
        $validated['icon'] = $validated['icon'] ?? 'fa-solid fa-user';
        $validated['gradient'] = $validated['gradient'] ?? 'from-brand-orange to-[#FF7A00]';

        TeamMember::create($validated);

        return back()->with('success', 'تمت إضافة عضو الفريق بنجاح ويظهر في صفحة من نحن فوراً.');
    }

    public function updateTeamMember(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'dept' => 'nullable|string|max:255',
            'quote' => 'nullable|string',
            'image_url' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:10240',
            'icon' => 'nullable|string|max:100',
            'gradient' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $uploadPath = public_path('uploads/team');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['image_url'] = '/uploads/team/' . $filename;
        }

        // Auto convert Google Drive image link to direct CDN image URL
        if (!empty($validated['image_url']) && str_contains($validated['image_url'], 'drive.google.com')) {
            if (preg_match('/(?:file\/d\/|id=)([a-zA-Z0-9_-]+)/', $validated['image_url'], $matches)) {
                $validated['image_url'] = 'https://lh3.googleusercontent.com/d/' . $matches[1];
            }
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        if (isset($validated['name'])) {
            $validated['letter'] = mb_substr($validated['name'], 0, 1, 'UTF-8');
        }

        $teamMember->update($validated);

        return back()->with('success', 'تم تحديث بيانات عضو الفريق بنجاح.');
    }

    public function destroyTeamMember(TeamMember $teamMember)
    {
        $teamMember->delete();

        return back()->with('success', 'تم حذف عضو الفريق بنجاح.');
    }
}
