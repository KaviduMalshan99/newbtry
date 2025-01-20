<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Lubricant;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->get();
        return view('admin.purchases.view', compact('purchases'));
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
        // return redirect()->route('purchases.create')->with('success', 'Purchase created successfully!');
        return redirect()->route('purchases.grn', $purchase->id)->with('success', 'Purchase created successfully!');
    }


    public function edit($id)
    {
        $purchase = Purchase::with('purchaseItems.battery', 'purchaseItems.lubricant', 'supplier')->findOrFail($id);
        $suppliers = Supplier::all(); // Fetch all suppliers

        // Determine product type based on the first purchase item
        $productType = $purchase->purchaseItems->first()?->battery_id ? 'batteries' : 'lubricants';

        // Fetch products based on the determined product type
        $products = $productType === 'batteries'
            ? Battery::all()
            : Lubricant::all();

        // Define available product types
        $productTypes = ['batteries', 'lubricants'];

        return view('admin.purchases.update', compact('purchase', 'suppliers', 'productType', 'productTypes', 'products'));
    }

    // In your controller
    public function getProductsByType($type)
    {
        if ($type === 'batteries') {
            $products = Battery::all(); // or however you're fetching batteries
        } elseif ($type === 'lubricants') {
            $products = Lubricant::all(); // or however you're fetching lubricants
        } else {
            return response()->json([], 404); // Return empty if type is invalid
        }

        return response()->json($products);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Decode the items from the hidden input field
        $items = json_decode($request->input('items'), true);

        // Retrieve the existing purchase record
        $purchase = Purchase::findOrFail($id);
        $totalPrice = 0;
        $supplierId = $data['supplier_id'];

        // Update the supplier_id of the purchase record
        $purchase->supplier_id = $supplierId;

        // Remove existing purchase items
        $purchase->purchaseItems()->delete();

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
            'supplier_id' => $supplierId,
        ]);

        // Redirect with success message
        return redirect()->route('purchases.edit', $purchase->id)->with('success', 'Purchase updated successfully!');
    }
    public function updatePurchaseItem(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'productId' => 'required|integer',
            'supplierId' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Find the purchase item and delete it
        $purchaseItem = PurchaseItem::where('product_id', $validated['productId'])
            ->where('supplier_id', $validated['supplierId'])
            ->where('quantity', $validated['quantity'])
            ->where('purchase_price', $validated['price'])
            ->first();

        if ($purchaseItem) {
            $purchaseItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }

    public function viewPurchaseItems(Purchase $purchase)
    {
        $purchaseItems = PurchaseItem::where('purchase_id', $purchase->id)->get();
        // Pass data to the view
        return view('admin/purchases.view-purchase-items', compact('purchaseItems', 'purchase'));
    }


    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }


    public function generateGrn(Purchase $purchase)
    {
        // Load the related purchase items and supplier
        $purchase->load(['supplier', 'purchaseItems.battery', 'purchaseItems.lubricant']);

        // Current date and time
        $currentDateTime = Carbon::now()->format('d.m.Y H:i');

        // Pass the data to the view
        return view('admin.purchases.grn', [
            'purchase' => $purchase,
            'purchaseItems' => $purchase->purchaseItems,
            'currentDateTime' => $currentDateTime,
        ]);
    }
}
