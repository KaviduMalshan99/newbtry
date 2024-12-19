@extends('layouts.simple.master')
@section('title', 'Ecommerce')

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
            href="{{ request()->query('ref') === 'view' ? route('lubricants.show', $lubricants->id) : route('lubricants.index') }}">
            Lubricant
        </a></li>
    <li class="breadcrumb-item active">Add New Lubricant</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Add New Lubricant</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('lubricants.show', $lubricants->id) : route('lubricants.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <!-- Form to create or update battery -->
                        <form action="{{ route('lubricants.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2 ">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                    
                            <div class="form-group mb-2">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" class="form-control" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price</label>
                                <input type="number" name="purchase_price" class="form-control" step="0.01" required>
                            </div>
                    
                            <div class="form-group my-2">
                                <label for="sale_price">Sale Price</label>
                                <input type="number" name="sale_price" class="form-control" step="0.01" required>
                            </div>
                    
                            <div class="form-group mb-2">
                                <label for="stock_quantity">Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control" required>
                            </div>
                    
                            <div class="form-group mb-2">
                                <label for="unit">Unit</label>
                                <input type="text" name="unit" class="form-control" required>
                            </div>
                    
                            <button type="submit" class="btn btn-success  mt-2">Create Lubricant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection
