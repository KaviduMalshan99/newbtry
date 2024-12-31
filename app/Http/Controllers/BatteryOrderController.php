<?php

// In BatteryOrderController.php
use Illuminate\Http\Request;
use App\Models\BatteryOrder;

public function placeOrder(Request $request)
{
    try {
        // Get the order details from the request
        $orderDetails = $request->order_details;
        $paymentMethod = $request->payment_method;
        $total = $request->total;

        // Create a new order
        $order = BatteryOrder::create([
            'order_id' => $request->order_id, // Use a unique order ID or let it be auto-generated
            'payment_method' => $paymentMethod,
            'items' => json_encode($orderDetails), // Store order details as JSON
            'subtotal' => array_sum(array_column($orderDetails, 'price')), // You can calculate the subtotal based on prices
            'total' => $total,
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully.',
        ]);
    } catch (\Exception $e) {
        // Handle errors
        return response()->json([
            'success' => false,
            'error' => 'Failed to place order: ' . $e->getMessage(),
        ]);
    }
}
