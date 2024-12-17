<?php

namespace App\Http\Controllers;

use App\Models\Lubricant;
use Illuminate\Http\Request;

class LubricantController extends Controller
{
    /**
     * Display a listing of the lubricants.
     */
    public function index()
    {
        // Paginate the lubricants (10 per page, adjust as needed)
        $lubricants = Lubricant::paginate(10);
        return view('admin.lubricants.index', compact('lubricants'));
    }

    /**
     * Show the form for creating a new lubricant.
     */
    public function create()
    {
        return view('admin.lubricants.create');
    }

    /**
     * Store a newly created lubricant in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Create the lubricant
        Lubricant::create($validated);

        return redirect()->route('lubricants.index')->with('success', 'Lubricant created successfully.');
    }

    /**
     * Show the form for editing the specified lubricant.
     */
    public function edit($id)
    {
        $lubricant = Lubricant::findOrFail($id);
        return view('admin.lubricants.edit', compact('lubricant'));
    }

    /**
     * Update the specified lubricant in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Find the lubricant and update it
        $lubricant = Lubricant::findOrFail($id);
        $lubricant->update($validated);

        return redirect()->route('lubricants.index')->with('success', 'Lubricant updated successfully.');
    }

    /**
     * Remove the specified lubricant from storage.
     */
    public function destroy($id)
    {
        $lubricant = Lubricant::findOrFail($id);
        $lubricant->delete();

        return redirect()->route('lubricants.index')->with('success', 'Lubricant deleted successfully.');
    }

    /**
     * Display the specified lubricant.
     */
    public function show($id)
    {
        $lubricant = Lubricant::findOrFail($id);
        return view('admin.lubricants.show', compact('lubricant'));
    }
}
