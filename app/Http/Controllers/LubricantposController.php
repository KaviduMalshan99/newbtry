<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use App\Models\BatteryOrder;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Lubricant;
use App\Models\OldBattery;
use App\Models\RepairBattery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;


class LubricantposController extends Controller
{
    //

    public function placeOrder(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'order_type' => 'required|string|max:255',
        'measurement_type' => 'required|string|max:255',
        'unit' => 'required|numeric',
        'total_items' => 'nullable|numeric',
        'all_id' => 'nullable|string',
        'total_price' => 'required|numeric',
        'paid_amount' => 'required|numeric',
        'due_amount' => 'required|numeric',
        'payment_type' => 'required|string|max:255',
        'customer_id' => 'nullable|numeric',
    ]);

    // Generate the next `order_id`
    $lastOrder = DB::table('lubricant_orders')
        ->select('order_id')
        ->orderBy('id', 'desc')
        ->first();

    $nextOrderId = $lastOrder
        ? str_pad((int)$lastOrder->order_id + 1, 5, '0', STR_PAD_LEFT)
        : '00001';

    // Insert data into `lubricant_orders` table
    DB::table('lubricant_orders')->insert([
        'order_id' => $nextOrderId,
        'order_type' => $validatedData['order_type'],
        'measurement_type' => $validatedData['measurement_type'],
        'unit' => $validatedData['unit'],
        'all_id' => $validatedData['all_id'] ?? null,
        'subtotal' => $validatedData['total_price'], // Assuming subtotal is the same as total_price here
        'total_price' => $validatedData['total_price'],
        'paid_amount' => $validatedData['paid_amount'],
        'due_amount' => $validatedData['due_amount'],
        'payment_type' => $validatedData['payment_type'],
        'payment_status' => $validatedData['due_amount'] == 0 ? 'Paid' : 'Unpaid',
        'coustomer_id' => $validatedData['customer_id'] ?? null,
        'items' => $validatedData['total_items'] ?? 0,
        'lubricant_discount' => 0, // Add logic to calculate this if applicable
    ]);

    // Redirect with success message
    return redirect()->route('POS.index')->with('success', 'Order placed successfully!');
}

  



}
