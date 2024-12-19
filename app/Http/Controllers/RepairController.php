<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Customer;
use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::with(['customer', 'battery'])->paginate(10);
        return view('repairs.index', compact('repairs'));
    }

    public function create()
    {
        $customers = Customer::all();
        $batteries = Battery::all();
        return view('repairs.create', compact('customers', 'batteries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'battery_id' => 'required|exists:batteries,id',
            'repair_cost' => 'required|numeric|min:0',
            'repair_details' => 'required|string',
        ]);

        Repair::create($request->all());

        return redirect()->route('repairs.index')->with('success', 'Repair added successfully.');
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
