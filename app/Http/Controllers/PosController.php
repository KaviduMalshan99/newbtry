<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Brand;
use App\Models\Lubricant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('admin.POS.pos', compact('brands', 'batteries', 'lubricants', 'customers'));
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
    public function storeBatteryOrder(Request $request)
    {
        $validatedData = $request->validate([
            'c_phone_number' => 'required|string|max:15',
            'payment_method' => 'required|in:Card,Full_Payment,Half_Payment',
            'items' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'order_items' => 'required|array|min:1',
            'order_items.*.name' => 'required|string|max:255',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            // Insert the order
            $orderId = DB::table('battery_order')->insertGetId([
                'c_phone_number' => $validatedData['c_phone_number'],
                'payment_method' => $validatedData['payment_method'],
                'items' => $validatedData['items'],
                'subtotal' => $validatedData['subtotal'],
                'total' => $validatedData['total'],
            ]);

            // Insert order items
            $orderItems = array_map(function ($item) use ($orderId) {
                return [
                    'order_id' => $orderId,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
            }, $validatedData['order_items']);

            DB::table('order_items')->insert($orderItems);

            return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
        }
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