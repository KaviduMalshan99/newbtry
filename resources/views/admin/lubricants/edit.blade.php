@extends('layouts.simple.master')
@section('title', 'Edit Lubricant')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Lubricant Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('lubricants.show', $lubricant->id) : route('lubricants.index') }}">
            Lubricant
        </a></li>
    <li class="breadcrumb-item active">Edit lubricant</li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-md-11 mb-4">
                        <h2 class="content-title">Edit Lubricant</h2>
                    </div>
                    <div class="col-md-1 mb-4">
                        <a href="{{ route('lubricants.index') }}"
                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                    </div>
                </div>
                <form action="{{ route('lubricants.update', $lubricant->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Lubricant Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $lubricant->name }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" class="form-control" name="brand" value="{{ $lubricant->brand }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price"
                                    value="{{ $lubricant->purchase_price }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="number" class="form-control" name="sale_price"
                                    value="{{ $lubricant->sale_price }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock_quantity">Stock Quantity</label>
                        <input type="number" class="form-control" name="stock_quantity"
                            value="{{ $lubricant->stock_quantity }}" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" value="{{ $lubricant->type }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" class="form-control" name="unit" value="{{ $lubricant->unit }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Lubricant Image</label>
                        <input type="file" class="form-control" name="image">
                        @if ($lubricant->image)
                            <img src="{{ asset('storage/' . $lubricant->image) }}" alt="Lubricant Image"
                                class="img-thumbnail mt-2" width="100">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
