<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::all();
        return view('admin.venue.list', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Venue::create($request->only('name', 'description'));

        return redirect()->route('admin.venue.list')->with('success', 'Venue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        return view('admin.venue.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $venue->update($request->only('name', 'description'));

        return redirect()->route('admin.venue.list')->with('success', 'Venue updated successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
         $venue->delete();

        return redirect()->route('admin.venue.list')->with('success', 'Venue deleted successfully.');
    }
}
