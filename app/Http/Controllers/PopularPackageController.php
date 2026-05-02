<?php

namespace App\Http\Controllers;

use App\Models\PopularPackage;
use App\Models\PopularPackageInclusion;
use Illuminate\Http\Request;

class PopularPackageController extends Controller
{
    public function index()
    {
        $packages = PopularPackage::with('inclusions')->latest()->get();
        return view('admin.popular.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.popular.create');
    }

    public function store(Request $request)
{
    $package = PopularPackage::create([
        'name' => $request->name,
        'event_type' => $request->event_type,
        'price' => $request->price,
        'guest_capacity' => $request->guest_capacity,
        'duration_hours' => $request->duration_hours,
    ]);

    $inclusions = $request->inclusions ?? [];
    $types = $request->inclusion_types ?? [];

    foreach ($inclusions as $key => $inc) {

        if (!empty($inc)) {

            PopularPackageInclusion::create([
                'popular_package_id' => $package->id,
                'title' => $inc,
                'type' => $types[$key] ?? null,
            ]);
        }
    }

    return redirect()->route('admin.popular.index')
        ->with('success', 'Popular package created');
}
}

