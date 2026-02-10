<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\FaqItem;
use App\Models\PricingPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact('services'));
    }

    public function getServices(): JsonResponse
    {
        $services = Service::where('is_active', true)
            ->with('pricingPackages')
            ->get();

        return response()->json($services);
    }

    public function getPortfolios(): JsonResponse
    {
        $portfolios = PortfolioProject::where('is_active', true)
            ->orderBy('order_column')
            ->get();

        return response()->json($portfolios);
    }

    public function getTestimonials(): JsonResponse
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order_column')
            ->get();

        return response()->json($testimonials);
    }

    public function getFaqs(): JsonResponse
    {
        $faqs = FaqItem::where('is_active', true)
            ->orderBy('order_column')
            ->get();

        return response()->json($faqs);
    }

    public function getPricingPackages(): JsonResponse
    {
        $packages = PricingPackage::where('is_active', true)
            ->with('service')
            ->get();

        return response()->json($packages);
    }
}

