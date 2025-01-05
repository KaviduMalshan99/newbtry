@extends('layouts.simple.master')

@section('title', 'Update Battery')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Battery Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('batteries.show', $battery->id) : route('batteries.index') }}">
            Battery
        </a></li>
    <li class="breadcrumb-item active">Edit Battery</li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-md-11 mb-4">
                        <h2 class="content-title">Edit Battery</h2>
                    </div>
                    <div class="col-md-1 mb-4">
                        <a href="{{ route('batteries.index') }}"
                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                    </div>
                </div>

                <!-- Form to update an existing battery -->
                <form action="{{ route('batteries.update', $battery->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="model_name" class="mb-2">Model Name</label>
                                <input type="text" name="model_name" class="form-control"
                                    value="{{ old('model_name', $battery->model_name) }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="brand_id" class="mb-2">Brand</label>

                                <select id="brand_id" name="brand_id" class="form-select" required>
                                    <option value="" disabled>Select brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == $battery->brand_id ? 'selected' : '' }}>
                                            {{ $brand->type }} | {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="capacity" class="mb-2">Capacity (Ah)</label>
                                <input type="number" name="capacity" class="form-control"
                                    value="{{ old('capacity', $battery->capacity) }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group my-2">
                                <label for="voltage" class="mb-2">Voltage (e.g., 12V)</label>
                                <input type="text" name="voltage" class="form-control"
                                    value="{{ old('voltage', $battery->voltage) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="type" class="mb-2">Battery Type</label>
                                <input type="text" name="type" class="form-control"
                                    value="{{ old('type', $battery->type) }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group my-2">
                                <label for="warranty_period" class="mb-2">Warranty Period (months)</label>
                                <input type="number" name="warranty_period" class="form-control"
                                    value="{{ old('warranty_period', $battery->warranty_period) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="purchase_price" class="mb-2">Purchase Price</label>
                                <input type="number" name="purchase_price" class="form-control" step="0.01"
                                    value="{{ old('purchase_price', $battery->purchase_price) }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group my-2">
                                <label for="selling_price" class="mb-2">Selling Price</label>
                                <input type="number" name="selling_price" class="form-control" step="0.01"
                                    value="{{ old('selling_price', $battery->selling_price) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="manufacturing_date" class="mb-2">Manufacturing Date</label>
                                <input type="date" name="manufacturing_date" class="form-control"
                                    value="{{ old('manufacturing_date', $battery->manufacturing_date) }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group my-2">
                                <label for="expiry_date" class="mb-2">Expiry Date (if applicable)</label>
                                <input type="date" name="expiry_date" class="form-control"
                                    value="{{ old('expiry_date', $battery->expiry_date) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="stock_quantity" class="mb-2">Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity', $battery->stock_quantity) }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group my-2">
                                <label for="added_date" class="mb-2">Added Date</label>
                                <input type="date" name="added_date" class="form-control"
                                    value="{{ old('added_date', $battery->added_date) }}" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary my-3">Update Battery</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
