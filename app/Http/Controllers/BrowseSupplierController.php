<?php

namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use Illuminate\Http\Request;

class BrowseSupplierController extends Controller
{
    public function browse(Request $request)
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
                ->orWhere('category_id', 'like', "%{$search}%");
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
        if ($request->has('category_id') && !empty($request->category)) {
            $query->whereHas('category_id', function ($q) use ($request) {
                $q->whereIn('slug', $request->category);
            });
        }

        

        // ✅ Final filtered suppliers
        $suppliers = $query->get();

        // ✅ IMPORTANT: use ALL suppliers for filter UI
        $allSuppliers = SupplierProfile::all();

        $cities = $allSuppliers->pluck('city')
            ->filter()->unique()->sort()->values();

        $categories = $allSuppliers->pluck('category_id')
            ->filter()->unique()->sort()->values();

        return view('client.browse.supplier', compact(
            'suppliers',
            'cities',
            'categories'
        ));
    }
    
    public function show($id)
    {
        $supplier = SupplierProfile::findOrFail($id);
        return view('client.browse.details', compact('supplier'));
    }
}