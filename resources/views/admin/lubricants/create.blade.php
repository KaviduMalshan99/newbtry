@extends('layouts.simple.master')
@section('title', 'Add Lubricant')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
    <h3 class="my-3 pb-3">Add New Lubricant</h3>
    <form action="{{ route('lubricants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group my-3 ">
            <label for="name" class="pb-2">Lubricant Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group my-2">
                    <label for="brand_id" class="pb-2">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="" disabled {{ old('brand_id', $battery->brand_id ?? '') == '' ? 'selected' : '' }}>Select a Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}" {{ old('brand_id', $battery->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand_id }} - {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            {{-- <div class="col-sm-6"> <div class="form-group my-2">
                <label for="purchase_price" class="pb-2">Purchase Price</label>
                <input type="number" class="form-control" name="purchase_price" required>
            </div></div> --}}

            <div class="col-sm-6">
                
                {{-- <div class="form-group my-2">
                <label for="type" class="pb-2">Type</label>
                <input type="text" class="form-control" name="type" required>
            </div> </div> --}}

            <div class="form-group ">
                <label for="unit_type" class="py-2">Unit Type</label>
                <select name="type" class="form-control" required>
                    <option value="Drum">Drum</option>
                    <option value="Bottle">Bottle</option>
                    <option value="Liter">Liter</option>
                </select>
            </div>

        </div>

        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="form-group my-3">
                    <label for="volume" class="pb-2">Volume</label>
                    <input type="text" class="form-control" name="volume" placeholder="Enter volume (e.g., 50000 ml)" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group my-3">
                    <label for="total" class="pb-2">Total Quantity</label>
                    <input type="text" class="form-control" name="total_count" placeholder="Enter total quantity (e.g., 20 bottles, 5 drums)" required>
                </div>
            </div>

        </div>



        <div class="row">

            {{-- <div class="col-sm-6">
                <div class="form-group my-3">
                    <label for="sale_price" class="pb-2">Sale Price</label>
                    <input type="number" class="form-control" name="sale_price" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group my-3">
                    <label for="stock_quantity" class="pb-2">Stock Quantity</label>
                    <input type="number" class="form-control" name="stock_quantity" required>
                </div>
            </div> --}}

        </div>


        {{-- <div class="row">
            <div class="col-sm-6"><div class="form-group my-3">
                <label for="type" class="pb-2">Type</label>
                <input type="text" class="form-control" name="type" required>
            </div> </div> --}}
            {{-- <div class="col-sm-6"> <div class="form-group my-3">
                <label for="unit" class="pb-2">Unit</label>
                <input type="text" class="form-control" name="unit" required>
            </div> </div> --}}
        </div>


        <div class="row">
            <div class="col-sm-12 ms-4">
                <div class="form-group my-3">
                    <label for="image" class="pb-2">Lubricant Image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary my-3">Save</button>
            </div>
        </div>
            
            </form>
        </div>
        </div>
        </div>
@endsection
