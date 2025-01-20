<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from database (adjust queries as per your schema)
        $purchaseBatteryCount = DB::table('battery_purchases')->count(); // Example query
        $lubricantsPurchaseCount = DB::table('lubricant_purchases')->count(); // Example query
        $suppliersCount = Supplier::count(); // Example query
        $batteryCount = Battery::count(); // Example query
        $lubricantsCount = Lubricant::count(); // Example query
        $batteryOrdersCount = BatteryOrder::count(); // Example


        return view('dashboard.index', compact(
            'purchaseBatteryCount',
            'lubricantsPurchaseCount',
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

    public function getGrowthSupplierData()
    {
        $growthSupplierData = Supplier::select(
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('COUNT(*) as growth'),
            DB::raw('MIN(created_at) as created_at')  // Add this for proper ordering
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b")'))
            ->orderBy('created_at')
            ->get();

        return response()->json($growthSupplierData);
    }

    public function getUserStatistics()
    {
        // Get current month and previous month's data
        $currentMonthUsers = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        $lastMonthUsers = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m') - 1)
            ->count();

        // Calculate percentage change for growth
        $percentageChange = 0;
        if ($lastMonthUsers > 0) {
            $percentageChange = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        }

        // Get current month's inactive users (you might need to adjust this based on your criteria)
        $inactiveUsers = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', '<', date('m'))
            ->count();

        // Calculate percentage change for inactive users (comparing to previous month)
        $lastMonthInactive = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', '<', date('m') - 1)
            ->count();

        $inactivePercentageChange = 0;
        if ($lastMonthInactive > 0) {
            $inactivePercentageChange = (($inactiveUsers - $lastMonthInactive) / $lastMonthInactive) * 100;
        }

        return [
            'active_users' => [
                'count' => $currentMonthUsers,
                'percentage' => round($percentageChange, 2)
            ],
            'inactive_users' => [
                'count' => $inactiveUsers,
                'percentage' => round($inactivePercentageChange, 2)
            ]
        ];
    }

    public function getSupplierStatistics()
    {
        // Get current month and previous month's data
        $currentMonthUsers = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        $lastMonthUsers = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m') - 1)
            ->count();

        // Calculate percentage change for growth
        $percentageChange = 0;
        if ($lastMonthUsers > 0) {
            $percentageChange = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        }

        // Get current month's inactive users (you might need to adjust this based on your criteria)
        $inactiveUsers = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', '<', date('m'))
            ->count();

        // Calculate percentage change for inactive users (comparing to previous month)
        $lastMonthInactive = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', '<', date('m') - 1)
            ->count();

        $inactivePercentageChange = 0;
        if ($lastMonthInactive > 0) {
            $inactivePercentageChange = (($inactiveUsers - $lastMonthInactive) / $lastMonthInactive) * 100;
        }

        return [
            'active_users' => [
                'count' => $currentMonthUsers,
                'percentage' => round($percentageChange, 2)
            ],
            'inactive_users' => [
                'count' => $inactiveUsers,
                'percentage' => round($inactivePercentageChange, 2)
            ]
        ];
    }

    public function getBalanceStatistics()
    {
        // Get today's date and first day of current month
        $today = now();
        $firstDayOfMonth = $today->startOfMonth();

        // Calculate total earnings (total_price)
        $totalEarnings = BatteryOrder::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum('total_price');

        // Calculate total expenses (assuming 70% of price is expense)
        $totalExpense = BatteryOrder::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum(DB::raw('total_price - subtotal')); // Adjust this calculation based on your actual expense logic

        // Calculate cashback (total of discounts)
        $totalCashback = BatteryOrder::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum(DB::raw('COALESCE(battery_discount, 0) + COALESCE(old_battery_discount_value, 0)'));

        // Get daily earnings and expenses for the chart
        $dailyData = BatteryOrder::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as earnings'),
            DB::raw('SUM(total_price - subtotal) as expenses') // Adjust based on actual expense calculation
        )
            ->whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Calculate today's changes
        $todayEarnings = BatteryOrder::whereDate('created_at', $today)
            ->sum('total_price');
        $yesterdayEarnings = BatteryOrder::whereDate('created_at', $today->copy()->subDay())
            ->sum('total_price');
        $earningsChange = $todayEarnings - $yesterdayEarnings;

        $todayExpense = BatteryOrder::whereDate('created_at', $today)
            ->sum(DB::raw('total_price - subtotal'));
        $yesterdayExpense = BatteryOrder::whereDate('created_at', $today->copy()->subDay())
            ->sum(DB::raw('total_price - subtotal'));
        $expenseChange = $todayExpense - $yesterdayExpense;

        return [
            'earnings' => [
                'total' => round($totalEarnings, 2),
                'change' => round($earningsChange, 2)
            ],
            'expense' => [
                'total' => round($totalExpense, 2),
                'change' => round($expenseChange, 2)
            ],
            'cashback' => [
                'total' => round($totalCashback, 2)
            ],
            'chart_data' => $dailyData
        ];
    }

    public function getRecentOrders()
    {
        // Define the start date (6 months ago from today)
        $startDate = Carbon::now()->subMonths(6);

        // Fetch order data
        $notCompletedPaymentOrders = BatteryOrder::where('order_date', '>=', $startDate)
            ->where('payment_status', 'Not Completed') // Assuming 'Not Completed' represents canceled orders
            ->count();

        $completedPaymentOrders = BatteryOrder::where('order_date', '>=', $startDate)
            ->where('payment_status', 'Completed') // Assuming 'Completed' represents delivered orders
            ->count();

        $pendingPaymentOrders = BatteryOrder::where('order_date', '>=', $startDate)
            ->where('payment_status', 'Pending') // Assuming 'Pending' represents orders in progress
            ->count();

        // Return the data
        return response()->json([
            'notCompletedPaymentOrders' => $notCompletedPaymentOrders,
            'completedPaymentOrders' => $completedPaymentOrders,
            'pendingPaymentOrders' => $pendingPaymentOrders,
        ]);
    }
}
