@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Repair Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}">
            Repairs
        </a></li>
    <li class="breadcrumb-item active">Update Repair</li>
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
                                <h2 class="content-title">Update Repairs</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="repairForm" action="{{ route('repairs.update', $repair) }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            @method('PUT')
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" required>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $repair->customer_id ? 'selected' : '' }}>
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="add_customer_view" class="form-label">Create New Customer</label>
                                    <input type="button" id="add_customer_view" class="form-control"
                                        value="Create New Customer"
                                        onclick="window.location.href='{{ route('customers.create') }}'" />

                                </div>
                            </div>
                            <!-- Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="type my-2">Type</label>
                                    <input type="text" name="type" class="form-control"
                                        value="{{ old('type', $repair->repairBattery->type) }}" required>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ old('brand', $repair->repairBattery->brand ?? '') }}" required>

                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="model_number my-2">Model Number</label>
                                <input type="text" name="model_number" class="form-control"
                                    value="{{ old('model_number', $repair->repairBattery->model_number ?? '') }}" required>

                            </div>


                            <div class="mb-4">
                                <label for="diagnostic_report" class="form-label">Diagnostic Report</label>
                                <textarea name="diagnostic_report" placeholder="Type here" class="form-control" id="diagnostic_report"> {{ old('diagnostic_report', $repair->diagnostic_report) }}</textarea>

                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="repair_order_end_date" class="form-label">Repair Order End Date</label>
                                    <input type="date" name="repair_order_end_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('model_number', $repair->repair_order_end_date ?? '') }}" />

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" class="form-control"
                                        value="{{ old('advance_amount', $repair->advance_amount) }}">
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" form="repairForm" class="btn btn-success col-md-3">Update</button>
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
