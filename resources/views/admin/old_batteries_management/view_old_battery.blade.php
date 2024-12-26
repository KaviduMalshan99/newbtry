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
    <li class="breadcrumb-item active">Old Battery Full Details</li>
@endsection

@section('content')

    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class=" content-header">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row gx-3">
                                <div class="col-md-11 mb-4">
                                    <h2 class="content-title">View Old Battery Details</h2>
                                </div>
                                <div class="col-md-1 mb-4">
                                    <a href="{{ request()->query('ref') === 'view' ? route('oldBatteries.show', $oldBattery->id) : route('oldBatteries.index') }}"
                                        class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">

                        @if (!empty($oldBattery->customer->first_name) && !empty($repair->customer->last_name))
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $oldBattery->customer->first_name }}
                                        {{ $oldBattery->customer->last_name }}</label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($oldBattery->old_battery_type))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Type</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $oldBattery->old_battery_type }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($oldBattery->old_battery_condition))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Condition</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $oldBattery->old_battery_condition }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($oldBattery->old_battery_value))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Valuer</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">Rs : {{ $oldBattery->old_battery_value }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($oldBattery->battery_status))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">battery Status</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $oldBattery->battery_status }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($oldBattery->notes))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Notes</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $oldBattery->notes }}
                                    </label>
                                </div>
                            </div>
                        @endif
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
