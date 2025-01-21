<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    // public function index()
    // {
    //     return view('admin.index', data: [
    //         'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
    //         'email' => Auth::user()->email,
    //     ]);
    // }



    // AdminController.php
public function showRegistrationForm()
{
    return view('auth.admin');
}

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

    // Create new user with a default user_type of 'SuperAdmin'
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type' => 'SuperAdmin', // Default value
    ]);

    // After registration, redirect to login page
    return redirect()->route('login');
}






}