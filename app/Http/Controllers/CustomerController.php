<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

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
        $validated['purchase_history'] = json_encode([
            ['item' => 'Laptop', 'amount' => 1200, 'date' => '2024-12-01'],
            ['item' => 'Laptop', 'amount' => 1200, 'date' => '2024-12-01'],
            ['item' => 'Laptop', 'amount' => 1200, 'date' => '2024-12-01'],
        ]);

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
        // Decode the JSON purchase history
        $purchaseHistories = collect(json_decode($customer->purchase_history));

        // Pass data to the view
        return view('admin/customers.view-purchase-history', compact('purchaseHistories', 'customer'));
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
}