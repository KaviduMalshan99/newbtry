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
    <h3>Battery Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Battery Management</li>
    <li class="breadcrumb-item">Add Battery</li>

@endsection

@section('content')
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">



                    <div class="container  card-body">
                        <!-- Form to create or update battery -->
                        <form
                            action="{{ isset($battery) ? route('batteries.update', $battery->id) : route('batteries.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($battery))
                                @method('PUT')
                            @endif

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="type my-2">Type</label>
                                    <input type="text" name="type" class="form-control"
                                        value="{{ old('type', $battery->type ?? '') }}" required>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ old('brand', $battery->brand ?? '') }}" required>

                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="model_number my-2">Model Number</label>
                                <input type="text" name="model_number" class="form-control"
                                    value="{{ old('model_number', $battery->model_number ?? '') }}" required>

                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="purchase_price my-2">Purchase Price</label>
                                    <input type="number" name="purchase_price" class="form-control" step="0.01"
                                        value="{{ old('purchase_price', $battery->purchase_price ?? '') }}" required>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="sale_price my-2">Sale Price</label>
                                    <input type="number" name="sale_price" class="form-control" step="0.01"
                                        value="{{ old('sale_price', $battery->sale_price ?? '') }}" required>

                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="stock_quantity my-2">Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity', $battery->stock_quantity ?? '') }}" required>

                            </div>
                            <div class="mb-4">
                                <label for="rental_price_per_day my-2">Rental Price/Day</label>
                                <input type="number" name="rental_price_per_day" class="form-control" step="0.01"
                                    value="{{ old('rental_price_per_day', $battery->rental_price_per_day ?? '') }}"
                                    required>

                            </div>
                            <div class="mb-4">
                                <button type="submit"
                                    class="btn btn-primary my-2">{{ isset($battery) ? 'Update' : 'Create' }}
                                    Battery</button>
                            </div>



                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
@endsection
