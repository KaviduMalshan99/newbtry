@extends('layouts.simple.master')
@section('title', 'Edit Lubricant')

@section('content')
<div class="container">
    <h3>Edit Lubricant</h3>
    <form action="{{ route('lubricants.update', $lubricant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Lubricant Name</label>
            <input type="text" class="form-control" name="name" value="{{ $lubricant->name }}" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" name="brand" value="{{ $lubricant->brand }}" required>
        </div>
        <div class="form-group">
            <label for="purchase_price">Purchase Price</label>
            <input type="number" class="form-control" name="purchase_price" value="{{ $lubricant->purchase_price }}" required>
        </div>
        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="number" class="form-control" name="sale_price" value="{{ $lubricant->sale_price }}" required>
        </div>
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" class="form-control" name="stock_quantity" value="{{ $lubricant->stock_quantity }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" name="type" value="{{ $lubricant->type }}" required>
        </div>
        
        <div class="form-group">
            <label for="unit">Unit</label>
            <input type="text" class="form-control" name="unit" value="{{ $lubricant->unit }}" required>
        </div>
        <div class="form-group">
            <label for="image">Lubricant Image</label>
            <input type="file" class="form-control" name="image">
            @if ($lubricant->image)
                <img src="{{ asset('storage/' . $lubricant->image) }}" alt="Lubricant Image" class="img-thumbnail mt-2" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
