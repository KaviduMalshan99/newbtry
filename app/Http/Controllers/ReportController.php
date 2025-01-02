<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryPurchase;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\Rental;
use App\Models\Repair;
use App\Models\Supplier;
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
}
