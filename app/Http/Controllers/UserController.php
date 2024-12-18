<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        $userTypes = ['Admin', 'SuperAdmin', 'Cashier']; // Define the user types here
        return view('users.add', compact('userTypes'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6|confirmed', // `confirmed` ensures password matches `repassword`
            'user_type' => 'required|in:Admin,SuperAdmin,Cashier',
        ]);

        // Hash the password before saving
        $validated['password'] = bcrypt($validated['password']);

        // Save the user
        User::create($validated);

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(10);
        return view('users.view', compact('users'));
    }

    public function edit(User $user)
    {
        $userTypes = ['Admin', 'SuperAdmin', 'Cashier'];
        return view('users.update', compact('user', 'userTypes'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20',
            'password' => 'nullable|confirmed|min:8',
            'user_type' => 'required|in:Admin,SuperAdmin,Cashier',
        ]);



        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $passwordEnd = bcrypt($request->input('password'));
            $user->update([
                'password' => $passwordEnd,
            ]);
        }

        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'user_type' => $request->input('user_type'),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
}
