<?php

namespace App\Http\Controllers;

use App\Models\Lubricant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LubricantController extends Controller
{
    public function index()
    {
        $lubricants = Lubricant::paginate(10);
        return view('admin.lubricants.index', compact('lubricants'));
    }

    public function create()
    {
        return view('admin.lubricants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50', // New validation rule
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lubricants', 'public');
            $validated['image'] = $imagePath;
        }

        Lubricant::create($validated);
        return redirect()->route('lubricants.index')->with('success', 'Lubricant created successfully.');
    }

    public function edit($id)
    {
        $lubricant = Lubricant::findOrFail($id);
        return view('admin.lubricants.edit', compact('lubricant'));
    }

    public function show($id)
    {
        $lubricant = Lubricant::findOrFail($id);
        return view('admin.lubricants.show', compact('lubricant'));
    }


    public function update(Request $request, $id)
    {
        $lubricant = Lubricant::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50', // New validation rule
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        if ($request->hasFile('image')) {
            // Delete old image
            if ($lubricant->image) {
                Storage::disk('public')->delete($lubricant->image);
            }
            $imagePath = $request->file('image')->store('lubricants', 'public');
            $validated['image'] = $imagePath;
        }

        $lubricant->update($validated);
        return redirect()->route('lubricants.index')->with('success', 'Lubricant updated successfully.');
    }



    public function destroy($id)
    {
        $lubricant = Lubricant::findOrFail($id);

        // Delete image
        if ($lubricant->image) {
            Storage::disk('public')->delete($lubricant->image);
        }

        $lubricant->delete();
        return redirect()->route('lubricants.index')->with('success', 'Lubricant deleted successfully.');
    }
}
