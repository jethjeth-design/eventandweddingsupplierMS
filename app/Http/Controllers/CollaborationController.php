<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Models\CollaborationMember;
use App\Models\SupplierProfile;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // ✅ FIX
        $supplier = auth()->user()->supplier;

        // Prevent null errors
        if (!$supplier) {

            return redirect()
                ->back()
                ->with('error', 'No supplier profile found.');
        }

        /*
        |--------------------------------------------------------------------------
        | AUTO STATUS UPDATE
        |--------------------------------------------------------------------------
        */

        $allProjects = Collaboration::all();

        foreach ($allProjects as $project) {

            if (!$project->event_date) {
                continue;
            }

            $today = now()->toDateString();

            if ($project->status != 'completed') {

                if ($project->event_date > $today) {

                    $project->update([
                        'status' => 'upcoming'
                    ]);

                } elseif ($project->event_date == $today) {

                    $project->update([
                        'status' => 'ongoing'
                    ]);

                } elseif ($project->event_date < $today) {

                    $project->update([
                        'status' => 'completed'
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MY PROJECTS
        |--------------------------------------------------------------------------
        */

            $projects = Collaboration::with([
                'members.supplier'
            ])
            ->where('owner_supplier_profile_id', $supplier->id)
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | INVITATIONS
        |--------------------------------------------------------------------------
        */

        $invites = CollaborationMember::with([
                'collaboration.owner'
            ])
            ->where('supplier_profile_id', $supplier->id)
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SUPPLIERS DROPDOWN
        |--------------------------------------------------------------------------
        */

        $suppliers = SupplierProfile::where(
                'id',
                '!=',
                $supplier->id
            )
            ->latest()
            ->get();

        return view(
            'supplier.collaborations.index',
            compact(
                'projects',
                'invites',
                'suppliers'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // ✅ FIX
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with('error', 'No supplier profile found.');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'title' => 'required|string|max:255',

            'event_date' => 'nullable|date',

            'budget' => 'nullable|numeric',

            'supplier_profile_id' =>
                'nullable|exists:supplier_profiles,id',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE PROJECT
        |--------------------------------------------------------------------------
        */

        $project = Collaboration::create([

            'owner_supplier_profile_id' => $supplier->id,

            'title' => $request->title,

            'description' => $request->description,

            'event_date' => $request->event_date,

            'location' => $request->location,

            'budget' => $request->budget,

            'status' => 'upcoming'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE INVITATION
        |--------------------------------------------------------------------------
        */

        if ($request->supplier_profile_id) {

            CollaborationMember::create([

                'collaboration_id' => $project->id,

                'supplier_profile_id' =>
                    $request->supplier_profile_id,

                'role' => $request->role,

                'responsibilities' =>
                    $request->responsibilities,

                'agreed_price' =>
                    $request->agreed_price,

                'status' => 'pending'
            ]);
        }

        return redirect()
            ->route('collaborations.index')
            ->with(
                'success',
                'Project created and invitation sent.'
            );
    }

    public function update(Request $request, Collaboration $collaboration)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTH SUPPLIER
        |--------------------------------------------------------------------------
        */

        $supplier = auth()->user()->supplier;

        // Prevent null errors
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
        | CHECK PROJECT OWNER
        |--------------------------------------------------------------------------
        */

        if (
            $collaboration->owner_supplier_profile_id
            !=
            $supplier->id
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'event_date' => 'nullable|date',

            'location' => 'nullable|string|max:255',

            'budget' => 'nullable|numeric|min:0',

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE PROJECT
        |--------------------------------------------------------------------------
        */

        $collaboration->update([

            'title' => $request->title,

            'description' => $request->description,

            'event_date' => $request->event_date,

            'location' => $request->location,

            'budget' => $request->budget,

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('collaborations.index')
            ->with(
                'success',
                'Project updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Collaboration $collaboration)
    {
        $collaboration->load(
            'members.supplier'
        );

        $suppliers = SupplierProfile::latest()->get();

        return view(
            'supplier.collaborations.show',
            compact(
                'collaboration',
                'suppliers'
            )
        );
    }

    public function destroy(Collaboration $collaboration)
    {
        // ✅ FIX
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with('error', 'No supplier profile found.');
        }

        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $collaboration->owner_supplier_profile_id
            !=
            $supplier->id
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE PROJECT
        |--------------------------------------------------------------------------
        */

        $collaboration->delete();

        return redirect()
            ->route('collaborations.index')
            ->with(
                'success',
                'Project deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    public function complete(Collaboration $collaboration)
    {
        // ✅ FIX
        $supplier = auth()->user()->supplier;

        if (!$supplier) {

            return redirect()
                ->back()
                ->with('error', 'No supplier profile found.');
        }

        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $collaboration->owner_supplier_profile_id
            !=
            $supplier->id
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | COMPLETE PROJECT
        |--------------------------------------------------------------------------
        */

        $collaboration->update([

            'status' => 'completed'
        ]);

        return redirect()
            ->route('collaborations.index')
            ->with(
                'success',
                'Project marked as completed.'
            );
    }
    
}