<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Log;

// use Illuminate\Support\Str; // Correctly import the Str class
// use Carbon\Carbon;


// use App\Models\LubricantOrder;

// class PosController extends Controller
// {
//     /**
//      * Display the main POS page.
//      */
//     public function index()
//     {
//         $brands = DB::table('brands')->where('type', 'battery')->get();
//         $batteries = DB::table('batteries')->orderBy('id', 'asc')->get();
//         $lubricants = DB::table('lubricants')->orderBy('id', 'asc')->get();
//         $customers = DB::table('customers')
//             ->select('id', 'first_name', 'last_name', 'phone_number')
//             ->get();

//         return view('admin.POS.pos', compact('brands', 'batteries', 'lubricants', 'customers'));
//     }


//     public function lubricant()
//     {
//         $brands = DB::table('brands')->where('type', 'lubricant')->get();
//         $batteries = DB::table('batteries')->orderBy('id', 'asc')->get();
//         $lubricants = DB::table('lubricants')->orderBy('id', 'asc')->get();
//         $customers = DB::table('customers')
//             ->select('id', 'first_name', 'last_name', 'phone_number')
//             ->get();

//         return view('admin.POS.lubricant', compact('brands', 'batteries', 'lubricants', 'customers'));
//     }

//     /**
//      * Create a new customer.
//      */
//     public function createCustomer(Request $request)
//     {
//         $validated = $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'phone_number' => 'required|string|max:15|unique:customers',
//             'email' => 'nullable|email|max:255',
//             'address' => 'required|string|max:255',
//         ]);

//         try {
//             DB::table('customers')->insert($validated);
//             return redirect()->back()->with('success', 'Customer created successfully!');
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', 'Failed to create customer: ' . $e->getMessage());
//         }
//     }

//     /**
//  * Store a new battery order.
//  */
// public function storeOrder(Request $request)
// {
//     try {
//         // Validate incoming data
//         $validated = $request->validate([
//             'payment_method' => 'required|string|max:255',
//             'items' => 'required|string',
//             'all_ids' => 'required|string',
//             'subtotal' => 'required|numeric|min:0',
//             'c_phone_number' => 'required|string|max:15',
//             'order_type' => 'required|string|max:50',
//         ]);

//         // Generate unique order ID
//         $latestOrder = DB::table('battery_order')->latest('id')->first();
//         $orderNumber = $latestOrder ? (int)Str::substr($latestOrder->order_id, 2) + 1 : 1;
//         $orderId = 'BO' . str_pad($orderNumber, 4, '0', STR_PAD_LEFT);

//         // Calculate total if needed (adjust logic if discounts or taxes apply)
//         $total = $validated['subtotal']; // Use additional logic for discounts/taxes if applicable

//         // Start database transaction
//         DB::beginTransaction();

//         // Insert data into the battery_order table
//         $batteryOrderId = DB::table('battery_order')->insertGetId([
//             'order_id' => $orderId,
//             'c_phone_number' => $validated['c_phone_number'],
//             'payment_method' => $validated['payment_method'],
//             'items' => $validated['items'],
//             'all_ids' => $validated['all_ids'],
//             'subtotal' => $validated['subtotal'],
//             'total' => $total,
//             'order_type' => $validated['order_type'],
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);

//         // Split the all_ids column into individual IDs
//         $allIds = explode(',', $validated['all_ids']);

//         // Insert data into the border_store table
//         $borderStoreData = [];
//         foreach ($allIds as $allId) {
//             $borderStoreData[] = [
//                 'battery_order_id' => $batteryOrderId, // Foreign key linking to battery_order table
//                 'all_id' => $allId,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ];
//         }

//         // Perform bulk insert
//         DB::table('border_store')->insert($borderStoreData);

//         // Commit transaction
//         DB::commit();

//         // Return success response
//         return redirect()->back()->with('success', 'Order placed successfully!');
//     } catch (\Exception $e) {
//         // Rollback transaction in case of error
//         DB::rollBack();

