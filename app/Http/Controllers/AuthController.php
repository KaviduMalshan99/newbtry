<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle Registration Form Submission
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // After registration, redirect to login page
        return redirect()->route('login');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login Form Submission
    public function login(Request $request)
    {
        // Validate user credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Storing user information in the session
            $user = Auth::user();
            session([
                'user_id' => $user->user_id,
                'user_name' => $user->name,
                'user_email' => $user->email
            ]);
            
            return redirect()->route('admin.index'); // Redirect to admin dashboard
        }
    
        // If login fails, redirect back with an error
        return back()->withErrors(['login' => 'Invalid credentials']);
    }
    

    // Handle Logout
    public function logout()
    {
        Auth::logout();
        
        // Clear session data
        session()->flush();
        
        return redirect()->route('login'); // Redirect to login page
    }
    
}
