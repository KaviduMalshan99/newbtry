<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display the main POS page.
     */
    public function index()
    {
        return view('admin.POS.pos'); // Render the POS view
    }
}