//         // Log error for debugging
//         Log::error('Error placing order: ' . $e->getMessage());

//         // Return error response
//         return redirect()->back()->with('error', 'Failed to place order. Please try again.');
//     }
// }





// public function storeOrderLubrican(Request $request)
//     {
//         // Validate incoming data
//         $validated = $request->validate([
//             'payment_method' => 'required|string|max:255',
//             'items' => 'required|string',
//             'all_ids' => 'required|string',
//             'subtotal' => 'required|numeric',
//             'c_phone_number' => 'required|string|max:15',
//             'order_type' => 'required|string|max:50',
//         ]);

//         // Generate unique order ID
//         $latestOrder = DB::table('lubricant_orders')->latest('id')->first();
//         $orderNumber = $latestOrder ? (int)Str::substr($latestOrder->order_id, 2) + 1 : 1;
//         $orderId = 'LO' . str_pad($orderNumber, 4, '0', STR_PAD_LEFT);

//         // Calculate total (if needed, otherwise set a default or include it in the form)
//         $total = $validated['subtotal']; // Modify as per your logic

//         // Insert data into database
//         DB::table('lubricant_orders')->insert([
//             'order_id' => $orderId,
//             'c_phone_number' => $validated['c_phone_number'],
//             'payment_method' => $validated['payment_method'],
//             'all_ids' => $validated['all_ids'],
//             'subtotal' => $validated['subtotal'],
//             'total' => $total,
//             'order_type' => $validated['order_type'],

//         ]);

//         // Return response (or redirect)
//         return redirect()->back()->with('success', 'Order placed successfully!');
//     }




    // public function bsummary()
    // {
    //     // Fetch battery orders along with customer and battery details
    //     $batteryOrders = DB::select("
    //         SELECT
    //             bo.order_id,
    //             bo.all_ids,
    //             c.first_name,
    //             c.last_name,
    //             c.phone_number AS customer_phone_number,
    //             bo.payment_method,
    //             bo.order_type,
    //             bo.items,
    //             bo.subtotal,
    //             bo.total,
    //             b.id AS battery_id,
    //             b.brand_id,
    //             b.model_name
    //         FROM
    //             battery_order bo
    //         JOIN
    //             customers c
    //             ON c.phone_number COLLATE utf8mb4_general_ci = bo.c_phone_number COLLATE utf8mb4_general_ci
    //         LEFT JOIN
    //             batteries b
    //             ON FIND_IN_SET(b.id, bo.all_ids) > 0
    //         ORDER BY
    //             bo.order_id,
    //             b.id
    //     ");

    //     // Group battery orders by `order_id` and attach battery details
    //     $batteryOrdersGrouped = [];
    //     foreach ($batteryOrders as $order) {
    //         $orderId = $order->order_id;

    //         // Initialize the order entry in the grouped array if it doesn't exist
    //         if (!isset($batteryOrdersGrouped[$orderId])) {
    //             $batteryOrdersGrouped[$orderId] = [
    //                 'order_id' => $order->order_id,
    //                 'customer_name' => $order->first_name . ' ' . $order->last_name,
    //                 'customer_phone' => $order->customer_phone_number,
    //                 'payment_method' => $order->payment_method,
    //                 'order_type' => $order->order_type,
    //                 'items' => $order->items,
    //                 'subtotal' => $order->subtotal,
    //                 'total' => $order->total,
    //                 'batteries' => []
    //             ];
    //         }

         
    //         if ($order->battery_id) {
    //             $batteryOrdersGrouped[$orderId]['batteries'][] = [
    //                 'id' => $order->battery_id,
    //                 'brand_id' => $order->brand_id,
    //                 'model_name' => $order->model_name
    //             ];
    //         }
    //     }

    //     // Convert the grouped orders to a sequential array for the view
    //     $batteryOrdersGrouped = array_values($batteryOrdersGrouped);

    //     // Pass the grouped battery orders to the view
    //     return view('admin.POS.bsummary', compact('batteryOrdersGrouped'));
    // }







    // public function lubricantshow(){

    // }

