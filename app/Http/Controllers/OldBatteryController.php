<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\OldBattery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OldBatteryController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $old_battery_conditions = ['Good', 'Average', 'Poor'];
        return view('admin.old_batteries_management.create', compact('customers', 'old_battery_conditions'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'old_battery_type' => 'required|string',
            'old_battery_condition' => 'required|in:Good,Average,Poor',
            'old_battery_value' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        // Store the data in the database
        $oldBattery = OldBattery::create([
            'customer_id' => $validatedData['customer_id'],
            'old_battery_type' => $validatedData['old_battery_type'],
            'old_battery_condition' => $validatedData['old_battery_condition'],
            'old_battery_value' => $validatedData['old_battery_value'],
            'battery_status' => 'Direct', // Assuming 'Direct' as the default value
            'notes' => $validatedData['notes'],
        ]);

        // Redirect back with a success message
        // return redirect()->route('oldBatteries.index')->with('success', 'Old battery added successfully.');
        return redirect()->route('oldBatteries.bill', $oldBattery->id)->with('success', 'Old battery added successfully.');
    }

    public function index()
    {
        // Fetch all old batteries with related customer details
        $oldBatteries = OldBattery::with('customer')->get();

        // Return the view with old batteries data
        return view('admin.old_batteries_management.view', compact('oldBatteries'));
    }

    public function edit($id)
    {
        $oldBattery = OldBattery::findOrFail($id);
        $customers = Customer::all();
        $old_battery_conditions = ['Good', 'Average', 'Poor'];
        return view('admin.old_batteries_management.update', compact('oldBattery', 'customers', 'old_battery_conditions'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'old_battery_type' => 'required|string',
            'old_battery_condition' => 'required|in:Good,Average,Poor',
            'old_battery_value' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        // Find the old battery by ID
        $oldBattery = OldBattery::findOrFail($id);

        // Update the old battery data
        $oldBattery->update([
            'customer_id' => $validatedData['customer_id'],
            'old_battery_type' => $validatedData['old_battery_type'],
            'old_battery_condition' => $validatedData['old_battery_condition'],
            'old_battery_value' => $validatedData['old_battery_value'],
            'notes' => $validatedData['notes'],
        ]);

        // Redirect back with a success message
        return redirect()->route('oldBatteries.index')->with('success', 'Old battery updated successfully.');
    }

    public function viewOldBatteryDetails($id)
    {
        // Fetch the old battery with related customer details
        $oldBattery = OldBattery::with('customer')->findOrFail($id);

        // Return the view with old battery data
        return view('admin.old_batteries_management.view_old_battery', compact('oldBattery'));
    }

    public function destroy($id)
    {
        // Find the old battery by ID
        $oldBattery = OldBattery::findOrFail($id);

        // Delete the old battery
        $oldBattery->delete();

        // Redirect back with a success message
        return redirect()->route('oldBatteries.index')->with('success', 'Old battery deleted successfully.');
    }

    public function generateBill($id)
    {
        $oldBattery = OldBattery::with(['customer'])->findOrFail($id);
        // Current date and time
        $currentDateTime = Carbon::now()->format('d.m.Y H:i');
        $companyDetails = Company::first();

        // Pass the data to the view
        return view('admin.old_batteries_management.bill', [
            'oldBattery' => $oldBattery,
            'currentDateTime' => $currentDateTime,
            'companyDetails' => $companyDetails,
        ]);
    }
}
