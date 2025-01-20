<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainPosController extends Controller
{
    /**
     * Display the Main POS view.
     */
    public function mainpos()
    {
        return view('admin.POS.mainpos');
    }

    /**
     * Display the Lubricant Dashboard view.
     */
    public function lubricantdashboard()
    {
        return view('dashboard.lubricant-dashboard');
    }

    /**
     * Display the main dashboard with aggregated data.
     */
    public function index()
    {
        // Fetch aggregated data for the dashboard
        $data = [
            'purchaseBatteryCount' => DB::table('battery_purchases')->count(),
            'lubricantsPurchaseCount' => DB::table('lubricant_purchases')->count(),
            'suppliersCount' => Supplier::count(),
            'batteryCount' => Battery::count(),
            'lubricantsCount' => Lubricant::count(),
            'batteryOrdersCount' => BatteryOrder::count(),
        ];

       


        return view('dashboard.index', $data);
    }

    /**
     * Get growth data for customers.
     */
    public function getGrowthData()
    {
        $growthData = Customer::select(
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('COUNT(*) as growth'),
            DB::raw('MIN(created_at) as created_at')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b")'))
        ->orderBy('created_at')
        ->get();

        return response()->json($growthData);
    }

    /**
     * Get growth data for suppliers.
     */
    public function getGrowthSupplierData()
    {
        $growthSupplierData = Supplier::select(
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('COUNT(*) as growth'),
            DB::raw('MIN(created_at) as created_at')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b")'))
        ->orderBy('created_at')
        ->get();

        return response()->json($growthSupplierData);
    }

    /**
     * Get user statistics for active and inactive users.
     */
    public function getUserStatistics()
    {
        $currentMonth = date('m');
        $lastMonth = date('m') - 1;

        $currentMonthUsers = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $lastMonthUsers = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $lastMonth)
            ->count();

        $inactiveUsers = Customer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', '<', $currentMonth)
            ->count();

        return [
            'active_users' => [
                'count' => $currentMonthUsers,
                'percentage' => $this->calculatePercentageChange($lastMonthUsers, $currentMonthUsers),
            ],
            'inactive_users' => [
                'count' => $inactiveUsers,
                'percentage' => $this->calculatePercentageChange($lastMonthUsers, $inactiveUsers),
            ],
        ];
    }

    /**
     * Get supplier statistics for active and inactive suppliers.
     */
    public function getSupplierStatistics()
    {
        $currentMonth = date('m');
        $lastMonth = date('m') - 1;

        $currentMonthSuppliers = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $lastMonthSuppliers = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $lastMonth)
            ->count();

        $inactiveSuppliers = Supplier::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', '<', $currentMonth)
            ->count();

        return [
            'active_users' => [
                'count' => $currentMonthSuppliers,
                'percentage' => $this->calculatePercentageChange($lastMonthSuppliers, $currentMonthSuppliers),
            ],
            'inactive_users' => [
                'count' => $inactiveSuppliers,
                'percentage' => $this->calculatePercentageChange($lastMonthSuppliers, $inactiveSuppliers),
            ],
        ];
    }

    /**
     * Get balance statistics for earnings, expenses, and cashback.
     */
    public function getBalanceStatistics()
    {
        $today = now();
        $totalEarnings = BatteryOrder::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum('total_price');

        $totalExpense = BatteryOrder::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum(DB::raw('total_price - subtotal'));

        // $totalCashback = BatteryOrder::whereMonth('created_at', $today->month)
        //     ->whereYear('created_at', $today->year)
        //     ->sum(DB::raw('COALESCE(battery_discount, 0) + COALESCE(old_battery_discount_value, 0)'));

        return [
            'earnings' => ['total' => $totalEarnings],
            'expense' => ['total' => $totalExpense],
            // 'cashback' => ['total' => $totalCashback],
        ];
    }

    /**
     * Get recent order statistics.
     */
    public function getRecentOrders()
    {
        $startDate = Carbon::now()->subMonths(6);

        $notCompletedPaymentOrders = BatteryOrder::where('order_date', '>=', $startDate)
            ->where('payment_status', 'Not Completed')
            ->count();

        $completedPaymentOrders = BatteryOrder::where('order_date', '>=', $startDate)
            ->where('payment_status', 'Completed')
            ->count();

        $pendingPaymentOrders = BatteryOrder::where('order_date', '>=', $startDate)
            ->where('payment_status', 'Pending')
            ->count();

        return response()->json([
            'notCompletedPaymentOrders' => $notCompletedPaymentOrders,
            'completedPaymentOrders' => $completedPaymentOrders,
            'pendingPaymentOrders' => $pendingPaymentOrders,
        ]);
    }

    /**
     * Helper method to calculate percentage change.
     */
    private function calculatePercentageChange($previous, $current)
    {
        if ($previous == 0) {
            return 0;
        }
        return round((($current - $previous) / $previous) * 100, 2);
    }
}
