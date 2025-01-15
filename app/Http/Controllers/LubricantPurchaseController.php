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
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'status' => 'required|string',
        ]);
    
        // Generate the next purchase_id (LP0001, LP0002, ...)
        $lastPurchase = \App\Models\LubricantPurchase::latest('id')->first();
        $nextPurchaseId = $lastPurchase 
            ? 'LP' . str_pad((int)substr($lastPurchase->purchase_id, 2) + 1, 4, '0', STR_PAD_LEFT) 
            : 'LP0001';
    
        // Save the lubricant purchase
        $purchase = new \App\Models\LubricantPurchase();
        $purchase->purchase_id = $nextPurchaseId;
        $purchase->lubricant_id = $validated['lubricant_id'];
        $purchase->supplier_id = $validated['supplier_id'];
        $purchase->purchase_date = $validated['purchase_date'];
        $purchase->quantity_purchased = $validated['quantity_purchased'];
        $purchase->unit_type = $validated['unit_type'];
        $purchase->total_cost = $validated['total_cost'];
        $purchase->payment_status = $validated['payment_status'];
        $purchase->purchase_price = $validated['purchase_price'];
        $purchase->sale_price = $validated['sale_price'];
        $purchase->status = $validated['status'];
        $purchase->save();
    
        // Update lubricant details in the lubricants table
        $lubricant = \App\Models\Lubricant::find($validated['lubricant_id']);
        if ($lubricant) {
            $lubricant->purchase_price = $validated['purchase_price'];
            $lubricant->sale_price = $validated['sale_price'];
            $lubricant->stock_quantity += $validated['quantity_purchased'];
            $lubricant->unit = $validated['unit_type'];
            $lubricant->save();
        }
    
        return redirect()->route('lubricant_purchases.index')->with('success', 'Purchase added successfully.');
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
