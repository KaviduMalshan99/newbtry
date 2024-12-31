<?php
namespace App\Http\Controllers;

use App\Models\LPayment;
use Illuminate\Http\Request;

class LpaymentController extends Controller
{
    public function index()
    {
        $payments = LPayment::all();
        return view('admin.Payments.l_payment.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.Payments.l_payment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'nullable|string', 
            'discount' => 'nullable|numeric', 
            'description' => 'nullable|string', 
            'purchase_id' => 'nullable|exists:lubricant_purchases,id', // Validate purchase_id if provided
        ]);
    
        LPayment::create([
            'payment_id' => LPayment::generatePaymentId(),
            'product_type' => $request->product_type,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'discount' => $request->discount ?? 0,
            'status' => $request->status ?? 'Pending',
            'description' => $request->description ?? '',
            'purchase_id' => $request->purchase_id, // Store the purchase_id if provided
        ]);
    
        return redirect()->route('l_payment.index')->with('success', 'Payment created successfully!');
    }
    

    public function edit(LPayment $l_payment)
    {
        return view('admin.Payments.l_payment.edit', compact('l_payment'));
    }

    public function update(Request $request, LPayment $l_payment)
    {
        $request->validate([
            'product_type' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'nullable|string', 
            'discount' => 'nullable|numeric', 
            'description' => 'nullable|string', 
            'purchase_id' => 'nullable|exists:lubricant_purchases,id', // Validate purchase_id if provided
        ]);
    
        // Update the payment record with the validated data
        $l_payment->update([
            'product_type' => $request->product_type,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'discount' => $request->discount ?? 0,
            'status' => $request->status ?? 'Pending',
            'description' => $request->description ?? '',
            'purchase_id' => $request->purchase_id, // Update purchase_id if provided
        ]);
    
        return redirect()->route('l_payment.index')->with('success', 'Payment updated successfully!');
    }
    

    public function destroy(LPayment $l_payment)
    {
        $l_payment->delete();
        return redirect()->route('l_payment.index')->with('success', 'Payment deleted successfully!');
    }
}
