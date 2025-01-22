<?php
namespace App\Http\Controllers;

use App\Models\Battery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BatteryController extends Controller
{
    // Display the list of all batteries
    public function index()
    {
        $batteries = Battery::all();
        return view('admin.batteries.index', compact('batteries'));
    }

    // Show the form for creating a new battery
    public function create()
    {
        return view('admin.batteries.create');
    }

    // Store a newly created battery in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'capacity' => 'required|numeric',
            'voltage' => 'required|string|max:10', // Voltage can be a string (e.g., "12V")
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'warranty_period' => 'required|integer',
            'manufacturing_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'stock_quantity' => 'required|integer',
            'added_date' => 'required|date',
            'model_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('batteries', 'public');
        }

        Battery::create($validatedData);

        return redirect()->route('batteries.index')->with('success', 'Battery added successfully!');
    }

    // Show the form for editing a specific battery
    public function edit($id)
    {
        $battery = Battery::findOrFail($id); // Use findOrFail for better error handling
        return view('admin.batteries.edit', compact('battery'));
    }

    // Update the specified battery in the database
    public function update(Request $request, $id)
    {
        $battery = Battery::findOrFail($id);

        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'capacity' => 'required|numeric',
            'voltage' => 'required|string|max:10',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'warranty_period' => 'required|integer',
            'manufacturing_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'stock_quantity' => 'required|integer',
            'added_date' => 'required|date',
            'model_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Nullable for updates
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($battery->image) {
                Storage::disk('public')->delete($battery->image);
            }
            $validatedData['image'] = $request->file('image')->store('batteries', 'public');
        }

        $battery->update($validatedData);

        return redirect()->route('batteries.index')->with('success', 'Battery updated successfully!');
    }

    // Remove the specified battery from the database
    public function destroy($id)
    {
        $battery = Battery::findOrFail($id);

        // Delete the associated image
        if ($battery->image) {
            Storage::disk('public')->delete($battery->image);
        }

        $battery->delete();

        return redirect()->route('batteries.index')->with('success', 'Battery deleted successfully!');
    }
}
