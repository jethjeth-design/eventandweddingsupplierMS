<?php

namespace App\Http\Controllers;

use App\Models\CollaborationMember;
use Illuminate\Http\Request;

class CollaborationMemberController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'collaboration_id' => 'required|exists:collaborations,id',
        'supplier_profile_id' => 'required|exists:supplier_profiles,id',
        'role' => 'required'
    ]);

        CollaborationMember::create($request->all());

        return back()->with('success', 'Supplier invited.');
    }

    public function accept(CollaborationMember $member)
    {
        $member->update([
            'status' => 'accepted'
        ]);

        return back()->with('success', 'Accepted.');
    }

    public function reject(CollaborationMember $member)
    {
        $member->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Rejected.');
    }
    public function destroy(CollaborationMember $member)
    {
        $supplier = auth()->user()->supplier;

        // Check if owner of project
        if (
            $member->collaboration->owner_supplier_profile_id
            !=
            $supplier->id
        ) {
            return back()->with('error', 'Unauthorized action.');
        }

        $member->delete();

        return back()->with(
            'success',
            'Invitation deleted successfully.'
        );
    }
}