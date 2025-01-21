<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileDetails extends Controller
{
    /**
     * Show the profile details.
     */
    public function show()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('admin.profile.profile', compact('user'));
    }

    /**
     * Update the profile details.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone_number' => 'nullable|string|max:15',
            'user_type' => 'required|string', // Ensure user_type is included
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->user_type = $request->user_type;

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
