<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Inquiry;
use App\Models\Partner;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $portfolioItems = PortfolioItem::with('service')->orderBy('sort_order')->latest()->get();
        $featuredItems = PortfolioItem::with('service')->where('is_featured', true)->orderBy('sort_order')->latest()->get();
        if ($featuredItems->isEmpty()) {
            $featuredItems = $portfolioItems->take(6);
        }
        $clients = Client::where('status', 'active')->take(12)->get();
        
        try {
            $partners = Partner::where('is_active', true)->orderBy('sort_order')->get();
        } catch (\Throwable $e) {
            $partners = collect();
        }

        try {
            $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        } catch (\Throwable $e) {
            $testimonials = collect();
        }

        return view('home', compact('services', 'portfolioItems', 'featuredItems', 'clients', 'partners', 'testimonials'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $clients = Client::where('status', 'active')->take(12)->get();

        return view('pages.services', compact('services', 'clients'));
    }

    public function portfolio(Request $request)
    {
        $query = PortfolioItem::with('service')->orderBy('sort_order')->latest();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $portfolioItems = $query->get();
        $featuredItems = PortfolioItem::where('is_featured', true)->get();
        $clients = Client::where('status', 'active')->take(12)->get();

        return view('pages.portfolio', compact('portfolioItems', 'featuredItems', 'clients'));
    }

    public function process()
    {
        $clients = Client::where('status', 'active')->take(12)->get();

        return view('pages.process', compact('clients'));
    }

    public function contact()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.contact', compact('services'));
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'service_interested' => 'nullable|string',
            'budget_range' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        \App\Support\DatabaseSchemaAligner::alignInquiries();
        
        $data = $validated;
        $data['company_name'] = $validated['brand_name'] ?? null;
        $data['service_type'] = $validated['service_interested'] ?? null;

        try {
            $availableCols = \Illuminate\Support\Facades\Schema::getColumnListing('inquiries');
            if (!empty($availableCols)) {
                $data = array_intersect_key($data, array_flip($availableCols));
            }
        } catch (\Throwable $e) {}

        Inquiry::create($data);

        return back()->with('success_inquiry', 'تم استلام طلبك واستشارتك بنجاح! سيتواصل معك أحد مستشاري بريق للتسويق خلال ساعات قليلة.');
    }
}
