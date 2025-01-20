<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Customer;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['customer', 'battery'])->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $customers = Customer::all();
        $batteries = Battery::all();
        return view('rentals.create', compact('customers', 'batteries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'battery_id' => 'required|exists:batteries,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'required|date|after_or_equal:rental_start_date',
            'rental_cost' => 'required|numeric|min:0',
            'deposit_amount' => 'required|numeric|min:0',
        ]);

        Rental::create($request->all());

        return redirect()->route('rentals.index')->with('success', 'Rental added successfully.');
    }

    public function edit(Rental $rental)
    {
        $customers = Customer::all();
        $batteries = Battery::all();
        return view('rentals.edit', compact('rental', 'customers', 'batteries'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'battery_id' => 'required|exists:batteries,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'required|date|after_or_equal:rental_start_date',
            'rental_cost' => 'required|numeric|min:0',
            'deposit_amount' => 'required|numeric|min:0',
        ]);

        $rental->update($request->all());

        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
