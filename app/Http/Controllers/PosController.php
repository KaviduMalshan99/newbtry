<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\OldBattery;
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
        $old_battery_conditions = ['Good', 'Average', 'Poor'];

        return view('admin.POS.pos', compact('brands', 'batteries', 'lubricants', 'customers', 'paymentTypes', 'old_battery_conditions'));
    }

    public function show()
    {
        return DB::table('batteries')->orderBy('id', 'asc')
            ->where('stock_quantity', '>', 0)
            ->get();
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
            Customer::create($validated);
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
            'battery_discount' => 'nullable|numeric|min:0',
            'old_battery_discount_value' => 'nullable|numeric|min:0',
            'payment_type' => 'required|in:Cash,Card,Bank Transfer', // Ensure the payment type is one of the valid options
            'order_type' => 'required|in:New Order,Old Battery,Repair', // Ensure the order type is one of the valid options
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
            $oldBattery = json_decode($request->input('old_battery'), true);
            // Prepare the BatteryOrder data
            $batteryOrder = new BatteryOrder();
            $batteryOrder->customer_id = $validatedData['customer_id'];
            $batteryOrder->order_type = $validatedData['order_type'];
            $batteryOrder->items = json_encode($request->items, true); // Encode items to JSON format
            $batteryOrder->battery_discount = $validatedData['battery_discount'] ?? 0;
            $batteryOrder->old_battery_discount_value = $validatedData['old_battery_discount_value'] ?? 0;
            $batteryOrder->subtotal = $validatedData['subtotal'];
            $batteryOrder->total_price = $validatedData['total_price'];
            $batteryOrder->paid_amount = $validatedData['paid_amount'];
            $batteryOrder->due_amount = $validatedData['due_amount'];
            $batteryOrder->payment_type = $validatedData['payment_type'];
            $batteryOrder->order_date = $request->input('order_date', now());
            $batteryOrder->payment_status = $paymentStatus;

            // Save the order
            $batteryOrder->save();

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
            if ($validatedData['order_type'] == "New Order") {
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
            } else if ($validatedData['order_type'] == "Old Battery") {
                foreach ($items as $item) {
                    $battery = OldBattery::find($item['old_battery_id']);
                    if (!$battery) {
                        // Rollback transaction and return error if battery is not found
                        DB::rollBack();
                        // return redirect()->route('POS.index')->with('success', 'Battery with ID not found.');
                        return response()->json(['error' => "Old Battery with ID {$item['old_battery_id']} not found."], 404);
                    }

                    // Decrease stock quantity
                    $battery->isActive = 0;
                    $battery->save();
                }
            } else if ($validatedData['order_type'] == "Repair") {
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

    public function storeOldBattery(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'old_battery_type' => 'required|string|max:255',
            'old_battery_condition' => 'required|in:Good,Average,Poor',
            'old_battery_value' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        try {
            // Insert the data into the old_batteries table
            $oldBattery = OldBattery::create([
                'order_id' => $request->order_id, // Nullable
                'customer_id' => $validated['customer_id'],
                'old_battery_type' => $validated['old_battery_type'],
                'old_battery_condition' => $validated['old_battery_condition'],
                'old_battery_value' => $validated['old_battery_value'],
                'battery_status' => $request->battery_status ?? 'Replace', // Default to Direct if not provided
                'notes' => $validated['notes'],
            ]);

            // Return a JSON response for success
            return response()->json([
                'success' => true,
                'message' => 'Old Battery added successfully.',
                'data' => $oldBattery,
            ], 201);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'Failed to add Old Battery. ' . $e->getMessage(),
            ], 500);
        }
    }
}
