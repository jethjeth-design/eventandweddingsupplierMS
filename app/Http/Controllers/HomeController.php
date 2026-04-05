<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
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
        $banner = Banner::first();
        return view('welcomepage.welcome', compact('banner'));
    }
    
    public function showprofile(Request $request)
    {
        // ✅ Base query (filtered suppliers)
        $query = SupplierProfile::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // SORT
        if ($request->filled('sort')) {
            if ($request->sort === 'latest') {
                $query->latest();
            } elseif ($request->sort === 'oldest') {
                $query->oldest();
            }
        }

        // CITY
        if ($request->has('city') && !empty($request->city)) {
            $query->whereIn('city', $request->city);
        }

        // CATEGORY
        if ($request->has('category') && !empty($request->category)) {
            $query->whereIn('category', $request->category);
        }

        // ✅ Final filtered suppliers
        $suppliers = $query->get();

        // ✅ IMPORTANT: use ALL suppliers for filter UI
        $allSuppliers = SupplierProfile::all();

        $cities = $allSuppliers->pluck('city')
            ->filter()->unique()->sort()->values();

        $categories = $allSuppliers->pluck('category')
            ->filter()->unique()->sort()->values();

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
        $portfolio = SupplierPortfolio::with('supplier')->get();

        return view('welcomepage.supplier.portfolio', compact('portfolio'));
    }
}               