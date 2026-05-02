<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Team;
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
            'name' => 'required',
            'price' => 'required|numeric',
            'guest_capacity' => 'required|numeric',
            'description' => 'required',
            'event_type' => 'required',

            // ✅ FIX: inclusions validation
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'nullable|string',

            // ✅ FIX: teams validation
            'teams' => 'nullable|array',
        ]);

        $package = Package::create([
            'supplier_id' => auth()->user()->supplier->id,
            'name' => $request->name,
            'price' => $request->price,
            'guest_capacity' => $request->guest_capacity,
            'description' => $request->description,
            'event_type' => $request->event_type,
        ]);

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

  
        return redirect()->route('supplier.package.index')
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

            'teams' => 'nullable|array',
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

        // ✅ FIX: sync teams with roles
        $syncData = [];

        if ($request->teams) {
            foreach ($request->teams as $teamId) {
                $syncData[$teamId] = [
                    'role_in_package' => $request->roles[$teamId] ?? null
                ];
            }
        }

        $package->teams()->sync($syncData);


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

        ActivityLogger::log('delete_package', Auth::user(), [
            'package_id' => $package->id,
            'name' => $package->name,
            'price' => $package->price,
            'snapshot' => $data,
        ]);

        $package->delete();

        return redirect()->route('supplier.package.index')
            ->with('success', 'Package deleted successfully.');
    }
    
    public function showAssignTeams($id)
    {   
        if (!auth()->user()->hasVerifiedEmail()) {
            return redirect()->back()->with('error', 'Please verify your email before booking.');
        }
        $package = Package::findOrFail($id);

        $teams = Team::where('supplier_id', auth()->user()->supplier->id)->get();

        return view('supplier.packages.create', compact('package', 'teams'));
    }
    
    public function assignTeams(Request $request, $id)
    {
        $request->validate([
            'teams' => 'nullable|array'
        ]);

        $package = Package::findOrFail($id);

        // 🔒 Security check
        if ($package->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $syncData = [];

        if ($request->teams) {
            foreach ($request->teams as $teamId) {
                $syncData[$teamId] = [
                    'role_in_package' => $request->roles[$teamId] ?? null
                ];
            }
        }

        // ✅ THIS SAVES TO PIVOT
        $package->teams()->sync($syncData);

        return back()->with('success', 'Teams assigned successfully!');
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