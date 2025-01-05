<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Brand;
use App\Models\Customer;
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
        $batteries = DB::table('batteries')->orderBy('id', 'asc')
            ->where('stock_quantity', '>', 0)
            ->get();
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

        // Calculate payment_status based on business logic
        $paymentStatus = 'Pending';
        if ($validatedData['due_amount'] > 0) {
            $paymentStatus = 'Not Completed';
        } elseif ($validatedData['paid_amount'] >= $validatedData['total_price']) {
            $paymentStatus = 'Completed';
        }

        // Generate unique order_id

        DB::beginTransaction();

        try {
            // Prepare the BatteryOrder data
            $batteryOrder = new BatteryOrder();
            $batteryOrder->customer_id = $validatedData['customer_id'];
            $batteryOrder->order_type = $request->input('order_type', 'New Order');
            $batteryOrder->items = json_encode($request->items, true); // Encode items to JSON format
            $batteryOrder->battery_discount = $validatedData['battery_discount'] ?? 0;
            $batteryOrder->subtotal = $validatedData['subtotal'];
            $batteryOrder->total_price = $validatedData['total_price'];
            $batteryOrder->paid_amount = $validatedData['paid_amount'];
            $batteryOrder->due_amount = $validatedData['due_amount'];
            $batteryOrder->payment_type = $validatedData['payment_type'];
            $batteryOrder->order_date = $request->input('order_date', now());
            $batteryOrder->payment_status = $paymentStatus;

            // Save the order
            $batteryOrder->save();

            // Retrieve the customer record
            $customer = Customer::findOrFail($validatedData['customer_id']);

            // Decode the current purchase_history
            $currentHistory = json_decode($customer->purchase_history, true) ?? [];

            // Add the new BatteryOrder ID to the history
            $currentHistory[] = ['battery_order_id' => $batteryOrder->order_id];

            // Update the customer's purchase_history
            $customer->purchase_history = json_encode($currentHistory);
            $customer->save();

            // Update stock_quantity for each battery
            foreach ($items as $item) {
                $battery = Battery::find($item['battery_id']);
                if (!$battery) {
                    // Rollback transaction and return error if battery is not found
                    DB::rollBack();
                    // return redirect()->route('POS.index')->with('success', 'Battery with ID not found.');
                    return response()->json(['error' => "Battery with ID {$item['battery_id']} not found."], 404);
                }

                // Check if stock is sufficient
                if ($battery->stock_quantity < $item['quantity']) {
                    // Rollback transaction and return error if stock is insufficient
                    DB::rollBack();
                    // return redirect()->route('POS.index')->with('success', 'Insufficient stock for Battery ID.');
                    return response()->json(['error' => "Insufficient stock for Battery ID {$item['battery_id']}."], 400);
                }

                // Decrease stock quantity
                $battery->stock_quantity -= $item['quantity'];
                $battery->save();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('POS.index')->with('success', 'Purchase Saved successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return response()->json([
                'error' => 'An error occurred while placing the order.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function loadProductsByBrand($brandId)
    {
        // Fetch the brand by its ID
        $brand = Brand::findOrFail($brandId);

        // Get products based on brand type
        if ($brand->type == 'battery') {
            $products = Battery::where('brand_id', $brandId)
                ->where('stock_quantity', '>', 0)
                ->get();
        } elseif ($brand->type == 'lubricant') {
            $products = Lubricant::where('brand_id', $brandId)->get();
        } else {
            $products = collect(); // Return empty collection for unknown types
        }

        // Return the partial view with the fetched products
        return view('admin.POS.partials.product-list', compact('products'));
    }
}
