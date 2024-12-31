<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Repair;
use App\Models\RepairBattery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        // Fetch all repairs with related customer and battery details
        $repairs = Repair::with(['customer', 'repairBattery'])->get();

        // Return the view with repairs data
        return view('admin.repairs_management.view', compact('repairs'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('admin.repairs_management.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model_number' => 'required|string|max:255',
            'diagnostic_report' => 'required|string',
            'repair_order_end_date' => 'nullable|date',
            'advance_amount' => 'nullable|numeric',
        ]);

        // Create or find the battery
        $battery = RepairBattery::firstOrCreate([
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'model_number' => $validatedData['model_number'],
        ]);

        // Insert the repair record
        $repair = Repair::create([
            'customer_id' => $validatedData['customer_id'],
            'repair_battery_id' => $battery->id,
            'repair_order_start_date' => now(),
            'diagnostic_report' => $validatedData['diagnostic_report'] ?? null,
            'repair_order_end_date' => $validatedData['repair_order_end_date'] ?? null,
            'advance_amount' => $validatedData['advance_amount'],
            'repair_status' => 'In Progress', // Default status
        ]);

        // Redirect to a specific page with a success message
        // return redirect()->route('repairs.index')->with('success', 'Repair added successfully!');
        return redirect()->route('repairs.bill', $repair->id)->with('success', 'Repair added successfully!');
    }

    public function edit($id)
    {
        $repair = Repair::with(['customer', 'repairBattery'])->findOrFail($id);
        $customers = Customer::all();
        return view('admin.repairs_management.update', compact('repair', 'customers'));
    }

    public function completedOrder($id)
    {
        $repair = Repair::with(['customer', 'repairBattery'])->findOrFail($id);
        $customers = Customer::all();
        $paymentTypes = ['Cash', 'Card', 'Bank Transfer'];
        return view('admin.repairs_management.completed-order', compact('repair', 'customers', 'paymentTypes'));
    }

    public function update(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model_number' => 'required|string|max:255',
            'repair_order_end_date' => 'nullable|date',
            'diagnostic_report' => 'nullable|string',
            'advance_amount' => 'nullable|numeric',
        ]);

        // Update or create the associated battery
        $battery = RepairBattery::updateOrCreate(
            [
                'id' => $repair->repair_battery_id,
            ],
            [
                'type' => $validatedData['type'],
                'brand' => $validatedData['brand'],
                'model_number' => $validatedData['model_number'],
            ]
        );

        // Update the repair record
        $repair->update([
            'customer_id' => $validatedData['customer_id'],
            'repair_battery_id' => $battery->id,
            'repair_order_end_date' => $validatedData['repair_order_end_date'] ?? null,
            'diagnostic_report' => $validatedData['diagnostic_report'] ?? null,
            'advance_amount' => $validatedData['advance_amount'],
        ]);

        // Redirect with a success message
        return redirect()->route('repairs.index')->with('success', 'Repair updated successfully!');
    }

    public function updateCompletedRepair(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'items_used' => 'required|json', // Assuming JSON string input
            'repair_cost' => 'required|numeric',
            'labor_charges' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'repair_status' => 'required|string',
            'delivery_status' => 'required|string',
            'paid_amount' => 'nullable|numeric',
            'due_amount' => 'nullable|numeric',
            'payment_type' => 'required|in:Cash,Card,Bank Transfer',
            'advance_amount' => 'nullable|numeric',
            'payable_amount' => 'nullable|numeric',
        ]);

        $totalPrice = $validatedData['total_cost'];
        $paid_amount = $validatedData['paid_amount'];
        $payable_amount = $validatedData['payable_amount'];
        $totalPaid = $paid_amount + $payable_amount;

        $paymentStatus = 'Pending';
        if ($totalPaid == $totalPrice - $validatedData['advance_amount']) {
            $paymentStatus = 'Completed';
        } elseif ($totalPaid > 0 && $totalPaid < $totalPrice - $validatedData['advance_amount']) {
            $paymentStatus = 'Not Completed';
        }

        // Update the repair record
        $repair->update([
            'items_used' => $validatedData['items_used'] ? json_decode($validatedData['items_used'], true) : null,
            'repair_cost' => $validatedData['repair_cost'] ?? null,
            'labor_charges' => $validatedData['labor_charges'],
            'total_cost' => $totalPrice,
            'repair_status' => $validatedData['repair_status'],
            'delivery_status' => $validatedData['delivery_status'],
            'paid_amount' => $totalPaid,
            'due_amount' => $totalPrice - $totalPaid - $validatedData['advance_amount'],
            'payment_type' => $validatedData['payment_type'],
            'payment_status' => $paymentStatus,
        ]);

        // Redirect with a success message
        // return redirect()->route('repairs.index')->with('success', 'Repair updated successfully!');
        return redirect()->route('repairs.bill', $repair->id)->with('success', 'Repair updated successfully!');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->route('repairs.index')->with('success', 'Repair deleted successfully.');
    }

    public function viewRepairDetails($id)
    {
        $repair = Repair::with(['customer', 'repairBattery'])->findOrFail($id);
        return view('admin.repairs_management.view-repair-details', compact('repair'));
    }

    public function changeStatus(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'repair_status' => 'nullable|string',
        ]);
        $repair->update([
            'repair_status' => $validatedData['repair_status'],
        ]);

        return redirect()->route('repairs.view-repair-details', $id)->with('success', 'Repair status updated successfully!');
    }

    public function changeDeliveryStatus(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'delivery_status' => 'nullable|string',
        ]);
        $repair->update([
            'delivery_status' => $validatedData['delivery_status'],
        ]);

        return redirect()->route('repairs.view-repair-details', $id)->with('success', 'Delivery status updated successfully!');
    }

    public function generateBill($id)
    {
        $repair = Repair::with(['customer', 'repairBattery'])->findOrFail($id);
        // Current date and time
        $currentDateTime = Carbon::now()->format('d.m.Y H:i');
        $companyDetails = Company::first();

        // Pass the data to the view
        return view('admin.repairs_management.bill', [
            'repair' => $repair,
            'currentDateTime' => $currentDateTime,
            'companyDetails' => $companyDetails,
        ]);
    }
}
