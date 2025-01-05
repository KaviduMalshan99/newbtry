<?php

namespace App\Http\Controllers;

use App\Models\BatteryOrder;
use App\Models\Customer;
use App\Models\Repair;
use Illuminate\Http\Request;
use Log;

class CustomerController extends Controller
{
    public function create()
    {
        return view('admin/customers.create'); // Path to the customers.add Blade file.
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'phone_number' => 'required|string|max:15|unique:customers,phone_number',
            'address' => 'required|string|max:255',

        ]);

        // Add purchase history to the data
        // $validated['purchase_history'] = json_encode([
        //     ['item' => 'Laptop', 'amount' => 1200, 'date' => '2024-12-01'],
        //     ['item' => 'Laptop', 'amount' => 1200, 'date' => '2024-12-01'],
        //     ['item' => 'Laptop', 'amount' => 1200, 'date' => '2024-12-01'],
        // ]);

        Customer::create($validated);

        return redirect()->route('customers.create')->with('success', 'Customer added successfully!');
    }

    public function index()
    {
        // Fetch customers with pagination (10 per page)
        $customers = Customer::orderBy('updated_at', 'desc')->paginate(10);

        // Pass the customers to the view
        return view('admin/customers.view', compact('customers'));
    }

    public function viewPurchaseHistory(Customer $customer)
    {
        try {
            // 1. Decode purchase history and get order IDs
            $purchaseHistories = collect(json_decode($customer->purchase_history));
            $orderIds = $purchaseHistories->pluck('battery_order_id')->toArray();

            // 2. Get battery orders
            $batteryOrders = BatteryOrder::whereIn('order_id', $orderIds)->get();

            $validOrders = [];

            foreach ($batteryOrders as $order) {
                // The items string is double-encoded in the database, so we need to:
                // 1. First decode the outer JSON string (removes outer quotes and escapes)
                // 2. Then decode the resulting JSON string to get the actual array

                $firstDecode = json_decode($order->items);

                if ($firstDecode === null) {
                    // \Log::error('First JSON decode failed for order ' . $order->order_id . ': ' . json_last_error_msg());
                    continue;
                }

                $items = json_decode($firstDecode, true);

                if (is_array($items)) {
                    $validOrders[] = [
                        'order_id' => $order->order_id,
                        'items' => $items,
                        'total_price' => $order->total_price,
                        'order_date' => $order->created_at,
                    ];
                } else {
                    // \Log::error('Second JSON decode failed for order ' . $order->order_id . ': ' . json_last_error_msg());
                }
            }

            return view('admin/customers.view-purchase-history', compact('validOrders', 'customer'));
        } catch (\Exception $e) {
            // \Log::error('Purchase history error: ' . $e->getMessage());
            $validOrders = [];
            return view('admin/customers.view-purchase-history', compact('validOrders', 'customer'));
        }
    }



    public function edit(Customer $customer)
    {
        return view('admin/customers.update', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'phone_number' => 'required|string|max:15|unique:customers,phone_number,' . $customer->id,
            'address' => 'required|string|max:255',
        ]);

        $customer->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('customers.index')->with('error', 'Failed to delete customer.');
        }
    }

    public function indexByCustomer($customerId)
    {
        $repairs = Repair::where('customer_id', $customerId)->orderBy('updated_at', 'desc')->get();
        return view('admin.repairs_management.view', compact('repairs'));
    }
}
