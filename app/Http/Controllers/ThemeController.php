<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes = Theme::all();
        return view('admin.themes.list', compact('themes'));
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

        Theme::create($request->only('name', 'description'));

        return redirect()->route('admin.themes.list')->with('success', 'Theme created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $theme->update($request->only('name', 'description'));

        return redirect()->route('admin.themes.list')->with('success', 'Theme updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        $theme->delete();

        return redirect()->route('admin.themes.list')->with('success', 'Theme deleted successfully.');
    }
}
