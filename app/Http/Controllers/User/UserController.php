<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // index page
    public function index()
    {
        return view('user.profile');
    }
    // update profile details
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|numeric|regex:/^01[3-9]\d{8}$/|unique:users,phone,' . $user->id,
            'address' => 'nullable|string',
        ]);
        $user->update(array_filter($validated));
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    // update password
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully.');
    }
    // update profile picture
    public function updateProfilePicture(Request $request, User $user)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $path = $request->file('photo')->store('images', 'public');
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->update(['photo' => $path]);
        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
}
