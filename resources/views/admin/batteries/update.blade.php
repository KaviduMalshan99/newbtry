

@extends('layouts.simple.master')


@section('title', 'Bootstrap Basic Tables')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Batteries</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Batteries Update</li>

@endsection


@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection



<div class="container">

    <h2>Edit Battery</h2>

    <!-- Form to update an existing battery -->
    <form action="{{ route('batteries.update', $battery->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $battery->type) }}" required>
        </div>

        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ old('brand', $battery->brand) }}" required>
        </div>

        <div class="form-group">
            <label for="model_number">Model Number</label>
            <input type="text" name="model_number" class="form-control" value="{{ old('model_number', $battery->model_number) }}" required>
        </div>

        <div class="form-group">
            <label for="purchase_price">Purchase Price</label>
            <input type="number" name="purchase_price" class="form-control" step="0.01" value="{{ old('purchase_price', $battery->purchase_price) }}" required>
        </div>

        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="number" name="sale_price" class="form-control" step="0.01" value="{{ old('sale_price', $battery->sale_price) }}" required>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $battery->stock_quantity) }}" required>
        </div>

        <div class="form-group">
            <label for="rental_price_per_day">Rental Price/Day</label>
            <input type="number" name="rental_price_per_day" class="form-control" step="0.01" value="{{ old('rental_price_per_day', $battery->rental_price_per_day) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Battery</button>
    </form>

</div>
     


@section('script')

@endsection