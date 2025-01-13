<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\OldBattery;
use App\Models\Replacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReplacementController extends Controller
{
    public function index()
    {
        $brands = DB::table('brands')->where('type', 'battery')->get();
        $batteries = DB::table('batteries')->orderBy('id', 'asc')
            ->where('stock_quantity', '>', 0)
            ->get();
        $lubricants = DB::table('lubricants')->orderBy('id', 'asc')->get();
        // Fetch customers whose ID exists in the battery_orders table
        $customers = DB::table('customers')
            ->join('battery_orders', 'customers.id', '=', 'battery_orders.customer_id')
            ->select('customers.id', 'customers.first_name', 'customers.last_name', 'customers.phone_number')
            ->distinct()
            ->get();

        $paymentTypes = ['Cash', 'Card', 'Bank Transfer'];
        $old_battery_conditions = ['Good', 'Average', 'Poor'];
        $replacementReasons = ['Defective', 'Mismatch', 'Warranty Claim'];

        return view('admin.replacement_management.index', compact('brands', 'batteries', 'lubricants', 'customers', 'paymentTypes', 'old_battery_conditions', 'replacementReasons'));
    }

    public function getCustomerOrders($customerId)
    {
        // Use the BatteryOrder model to fetch orders
        $orders = BatteryOrder::where('customer_id', $customerId)
            ->select('id', 'order_id', 'order_type', 'order_date')
            ->orderBy('order_date', 'desc')
            ->get();

        return response()->json($orders);
    }

    public function getOrderItems($orderId)
    {
        try {
            // Find the order by ID
            $order = BatteryOrder::findOrFail($orderId);

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            // Log the original raw data
            Log::debug('Original raw data:', [
                'data' => $order->items,
                'type' => gettype($order->items)
            ]);

            // First decode attempt
            $firstDecode = json_decode($order->items, true);

            // If first decode results in a string, try second decode
            if (is_string($firstDecode)) {
                Log::debug('First decode resulted in string, attempting second decode:', [
                    'first_decode' => $firstDecode
                ]);

                $items = json_decode($firstDecode, true);
            } else {
                $items = $firstDecode;
            }

            // Log the final decoded result
            Log::debug('Final decoded result:', [
                'data' => $items,
                'type' => gettype($items)
            ]);

            // Verify we have valid data
            if ($items === null && json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON Decode Error:', [
                    'error' => json_last_error_msg(),
                    'raw_data' => $order->items
                ]);
                return response()->json(['error' => 'Invalid JSON format in items'], 400);
            }

            // Handle single object case
            if (!is_array($items)) {
                Log::error('Final decoded data is not an array:', [
                    'type' => gettype($items),
                    'value' => $items
                ]);
                // If it's a single object, try to wrap it
                if (is_object($items) || (is_array($items) && !isset($items[0]))) {
                    $items = [$items];
                } else {
                    return response()->json([
                        'error' => 'Unable to process items data',
                        'received_type' => gettype($items)
                    ], 400);
                }
            }

            // Process items
            $items = collect($items)->map(function ($item) {
                if (!is_array($item)) {
                    Log::error('Invalid item format', ['item' => $item]);
                    return null;
                }

                if (!isset($item['battery_id'])) {
                    Log::error('Missing battery_id in item', ['item' => $item]);
                    return null;
                }

                $battery = Battery::find($item['battery_id']);

                if (!$battery) {
                    $item['image'] = 'default-image.jpg';
                    $item['name'] = 'Unknown Battery';
                } else {
                    $item['image'] = $battery->image;
                    $item['name'] = $battery->model_name;
                }

                return $item;
            })->filter();

            return response()->json([
                'order_id' => $order->id,
                'items' => $items,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching order items:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Unable to fetch order items'], 500);
        }
    }

    public function storeReplacement(Request $request)
    {
        // Manually decode the 'items' field to ensure it's an array
        $items = json_decode($request->input('items'), true);

        // Check if items is a valid array and has at least one item
        if (!is_array($items) || count($items) < 1) {
            return response()->json(['error' => 'Items are required.'], 400);
        }

        // Manually decode the 'items' field to ensure it's an array
        $customerOrderItems = json_decode($request->input('customer_order_items'), true);

        // Check if items is a valid array and has at least one item
        if (!is_array($customerOrderItems) || count($customerOrderItems) < 1) {
            return response()->json(['error' => 'Items are required.'], 400);
        }

        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validate that customer_id is a valid existing customer

            'subtotal' => 'required|numeric', // Ensure subtotal is a valid numeric value
            'total_price' => 'required|numeric', // Ensure total_price is a valid numeric value
            'paid_amount' => 'required|numeric', // Ensure paid_amount is a valid numeric value
            'due_amount' => 'required|numeric', // Ensure due_amount is a valid numeric value
            'battery_discount' => 'nullable|numeric|min:0',
            'old_battery_discount_value' => 'nullable|numeric|min:0',
            'payment_type' => 'required|in:Cash,Card,Bank Transfer', // Ensure the payment type is one of the valid options
            'items' => 'required',

            'replacement_reason' => 'required|in:Defective,Mismatch,Warranty Claim',
            'order_id' => 'required|exists:battery_orders,id',
            'customer_order_items' => 'required',


        ]);

        DB::beginTransaction();

        try {
            $oldBattery = json_decode($request->input('old_battery'), true);
            // Insert a new replacement record
            $customerOrderItems = json_decode($validatedData['customer_order_items'], true);
            $items = json_decode($validatedData['items'], true);

            // Insert a new replacement record
            $replacement = Replacement::create([
                'order_id' => $validatedData['order_id'],
                'bought_old_battery_id' => $customerOrderItems[0]['battery_id'],
                'old_battery_id' => $oldBattery['id'] ?? null,
                'replacement_reason' => $validatedData['replacement_reason'],
                'replacement_date' => now(),
                'bought_old_battery_price' => $customerOrderItems[0]['price'],
                'bought_old_battery_quantity' => $customerOrderItems[0]['quantity'],
                'new_battery_id' => $items[0]['battery_id'],
                'new_battery_price' => $items[0]['price'],
                'new_battery_quantity' => $items[0]['quantity'],
                'price_adjustment' => $validatedData['total_price'],
                'payment_type' => $validatedData['payment_type'],
            ]);

            // Fetch the order
            $batteryOrder = BatteryOrder::findOrFail($validatedData['order_id']);

            // Get items to remove from payload
            $itemsToRemove = json_decode($validatedData['customer_order_items'], true);

            // Decode existing items from DB
            $existingItems = json_decode(stripslashes(trim($batteryOrder->items, '"')), true);

            // Filter out the matching item
            $updatedItems = array_filter($existingItems, function ($item) use ($itemsToRemove) {
                return !(
                    $item['battery_id'] === $itemsToRemove[0]['battery_id'] &&
                    $item['quantity'] === $itemsToRemove[0]['quantity'] &&
                    $item['price'] === $itemsToRemove[0]['price']
                );
            });

            // Reindex array to ensure sequential keys
            $updatedItems = array_values($updatedItems);

            // Add the new item
            $updatedItems[] = [
                'battery_id' => $items[0]['battery_id'],
                'quantity' => $items[0]['quantity'],
                'price' => $items[0]['price']
            ];

            // Single database update
            DB::table('battery_orders')
                ->where('id', $validatedData['order_id'])
                ->update([
                    'items' => '"' . addslashes(json_encode($updatedItems)) . '"'
                ]);

            $batteryOrder->subtotal += $validatedData['subtotal'];
            $batteryOrder->total_price += $validatedData['total_price'];
            $batteryOrder->battery_discount += $validatedData['battery_discount'];
            $batteryOrder->old_battery_discount_value += $validatedData['old_battery_discount_value'];
            $batteryOrder->paid_amount += $validatedData['paid_amount'];
            $batteryOrder->due_amount += $validatedData['due_amount'];
            $batteryOrder->save();

            $items = json_decode($validatedData['items'], true);

            // Update stock for each battery
            foreach ($items as $item) {
                $battery = Battery::find($item['battery_id']);
                if (!$battery || $battery->stock_quantity < $item['quantity']) {
                    DB::rollBack();
                    return response()->json(['error' => "Insufficient stock for Battery ID {$item['battery_id']}."], 400);
                }
                $battery->stock_quantity -= $item['quantity'];
                $battery->save();
            }

            if ($oldBattery) {
                // Find the existing OldBattery record based on its unique identifier
                $existingOldBattery = OldBattery::find($oldBattery['id']);

                if ($existingOldBattery) {
                    // Update the record with the battery_order_id
                    $existingOldBattery->update(['battery_order_id' => $batteryOrder->id]);
                } else {
                    // If no existing record is found, create a new one
                    OldBattery::create(array_merge($oldBattery, ['battery_order_id' => $batteryOrder->id]));
                }
            }

            DB::commit();

            // return response()->json([
            //     'message' => 'Replacement processed successfully.',
            //     'replacement' => $replacement,
            //     'updated_order' => $batteryOrder,
            // ]);

            return redirect()->route('replacements.index')->with('success', 'Replacement processed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'An error occurred while processing the replacement.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
