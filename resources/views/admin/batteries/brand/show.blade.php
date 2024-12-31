@extends('layouts.simple.master')
@section('title', 'Brand Details')

@section('content')
<div class="container">
    <h1>Brand Details</h1>
    <div class="card">
        <div class="card-header">
            <h3>{{ $brand->brand_name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Type:</strong> {{ ucfirst($brand->type) }}</p>
            <p><strong>Brand ID:</strong> {{ $brand->brand_id }}</p>
            <p><strong>Date:</strong> {{ $brand->date }}</p>
            @if($brand->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->brand_name }}" class="img-thumbnail" style="width: 150px;">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('brand.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
