<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Brand;
use App\Models\Lubricant;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class PosController extends Controller
{
    /**
     * Display the main POS page.
     */
    public function index()
    {
        $brands = DB::table('brands')->where('type', 'battery')->get();
        $batteries = DB::table('batteries')->orderBy('id', 'asc')->get();
        $lubricants = DB::table('lubricants')->orderBy('id', 'asc')->get();
        $customers = DB::table('customers')
            ->select('id', 'first_name', 'last_name', 'phone_number')
            ->get();

        $paymentTypes = ['Cash', 'Card', 'Bank Transfer'];

        return view('admin.POS.pos', compact('brands', 'batteries', 'lubricants', 'customers', 'paymentTypes'));
    }

    /**
     * Create a new customer.
     */
    public function createCustomer(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15|unique:customers',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        try {
            DB::table('customers')->insert($validated);
            return redirect()->back()->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create customer: ' . $e->getMessage());
        }
    }

    /**
     * Store a new battery order.
     */
    // public function storeBatteryOrder(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'c_phone_number' => 'required|string|max:15',
    //         'payment_method' => 'required|in:Card,Full_Payment,Half_Payment',
    //         'items' => 'required|integer|min:1',
    //         'subtotal' => 'required|numeric|min:0',
    //         'total' => 'required|numeric|min:0',
    //         'order_items' => 'required|array|min:1',
    //         'order_items.*.name' => 'required|string|max:255',
    //         'order_items.*.quantity' => 'required|integer|min:1',
    //         'order_items.*.price' => 'required|numeric|min:0',
    //     ]);

    //     try {
    //         // Insert the order
    //         $orderId = DB::table('battery_order')->insertGetId([
    //             'c_phone_number' => $validatedData['c_phone_number'],
    //             'payment_method' => $validatedData['payment_method'],
    //             'items' => $validatedData['items'],
    //             'subtotal' => $validatedData['subtotal'],
    //             'total' => $validatedData['total'],
    //         ]);

    //         // Insert order items
    //         $orderItems = array_map(function ($item) use ($orderId) {
    //             return [
    //                 'order_id' => $orderId,
    //                 'name' => $item['name'],
    //                 'quantity' => $item['quantity'],
    //                 'price' => $item['price'],
    //             ];
    //         }, $validatedData['order_items']);

    //         DB::table('order_items')->insert($orderItems);

    //         return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
    //     }
    // }

    public function storeBatteryOrder(Request $request)
    {
        // Manually decode the 'items' field to ensure it's an array
        $items = json_decode($request->input('items'), true);

        // Check if items is a valid array and has at least one item
        if (!is_array($items) || count($items) < 1) {
            return response()->json(['error' => 'Items are required.'], 400);
        }
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validate that customer_id is a valid existing customer

            'subtotal' => 'required|numeric|min:0', // Ensure subtotal is a valid numeric value
            'total_price' => 'required|numeric|min:0', // Ensure total_price is a valid numeric value
            'paid_amount' => 'required|numeric|min:0', // Ensure paid_amount is a valid numeric value
            'due_amount' => 'required|numeric|min:0', // Ensure due_amount is a valid numeric value
            'payment_type' => 'required|in:Cash,Card,Bank Transfer', // Ensure the payment type is one of the valid options
            'items' => 'required',
        ]);



        // Generate unique order_id
        $orderId = 'BO-' . strtoupper(uniqid());

        // Prepare the BatteryOrder data
        $batteryOrder = new BatteryOrder();
        $batteryOrder->order_id = $orderId;
        $batteryOrder->customer_id = $validatedData['customer_id'];
        $batteryOrder->items = json_encode($request->items); // Encode items to JSON format
        $batteryOrder->battery_discount = $validatedData['battery_discount'] ?? 0;
        $batteryOrder->subtotal = $validatedData['subtotal'];
        $batteryOrder->total_price = $validatedData['total_price'];
        $batteryOrder->paid_amount = $validatedData['paid_amount'];
        $batteryOrder->due_amount = $validatedData['due_amount'];
        $batteryOrder->payment_type = $validatedData['payment_type'];
        $batteryOrder->order_date = $request->input('order_date', now());

        // Save the order
        $batteryOrder->save();

        return redirect()->route('POS.index')->with('success', 'Purchase Saved successfully!');
    }

    public function loadProductsByBrand($brandId)
    {
        // Fetch the brand by its ID
        $brand = Brand::findOrFail($brandId);

        // Get products based on brand type
        if ($brand->type == 'battery') {
            $products = Battery::where('brand_id', $brandId)->get();
        } elseif ($brand->type == 'lubricant') {
            $products = Lubricant::where('brand_id', $brandId)->get();
        } else {
            $products = collect(); // Return empty collection for unknown types
        }

        // Return the partial view with the fetched products
        return view('admin.POS.partials.product-list', compact('products'));
    }
}