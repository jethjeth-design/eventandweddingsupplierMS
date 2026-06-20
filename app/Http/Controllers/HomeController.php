<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Section;
use App\Models\Category;
use App\Models\Package;
use App\Models\Eventcategory;
use App\Models\PopularPackage;
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
        $suppliers = SupplierProfile::with('user')
            ->latest()
            ->get();


        return view('welcomepage.supplier.profile', compact(
            'suppliers',

        ));
    }

    public function showprofiledetails($id)
    {
        $supplier = SupplierProfile::findOrFail($id);
        return view('welcomepage.supplier.details', compact('supplier'));
    }

    public function gallery()
{
    $galleries = SupplierPortfolio::latest()->get();
    

    return view('welcomepage.gallery', compact('galleries'));
}
    
    public function showgallery($id)
{
    $supplier = SupplierProfile::with('ratings')->findOrFail($id);

    $portfolios = SupplierPortfolio::where('supplier_id', $supplier->id)
        ->latest()
        ->get();

    $ratings = $supplier->ratings()->with('user')->get();

    return view('welcomepage.supplier.portfolio', compact(
        'portfolios',
        'supplier',
        'ratings'
    ));
}


    public function event()
    {
        $events = Eventcategory::latest()->get();

        return view('welcomepage.event', compact('events'));
    }

    public function package(Request $request)
    {
        // Admin curated packages
    $curatedPackages = Package::with([
    'supplier',
    'inclusions'
    ])
    ->where('is_listed', 1)
    ->latest()
    ->get();


    // Featured suppliers — only those marked as featured
    $suppliers = SupplierProfile::where('is_featured', true)
        ->with(['categories', 'ratings'])
        ->latest()
        ->get();

        return view('welcomepage.supplier.package', compact('suppliers', 'curatedPackages'));
    }
    
public function showPopular($id)
{
        // ── 1. Load the popular package with its inclusions ──────────────────
        $popular = PopularPackage::with('inclusions')->findOrFail($id);
 
        // ── 2. Collect the distinct inclusion types of this popular package ──
        //       Normalise to lowercase + trim so comparisons are reliable.
        $targetTypes = $popular->inclusions
            ->pluck('type')
            ->filter()                          // drop nulls / empty strings
            ->map(fn($t) => strtolower(trim($t)))
            ->unique()
            ->values()
            ->toArray();
 
        // ── 3. Find supplier packages whose inclusions share ≥1 type ─────────
        //       We join through the inclusions table so we can filter by type,
        //       then eager-load the full data we need for the view.
        if (!empty($targetTypes)) {
            $matchedPackages = Package::with([
                    'inclusions',
                    'supplier',         // adjust relationship name if needed
                ])
                ->whereHas('inclusions', function ($q) use ($targetTypes) {
                    // Match any inclusion whose normalised type is in $targetTypes
                    $q->whereRaw('LOWER(TRIM(type)) IN (?)', [implode("','", $targetTypes)])
                      ->orWhereIn(\DB::raw('LOWER(TRIM(type))'), $targetTypes);
                })
                ->get()
                // ── 4. Sort: packages with MORE matching types come first ────
                ->sortByDesc(function ($package) use ($targetTypes) {
                    return $package->inclusions
                        ->filter(fn($inc) => in_array(
                            strtolower(trim($inc->type ?? '')),
                            $targetTypes
                        ))
                        ->count();
                })
                ->values();
        } else {
            // Popular package has no typed inclusions — return empty
            $matchedPackages = collect();
        }
 
        return view('welcomepage.supplier.show', compact(
            'popular',
            'targetTypes',
            'matchedPackages'
        ));
}
}