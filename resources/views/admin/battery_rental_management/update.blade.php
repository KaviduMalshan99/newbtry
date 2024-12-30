@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Rental Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}">
            Rentals
        </a></li>
    <li class="breadcrumb-item active">Add New Rentals</li>
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
                                <h2 class="content-title">Add New Rentals</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="rentalForm" action="{{ route('rentals.update', $rental) }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            @method('PUT')
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" required>
                                        <option value="" disabled selected>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $rental->customer_id ? 'selected' : '' }}>
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="add_customer_view" class="form-label">Create New</label>
                                    <input type="button" id="add_customer_view" class="form-control"
                                        value="Create New Customer"
                                        onclick="window.location.href='{{ route('customers.create') }}'" />

                                </div>
                            </div>

                            <!-- Old Battery -->
                            <div class="mb-4">
                                <label for="old_battery_id" class="form-label">Old Battery</label>
                                <select name="old_battery_id" id="old_battery_id" class="form-select" required>
                                    <option value="{{ $rental->old_battery_id }}" selected>
                                        {{ $rental->oldBattery->old_battery_type }}
                                        {{ $rental->oldBattery->old_battery_condition }}</option>
                                    @foreach ($oldBatteries as $oldBattery)
                                        <option value="{{ $oldBattery->id }}">
                                            {{ $oldBattery->old_battery_type }}
                                            {{ $oldBattery->old_battery_condition }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="rental_start_date" class="form-label">Rental Start Date</label>
                                    <input type="date" name="rental_start_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('rental_start_date', $rental->rental_start_date ?? '') }}" />

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="rental_end_date" class="form-label">Rental End Date</label>
                                    <input type="date" name="rental_end_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('rental_end_date', $rental->rental_end_date ?? '') }}" />

                                </div>
                            </div>



                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="rental_cost my-2">Rental Cost</label>
                                    <input type="number" name="rental_cost" class="form-control"
                                        value="{{ old('rental_cost', $rental->rental_cost ?? '') }}" required>


                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" class="form-control"
                                        value="{{ old('advance_amount', $rental->advance_amount ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="notes my-2">Note</label>
                                <textarea name="notes" placeholder="Type here" class="form-control" id="notes">{{ old('notes', $rental->notes ?? '') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <button type="submit" form="rentalForm" class="btn btn-success col-md-3">Update</button>
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
