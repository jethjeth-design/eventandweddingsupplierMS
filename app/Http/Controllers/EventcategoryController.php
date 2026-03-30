<?php

namespace App\Http\Controllers;

use App\Models\Eventcategory;
use Illuminate\Http\Request;

class EventcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventcategories = Eventcategory::all();
        return view('admin.event.list', compact('eventcategories'));
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

        Eventcategory::create($request->only('name', 'description'));

        return redirect()->route('admin.event.list')->with('success', 'Event category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Eventcategory $eventcategory)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eventcategory $eventcategory)
    {
         return view('admin.event.edit', compact('eventcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eventcategory $eventcategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $eventcategory->update($request->only('name', 'description'));

        return redirect()->route('admin.event.list')->with('success', 'Event category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eventcategory $eventcategory)
    {
        $eventcategory->delete();

        return redirect()->route('admin.event.list')->with('success', 'Event category deleted successfully.');
    }
}
