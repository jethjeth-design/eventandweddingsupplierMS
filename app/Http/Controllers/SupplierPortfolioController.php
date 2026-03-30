<?php

namespace App\Http\Controllers;

use App\Models\SupplierPortfolio;
use Illuminate\Http\Request;

class SupplierPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = SupplierPortfolio::where('supplier_id', auth()->id())->get();
        return view('supplier.portfolio.index', compact('portfolios'));
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',

            'video' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
        ]);

        // ✅ MULTIPLE IMAGES
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('portfolio/images', 'public');
            }
        }

        // ✅ OPTIONAL VIDEO
        $videoPath = null;

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('portfolio/videos', 'public');
        }

        // ✅ SAVE
        SupplierPortfolio::create([
            'supplier_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'images' => $imagePaths,
            'video' => $videoPath,
        ]);

        return redirect()->route('supplier.supplierprofile')->with('success', 'Portfolio created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierPortfolio $supplierPortfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierPortfolio $supplierPortfolio)
    {
        $portfolio = SupplierPortfolio::findOrFail($id);
        return view('supplier.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierPortfolio $supplierPortfolio)
    {
        $request->validate([
            'title' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10000',
        ]);

        $imagePaths = $supplierPortfolio->images;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('portfolio/images', 'public');
            }
        }

        $videoPath = $supplierPortfolio->video;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('portfolio/videos', 'public');
        }

        $supplierPortfolio->update([
            'title' => $request->title,
            'description' => $request->description,
            'images' => $imagePaths,
            'video' => $videoPath,
        ]);

        return redirect()->route('supplier.portfolio.index')->with('success', 'Portfolio updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierPortfolio $supplierPortfolio)
    {
        $supplierPortfolio->delete();
        return redirect()->route('supplier.portfolio.index')->with('success', 'Portfolio deleted!');
    }
}
