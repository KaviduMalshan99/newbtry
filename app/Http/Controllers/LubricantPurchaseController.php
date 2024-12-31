<?php

namespace App\Http\Controllers;

use App\Models\LubricantPurchase;
use App\Models\Lubricant;
use App\Models\Supplier;
use Illuminate\Http\Request;

class LubricantPurchaseController extends Controller
{
    public function index()
    {
        $purchases = LubricantPurchase::with(['lubricant', 'supplier'])->paginate(10);
        return view('admin.lubricants.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $lubricants = Lubricant::all();
        $suppliers = Supplier::all();
        return view('admin.lubricants.purchase.create', compact('lubricants', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            
            'lubricant_id' => 'required|exists:lubricants,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'quantity_purchased' => 'required|integer',
            'unit_type' => 'required|string',
            'total_cost' => 'required|numeric',
            'payment_status' => 'required|string',
            'status' => 'required|string',
        ]);

        LubricantPurchase::create($validated);

        return redirect()->route('lubricant_purchases.index')->with('success', 'Purchase added successfully');
    }

    public function edit($id)
    {
        $purchase = LubricantPurchase::findOrFail($id);
        $lubricants = Lubricant::all();
        $suppliers = Supplier::all();
        
        return view('admin.lubricants.purchase.edit', compact('purchase', 'lubricants', 'suppliers'));
    }

    public function update(Request $request, LubricantPurchase $lubricantPurchase)
    {
        $validated = $request->validate([
            'lubricant_id' => 'required|exists:lubricants,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'quantity_purchased' => 'required|integer',
            'unit_type' => 'required|string',
            'total_cost' => 'required|numeric',
            'payment_status' => 'required|string',
            'status' => 'required|string',
        ]);

        $lubricantPurchase->update($validated);

        return redirect()->route('lubricant_purchases.index')->with('success', 'Purchase updated successfully');
    }

    public function destroy(LubricantPurchase $lubricantPurchase)
    {
        $lubricantPurchase->delete();

        return redirect()->route('lubricant_purchases.index')->with('success', 'Purchase deleted successfully');
    }

    public function show($id)
    {
        $purchase = LubricantPurchase::with('lubricant', 'supplier')->findOrFail($id);

        return view('admin.lubricants.purchase.show', compact('purchase'));
    }
}
