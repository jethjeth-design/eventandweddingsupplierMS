<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // ✅ List all roles of supplier
    public function index()
    {
        $roles = Role::where('supplier_id', auth()->user()->supplier->id)->latest()->get();

        return view('supplier.roles.index', compact('roles'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('supplier.roles.create');
    }

    // ✅ Store role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Role::create([
            'supplier_id' => auth()->user()->supplier->id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully!');
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        // 🔒 Security check
        if ($role->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        return view('roles.edit', compact('role'));
    }

    // ✅ Update role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $role = Role::findOrFail($id);

        // 🔒 Security check
        if ($role->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully!');
    }

    // ✅ Delete role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // 🔒 Security check
        if ($role->supplier_id !== auth()->user()->supplier->id) {
            abort(403);
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully!');
    }
}