<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    // List all brands
    public function index()
    {
        $brands = Brand::all();
        return view('admin.batteries.brand.index', compact('brands'));
    }

    // Show the create form
    public function create()
    {
        return view('admin.batteries.brand.create');
    }

    // Store a new brand
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:battery,lubricant',
            'brand_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'required|date',
        ]);

        // Generate the brand_id based on type
        $prefix = $validatedData['type'] === 'battery' ? 'B' : 'L';
        $lastBrand = Brand::where('type', $validatedData['type'])->latest('id')->first();
        $newId = $lastBrand ? (int)substr($lastBrand->brand_id, 1) + 1 : 1;
        $validatedData['brand_id'] = $prefix . str_pad($newId, 4, '0', STR_PAD_LEFT);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('brands', 'public');
        }

        Brand::create($validatedData);

        return redirect()->route('brand.index')->with('success', 'Brand created successfully!');
    }

    // Show the edit form
    public function edit(Brand $brand)
    {
        return view('admin.batteries.brand.edit', compact('brand'));
    }

    // Update a brand
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:battery,lubricant',
            'brand_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'required|date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            $validatedData['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand->update($validatedData);

        return redirect()->route('brand.index')->with('success', 'Brand updated successfully!');
    }

    // Delete a brand
    public function destroy(Brand $brand)
    {
        // Delete the image if it exists
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully!');
    }

    // Show the details of a brand
    public function show(Brand $brand)
    {
        return view('admin.batteries.brand.show', compact('brand'));
    }

    public function getAllBrands()
    {
        $brands = DB::table('brands')->where('type', 'battery')->get();
        return response()->json($brands);
    }
}
