<?php

namespace App\Http\Controllers;

use App\Models\OldBattery;
use Illuminate\Http\Request;

class OldBatteryController extends Controller
{
    // Display a listing of old batteries
    public function index()
    {
        $batteries = OldBattery::all();
        return view('admin.batteries.old-batteries.index', compact('batteries'));
    }

    // Show the form to create a new old battery
    public function create()
    {
        return view('admin.batteries.old-batteries.create');
    }

    // Store a newly created old battery in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'old_battery_type' => 'required|string',
            'old_battery_condition' => 'required|string',
            'old_battery_value' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        OldBattery::create($validatedData);
        return redirect()->route('admin.old-batteries.index')->with('success', 'Old Battery added successfully!');
    }

    // Display the specified old battery
    public function show($id)
    {
        $battery = OldBattery::findOrFail($id);
        return view('admin.batteries.old-batteries.show', compact('battery'));
    }

    // Show the form to edit an existing old battery
    public function edit($id)
    {
        $battery = OldBattery::findOrFail($id);
        return view('admin.batteries.old-batteries.edit', compact('battery'));
    }

    // Update the specified old battery in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'old_battery_type' => 'required|string',
            'old_battery_condition' => 'required|string',
            'old_battery_value' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $battery = OldBattery::findOrFail($id);
        $battery->update($validatedData);

        return redirect()->route('admin.old-batteries.index')->with('success', 'Old Battery updated successfully!');
    }

    // Remove the specified old battery from the database
    public function destroy($id)
    {
        $battery = OldBattery::findOrFail($id);
        $battery->delete();

        return redirect()->route('admin.old-batteries.index')->with('success', 'Old Battery deleted successfully!');
    }
}
