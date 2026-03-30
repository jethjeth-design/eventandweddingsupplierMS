<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.location.list', compact('locations'));
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

        Location::create($request->only('name', 'description'));

        return redirect()->route('admin.location.list')->with('success', 'Location category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
         return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $location->update($request->only('name', 'description'));

        return redirect()->route('admin.location.list')->with('success', 'Location category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.location.list')->with('success', 'Location category deleted successfully.');
    }
}
