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
    <li class="breadcrumb-item active">Repair Full Details</li>
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
                                    <h2 class="content-title">View Repair Details</h2>
                                </div>
                                <div class="col-md-1 mb-4">
                                    <a href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}"
                                        class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                        Back
                                    </a>
                                </div>
                            </div>

                            <div class="row gx-3">

                                <div class="col-md-3 mb-4">
                                    <h6>Change Repair Status</h6>
                                </div>

                                <div class="col-md-8 mb-4">
                                    <form id="repairStatusUpdateForm"
                                        action="{{ route('repairs.updateStatus', $repair->id) }}" method="POST">
                                        @csrf <!-- Laravel's CSRF protection -->
                                        @method('PUT')
                                        <select name="repair_status" id="repair_status" class="form-select" required>
                                            <option value="In Progress"
                                                {{ $repair->repair_status == 'In Progress' ? 'selected' : '' }}>In Progress
                                            </option>
                                            <option value="Completed"
                                                {{ $repair->repair_status == 'Completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    </form>

                                </div>
                                <div class="col-md-1 mb-4">
                                    <button form="repairStatusUpdateForm" type="submit"
                                        class="btn btn-success rounded font-sm mr-5 text-body hover-up">
                                        Apply
                                    </button>
                                </div>

                            </div>

                            @if ($repair->repair_status == 'Completed')
                                <div class="row gx-3">

                                    <div class="col-md-3 mb-4">
                                        <h6>Change Delivery Status</h6>
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <form id="repairStatusUpdateForm"
                                            action="{{ route('repairs.updateDeliveryStatus', $repair->id) }}"
                                            method="POST">
                                            @csrf <!-- Laravel's CSRF protection -->
                                            @method('PUT')
                                            <select name="repair_delivery_status" id="repair_delivery_status"
                                                class="form-select" required>
                                                <option value="Not Delivered"
                                                    {{ $repair->delivery_status == 'Not Delivered' ? 'selected' : '' }}>Not
                                                    Delivered
                                                </option>
                                                <option value="Delivered"
                                                    {{ $repair->delivery_status == 'Delivered' ? 'selected' : '' }}>
                                                    Delivered</option>

                                            </select>
                                        </form>

                                    </div>
                                    <div class="col-md-1 mb-4">
                                        <button form="repairStatusUpdateForm" type="submit"
                                            class="btn btn-secondary rounded font-sm mr-5 text-body hover-up">
                                            Apply
                                        </button>
                                    </div>

                                </div>

                                <div class="row gx-3">
                                    <div class="col-md-10 mb-4">
                                    </div>
                                    <div class="col-md-2 mb-4">
                                        <a href="{{ route('repairs.completedOrder', $repair->id) }}"
                                            class="btn btn-air-light rounded font-sm mr-5 text-body hover-up">
                                            Completed Repair
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">

                        @if (!empty($repair->customer->first_name) && !empty($repair->customer->last_name))
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->customer->first_name }}
                                        {{ $repair->customer->last_name }}</label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->repairBattery->type))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Type</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->repairBattery->type }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->repairBattery->brand))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Brand</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->repairBattery->brand }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->repairBattery->model_number))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Model Number</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->repairBattery->model_number }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->repair_order_start_date))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Repair Order Start Date</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->repair_order_start_date }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->repair_order_end_date))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Repair Order End Date</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->repair_order_end_date }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->diagnostic_report))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Diagnostic Report</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->diagnostic_report }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($repair->items_used))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Items Used</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $repair->items_used }}
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
