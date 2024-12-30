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
    <li class="breadcrumb-item active">Rental Full Details</li>
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
                                    <h2 class="content-title">View Rental Details</h2>
                                </div>
                                <div class="col-md-1 mb-4">
                                    <a href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}"
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

                        @if (!empty($rental->customer->first_name) && !empty($rental->customer->last_name))
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->customer->first_name }}
                                        {{ $rental->customer->last_name }}</label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->oldBattery->old_battery_type))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Type</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->oldBattery->old_battery_type }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->oldBattery->old_battery_condition))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Condition</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->oldBattery->old_battery_condition }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->oldBattery->old_battery_value))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Battery Value</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->oldBattery->old_battery_value }}</label>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->rental_start_date))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Rental Start Date</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->rental_start_date }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->rental_end_date))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Rental End Date</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->rental_end_date }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->actual_return_date))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Actual Return Date</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->actual_return_date }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="row gx-3">
                            <div class="col-md-2 mb-4">
                                <label class="form-label">Battery </label>
                            </div>

                            <div class="col-md-1 mb-4">
                                <label class="form-label"> : </label>
                            </div>
                            <div class="col-md-9 mb-4">
                                <label class="form-label">{{ $rental->oldBattery->isActive ? 'Received' : 'Not Received' }}
                                </label>
                            </div>
                        </div>
                        @if (!empty($rental->rental_cost))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Rental Cost</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->rental_cost }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->late_return_fee))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Late Return Fee</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->late_return_fee }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->damage_fee))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Damage Fee</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->damage_fee }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->advance_amount))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Advance Amount</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->advance_amount }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->paid_amount))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Paid Amount</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->paid_amount }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->due_amount))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Due Amount</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->due_amount }}
                                    </label>
                                </div>
                            </div>
                        @endif

                        @if (!empty($rental->payment_type))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Payment Type</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->payment_type }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if (!empty($rental->payment_status))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Payment Status</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->payment_status }}
                                    </label>
                                </div>
                            </div>
                        @endif

                        @if (!empty($rental->total_cost))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Total Cost</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->total_cost }}
                                    </label>
                                </div>
                            </div>
                        @endif

                        @if (!empty($rental->notes))
                            <div class="row gx-3">
                                <div class="col-md-2 mb-4">
                                    <label class="form-label">Notes</label>
                                </div>

                                <div class="col-md-1 mb-4">
                                    <label class="form-label"> : </label>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <label class="form-label">{{ $rental->notes }}
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
