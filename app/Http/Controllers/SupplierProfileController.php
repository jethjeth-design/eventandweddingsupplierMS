<?php

namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use App\Models\SupplierPortfolio;
use App\Models\User;
use App\Models\Category;
use App\Models\Role;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
    $user = auth()->user();

    $supplier = $user->supplier;

    $portfolios = SupplierPortfolio::where('supplier_id', $user->id)->get();

    $roles = $supplier
        ? Role::where('supplier_id', $supplier->id)->latest()->get()
        : collect();

    $teams = $supplier
        ? Team::where('supplier_id', $supplier->id)->get()
        : collect();

    $supplierProfile = SupplierProfile::with('categories')
        ->where('user_id', $user->id)
        ->first();

        return view('supplier.supplierprofile', compact('supplierProfile', 'portfolios','teams', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('supplier.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {
        $request->validate([
            // Supplier fields
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            
        ]);
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('supplier_photos', 'public');
            }
        $supplier = SupplierProfile::create([
            'user_id' => auth()->id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'photo' => $photoPath,
            'business_name' => $request->business_name,
            'tagline' => $request->tagline,
            'phone' => $request->phone,
            'city' => $request->city,
            'province' => $request->province,
            'bio' => $request->bio,
            'description' => $request->description,
            'address' => $request->address,
            
        ]);

        // ✅ FIXED
        $supplier->categories()->sync($request->category_id);
        
          return redirect()->route('supplier.supplierprofile')->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierProfile $supplierProfile)
    {
        $supplierProfile = SupplierProfile::all();
        return view('welcomepage.profile', compact('supplierProfile'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierProfile $supplierProfile)
    {
        $categories = Category::all();
        return view('supplier.editprofile', compact('supplierProfile', 'categories'));
    }
    
    //seperated edit 
    public function editidentity(SupplierProfile $supplierProfile)
    {
        $categories = Category::all();
        return view('supplier.editidentity', compact('supplierProfile', 'categories'));
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
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // ✅ Prepare data for update
        $data = $validatedData;

        // ✅ Handle photo upload
        if ($request->hasFile('photo')) {

            // delete old photo
            if ($supplierProfile->photo && Storage::disk('public')->exists($supplierProfile->photo)) {
                Storage::disk('public')->delete($supplierProfile->photo);
            }

            // store new photo
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        // ✅ Update everything in one go
        $supplierProfile->update($data);
          // ✅ IMPORTANT FIX
        $supplierProfile->categories()->sync($request->category_id);    
        return redirect()->route('supplier.supplierprofile')->with('success', 'Profile updated successfully.');

    }


    //Separated Update
    public function updateidentity(Request $request, SupplierProfile $supplierProfile)
    {


        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'business_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
        ]);

        // ✅ Prepare data for update
        $data = $validatedData;

        // ✅ Handle photo upload
        if ($request->hasFile('photo')) {

            // delete old photo
            if ($supplierProfile->photo && Storage::disk('public')->exists($supplierProfile->photo)) {
                Storage::disk('public')->delete($supplierProfile->photo);
            }

            // store new photo
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        // ✅ Update everything in one go
        $supplierProfile->update($data);

        // ✅ IMPORTANT FIX
    $supplierProfile->categories()->sync($request->category_id);
             
        return redirect()->route('supplier.supplierprofile')->with('success', 'Profile updated successfully.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierProfile $supplierProfile)
    {
        $supplier = SupplierProfile::findOrFail($id);

        if ($supplierProfile->photo && Storage::disk('public')->exists($supplierProfile->photo)) {
            Storage::disk('public')->delete($supplierProfile->photo);
        }

        $supplierProfile->delete();

        return redirect()->route('supplier.supplierprofile')
            ->with('success', 'Supplier profile deleted successfully.');
    }


    //admin supplier management

        public function list()
        {
            $supplierProfiles = SupplierProfile::latest()->get();
            return view('admin.supplier.list', compact('supplierProfiles'));
        }

        public function destroyAdmin($id)
        {
            $supplier = SupplierProfile::findOrFail($id);

            // DELETE PHOTO FILE
            if ($supplier->photo && Storage::exists('public/' . $supplier->photo)) {
                Storage::delete('public/' . $supplier->photo);
            }

            // DELETE DATABASE RECORD
            $supplier->delete();
            return redirect()->route('admin.suppliers.index')->with('success', 'Supplier profile deleted successfully.');
        }
}
