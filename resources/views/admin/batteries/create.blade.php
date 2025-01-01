@extends('layouts.simple.master')
@section('title', 'Battery Management')

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
    <li class="breadcrumb-item active">Add Battery</li>
@endsection

@section('content')
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Add New Battery</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ route('batteries.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                            </div>
                        </div>
                        <form
                            action="{{ isset($battery) ? route('batteries.update', $battery->id) : route('batteries.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($battery))
                                @method('PUT')
                            @endif


                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Type -->
                                    <div class="form-group my-3">
                                        <label for="type" class="pb-3">Type</label>
                                        <input type="text" name="type" class="form-control"
                                            value="{{ old('type', $battery->type ?? '') }}" required>
                                        @error('type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Brand -->
                                    <div class="form-group   my-3">
                                        <label for="brand" class="pb-3">Brand</label>
                                        <input type="text" name="brand" class="form-control"
                                            value="{{ old('brand', $battery->brand ?? '') }}" required>
                                        @error('brand')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Model Name -->
                                    <div class="form-group  my-3">
                                        <label for="model_name" class="pb-3">Model Name</label>
                                        <input type="text" name="model_name" class="form-control"
                                            value="{{ old('model_name', $battery->model_name ?? '') }}" required>
                                        @error('model_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Capacity -->
                                    <div class="form-group  my-3">
                                        <label for="capacity" class="pb-3">Capacity (Ah)</label>
                                        <input type="number" name="capacity" class="form-control" step="0.01"
                                            value="{{ old('capacity', $battery->capacity ?? '') }}" required>
                                        @error('capacity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>






                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Voltage -->
                                    <div class="form-group  my-3">
                                        <label for="voltage" class="pb-3">Voltage (V)</label>
                                        <input type="text" name="voltage" class="form-control"
                                            value="{{ old('voltage', $battery->voltage ?? '') }}" required>
                                        @error('voltage')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Purchase Price -->
                                    <div class="form-group  my-3">
                                        <label for="purchase_price" class="pb-3">Purchase Price</label>
                                        <input type="number" name="purchase_price" class="form-control" step="0.01"
                                            value="{{ old('purchase_price', $battery->purchase_price ?? '') }}" required>
                                        @error('purchase_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>







                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Selling Price -->
                                    <div class="form-group  my-3">
                                        <label for="selling_price" class="pb-3">Selling Price</label>
                                        <input type="number" name="selling_price" class="form-control" step="0.01"
                                            value="{{ old('selling_price', $battery->selling_price ?? '') }}" required>
                                        @error('selling_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Warranty Period -->
                                    <div class="form-group  my-3">
                                        <label for="warranty_period" class="pb-3">Warranty Period (Months)</label>
                                        <input type="number" name="warranty_period" class="form-control"
                                            value="{{ old('warranty_period', $battery->warranty_period ?? '') }}" required>
                                        @error('warranty_period')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>








                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Manufacturing Date -->
                                    <div class="form-group  my-3">
                                        <label for="manufacturing_date" class="pb-3">Manufacturing Date</label>
                                        <input type="date" name="manufacturing_date" class="form-control"
                                            value="{{ old('manufacturing_date', $battery->manufacturing_date ?? '') }}"
                                            required>
                                        @error('manufacturing_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Expiry Date -->
                                    <div class="form-group  my-3">
                                        <label for="expiry_date" class="pb-3">Expiry Date</label>
                                        <input type="date" name="expiry_date" class="form-control"
                                            value="{{ old('expiry_date', $battery->expiry_date ?? '') }}">
                                        @error('expiry_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Stock Quantity -->
                                    <div class="form-group  my-3">
                                        <label for="stock_quantity" class="pb-3">Stock Quantity</label>
                                        <input type="number" name="stock_quantity" class="form-control"
                                            value="{{ old('stock_quantity', $battery->stock_quantity ?? '') }}" required>
                                        @error('stock_quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <!-- Added Date -->
                                    <div class="form-group  my-3">
                                        <label for="added_date" class="pb-3">Added Date</label>
                                        <input type="date" name="added_date" class="form-control"
                                            value="{{ old('added_date', $battery->added_date ?? '') }}" required>
                                        @error('added_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>







                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Battery Image -->
                                    <div class="form-group  my-3">
                                        <label for="image" class="pb-3">Battery Image</label>
                                        <input type="file" name="image" class="form-control"
                                            {{ isset($battery) ? '' : 'required' }}>
                                        @if (isset($battery) && $battery->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $battery->image) }}" alt="Battery Image"
                                                    width="100">
                                            </div>
                                        @endif
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>





                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mt-3">
                                {{ isset($battery) ? 'Update' : 'Create' }} Battery
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Add custom scripts if needed -->
@endsection
