@extends('layouts.simple.master')
@section('title', 'Add Lubricant')

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
    <li class="breadcrumb-item active">Add lubricant</li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-md-11 mb-4">
                        <h2 class="content-title">Add New Lubricant</h2>
                    </div>
                    <div class="col-md-1 mb-4">
                        <a href="{{ route('lubricants.index') }}"
                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                    </div>
                </div>
                <form action="{{ route('lubricants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3 ">
                        <label for="name" class="pb-2">Lubricant Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="brand" class="pb-2">Brand</label>
                                <input type="text" class="form-control" name="brand" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="purchase_price" class="pb-2">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price" required>
                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="sale_price" class="pb-2">Sale Price</label>
                                <input type="number" class="form-control" name="sale_price" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="stock_quantity" class="pb-2">Stock Quantity</label>
                                <input type="number" class="form-control" name="stock_quantity" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="type" class="pb-2">Type</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="unit" class="pb-2">Unit</label>
                                <input type="text" class="form-control" name="unit" required>
                            </div>
                        </div>
                    </div>



                    <div class="form-group my-3">
                        <label for="image" class="pb-2">Lubricant Image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
