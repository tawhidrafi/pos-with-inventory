<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LoginHistory;
use App\Models\Admin\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    // public function index()
    // {
    //     return view('user.dashboard');
    // }
    //  
    public function loginHistory()
    {
        $loginHistories = LoginHistory::with('user')->get();
        return view('admin.login-history', compact('loginHistories'));
    }
    //
    public function users()
    {
        $users = User::with('role')->get();
        return view('admin.users',  compact('users',));
    }
    //
    public function userEdit(User $user)
    {
        $roles = Role::all();
        return view('admin.user-edit', compact('user', 'roles'));
    }
    public function updateRole(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Find the user
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('success', 'User not found');
        }

        $user->role_id = $validated['role_id'];
        $user->save();

        return redirect()->route('users')->with('success', 'Role assigned successfully');
    }
}
