@extends('layouts.simple.master')

@section('title', 'Add Brand')

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
    <li class="breadcrumb-item active">Add Brand</li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-md-11 mb-4">
                        <h2 class="content-title">Add Brand</h2>
                    </div>
                    <div class="col-md-1 mb-4">
                        <a href="{{ route('brand.index') }}"
                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                    </div>
                </div>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group  my-2">
                        <label for="type" class="pb-2">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="battery">Battery</option>
                            <option value="lubricant">Lubricant</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="brand_name" class="pb-2">Brand Name</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <label for="image" class="pb-2">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <label for="date" class="pb-2">Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary my-2">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
