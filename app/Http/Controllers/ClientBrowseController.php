<?php

namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use App\Models\SupplierPortfolio;
use App\Models\Package;
use App\Models\SupplierAvailability;
use App\Models\PopularPackage;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientBrowseController extends Controller
{

    public function index(Request $request)
    {
        // Admin curated packages
    $curatedPackages = PopularPackage::with('inclusions')
        ->where('is_active', true)
        ->get();

    // Featured suppliers — only those marked as featured
    $suppliers = SupplierProfile::where('is_featured', true)
        ->with(['categories', 'ratings'])
        ->latest()
        ->get();

        return view('client.browse.package', compact('suppliers', 'curatedPackages'));
    }

    public function showPopular($id)
    {    

            // ── 1. Load the popular package with its inclusions ──────────────────
            $popular = PopularPackage::with('inclusions', 'supplier')->findOrFail($id);

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
    
            return view('client.browse.showpopular', compact(
                'popular',
                'targetTypes',
                'matchedPackages'
            ));
    }
    // 🔎 LIST ALL SUPPLIERS
    public function supplier()
    {
        $suppliers = SupplierProfile::with('user')
            ->latest()
            ->get();

        return view('client.browse.index', compact('suppliers'));
    }

    // 👤 SINGLE SUPPLIER + PACKAGES
    public function show($id)
    {
    $supplier = SupplierProfile::with(['user'])
    ->findOrFail($id);

    $packages = Package::where('supplier_id', $supplier->id)
    ->where('is_listed', true) // 🔥 ONLY SHOW PUBLISHED
    ->with('inclusions')
    ->latest()
    ->get();

    $events = Event::where('user_id', auth()->id())->get();

        return view('client.browse.show', compact('supplier', 'packages', 'events'));
    }

    public function portfolio($id)
    {
        $supplier = SupplierProfile::findOrFail($id);

    $portfolios = SupplierPortfolio::where('supplier_id', $supplier->id)
            ->latest()
            ->get();

        return view('client.browse.portfolio', compact('supplier', 'portfolios'));
    }


}


