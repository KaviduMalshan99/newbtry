@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Supplier Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('suppliers.show', $supplier->id) : route('suppliers.index') }}">
            Suppliers
        </a></li>
    <li class="breadcrumb-item active">Update Supplier</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">
                    <h2 class="content-title">Update Suppliers</h2>
                    <div>
                        {{-- <a href="{{ route('suppliers.show', 'view') }}"
                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                            Back
                        </a> --}}

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="supplierForm" action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $supplier->name }}" placeholder="Type here"
                                    class="form-control" id="name" required />
                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $supplier->email }}"
                                        placeholder="Type here" class="form-control" id="email" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" name="phone_number" value="{{ $supplier->phone_number }}"
                                        placeholder="Type here" class="form-control" id="phone_number" required />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" value="{{ $supplier->address }}" name="address"
                                    placeholder="Type here" class="form-control" id="address" required />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Product Type</label>
                                {{-- <select name="product_type" class="form-select" required>
                                @foreach ($productTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ $supplier->product_type == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select> --}}
                                <div class="col-lg-12">
                                    @foreach ($productTypes as $type)
                                        <label class="form-check my-2">
                                            <input type="checkbox" class="form-check-input" name="product_type[]"
                                                value="{{ $type }}"
                                                {{ in_array($type, json_decode($supplier->product_type, true)) ? 'checked' : '' }} />
                                            <span class="form-check-label">{{ ucfirst($type) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-4">
                                <button form="supplierForm" class="btn btn-primary col-md-3" type="submit">Update</button>
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
