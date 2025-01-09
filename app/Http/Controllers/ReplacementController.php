<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryOrder;
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

        return view('admin.replacement_management.index', compact('brands', 'batteries', 'lubricants', 'customers', 'paymentTypes', 'old_battery_conditions'));
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
}