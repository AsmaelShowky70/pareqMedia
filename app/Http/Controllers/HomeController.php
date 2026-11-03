<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Inquiry;
use App\Models\PortfolioItem;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $portfolioItems = PortfolioItem::with('service')->orderBy('sort_order')->get();
        $featuredItems = PortfolioItem::where('is_featured', true)->get();
        $clients = Client::where('status', 'active')->take(12)->get();

        return view('home', compact('services', 'portfolioItems', 'featuredItems', 'clients'));
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

        Inquiry::create($validated);

        return back()->with('success_inquiry', 'تم استلام طلبك واستشارتك بنجاح! سيتواصل معك أحد مستشاري بريق للتسويق خلال ساعات قليلة.');
    }
}
