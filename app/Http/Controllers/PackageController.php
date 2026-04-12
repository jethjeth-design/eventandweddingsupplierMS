<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Eventcategory;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $eventcategories = Eventcategory::all();
        $packages = Package::with('supplier')
        ->where('supplier_id', auth()->user()->supplier?->id)
        ->latest()
        ->get();

        return view('supplier.packages.index', compact('packages','eventcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'guest_capacity' => 'required|numeric',
        'description' => 'required',
        'event_type' => 'required',
    ]);

    $package = Package::create([
        'supplier_id' => auth()->user()->supplier->id,
        'name' => $request->name,
        'price' => $request->price,
        'guest_capacity' => $request->guest_capacity,
        'description' => $request->description,
        'event_type' => $request->event_type,
    ]);
     
       // ✅ NOW LOG ACTIVITY (SAFE)
    ActivityLogger::log('create_package', Auth::user(), [
        'package_id' => $package->id,
        'name' => $package->name, 
        'price' => $package->price,
    ]);
  
    return redirect()->route('supplier.package.index')->with('success', 'Package created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'guest_capacity' => 'required|numeric',
            'description' => 'required',
            'event_type' => 'required',
        ]);

        $package = Package::findOrFail($id);

        // store old data (optional but recommended)
        $oldData = $package->toArray();

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'guest_capacity' => $request->guest_capacity,
            'description' => $request->description,
            'event_type' => $request->event_type,
        ]);

        // ✅ Activity Log
        ActivityLogger::log('update_package', Auth::user(), [
            'package_id' => $package->id,
            'old' => $oldData,
            'new' => $package->toArray(),
        ]);

        return back()->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        // store data before delete (IMPORTANT)
        $data = $package->toArray();

        // ✅ Activity Log BEFORE delete
        ActivityLogger::log('delete_package', Auth::user(), [
            'package_id' => $package->id,
            'name' => $package->name,
            'price' => $package->price,
            'snapshot' => $data,
        ]);


        $package->delete();
        return redirect()->route('supplier.package.index')->with('success', 'Category deleted successfully.');
    }


    public function list()
    {
        $packages = Package::all();
        return view('admin.packages.list', compact('packages'));
    }

}