//     public function filterBatteriesByBrand($brandId)
// {
//     $batteries = DB::table('batteries')->where('brand_id', $brandId)->get();
//     return response()->json($batteries);
// }


// public function filterLubricantByBrand($brandId)
// {
//     $lubricants = DB::table('lubricants')->where('brand_id', $brandId)->get();
//     return response()->json($lubricants);
// }




// }

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\LubricantOrder;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Lubricant; 
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str; // Correctly import the Str class

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


        public function lubricant()
    {
        $brands = DB::table('brands')->where('type', 'lubricant')->get();
        $batteries = DB::table('batteries')->orderBy('id', 'asc')->get();
        $lubricants = DB::table('lubricants')->orderBy('id', 'asc')->get();
        $customers = DB::table('customers')
            ->select('id', 'first_name', 'last_name', 'phone_number')
            ->get();

        return view('admin.POS.lubricant', compact('brands', 'batteries', 'lubricants', 'customers'));
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

          // Generate unique order ID
        $latestOrder = DB::table('battery_orders')->latest('id')->first();
        $orderNumber = $latestOrder ? (int)Str::substr($latestOrder->order_id, 2) + 1 : 1;
        $orderId = 'BO' . str_pad($orderNumber, 4, '0', STR_PAD_LEFT);

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

            return redirect()->route('admin.POS.index')->with('success', 'Purchase Saved successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return response()->json([
                'error' => 'An error occurred while placing the order.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }



/**
 * Store a new lubricant order in the lubricant_orders table.
 */


// public function storeLubricantOrder(Request $request)
// {
//     $items = json_decode($request->input('items'), true);

   
//     $validatedData = $request->validate([
//         'customer_id' => 'required|exists:customers,id',
//         'subtotal' => 'required|numeric|min:0',
//         'total_price' => 'required|numeric|min:0',
//         'paid_amount' => 'required|numeric|min:0',
//         'due_amount' => 'required|numeric|min:0',
//         'payment_type' => 'required|in:Cash,Card,Bank Transfer',
//         'order_type' => 'required|in:New Order,Old Battery,Repair',
//         'unit' => 'required|numeric|min:1',
//         'measurement_type' => 'required|in:barrel,liter,drum',
//         'items' => 'required|json',
//         'c_phone_number' => 'required|string',
//     ]);

    
//     if ($validatedData['paid_amount'] + $validatedData['due_amount'] != $validatedData['total_price']) {
//         return response()->json(['error' => 'Paid and due amounts must match the total price.'], 400);
//     }

   
//     $latestOrder = DB::table('lubricant_orders')->latest('id')->first();
//     $orderNumber = $latestOrder ? (int)Str::substr($latestOrder->order_id, 2) + 1 : 1;
//     $orderId = 'LO' . str_pad($orderNumber, 4, '0', STR_PAD_LEFT);

  
//     $paymentStatus = $validatedData['due_amount'] > 0 ? 'Not Completed' : 'Completed';

//     DB::beginTransaction();

//     try {
      
//         $LubricantOrder = new LubricantOrder();
//         $LubricantOrder->order_id = $orderId;
//         $LubricantOrder->c_phone_number = $validatedData['c_phone_number'];
//         $LubricantOrder->order_type = $validatedData['order_type'];
//         $LubricantOrder->items = $request->input('items'); // Avoid re-encoding
//         $LubricantOrder->subtotal = $validatedData['subtotal'];
//         $LubricantOrder->total_price = $validatedData['total_price'];
//         $LubricantOrder->paid_amount = $validatedData['paid_amount'];
//         $LubricantOrder->due_amount = $validatedData['due_amount'];
//         $LubricantOrder->payment_type = $validatedData['payment_type'];
//         $LubricantOrder->payment_status = $paymentStatus;
//         $LubricantOrder->unit = $validatedData['unit'];
//         $LubricantOrder->measurement_type = $validatedData['measurement_type'];
//         $LubricantOrder->created_at = now();
//         $LubricantOrder->updated_at = now();
//         $LubricantOrder->save();

      
//         $customer = Customer::findOrFail($validatedData['customer_id']);
//         $purchaseHistory = json_decode($customer->purchase_history ?? '[]', true);
//         $purchaseHistory[] = ['lubricant_order_id' => $LubricantOrder->order_id];
//         $customer->purchase_history = json_encode($purchaseHistory);
//         $customer->save();

//         foreach ($items as $item) {
//             if (!isset($item['lubricant_id']) || !isset($item['quantity'])) {
//                 DB::rollBack();
//                 return response()->json(['error' => 'Invalid item data structure.'], 400);
//             }

//             $lubricant = Lubricant::find($item['lubricant_id']);
//             if (!$lubricant) {
//                 DB::rollBack();
//                 return response()->json(['error' => "Lubricant ID {$item['lubricant_id']} not found."], 404);
//             }

//             if ($lubricant->stock_quantity < $item['quantity']) {
//                 DB::rollBack();
//                 return response()->json(['error' => "Insufficient stock for Lubricant ID {$item['lubricant_id']}."], 400);
//             }

//             $lubricant->stock_quantity -= $item['quantity'];
//             $lubricant->save();
//         }

//         DB::commit();
//         return redirect()->route('admin.POS.lubricant')->with('success', 'Order placed successfully!');
        
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json([
//             'error' => 'An error occurred while placing the order.',
//             'details' => $e->getMessage(),
//         ], 500);
//     }
// }



public function storeOrderLubricant(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'order_type' => 'required|string',
        'measurement_type' => 'required|string',
        'unit' => 'required|integer|min:1',
        'total_items' => 'required|string',
        'all_id' => 'required|string',
        'total_price' => 'required|numeric',
        'paid_amount' => 'required|numeric',
        'due_amount' => 'required|numeric',
        'payment_type' => 'required|string',
        'customer_id' => 'nullable|integer',
    ]);

    try {
        // Use a database transaction to ensure atomicity
        DB::beginTransaction();

        // Generate the order_id (e.g., LO0001, LO0002)
        $latestOrder = DB::table('lubricant_orders')->latest('id')->first();
        $nextOrderId = $latestOrder ? ('LO' . str_pad($latestOrder->id + 1, 4, '0', STR_PAD_LEFT)) : 'LO0001';

        // Insert data into the lubricant_orders table
        $orderId = DB::table('lubricant_orders')->insertGetId([
            'order_id' => $nextOrderId,
            'coustomer_id' => $request->customer_id,
            'order_type' => $request->order_type,
            'items' => $request->total_items,
            'all_id' => $request->all_id,
            'lubricant_discount' => 0, // Default discount
            'subtotal' => $request->subtotal ?? 0, // Optional subtotal
            'total_price' => $request->total_price,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->due_amount > 0 ? 'Pending' : 'Paid',
            'unit' => $request->unit,
            'mesurement' => $request->unit,
            'mesurement_type' => $request->measurement_type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert data into the lubricant_purchase table
        DB::table('lubricant_purchase')->insert([
            'lubricant_orders_id' => $orderId,
            'total_price' => $request->total_price,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->due_amount > 0 ? 'Pending' : 'Paid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Commit the transaction
        DB::commit();

        // Redirect with success message
        return redirect()->back()->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
    }
}



public function storeLubricantOrderItems($orderId, $allIdsString)
{
    try {
        // Split the comma-separated IDs into an array
        $allIds = explode(',', $allIdsString);

        // Validate IDs against the lubricants table
        $validIds = DB::table('lubricants')
            ->whereIn('id', $allIds)
            ->pluck('id')
            ->toArray();

        // Insert valid IDs into lubricant_order_items table
        foreach ($validIds as $lubricantId) {
            DB::table('lubricant_order_items')->insert([  
                'lubricant_order_id' => $orderId,
                'lubricant_id' => $lubricantId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Lubricant order items processed successfully.']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to process order items: ' . $e->getMessage()], 500);
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
