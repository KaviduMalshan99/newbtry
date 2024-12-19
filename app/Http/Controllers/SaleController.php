<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $batteries = Battery::all();
        $lubricants = Lubricant::all();
        return view('sales.create', compact('customers', 'batteries', 'lubricants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'battery_ids' => 'nullable|array',
            'lubricant_ids' => 'nullable|array',
            'quantity' => 'required|integer',
            'sale_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'payment_method' => 'required|string',
        ]);

        Sale::create($data);
        return redirect()->route('sales.index')->with('success', 'Sale created successfully!');
    }

    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $batteries = Battery::all();
        $lubricants = Lubricant::all();
        return view('sales.edit', compact('sale', 'customers', 'batteries', 'lubricants'));
    }

    public function update(Request $request, Sale $sale)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'battery_ids' => 'nullable|array',
            'lubricant_ids' => 'nullable|array',
            'quantity' => 'required|integer',
            'sale_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'payment_method' => 'required|string',
        ]);

        $sale->update($data);
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully!');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully!');
    }
}
