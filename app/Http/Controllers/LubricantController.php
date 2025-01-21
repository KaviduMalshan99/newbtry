<?php

namespace App\Http\Controllers;

use App\Models\Lubricant;
use App\Models\LubricantOrder;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LubricantController extends Controller
{
    // Display a paginated list of lubricants
    public function index()
    {
        $lubricants = Lubricant::with('brand')->paginate(10);
        return view('admin.lubricants.index', compact('lubricants'));
    }

    // Show form to create a new lubricant
    public function create()
    {
        // Fetch all brands to populate the dropdown list in the form
        $brands = Brand::all();
        return view('admin.lubricants.create', compact('brands'));
    }

    // Store a new lubricant
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',                // Name of the lubricant
            'brand_id' => 'required|exists:brands,brand_id',    // Ensure the brand_id exists in the brands table
            'type' => 'required|string|max:50',                // Lubricant type (e.g., Drum, Bottle)
            'volume' => 'required|string|max:50',              // Volume of the lubricant
            'total_count' => 'required|integer|min:0',         // Total quantity (e.g., 20 bottles)
            'purchase_price' => 'nullable|numeric|min:0',      // Optional purchase price
            'sale_price' => 'nullable|numeric|min:0',          // Optional sale price
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image file
        ]);

        // Handle file upload if the image is present
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('lubricants', 'public');
        }

        // Create a new lubricant record
        Lubricant::create([
            'name' => $validated['name'],
            'brand_id' => $validated['brand_id'],
            'type' => $validated['type'],
            'volume' => $validated['volume'],
            'total_count' => $validated['total_count'],
            'purchase_price' => $validated['purchase_price'] ?? 0, // Default to 0 if null
            'sale_price' => $validated['sale_price'] ?? 0,         // Default to 0 if null
            'image' => $validated['image'] ?? null,               // Default to null if no image
        ]);

        // Redirect with success message
        return redirect()->route('POS.lubricant')->with('success', 'Lubricant created successfully.');

    }


    // Show a specific lubricant
    public function show($id)
    {
        $lubricant = Lubricant::with('brand')->findOrFail($id);
        return view('admin.lubricants.show', compact('lubricant'));
    }

    // Show form to edit an existing lubricant
    public function edit($id)
    {
        $lubricant = Lubricant::findOrFail($id);
        $brands = Brand::all();
        return view('admin.lubricants.edit', compact('lubricant', 'brands'));
    }

    // Update an existing lubricant
    public function update(Request $request, $id)
    {
        $lubricant = Lubricant::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'type' => 'required|string|max:50',
            'volume' => 'required|string|max:50',
            'total_count' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($lubricant->image) {
                Storage::disk('public')->delete($lubricant->image);
            }
            $validated['image'] = $request->file('image')->store('lubricants', 'public');
        }

        $lubricant->update($validated);
        return redirect()->route('lubricants.index')->with('success', 'Lubricant updated successfully.');
    }

    // Delete an existing lubricant
    public function destroy($id)
    {
        $lubricant = Lubricant::findOrFail($id);

        if ($lubricant->image) {
            Storage::disk('public')->delete($lubricant->image);
        }

        $lubricant->delete();
        return redirect()->route('lubricants.index')->with('success', 'Lubricant deleted successfully.');
    }

    // Show lubricant bill
    public function lubricant_bill($id)
    {
        // Fetch the lubricant order details
        $lubricantOrder = DB::table('lubricant_orders')
            ->join('customers', 'lubricant_orders.coustomer_id', '=', 'customers.id')
            ->join('lubricants', 'lubricant_orders.all_id', '=', 'lubricants.id')
            ->join('brands', 'lubricants.brand_id', '=', 'brands.brand_id')
            ->where('lubricant_orders.id', $id)
            ->select(
                'lubricant_orders.*',
                'customers.first_name',
                'customers.last_name',
                'customers.phone_number',
                'lubricants.name as lubricant_name',
                'brands.brand_name'
            )
            ->first();

        // Handle the case where the lubricant order is not found
        if (!$lubricantOrder) {
            return redirect()->back()->with('error', 'Lubricant order not found.');
        }

        // Recursive SQL query for splitting IDs
        $lubricantOrderDetails = DB::select("
            WITH RECURSIVE split_ids AS (
                SELECT
                    id,
                    TRIM(SUBSTRING_INDEX(all_id, ',', 1)) AS lubricant_id,
                    SUBSTRING(all_id FROM LENGTH(SUBSTRING_INDEX(all_id, ',', 1)) + 2) AS remaining_ids
                FROM lubricant_orders
                WHERE id = ?

                UNION ALL

                SELECT
                    id,
                    TRIM(SUBSTRING_INDEX(remaining_ids, ',', 1)) AS lubricant_id,
                    SUBSTRING(remaining_ids FROM LENGTH(SUBSTRING_INDEX(remaining_ids, ',', 1)) + 2)
                FROM split_ids
                WHERE remaining_ids != ''
            )

            SELECT
                L.id,
                L.name,
                L.brand_id,
                L.purchase_price,
                L.sale_price,
                L.stock_quantity,
                L.type,
                L.unit,
                L.volume,
                COUNT(L.id) AS total_count
            FROM
                split_ids S
            JOIN
                lubricants L ON S.lubricant_id = L.id
            GROUP BY
                L.id, L.name, L.brand_id, L.purchase_price, L.sale_price, L.stock_quantity, L.type, L.unit, L.volume
            ORDER BY
                L.id ASC;
        ", [$id]);

        return view('admin.POS.lubricant_bill', compact('lubricantOrder', 'lubricantOrderDetails'));
    }



    // Show list of lubricant orders
    public function lubricant_order()
    {
        // Fetch all lubricant orders along with customer details
        $lubricantOrders = DB::table('lubricant_orders')
            ->join('customers', 'lubricant_orders.coustomer_id', '=', 'customers.id')
            ->select(
                'lubricant_orders.*',
                'customers.first_name',
                'customers.last_name',
                'customers.phone_number',
                'customers.email'
            )
            ->orderBy('lubricant_orders.id', 'desc')
            ->paginate(15000000);
        // Pass data to the view
        return view('admin.POS.lubricant_order', compact('lubricantOrders'));
    }

}
