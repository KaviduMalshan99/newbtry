@extends('layouts.simple.master')
@section('title', 'Edit Brand')
@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Brand Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('brand.show', $brand->id) : route('brand.index') }}">
            Brand
        </a></li>
    <li class="breadcrumb-item active">Edit Brand</li>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-md-11 mb-4">
                        <h2 class="content-title">Edit Brand</h2>
                    </div>
                    <div class="col-md-1 mb-4">
                        <a href="{{ route('brand.index') }}"
                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                    </div>
                </div>
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
                        <input type="text" name="brand_name" id="brand_name" class="form-control"
                            value="{{ $brand->brand_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Brand Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if ($brand->image)
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->brand_name }}"
                                class="img-thumbnail mt-2" style="width: 150px;">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $brand->date }}"
                            required>
                    </div>

                    <button type="submit" class="btn btn-success">Update Brand</button>
                    <a href="{{ route('brand.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
