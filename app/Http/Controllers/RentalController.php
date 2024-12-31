<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OldBattery;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('customer', 'oldBattery')->orderBy('created_at', 'desc')->get();
        return view('admin.battery_rental_management.view', compact('rentals'));
    }

    public function create()
    {
        $customers = Customer::all();
        $oldBatteries = OldBattery::where('isActive', 1)->get();
        return view('admin.battery_rental_management.create', compact('customers', 'oldBatteries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'old_battery_id' => 'required|exists:old_batteries,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'rental_cost' => 'required|numeric|min:0',
            'advance_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $totalCost = $request->rental_cost;

        $rental = Rental::create([
            'customer_id' => $request->customer_id,
            'old_battery_id' => $request->old_battery_id,
            'rental_start_date' => $request->rental_start_date,
            'rental_end_date' => $request->rental_end_date,
            'rental_cost' => $request->rental_cost,
            'advance_amount' => $request->advance_amount ?? 0,
            'paid_amount' => $request->advance_amount ?? 0,
            'due_amount' => $totalCost - ($request->advance_amount ?? 0),
            'payment_type' => 'Cash', // Default value
            'payment_status' => $totalCost == ($request->advance_amount ?? 0) ? 'Completed' : 'Pending',
            'total_cost' => $totalCost,
            'notes' => $request->notes,
        ]);

        $oldBattery = OldBattery::find($request->old_battery_id);
        $oldBattery->isActive = 0;
        $oldBattery->save();

        return redirect()->route('rentals.bill', $rental->id)->with('success', 'Rental added successfully.');
        // return redirect()->route('rentals.index')->with('success', 'Rental added successfully.');
    }

    public function edit(Rental $rental)
    {
        $customers = Customer::all();
        $oldBatteries = OldBattery::where('isActive', 1)->get();
        return view('admin.battery_rental_management.update', compact('rental', 'customers', 'oldBatteries'));
    }

    public function update(Request $request, Rental $rental)
    {
        // Validate the input
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'old_battery_id' => 'required|exists:old_batteries,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'rental_cost' => 'required|numeric|min:0',
            'advance_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:255',
        ]);

        $oldBattery = OldBattery::find($rental->old_battery_id);
        $oldBattery->isActive = 1;
        $oldBattery->save();

        // Update the rental record
        $rental->update([
            'customer_id' => $validatedData['customer_id'],
            'old_battery_id' => $validatedData['old_battery_id'],
            'rental_start_date' => $validatedData['rental_start_date'],
            'rental_end_date' => $validatedData['rental_end_date'],
            'rental_cost' => $validatedData['rental_cost'],
            'advance_amount' => $validatedData['advance_amount'],
            'paid_amount' => $validatedData['advance_amount'],
            'due_amount' => $validatedData['rental_cost'] - $validatedData['advance_amount'],
            'payment_type' => 'Cash', // Default value
            'payment_status' => $validatedData['rental_cost'] == $validatedData['advance_amount'] ? 'Completed' : 'Pending',
            'total_cost' => $validatedData['rental_cost'],
            'notes' => $validatedData['notes'],
        ]);

        $newOldBattery = OldBattery::find($rental->old_battery_id);
        $newOldBattery->isActive = 0;
        $newOldBattery->save();

        // Redirect back with success message
        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental updated successfully!');
    }


    public function destroy(Rental $rental)
    {
        $oldBattery = OldBattery::find($rental->old_battery_id);
        $oldBattery->isActive = 1;
        $oldBattery->save();

        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully.');
    }

    public function completedRental($id)
    {
        $customers = Customer::all();
        $paymentTypes = ['Cash', 'Card', 'Bank Transfer'];
        $rental = Rental::with(['customer', 'oldBattery'])->findOrFail($id);
        $oldBatteries = OldBattery::where('isActive', 1)->get();

        return view('admin.battery_rental_management.completed-rental', compact('rental', 'customers', 'paymentTypes', 'oldBatteries'));
    }

    public function updateCompletedRental(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        // Validate request data
        $validatedData = $request->validate([
            'actual_return_date' => 'required|date|after_or_equal:rental_start_date',
            'late_return_fee' => 'nullable|numeric|min:0',
            'damage_fee' => 'nullable|numeric|min:0',
            'payable_amount' => 'nullable|numeric|min:0',
            'payment_type' => 'required|in:Cash,Card,Bank Transfer',
        ]);

        // Calculate updated values
        $totalCost = $rental->rental_cost + $validatedData['late_return_fee'] + $validatedData['damage_fee'];
        $dueAmount = $totalCost - $rental->paid_amount - $validatedData['payable_amount'];

        $totalPaid =  $rental->paid_amount + ($validatedData['payable_amount'] ?? 0);

        $paymentStatus = 'Pending';
        if ($totalPaid == $totalCost) {
            $paymentStatus = 'Completed';
        } elseif ($totalPaid > 0 && $totalPaid < $totalCost) {
            $paymentStatus = 'Not Completed';
        }

        // Update rental details
        $rental->update([
            'actual_return_date' => $validatedData['actual_return_date'],
            'late_return_fee' => $validatedData['late_return_fee'],
            'damage_fee' => $validatedData['damage_fee'],
            'total_cost' => $totalCost,
            'due_amount' => $dueAmount,
            'paid_amount' => $totalPaid,
            'payment_type' => $validatedData['payment_type'],
            'payment_status' => $paymentStatus,
        ]);

        $oldBattery = OldBattery::find($rental->old_battery_id);
        $oldBattery->isActive = 1;
        $oldBattery->save();

        // Redirect with success message
        return redirect()->route('rentals.bill', $rental->id)
            ->with('success', 'Rental completed and payment updated successfully!');
    }

    public function viewRentalDetails($id)
    {
        $rental = Rental::with(['customer', 'oldBattery'])->findOrFail($id);
        return view('admin.battery_rental_management.view-rental-details', compact('rental'));
    }

    public function generateBill($id)
    {
        $rental = Rental::with(['customer', 'oldBattery'])->findOrFail($id);
        // Current date and time
        $currentDateTime = Carbon::now()->format('d.m.Y H:i');

        // Pass the data to the view
        return view('admin.battery_rental_management.bill', [
            'rental' => $rental,
            'currentDateTime' => $currentDateTime,
        ]);
    }
}
