<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BatteryController extends Controller
{
    public function index()
    {
        $batteries = Battery::all();
        return view('admin.batteries.index', compact('batteries'));
    }

    public function create()
    {
        return view('admin.batteries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model_number' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'rental_price_per_day' => 'required|numeric',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle file upload
        $imagePath = $request->file('file')->store('uploads/battery', 'public');

        Battery::create([
            'type' => $request->type,
            'brand' => $request->brand,
            'model_number' => $request->model_number,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock_quantity' => $request->stock_quantity,
            'rental_price_per_day' => $request->rental_price_per_day,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.batteries.index')->with('success', 'Battery created successfully!');
    }

    public function edit($id)
    {
        $battery = Battery::findOrFail($id);
        return view('admin.batteries.edit', compact('battery'));
    }

    public function update(Request $request, $id)
    {
        $battery = Battery::findOrFail($id);

        $request->validate([
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model_number' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'rental_price_per_day' => 'required|numeric',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
        ]);

        // Handle file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($battery->image_path && Storage::disk('public')->exists($battery->image_path)) {
                Storage::disk('public')->delete($battery->image_path);
            }

            $imagePath = $request->file('file')->store('uploads/battery', 'public');
            $battery->image_path = $imagePath;
        }

        $battery->update($request->only([
            'type',
            'brand',
            'model_number',
            'purchase_price',
            'sale_price',
            'stock_quantity',
            'rental_price_per_day',
        ]));

        return redirect()->route('admin.batteries.index')->with('success', 'Battery updated successfully!');
    }

    public function destroy($id)
    {
        $battery = Battery::findOrFail($id);

        // Delete associated file
        if ($battery->image_path && Storage::disk('public')->exists($battery->image_path)) {
            Storage::disk('public')->delete($battery->image_path);
        }

        $battery->delete();

        return redirect()->route('admin.batteries.index')->with('success', 'Battery deleted successfully!');
    }
}
