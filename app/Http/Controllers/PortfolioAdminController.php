<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\PortfolioItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioAdminController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->latest()->get();
        $portfolioItems = PortfolioItem::with('service')->orderBy('sort_order')->latest()->get();
        $inquiries = Inquiry::latest()->paginate(15);
        $serviceCategories = Service::getCategories();

        return view('cms.index', compact('services', 'portfolioItems', 'inquiries', 'serviceCategories'));
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
            'metrics' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['thumbnail'] = $validated['thumbnail'] ?? '/images/portfolio/social_1.webp';

        PortfolioItem::create($validated);

        return back()->with('success', 'تمت إضافة العمل إلى معرض أعمال الموقع بنجاح.');
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
            'metrics' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $portfolioItem->update($validated);

        return back()->with('success', 'تم تحديث بيانات العمل بنجاح.');
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
}
