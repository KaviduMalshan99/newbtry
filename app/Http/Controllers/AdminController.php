<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'email' => Auth::user()->email,
        ]);
    }
}
