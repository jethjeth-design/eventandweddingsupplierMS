<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {        $user->delete();
        return redirect()->route('admin.user')->with('success', 'User deleted successfully.');
    }
}
