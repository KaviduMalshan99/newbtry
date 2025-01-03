<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from database (adjust queries as per your schema)
        $purchaseBatteryCount = DB::table('purchases')->count(); // Example query
        $customerCount = DB::table('customers')->count(); // Example query

        return view('dashboard.index', compact('purchaseBatteryCount', 'customerCount'));
    }
}
