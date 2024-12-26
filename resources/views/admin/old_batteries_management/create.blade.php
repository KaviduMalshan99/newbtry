@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Old Battery Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('oldBatteries.show', $oldBattery->id) : route('oldBatteries.index') }}">
            Old Battery
        </a></li>
    <li class="breadcrumb-item active">Add New Old Battery</li>
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
                                <h2 class="content-title">Add New Old Battery</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('oldBatteries.show', $oldBattery->id) : route('oldBatteries.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="oldBatteryForm" action="{{ route('oldBatteries.store') }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" required>
                                        <option value="" disabled selected>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->first_name }}
                                                {{ $customer->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="add_customer_view" class="form-label">Create New Customer</label>
                                    <input type="button" id="add_customer_view" class="form-control"
                                        value="Create Customer"
                                        onclick="window.location.href='{{ route('customers.create') }}'" />

                                </div>
                            </div>
                            <!-- Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="old_battery_type my-2">Old Battery Type</label>
                                    <input type="text" name="old_battery_type" class="form-control" required>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="old_battery_condition">Old Battery Condition</label>
                                    <select name="old_battery_condition" id="old_battery_condition" class="form-select"
                                        required>
                                        <option value="" disabled selected>Select Condition</option>
                                        @foreach ($old_battery_conditions as $condition)
                                            <option value="{{ $condition }}">
                                                {{ $condition }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="old_battery_value my-2">Old Battery Value</label>
                                <input type="number" name="old_battery_value" class="form-control" required>

                            </div>

                            <div class="mb-4">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea name="notes" placeholder="Type here" class="form-control" id="notes" required></textarea>

                            </div>

                            <div class="mb-4">
                                <button type="submit" form="oldBatteryForm" class="btn btn-success col-md-3">Save</button>
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
