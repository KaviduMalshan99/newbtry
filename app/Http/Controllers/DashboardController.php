<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from database (adjust queries as per your schema)
        $purchaseBatteryCount = DB::table('battery_purchases')->count(); // Example query
        $customerCount = DB::table('customers')->count(); // Example query
        $suppliersCount = Supplier::count(); // Example query
        $batteryCount = Battery::count(); // Example query
        $lubricantsCount = Lubricant::count(); // Example query
        $batteryOrdersCount = BatteryOrder::count(); // Example


        return view('dashboard.index', compact(
            'purchaseBatteryCount',
            'customerCount',
            'suppliersCount',
            'batteryCount',
            'lubricantsCount',
            'batteryOrdersCount'
        ));
    }

    public function getGrowthData()
    {
        $growthData = Customer::select(
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('COUNT(*) as growth'),
            DB::raw('MIN(created_at) as created_at')  // Add this for proper ordering
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b")'))
            ->orderBy('created_at')
            ->get();

        return response()->json($growthData);
    }
}
