<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\SupplierProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function editAdmin()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function editSupplier()
    {
        $supplierProfile = SupplierProfile::where('user_id', auth()->id())->first();
        return view('profile.edit', [
            'user' => auth()->user(),
            'supplierProfile' => $supplierProfile   
        ]);
    }

    public function editClient()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
         $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // ROLE BASED REDIRECT
    if ($user->isAdmin()) {
        return redirect()->route('admin.profile')
            ->with('success', 'Admin profile updated successfully.');
    }

    if ($user->isSupplier()) {
        return redirect()->route('supplier.profile')
            ->with('success', 'Supplier profile updated successfully.');
    }

    return redirect()->route('client.profile')
        ->with('success', 'Client profile updated successfully.');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
