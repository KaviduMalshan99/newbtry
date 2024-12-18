@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Customer Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('customers.show', $customer->id) : route('customers.index') }}">
            Customers
        </a></li>
    <li class="breadcrumb-item active">Update Customers</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">

                    <h3 class="content-title">Update Customers</h3>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="customerForm" action="{{ route('customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="first_name" class="form-label">Frist Name</label>
                                    <input type="text" name="first_name" value="{{ $customer->first_name }}"
                                        placeholder="Type here" class="form-control" id="first_name" required />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" value="{{ $customer->last_name }}"
                                        {{ $customer->last_name }}placeholder="Type here" class="form-control"
                                        id="last_name" required />
                                </div>
                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $customer->email }}"
                                        placeholder="Type here" class="form-control" id="email" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" name="phone_number" value="{{ $customer->phone_number }}"
                                        placeholder="Type here" class="form-control" id="phone_number" required />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" value="{{ $customer->address }}"
                                    placeholder="Type here" class="form-control" id="address" required />
                            </div>
                            <div class="mb-4">
                                <button form="customerForm" class="btn btn-primary col-md-3" type="submit">Update</button>
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
