<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model

class usersDetails extends Controller
{
    // Function to display the users list
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.customer_management.index', compact('users'));
    }

    // Function to update the user type
    public function updateUserType(Request $request, $id)
    {
        $request->validate([
            'user_type' => 'required|in:Admin,SuperAdmin,Cashier,User',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->user_type = $request->user_type;
            $user->save();
            return redirect()->route('customer_management.index')->with('success', 'User Type updated successfully');
        } else {
            return redirect()->route('customer_management.index')->with('error', 'User not found');
        }
    }
}
