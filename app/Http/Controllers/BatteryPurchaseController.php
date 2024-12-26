<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryPurchase;
use App\Models\BatteryPurchaseItem;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatteryPurchaseController extends Controller
{
    public function index()
    {
        $purchases = BatteryPurchase::with('supplier')->get();
        return view('admin.purchases.view', compact('purchases'));
    }

    public function create_battery()
    {
        $suppliers = Supplier::all();
        return view('admin.purchases.add_battery', compact('suppliers'));
    }

    public function createBatteryPurchase()
    {
        // Fetch suppliers where product_type matches 'batteries' using LIKE
        $suppliers = Supplier::where('product_type', 'LIKE', '%batteries%')->get();

        // Fetch all batteries
        $batteries = Battery::all();

        return view('admin.purchases.add_battery', compact('suppliers', 'batteries'));
    }

    public function storeBatteryPurchase(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|json', // Items should be a JSON string
        ]);

        $items = json_decode($data['items'], true);

        if (empty($items)) {
            return redirect()->back()->with('error', 'No items to process.');
        }

        $totalPrice = 0;
        $supplierId = $data['supplier_id'];

        // Create the purchase
        $purchase = BatteryPurchase::create([
            'supplier_id' => $supplierId,
            'total_price' => $totalPrice,
        ]);

        // Process each item in the purchase
        foreach ($items as $item) {
            $batteryId = $item['battery_id'];
            $quantity = $item['quantity'];
            $purchasePrice = $item['purchase_price'];

            // Validate the battery exists
            $battery = Battery::find($batteryId);
            if (!$battery) {
                return redirect()->back()->with('error', "Battery with ID {$batteryId} not found.");
            }

            // Update the battery's stock quantity
            $battery->increment('stock_quantity', $quantity);

            // Calculate total price for this item
            $totalPrice += $quantity * $purchasePrice;

            // Insert into the PurchaseItem table
            BatteryPurchaseItem::create([
                'battery_purchase_id' => $purchase->id,
                'supplier_id' => $supplierId,
                'battery_id' => $batteryId,
                'quantity' => $quantity,
                'purchase_price' => $purchasePrice,
            ]);
        }

        // Update the total price of the purchase
        $purchase->update(['total_price' => $totalPrice]);
        return redirect()->route('purchases.grn', $purchase->id)->with('success', 'Purchase created successfully!');
    }

    public function generateGrn(BatteryPurchase $purchase)
    {
        // Load the related purchase items and supplier
        $purchase->load(['supplier', 'batteryPurchaseItems.batteryPurchase']);

        // Current date and time
        $currentDateTime = Carbon::now()->format('d.m.Y H:i');

        // Pass the data to the view
        return view('admin.purchases.grn', [
            'purchase' => $purchase,
            'purchaseItems' => $purchase->batteryPurchaseItems,
            'currentDateTime' => $currentDateTime,
        ]);
    }

    public function destroy(BatteryPurchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }

    public function editBatteryPurchase($id)
    {
        // Fetch the BatteryPurchase record along with its associated items
        $purchase = BatteryPurchase::with(['batteryPurchaseItems.battery', 'supplier'])->findOrFail($id);

        // Fetch the required data for the dropdowns
        $suppliers = Supplier::all();
        $batteries = Battery::all();

        // Pass the data to the edit view
        return view('admin.purchases.update_battery', [
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'batteries' => $batteries,
        ]);
    }

    public function update_battery(Request $request, $id)
    {
        $purchase = BatteryPurchase::findOrFail($id);
        $items = json_decode($request->items, true);

        DB::beginTransaction();
        try {
            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'total_price' => collect($items)->sum(function ($item) {
                    return $item['quantity'] * $item['purchase_price'];
                })
            ]);

            // Get existing item IDs
            $existingIds = $purchase->batteryPurchaseItems->pluck('id')->toArray();

            foreach ($items as $item) {
                if (isset($item['id']) && in_array($item['id'], $existingIds)) {
                    // Update existing item
                    BatteryPurchaseItem::where('id', $item['id'])->update([
                        'supplier_id' => $item['supplier_id'],
                        'battery_id' => $item['battery_id'],
                        'quantity' => $item['quantity'],
                        'purchase_price' => $item['purchase_price']
                    ]);
                } else {

                    // Validate the battery exists
                    $battery = Battery::find($item['battery_id']);
                    if (!$battery) {
                        return redirect()->back()->with('error', "Battery with ID {$item['battery_id']} not found.");
                    }

                    // Update battery stock quantity
                    $battery->increment('stock_quantity', $item['quantity']);

                    // Create new item
                    $purchase->batteryPurchaseItems()->create([
                        'supplier_id' => $item['supplier_id'],
                        'battery_id' => $item['battery_id'],
                        'quantity' => $item['quantity'],
                        'purchase_price' => $item['purchase_price']
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('purchases.edit_battery', ['purchase' => $purchase->id])->with('success', 'Battery purchase updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            // return back()->with('error', 'Error updating battery purchase');
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Add this method to BatteryPurchaseController
    public function removeBatteryPurchaseItem($purchaseId, $itemId)
    {
        try {
            $item = BatteryPurchaseItem::findOrFail($itemId);
            $purchase = BatteryPurchase::findOrFail($purchaseId);

            DB::beginTransaction();

            // Validate the battery exists
            $battery = Battery::find($item['battery_id']);
            if (!$battery) {
                return redirect()->back()->with('error', "Battery with ID {$item['battery_id']} not found.");
            }

            // Update battery stock quantity
            $battery->decrement('stock_quantity', $item['quantity']);

            $item->delete();

            // Recalculate total price
            $newTotal = $purchase->batteryPurchaseItems()->sum(DB::raw('quantity * purchase_price'));
            $purchase->update(['total_price' => $newTotal]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function viewPurchaseItems(BatteryPurchase $purchase)
    {
        $purchaseItems = BatteryPurchaseItem::where('battery_purchase_id', $purchase->id)->get();
        // Pass data to the view
        return view('admin/purchases.view-purchase-items', compact('purchaseItems', 'purchase'));
    }
}
