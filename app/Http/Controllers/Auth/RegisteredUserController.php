<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SupplierProfile;
use App\Models\Category;
use App\Helpers\ActivityLogger;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'client',
            'password' => Hash::make($request->password),
        ]);
        
        ActivityLogger::log('register', $user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }





     // Show supplier registration form
    public function createSupplier()
    {
        $categories = Category::all();
        return view('auth.register-supplier', compact('categories'));
    }

    // Store supplier
    public function storeSupplier(Request $request)
    {
        $request->validate([
        'name' => ['required','string','max:255'],
        'email' => ['required','string','email','max:255','unique:users'],
        'password' => ['required','confirmed','min:8'],

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
        'experience' => 'nullable|string',
        'category_id' => 'required|array',
        'category_id.*' => 'exists:categories,id',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'supplier', // set role
            'password' => Hash::make($request->password),
        ]);

        ActivityLogger::log('register', $user);
        
        // ✅ HANDLE PHOTO UPLOAD
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('supplier_photos', 'public');
    }

    // ✅ CREATE SUPPLIER PROFILE (CONNECTED TO USER)
    $supplier = SupplierProfile::create([
        'user_id' => $user->id,

        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'photo' => $photoPath,
        'business_name' => $request->business_name,
        'tagline' => $request->tagline,
        'phone' => $request->phone,
        'city' => $request->city,
        'province' => $request->province,
        'bio' => $request->bio,
        'experience' => $request->experience,
        'description' => $request->description,
        'address' => $request->address,
        // ✅ ADD THIS (FIX)
        'price' => $request->price,
    ]);

    
        event(new Registered($user));

        auth()->login($user);
        
        // ✅ FIXED
        $supplier->categories()->sync($request->category_id);
        // redirect to supplier landing page
        return redirect(route('supplier.dashboard', absolute: false));
    }

}


  