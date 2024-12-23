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
        $repairs = Repair::with(['customer'])->paginate(10);
        return view('repairs.index', compact('repairs'));
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

    public function edit(Repair $repair)
    {
        $customers = Customer::all();
        $batteries = Battery::all();
        return view('repairs.edit', compact('repair', 'customers', 'batteries'));
    }

    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'battery_id' => 'required|exists:batteries,id',
            'repair_cost' => 'required|numeric|min:0',
            'repair_details' => 'required|string',
        ]);

        $repair->update($request->all());

        return redirect()->route('repairs.index')->with('success', 'Repair updated successfully.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->route('repairs.index')->with('success', 'Repair deleted successfully.');
    }
}
