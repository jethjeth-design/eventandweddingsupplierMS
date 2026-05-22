<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Eventcategory;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {   
        $eventcategories = Eventcategory::all();

        $packages = Package::with('supplier')
            ->where('supplier_id', auth()->user()->supplier?->id)
            ->latest()
            ->get();

        return view('supplier.packages.index', compact('packages','eventcategories'));
    }

    public function listing()
    {
        $supplierId = auth()->user()->supplier->id;

        $packages = \App\Models\Package::with('inclusions')
            ->where('supplier_id', $supplierId)
            ->latest()
            ->get();

        return view('supplier.packages.listing', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'guest_capacity' => 'required|numeric|min:1',
            'description' => 'required|string',
            'event_type' => 'required|string|max:255',

            // inclusions
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'nullable|string|max:255',

            'inclusion_types' => 'nullable|array',
            'inclusion_types.*' => 'nullable|string|max:100',

            // optional (for future bidding system)
            'is_listed' => 'nullable|boolean',
            'is_negotiable' => 'nullable|boolean',
            'min_price' => 'nullable|numeric|min:0',
        ]);

        // 🧠 SAFETY: ensure supplier exists
        $supplier = auth()->user()->supplier;

        if (!$supplier) {
            return back()->withErrors(['error' => 'Supplier profile not found.']);
        }

        // 🏗️ Create package
        $package = Package::create([
            'supplier_id' => $supplier->id,
            'name' => $request->name,
            'price' => $request->price,
            'guest_capacity' => $request->guest_capacity,
            'description' => $request->description,
            'event_type' => $request->event_type,

            // optional improvements for bidding system
            'is_listed' => $request->is_listed ?? false,
            'is_negotiable' => $request->is_negotiable ?? false,
            'min_price' => $request->min_price,
        ]);

        // 📦 Inclusions handling (clean + safe)
        $inclusions = $request->inclusions ?? [];
        $types = $request->inclusion_types ?? [];

        foreach ($inclusions as $key => $item) {
            if (!empty($item)) {
                $package->inclusions()->create([
                    'title' => $item,
                    'type'  => $types[$key] ?? null,
                ]);
            }
        }

        return redirect()
            ->route('supplier.package.index')
            ->with('success', 'Package created successfully');
    }
    public function togglePublish($id)
    {
        $package = Package::findOrFail($id);

        // 🔒 Security check
        if ($package->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $package->update([
            'is_listed' => !$package->is_listed
        ]);

        return back()->with('success', 'Package visibility updated.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'guest_capacity' => 'required|numeric',
            'description' => 'required',
            'event_type' => 'required',

            'inclusions' => 'nullable|array',
            'inclusions.*' => 'nullable|string',


            // optional (for future bidding system)
            'is_listed' => 'nullable|boolean',
            'is_negotiable' => 'nullable|boolean',
            'min_price' => 'nullable|numeric|min:0',
        ]);

        $package = Package::findOrFail($id);

        // 🔒 Security check
        if ($package->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $oldData = $package->toArray();

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'guest_capacity' => $request->guest_capacity,
            'description' => $request->description,
            'event_type' => $request->event_type,

            // optional improvements for bidding system
            'is_listed' => $request->is_listed ?? false,
            'is_negotiable' => $request->is_negotiable ?? false,
            'min_price' => $request->min_price,
        ]);

        // ✅ FIX: update inclusions (delete + recreate)
        $inclusions = $request->inclusions ?? [];
        $types = $request->inclusion_types ?? [];

        // For update (only if needed)
        $package->inclusions()->delete();

        foreach ($inclusions as $key => $item) {

            if (!empty($item)) {

                $package->inclusions()->create([
                    'title' => $item,
                    'type'  => $types[$key] ?? null,
                ]);
            }
        }


        return back()->with('success', 'Package updated successfully!');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        // 🔒 Security check
        if ($package->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $data = $package->toArray();
        $package->delete();

        return redirect()->route('supplier.package.index')
            ->with('success', 'Package deleted successfully.');
    }
    
    
 
    public function list(Request $request)
    {
    $search = $request->input('search');
    $status = $request->input('status'); // listed / unlisted

    $packages = Package::with(['supplier', 'inclusions'])
        ->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('event_type', 'like', "%{$search}%")
              ->orWhereHas('supplier', function ($s) use ($search) {
                  $s->where('business_name', 'like', "%{$search}%");
              });
        })
        ->when($status !== null, function ($q) use ($status) {
            $q->where('is_listed', $status);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('admin.packages.list', compact('packages'));
    }
}