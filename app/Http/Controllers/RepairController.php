<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Customer;
use App\Models\Repair;
use App\Models\RepairBattery;
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
            'repair_order_end_date' => 'nullable|date',
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
            'repair_order_end_date' => $validatedData['repair_order_end_date'] ?? null,
            'repair_status' => 'In Progress', // Default status
        ]);

        // Redirect to a specific page with a success message
        return redirect()->route('repairs.create')->with('success', 'Repair added successfully!');
    }

    public function edit($id)
    {
        $repair = Repair::with(['customer', 'repairBattery'])->findOrFail($id);
        $customers = Customer::all();
        return view('admin.repairs_management.update', compact('repair', 'customers'));
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
            'items_used' => 'nullable|string', // Assuming JSON string input
            'repair_cost' => 'nullable|numeric',
            'labor_charges' => 'nullable|numeric',
            'total_cost' => 'nullable|numeric',
            'repair_status' => 'nullable|string',
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
            'items_used' => $validatedData['items_used'] ? json_decode($validatedData['items_used'], true) : null,
            'repair_cost' => $validatedData['repair_cost'] ?? null,
            'labor_charges' => $validatedData['labor_charges'],
            'total_cost' => $validatedData['total_cost'],
            'repair_status' => $validatedData['repair_status'],
        ]);

        // Redirect with a success message
        return redirect()->route('repairs.index')->with('success', 'Repair updated successfully!');
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
}
