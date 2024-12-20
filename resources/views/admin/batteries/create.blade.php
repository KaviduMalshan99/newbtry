@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Batteries Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('batteries.show', $battery->id) : route('batteries.index') }}">
            Batteries
        </a></li>
    <li class="breadcrumb-item active">Add New Battery</li>
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
                                <h2 class="content-title">Add New Batteries</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('batteries.show', $battery->id) : route('batteries.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                      

                            <form id="supplierForm" action="{{ isset($battery) ? route('batteries.update', $battery->id) : route('batteries.store') }}" method="POST">
                                @csrf
                                @if(isset($battery))
                                    @method('PUT')
                                @endif
                    
                                
                            <div class="mb-4">
                                <label for="name" class="form-label">Type</label>
                                <input type="text" name="type" class="form-control" value="{{ old('type', $battery->type ?? '') }}" 
                                    id="type" required />
                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" class="form-control" value="{{ old('brand', $battery->brand ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="model_number my-2">Model Number</label>
                                <input type="text" name="model_number" class="form-control" value="{{ old('model_number', $battery->model_number ?? '') }}" required>
                                </div>
                            </div>
                      


                         

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="purchase_price my-2">Purchase Price</label>
                                <input type="number" name="purchase_price" class="form-control" step="0.01" value="{{ old('purchase_price', $battery->purchase_price ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="sale_price my-2">Sale Price</label>
                                    <input type="number" name="sale_price" class="form-control" step="0.01" value="{{ old('sale_price', $battery->sale_price ?? '') }}" required>
                                </div>
                            </div>


                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="stock_quantity my-2">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $battery->stock_quantity ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="rental_price_per_day my-2">Rental Price/Day</label>
                                    <input type="number" name="rental_price_per_day" class="form-control" step="0.01" value="{{ old('rental_price_per_day', $battery->rental_price_per_day ?? '') }}" required>
                                </div>
                            </div>


                            {{-- add image --}}
                            <div class="mb-4">
                                <label for="file" class="form-label">Image</label>
                                <input type="file" name="file" class="form-control" id="file" {{ isset($battery) ? '' : '' }} />
                                @if(isset($battery) && $battery->image_path)
                                    <img src="{{ asset('storage/' . $battery->image_path) }}" alt="Battery Image" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>

                           




                            <div class="mb-4">
                                {{-- <button type="submit" form="supplierForm" class="btn btn-success col-md-3">Save</button> --}}
                                <button type="submit" class="btn btn-primary my-2">{{ isset($battery) ? 'Update' : 'Create' }} Save</button>
                            </div>
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
