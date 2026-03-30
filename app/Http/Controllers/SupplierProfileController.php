<?php

namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use App\Models\SupplierPortfolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $portfolios = SupplierPortfolio::where('supplier_id', auth()->id())->get();
        $supplierProfile = SupplierProfile::where('user_id', auth()->id())->first();
        return view('supplier.supplierprofile', compact('supplierProfile', 'portfolios'));
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
            'supplier_id' => 'required|exists:suppliers,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::create([
            'user_id' => auth()->id(),
            'supplier_id' => $request->supplier_id,
            'rating' => $request->rating,
        ]);

        // 🔥 Update supplier average rating
        $supplier = Supplier::find($request->supplier_id);

        $average = $supplier->ratings()->avg('rating');

        $supplier->update([
            'rating' => round($average, 2)
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierProfile $supplierProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierProfile $supplierProfile)
    {
        $categories = Category::all();
        return view('supplier.editprofile', compact('supplierProfile', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierProfile $supplierProfile)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'business_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'experience' => 'nullable|string',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'rating' => 'required|numeric|min:0|max:5',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
        ]);
        
        // ✅ ADD THIS BLOCK (PHOTO UPDATE)
    if ($request->hasFile('photo')) {

        // delete old photo
        if ($supplierProfile->photo && Storage::exists('public/' . $supplierProfile->photo)) {
            Storage::delete('public/' . $supplierProfile->photo);
        }

        // store new photo
        $photoPath = $request->file('photo')->store('profiles', 'public');

        // save to model
        $supplierProfile->photo = $photoPath;
        $supplierProfile->save();
    }

        $supplierProfile->update($request->only(
            'first_name',
            'last_name',
            'business_name',
            'tagline',
            'phone',
            'city',
            'province',
            'bio',
            'experience',
            'category',
            'description',
            'address'

        ));
             
        return redirect()->route('supplier.supplierprofile')->with('success', 'Profile updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierProfile $supplierProfile)
    {
            $supplier = SupplierProfile::findOrFail($id);

        // DELETE PHOTO FILE
        if ($supplier->photo && Storage::exists('public/' . $supplier->photo)) {
            Storage::delete('public/' . $supplier->photo);
        }

        // DELETE DATABASE RECORD
        $supplier->delete();
        return redirect()->route('supplier.supplierprofile')->with('success', 'Supplier profile deleted successfully.');
    }
}
