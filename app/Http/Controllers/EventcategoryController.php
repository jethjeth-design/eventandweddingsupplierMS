<?php

namespace App\Http\Controllers;

use App\Models\Eventcategory;
use Illuminate\Support\Facades\Storage;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('event_photos', 'public');
        }

        Eventcategory::create([
            'name' => $request->name,
            'photo' => $photoPath,
            'description' => $request->description,
        ]);

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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Upload new photo if selected
        if ($request->hasFile('photo')) {

            // Delete old photo
            if (
                $eventcategory->photo &&
                Storage::disk('public')->exists($eventcategory->photo)
            ) {
                Storage::disk('public')->delete($eventcategory->photo);
            }

            // Store new photo
            $data['photo'] = $request->file('photo')
                ->store('event_photos', 'public');
        }

        $eventcategory->update($data);

        return redirect()
            ->route('admin.event.list')
            ->with('success', 'Event category updated successfully.');
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
