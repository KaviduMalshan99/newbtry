<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use Illuminate\Http\Request;

class BatteryController extends Controller
{
    /**
     * Display a listing of the batteries.
     */
    public function index()
    {
        $batteries = Battery::all(); // Fetch all batteries
        return view('admin.batteries.index', compact('batteries'));
    }

    /**
     * Show the form for creating a new battery.
     */
    public function create()
    {
        return view('admin.batteries.create');
    }

    /**
     * Store a newly created battery in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model_number' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'rental_price_per_day' => 'required|numeric|min:0',
        ]);

        Battery::create($validated);

        return redirect()->route('batteries.index')->with('success', 'Battery created successfully.');
    }

    /**
     * Display the specified battery.
     */
    public function show($id)
    {
        $battery = Battery::findOrFail($id);
        return view('admin.batteries.show', compact('battery'));
    }

    /**
     * Show the form for editing the specified battery.
     */
    public function edit($id)
    {
        $battery = Battery::findOrFail($id);
        return view('admin.batteries.edit', compact('battery'));
    }

    /**
     * Update the specified battery in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model_number' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'rental_price_per_day' => 'required|numeric|min:0',
        ]);

        $battery = Battery::findOrFail($id);
        $battery->update($validated);

        return redirect()->route('batteries.index')->with('success', 'Battery updated successfully.');
    }

    /**
     * Remove the specified battery from storage.
     */
    public function destroy($id)
    {
        $battery = Battery::findOrFail($id);
        $battery->delete();

        return redirect()->route('batteries.index')->with('success', 'Battery deleted successfully.');
    }
}
