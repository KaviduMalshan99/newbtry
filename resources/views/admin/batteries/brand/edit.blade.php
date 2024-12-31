@extends('layouts.simple.master')
@section('title', 'Edit Brand')

@section('content')
<div class="container">
    <h1>Edit Brand</h1>
    <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="battery" {{ $brand->type == 'battery' ? 'selected' : '' }}>Battery</option>
                <option value="lubricant" {{ $brand->type == 'lubricant' ? 'selected' : '' }}>Lubricant</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="brand_name" class="form-label">Brand Name</label>
            <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{ $brand->brand_name }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Brand Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($brand->image)
                <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->brand_name }}" class="img-thumbnail mt-2" style="width: 150px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $brand->date }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Brand</button>
        <a href="{{ route('brand.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
