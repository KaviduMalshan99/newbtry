<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function show()
    {
        $suppliers = Supplier::orderBy('updated_at', 'desc')->paginate(10);
        $productTypes = ['batteries', 'lubricants'];
        return view('suppliers.view', compact('suppliers', 'productTypes'));
    }

    public function create()
    {
        $productTypes = ['batteries', 'lubricants'];

        return view('suppliers.add', compact('productTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . ($supplier->id ?? 'NULL'),
            'phone_number' => 'required|string|max:15|unique:suppliers,phone_number,' . ($supplier->id ?? 'NULL'),
            'address' => 'required|string|max:255',
            'product_type' => 'required|array', // Expect an array for product types
            'product_type.*' => 'in:batteries,lubricants', // Validate each value
        ]);
        

        // Create a new supplier
    Supplier::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'product_type' => json_encode($request->product_type), // Store product types as JSON
    ]);

        // Redirect with a success message
        return redirect()->route('suppliers.create')->with('success', 'Supplier added successfully!');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $productTypes = ['batteries', 'lubricants'];

        return view('suppliers.update', compact('supplier', 'productTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:suppliers,email,' . $id, 
            'phone_number' => 'required|string|max:15|unique:suppliers,phone_number,' . $id,
            'address' => 'required|string|max:255',
            'product_type' => 'required|array', // Expect an array for product types
        'product_type.*' => 'in:batteries,lubricants', // Validate each value
        ]);      

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'product_type' => json_encode($request->product_type), // Store product types as JSON
        ]);

        return redirect()->route('suppliers.show', "view")
            ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete(); // Delete the supplier
        return redirect()->route('suppliers.show', "view")
            ->with('success', 'Supplier deleted successfully!');
    }
}
