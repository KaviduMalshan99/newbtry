<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        $totalItems = $request->input('totalItems');
        $formattedSubtotal = $request->input('formattedSubtotal');
        $formattedTotal = $request->input('formattedTotal');

        // Pass the data to the summary view
        return redirect()->route('summary')->with([
            'totalItems' => $totalItems,
            'formattedSubtotal' => $formattedSubtotal,
            'formattedTotal' => $formattedTotal,
        ]);
    }

    public function summary()
    {
        return view('admin.POS.summary');
    }
}
