<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Lubricant;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $productTypes = ['batteries', 'lubricants'];
        return view('admin.purchases.add', compact('suppliers', 'productTypes'));
    }

    public function getProducts($type)
    {
        if ($type == 'batteries') {
            $products = Battery::all();
        } elseif ($type == 'lubricants') {
            $products = Lubricant::all();
        } else {
            $products = [];
        }

        return response()->json($products);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $items = json_decode($request->input('items'), true);

        $totalPrice = 0;
        $supplierId = $data['supplier_id'];

        $purchase = Purchase::create([
            'supplier_id' => $supplierId,
            'total_price' => $totalPrice,
        ]);

        // Optional: You can loop through the items to process them or validate them further if needed
        foreach ($items as $item) {
            $productType = $item['product_type'];
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $purchasePrice = $item['purchase_price'];

            $totalPrice += $quantity * $purchasePrice;

            // Insert the purchase item into the database
            PurchaseItem::create([
                'purchase_id' => $purchase->id,  // Assuming $purchase is the purchase record
                'supplier_id' => $supplierId,
                'battery_id' => $productType == 'batteries' ? $productId : null,
                'lubricant_id' => $productType == 'lubricants' ? $productId : null,
                'quantity' => $quantity,
                'purchase_price' => $purchasePrice,
            ]);
        }
        $purchase->update([
            'total_price' => $totalPrice,
        ]);


        // Redirect with success message
        return redirect()->route('purchases.create')->with('success', 'Purchase created successfully!');
    }


    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $batteries = Battery::all();
        $lubricants = Lubricant::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'batteries', 'lubricants'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'battery_ids' => 'nullable|array',
            'lubricant_ids' => 'nullable|array',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
        ]);

        $purchase->update($data);
        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}