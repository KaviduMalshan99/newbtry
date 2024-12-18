



@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

{{-- 
@section('content')
<div class="container">
    <h1>Batteries</h1>
    <a href="{{ route('batteries.create') }}" class="btn btn-primary mb-3">Add New Battery</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Model Number</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
                <th>Stock Quantity</th>
                <th>Rental Price/Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($batteries as $battery)
            <tr>
                <td>{{ $battery->id }}</td>
                <td>{{ $battery->type }}</td>
                <td>{{ $battery->brand }}</td>
                <td>{{ $battery->model_number }}</td>
                <td>{{ $battery->purchase_price }}</td>
                <td>{{ $battery->sale_price }}</td>
                <td>{{ $battery->stock_quantity }}</td>
                <td>{{ $battery->rental_price_per_day }}</td>
                <td>
                    <a href="{{ route('batteries.edit', $battery) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('batteries.destroy', $battery) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}



@extends('layouts.simple.master')
@section('title', 'Bootstrap Basic Tables')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bootstrap Basic Tables</h3>
@endsection

{{-- @section('breadcrumb-items')
<li class="breadcrumb-item">Bootstrap Tables</li>

@endsection --}}

@section('content')
 <div class="container-fluid basic_table">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  


                    <div class="container  card-body">
                        <form action="{{ route('lubricants.update', $lubricant->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $lubricant->name) }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" class="form-control" value="{{ old('brand', $lubricant->brand) }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price</label>
                                <input type="number" name="purchase_price" class="form-control" value="{{ old('purchase_price', $lubricant->purchase_price) }}" step="0.01" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price', $lubricant->sale_price) }}" step="0.01" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="stock_quantity">Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $lubricant->stock_quantity) }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" name="unit" class="form-control" value="{{ old('unit', $lubricant->unit) }}" required>
                            </div>
                    
                            <button type="submit" class="btn btn-success">Update Lubricant</button>
                        </form>
                    </div>


                </div>
              </div>
            </div>
        </div>
             
         
@endsection

@section('script')
@endsection