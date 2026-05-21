<?php

namespace App\Http\Controllers;

use App\Models\PopularPackage;
use App\Models\SupplierProfile;
use App\Models\Package;
use App\Models\PopularPackageItem;
use App\Models\PopularPackageInclusion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopularPackageController extends Controller
{
    public function index()
    {   
        $suppliers = SupplierProfile::all();
        $packages = Package::all();
        $popularPackages = PopularPackage::with('inclusions')
        ->latest()
        ->get();
        return view('admin.popular.index', compact('popularPackages','suppliers','packages'));
    }

    public function create()
    {
        return view('admin.popular.create');
    }

    public function store(Request $request)
{
    $request->validate([

        'name' => 'required|string|max:255',
        'event_type' => 'required|string|max:255',
        'price' => 'nullable|numeric',
        'guest_capacity' => 'nullable|integer',
        'duration_hours' => 'nullable|integer',
        'description' => 'nullable|string',
        'min_price' => 'nullable|numeric',
        'is_negotiable' => 'nullable|boolean',
        'is_featured' => 'nullable|boolean',

        // ✅ inclusions
        'inclusions' => 'nullable|array',
        'inclusions.*' => 'nullable|string',

        // ✅ bundle items
        'supplier_ids' => 'nullable|array',
        'supplier_ids.*' => 'exists:supplier_profiles,id',

        'package_ids' => 'nullable|array',
        'package_ids.*' => 'exists:packages,id',
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | CREATE POPULAR PACKAGE
        |--------------------------------------------------------------------------
        */

        $package = PopularPackage::create([
            'name' => $request->name,
            'event_type' => $request->event_type,
            'price' => $request->price,
            'guest_capacity' => $request->guest_capacity,
            'duration_hours' => $request->duration_hours,
            'description' => $request->description,
            'min_price' => $request->min_price,
            'is_negotiable' => $request->is_negotiable ? true : false,
            'is_featured' => $request->is_featured ? true : false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SAVE INCLUSIONS (DISPLAY ONLY)
        |--------------------------------------------------------------------------
        */

        $inclusions = $request->inclusions ?? [];
        $types      = $request->inclusion_types ?? [];

        foreach ($inclusions as $key => $inc) {

            if (!empty($inc)) {

                PopularPackageInclusion::create([
                    'popular_package_id' => $package->id,
                    'title' => $inc,
                    'type' => $types[$key] ?? null,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE BUNDLE ITEMS (REAL RELATIONSHIPS)
        |--------------------------------------------------------------------------
        */

        $supplierIds = $request->supplier_ids ?? [];
        $packageIds  = $request->package_ids ?? [];

        foreach ($supplierIds as $index => $supplierId) {

            $packageId = $packageIds[$index] ?? null;

            if ($supplierId && $packageId) {

                PopularPackageItem::create([
                    'popular_package_id' => $package->id,
                    'supplier_id' => $supplierId,
                    'package_id' => $packageId,
                ]);
            }
        }

        DB::commit();

        return redirect()
            ->route('admin.popular.index')
            ->with('success', 'Popular package created successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            'Failed to create popular package.'
        );
    }
}

public function update(Request $request, PopularPackage $popular)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'event_type'        => 'required|string|max:100',
            'price'             => 'nullable|numeric|min:0',
            'guest_capacity'    => 'nullable|integer|min:1',
            'duration_hours'    => 'nullable|integer|min:1',
            'inclusions'        => 'nullable|array',
            'inclusions.*'      => 'nullable|string|max:255',
            'inclusion_types'   => 'nullable|array',
            'inclusion_types.*' => 'nullable|string|max:50',
            'supplier_ids'      => 'nullable|array',
            'supplier_ids.*'    => 'nullable|exists:suppliers,id',
            'supplier_package_ids'   => 'nullable|array',
            'supplier_package_ids.*' => 'nullable|exists:supplier_packages,id',
            'description' => 'nullable|string',
            'min_price' => 'nullable|numeric',
            'is_negotiable' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);
 
        DB::transaction(function () use ($popular, $validated) {
            $popular->update([
                'name'           => $validated['name'],
                'event_type'     => $validated['event_type'],
                'price'          => $validated['price']          ?? null,
                'guest_capacity' => $validated['guest_capacity'] ?? null,
                'duration_hours' => $validated['duration_hours'] ?? null,
                'description' => $validated['description'] ?? null,
                'min_price' => $validated['min_price'] ?? null,
                'is_negotiable' => $validated['is_negotiable'] ?? false,
                'is_featured' => $validated['is_featured'] ?? false,
            ]);
 
            // Sync inclusions (delete old, insert new)
            $popular->inclusions()->delete();
            $this->syncInclusions($popular, $validated);
 
            // Sync bundle items (delete old, insert new)
            $popular->bundleItems()->delete();
            $this->syncBundleItems($popular, $validated);
        });
 
        return redirect()->route('admin.popular.index')
            ->with('success', 'Package updated successfully.');
    }
 
    /**
     * Delete a package and all related data.
     */
public function destroy($id)
{
    $popular = PopularPackage::findOrFail($id);

    DB::transaction(function () use ($popular) {

        $popular->inclusions()->delete();

        $popular->bundleItems()->delete();

        $popular->delete();
    });

    return redirect()
        ->route('admin.popular.index')
        ->with('success', 'Package deleted successfully.');
}

    public function matching($id)
{
    $popular = PopularPackage::with('inclusions')
        ->findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | POPULAR INCLUSIONS
    |--------------------------------------------------------------------------
    */

    $popularTitles = $popular->inclusions
        ->pluck('title')
        ->map(fn ($t) => strtolower(trim($t)))
        ->toArray();

    $popularTypes = $popular->inclusions
        ->pluck('type')
        ->filter()
        ->map(fn ($t) => strtolower(trim($t)))
        ->toArray();

    /*
    |--------------------------------------------------------------------------
    | SUPPLIER PACKAGES
    |--------------------------------------------------------------------------
    */

    $packages = Package::with([
            'supplier',
            'inclusions'
        ])
        ->where('is_listed', true)
        ->whereRaw('LOWER(event_type) = ?', [
            strtolower($popular->event_type)
        ])
        ->get();

    /*
    |--------------------------------------------------------------------------
    | MATCH PACKAGES
    |--------------------------------------------------------------------------
    */

    $matchedPackages = $packages->filter(function ($pkg)
        use ($popularTitles, $popularTypes) {

        $pkgTitles = $pkg->inclusions
            ->pluck('title')
            ->map(fn ($t) => strtolower(trim($t)))
            ->toArray();

        $pkgTypes = $pkg->inclusions
            ->pluck('type')
            ->filter()
            ->map(fn ($t) => strtolower(trim($t)))
            ->toArray();

        // Match by TITLE
        $titleMatch = count(array_intersect(
            $popularTitles,
            $pkgTitles
        )) > 0;

        // Match by TYPE
        $typeMatch = count(array_intersect(
            $popularTypes,
            $pkgTypes
        )) > 0;

        return $titleMatch || $typeMatch;
    });

    return view('client.events.matching', compact(
        'popular',
        'matchedPackages'
    ));
}

}


