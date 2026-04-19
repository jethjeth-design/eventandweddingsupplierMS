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

        // ✅ FIX: safe inclusions
        if ($request->inclusions) {
            foreach ($request->inclusions as $item) {
                if (!empty($item)) {
                    $package->inclusions()->create([
                        'title' => $item
                    ]);
                }
            }
        }

        ActivityLogger::log('create_package', Auth::user(), [
            'package_id' => $package->id,
            'name' => $package->name, 
            'price' => $package->price,
        ]);
  
        return redirect()->route('supplier.package.index')
            ->with('success', 'Package created successfully');
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
        $package->inclusions()->delete();

        if ($request->inclusions) {
            foreach ($request->inclusions as $item) {
                if (!empty($item)) {
                    $package->inclusions()->create([
                        'title' => $item
                    ]);
                }
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

        ActivityLogger::log('update_package', Auth::user(), [
            'package_id' => $package->id,
            'old' => $oldData,
            'new' => $package->toArray(),
        ]);

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
    public function list()
    {
         $packages = Package::paginate(10);
        return view('admin.packages.list', compact('packages'));
    }
}