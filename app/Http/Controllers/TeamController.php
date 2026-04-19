<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
      // Show create form
    public function create()
    {   
        $teams = Team::where('supplier_id', auth()->user()->supplier->id)->get();
        return view('supplier.packages.create', compact('teams'));
    }

    // ✅ Store new team member
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        Team::create([
            'supplier_id' => auth()->user()->supplier->id, // ✅ FIXED
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => true,
        ]);

        return redirect()->route('supplier.supplierprofile')
            ->with('success', 'Team member added successfully!');
    }

    // ✅ Edit form
    public function edit($id)
    {
        $team = Team::findOrFail($id);

        // 🔒 Security check
        if ($team->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        return view('teams.edit', compact('team'));
    }

    // ✅ Update team member
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        $team = Team::findOrFail($id);

        // 🔒 Security check
        if ($team->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $team->update([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('teams.index')
            ->with('success', 'Team updated successfully!');
    }

    // ✅ Delete team member
    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        // 🔒 Security check
        if ($team->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $team->delete();

        return redirect()->route('supplier.supplierprofile')
            ->with('success', 'Team member deleted!');
    }
}