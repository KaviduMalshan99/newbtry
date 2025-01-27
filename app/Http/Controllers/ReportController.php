<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\BatteryPurchase;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\LubricantOrder;
use App\Models\Rental;
use App\Models\Repair;
use App\Models\Replacement;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function customerIndex()
    {
        $customers = Customer::orderBy('updated_at', 'desc')->get();

        // Pass the customers to the view
        return view('admin.reports.customer-report', compact('customers'));
    }

    public function supplierIndex()
    {
        $suppliers = Supplier::orderBy('updated_at', 'desc')->get();
        $productTypes = ['batteries', 'lubricants'];
        return view('admin.reports.supplier-report', compact('suppliers', 'productTypes'));
    }

    public function batteryPurchaseIndex()
    {
        $purchases = BatteryPurchase::with('supplier')->orderBy('updated_at', 'desc')->get();
        return view('admin.reports.battery-purchase-report', compact('purchases'));
    }

    public function batteryIndex()
    {
        $batteries = Battery::orderBy('updated_at', 'desc')->get();
        return view('admin.reports.battery-report', compact('batteries'));
    }

    public function LubricantIndex()
    {
        $lubricants = Lubricant::orderBy('updated_at', 'desc')->get();
        return view('admin.reports.lubricant-report', compact('lubricants'));
    }

    public function completeRentalIndex()
    {
        $rentals = Rental::with('customer', 'oldBattery')->orderBy('updated_at', 'desc')->get();
        return view('admin.reports.complete-rental-report', compact('rentals'));
    }
    public function rentalIndex()
    {
        $rentals = Rental::with('customer', 'oldBattery')->orderBy('updated_at', 'desc')->get();
        return view('admin.reports.rental-report', compact('rentals'));
    }

    public function repairIndex()
    {
        // Fetch all repairs with related customer and battery details
        $repairs = Repair::with(['customer', 'repairBattery'])->get();

        // Return the view with repairs data
        return view('admin.reports.repair-report', compact('repairs'));
    }

    public function repairCompleteIndex()
    {
        // Fetch all repairs with related customer and battery details
        $repairs = Repair::with(['customer', 'repairBattery'])->get();

        // Return the view with repairs data
        return view('admin.reports.repair-complete-report', compact('repairs'));
    }

    public function batteryOrderIndex()
    {
        $battery_orders = BatteryOrder::orderBy('updated_at', 'desc')->get();

        // Pass the customers to the view
        return view('admin.reports.battery-pos-report', compact('battery_orders'));
    }

    public function lubricantOrderIndex()
    {
        $lubricant_orders = LubricantOrder::orderBy('updated_at', 'desc')->get();

        // Pass the customers to the view
        return view('admin.reports.lubricant-pos-report', compact('lubricant_orders'));
    }

    public function replacementOrderIndex()
    {
        $replacements = Replacement::orderBy('updated_at', 'desc')->get();

        // Pass the customers to the view
        return view('admin.reports.replacement-report', compact('replacements'));
    }

    public function incomeIndex(Request $request)
    {
        // Set default start and end dates (last 7 days as default)
        $startDate = $request->input('start_date', Carbon::now()->subDays(7)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Fetch battery and lubricant orders within the date range
        $batteryOrders = BatteryOrder::whereBetween('created_at', [$startDate, $endDate])->get();
        $lubricantOrders = LubricantOrder::whereBetween('created_at', [$startDate, $endDate])->get();

        // Initialize income details
        $incomeDetails = [];
        $totalIncome = 0;
        $totalDiscount = 0;
        $totalSubtotal = 0;

        // Loop through each day in the range
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dailyStart = $date->copy()->startOfDay();
            $dailyEnd = $date->copy()->endOfDay();

            // Calculate battery income, discount, and subtotal
            $dailyBatteryOrders = $batteryOrders->whereBetween('created_at', [$dailyStart, $dailyEnd]);
            $dailyBatterySubtotal = $dailyBatteryOrders->sum('subtotal');
            $dailyBatteryDiscount = $dailyBatteryOrders->sum(function ($order) {
                return $order->battery_discount + $order->old_battery_discount_value;
            });
            $dailyBatteryIncome = $dailyBatteryOrders->sum('total_price');

            // Calculate lubricant income, discount, and subtotal
            $dailyLubricantOrders = $lubricantOrders->whereBetween('created_at', [$dailyStart, $dailyEnd]);
            $dailyLubricantSubtotal = $dailyLubricantOrders->sum('subtotal');
            $dailyLubricantDiscount = $dailyLubricantOrders->sum('lubricant_discount');
            $dailyLubricantIncome = $dailyLubricantOrders->sum('total_price');

            // Calculate daily totals
            $dailySubtotal = $dailyBatterySubtotal + $dailyLubricantSubtotal;
            $dailyDiscount = $dailyBatteryDiscount + $dailyLubricantDiscount;
            $dailyTotal = $dailyBatteryIncome + $dailyLubricantIncome;

            $incomeDetails[] = [
                'date' => $date->toDateString(),
                'battery_subtotal' => $dailyBatterySubtotal,
                'lubricant_subtotal' => $dailyLubricantSubtotal,
                'subtotal' => $dailySubtotal,
                'battery_discount' => $dailyBatteryDiscount,
                'lubricant_discount' => $dailyLubricantDiscount,
                'total_discount' => $dailyDiscount,
                'total_income' => $dailyTotal,
            ];

            // Accumulate totals
            $totalIncome += $dailyTotal;
            $totalDiscount += $dailyDiscount;
            $totalSubtotal += $dailySubtotal;
        }

        return view('admin.reports.income-report', compact('incomeDetails', 'totalIncome', 'totalDiscount', 'totalSubtotal', 'startDate', 'endDate'));
    }

    public function incomeViewIndex(Request $request)
    {
        return view('admin.reports.income-report');
    }
}