<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Section;
use App\Models\Category;
use App\Models\SupplierPortfolio;
use App\Models\SupplierProfile;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $section = Section::first();
        $banner = Banner::first();
        return view('welcomepage.welcome', compact('banner','section'));
    }
    
    public function showprofile(Request $request)
    {
        $query = SupplierProfile::with('categories');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")
                
                // ✅ FIX FOR PIVOT
                ->orWhereHas('categories', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                });
            });
        }

        $suppliers = $query->get();

        // Filters
        $allSuppliers = SupplierProfile::with('categories')->get();

        $cities = $allSuppliers->pluck('city')->filter()->unique()->values();

        $categories = Category::all(); // ✅ best

        return view('welcomepage.supplier.profile', compact(
            'suppliers',
            'cities',
            'categories'
        ));
    }

    public function showprofiledetails($id)
    {
        $supplier = SupplierProfile::findOrFail($id);
        return view('welcomepage.supplier.details', compact('supplier'));
    }
    
    public function showgallery()
    {
        $portfolios = SupplierPortfolio::with('supplier')
        ->latest()
        ->get();

        return view('welcomepage.supplier.portfolio', compact('portfolios'));
    }

    public function package(Request $request)
    {
        $search = $request->search;
        $eventType = $request->event_type;

    $suppliers = SupplierProfile::with(['packages' => function ($query) use ($search, $eventType) {

        if ($eventType) {
            $query->where('event_type', $eventType);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

    }])->get();

        return view('welcomepage.supplier.package', compact('suppliers', 'search', 'eventType'));
    }
}               