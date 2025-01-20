<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPosController extends Controller
{
    /**
     * Display the Main POS view.
     */
    public function mainpos()
    {
        // Return the view located at resources/views/admin/POS/mainpos.blade.php
        return view('admin.POS.mainpos');
    }
}
