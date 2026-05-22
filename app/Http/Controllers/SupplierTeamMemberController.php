<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierTeamMember;

class SupplierTeamMemberController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'No supplier profile found.'
                );
        }

        $members = SupplierTeamMember::where(
                'supplier_profile_id',
                $supplier->id
            )
            ->latest()
            ->get();

        return view(
            'supplier.team_members.index',
            compact('members')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'No supplier profile found.'
                );
        }

        $request->validate([

            'name' => 'required',

            'role' => 'required',

        ]);

        $photo = null;

        /*
        |--------------------------------------------------------------------------
        | PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')
                ->store(
                    'team-members',
                    'public'
                );
        }

        SupplierTeamMember::create([

            'supplier_profile_id' => $supplier->id,

            'name' => $request->name,

            'role' => $request->role,

            'email' => $request->email,

            'phone' => $request->phone,

            'bio' => $request->bio,

            'photo' => $photo,


            'is_active' => true

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Team member added successfully.'
            );
    }

    public function update(Request $request, SupplierTeamMember $member)
    {
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'No supplier profile found.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $member->supplier_profile_id != $supplier->id
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        $request->validate([

            'name' => 'required',

            'role' => 'required',

        ]);

        $photo = $member->photo;

        /*
        |--------------------------------------------------------------------------
        | PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')
                ->store(
                    'team-members',
                    'public'
                );
        }

        $member->update([

            'name' => $request->name,

            'role' => $request->role,

            'email' => $request->email,

            'phone' => $request->phone,

            'bio' => $request->bio,

            'photo' => $photo,

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Team member updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(SupplierTeamMember $member)
    {
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'No supplier profile found.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $member->supplier_profile_id != $supplier->id
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        $member->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Team member deleted.'
            );
    }
}