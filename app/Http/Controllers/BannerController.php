<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::latest()->first();
        return view('admin.homepage.banner', compact('banner'));
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
            'hero_tag' => 'required',
            'hero_title_1' => 'required',
            'hero_title_2' => 'required',
            'hero_subtitle' => 'required',
            'slide_1' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'slide_2' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'slide_3' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'slide_4' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'slide_5' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $data = [
            'hero_tag' => $request->hero_tag,
            'hero_title_1' => $request->hero_title_1,
            'hero_title_2' => $request->hero_title_2,
            'hero_subtitle' => $request->hero_subtitle,
        ];
    
        
    foreach (['slide_1','slide_2','slide_3','slide_4','slide_5'] as $slide) {
    if ($request->hasFile($slide)) {
        $file = $request->file($slide);

        // unique filename
        $filename = time() . '_' . $slide . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('banners', $filename, 'public');

        $data[$slide] = $path;
    }
}
    

    Banner::create($data);
         

        return redirect()->route('admin.homepage.banners')->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.homepage.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
        // ✅ TEXT FIELDS
        'hero_tag' => 'required',
        'hero_title_1' => 'required',
        'hero_title_2' => 'required',
        'hero_subtitle' => 'required',

        // ✅ IMAGES
        'slide_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'slide_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'slide_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'slide_4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'slide_5' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ✅ UPDATE TEXT FIRST
    $banner->update([
        'hero_tag' => $request->hero_tag,
        'hero_title_1' => $request->hero_title_1,
        'hero_title_2' => $request->hero_title_2,
        'hero_subtitle' => $request->hero_subtitle,
    ]);

    // ✅ UPDATE IMAGES
    foreach (['slide_1','slide_2','slide_3','slide_4','slide_5'] as $slide) {

        if ($request->hasFile($slide)) {

            // Delete old file
            if ($banner->$slide && Storage::disk('public')->exists($banner->$slide)) {
                Storage::disk('public')->delete($banner->$slide);
            }

            // Store new file
            $file = $request->file($slide);
            $filename = $slide . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('banners', $filename, 'public');

            $banner->$slide = $path;
        }
    }

    // ✅ SAVE IMAGE CHANGES
    $banner->save();

            return redirect()->route('admin.homepage.banners')->with('success', 'Banner updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.homepage.banners')->with('success', 'Banner deleted successfully.');
    }
}
