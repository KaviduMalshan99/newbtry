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
    <li class="breadcrumb-item active">Rental</li>
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
                                <h2 class="content-title">Rentals</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="rentalForm" action="{{ route('rentals.updateCompletedRental', $rental->id) }}"
                            method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            @method('PUT')
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" disabled>
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
                                        onclick="window.location.href='{{ route('customers.create') }}'" disabled />
                                </div>
                            </div>

                            <!-- Old Battery -->
                            <div class="mb-4">
                                <label for="old_battery_id" class="form-label">Old Battery</label>
                                <select name="old_battery_id" id="old_battery_id" class="form-select" disabled>
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
                                        value="{{ old('rental_start_date', $rental->rental_start_date ?? '') }}"
                                        readonly />

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="rental_end_date" class="form-label">Rental End Date</label>
                                    <input type="date" name="rental_end_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('rental_end_date', $rental->rental_end_date ?? '') }}" readonly />

                                </div>
                            </div>



                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="rental_cost my-2">Rental Cost</label>
                                    <input type="number" name="rental_cost" class="form-control"
                                        value="{{ old('rental_cost', $rental->rental_cost ?? '') }}" readonly>


                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" class="form-control"
                                        value="{{ old('advance_amount', $rental->advance_amount ?? '') }}" readonly>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="notes my-2">Note</label>
                                <textarea name="notes" placeholder="Type here" class="form-control" id="notes" readonly>{{ old('notes', $rental->notes ?? '') }}</textarea>
                            </div>

                            <div class=" mb-4">
                                <label for="actual_return_date" class="form-label">Actual Return Date</label>
                                <input type="date" name="actual_return_date" placeholder="Type here" class="form-control"
                                    id="name"
                                    value="{{ old('actual_return_date', $rental->actual_return_date ?? '') }}" required />

                            </div>

                            <div class="row gx-3">
                                <div class="col-md-4 mb-4">
                                    <label for="late_return_fee" class="form-label">Late Return Fee</label>
                                    <input type="number" name="late_return_fee" placeholder="Type here"
                                        class="form-control" id="late_return_fee"
                                        value="{{ old('late_return_fee', $rental->late_return_fee) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="damage_fee" class="form-label">Damage Fee</label>
                                    <input type="number" name="damage_fee" placeholder="Type here" class="form-control"
                                        id="damage_fee" value="{{ old('damage_fee', $rental->damage_fee) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="total_cost" class="form-label">Total Cost</label>
                                    <input type="number" name="total_cost" placeholder="Type here" class="form-control"
                                        id="total_cost" readonly value="{{ old('total_cost', $rental->total_cost) }}" />
                                </div>
                            </div>

                    </div>




                </div>
            </div>

            <div class="col-lg-6">
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Payment Section</h2>
                            </div>
                        </div>

                        <!--  Price -->
                        <div class="mb-4">
                            <label for="total_price" class="form-label">Total Amount</label>
                            <input type="number" id="total_price" name="total_price" class="form-control"
                                placeholder="Total Cost" value="{{ $rental->total_cost }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="adavancePrice" class="form-label">Advance Amount</label>
                            <input type="number" id="adavancePrice" name="adavancePrice" class="form-control"
                                placeholder="advance Cost" value="{{ $rental->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="total_price" class="form-label">Total Amount (after reduce advance
                                amount)</label>
                            <input type="number" id="total_price_after_advance" name="total_price_after_advance"
                                class="form-control" placeholder="Total Cost"
                                value="{{ $rental->total_cost - $rental->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" id="paid_amount" name="paid_amount"
                                value="{{ $rental->paid_amount }}" class="form-control" step="0.01"
                                placeholder="Enter price" readonly />
                        </div>

                        <!-- payment -->
                        <div class="mb-4">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01"
                                placeholder="Due Amount" readonly value="{{ $rental->due_amount }}" />
                        </div>

                        <div class="mb-4">
                            <label for="payable_amount" class="form-label">Payable Amount</label>
                            <input type="number" id="due_amount" name="payable_amount" class="form-control"
                                step="0.01" placeholder="Payable Amount" />
                        </div>
                        <div class="mb-4">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select id="payment_type" name="payment_type" class="form-select" required>
                                @foreach ($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType }}">{{ $paymentType }}</option>)
                                @endforeach
                            </select>

                        </div>
                        <br>
                        <div class="mb-4">
                            <button type="submit" form="rentalForm" class="btn btn-success col-md-6">Proceed</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalCostInput = document.getElementById('total_cost');
            const totalPriceAfterAdvance = document.getElementById('total_price_after_advance');
            const paidAmountInput = document.getElementById('paid_amount');
            const advanceAmount = parseFloat({{ $rental->advance_amount ?? 0 }});
            const totalPriceInput = document.getElementById('total_price');
            const dueAmountInput = document.getElementById('due_amount');
            const payableAmountInput = document.getElementsByName('payable_amount')[0];

            const lateReturnFeeInput = document.getElementById('late_return_fee');
            const damageFeeInput = document.getElementById('damage_fee');
            const rentalCost = parseFloat({{ $rental->rental_cost ?? 0 }});



            function updateTotalCost() {
                const lateReturnFee = parseFloat(lateReturnFeeInput.value) || 0;
                const damageFee = parseFloat(damageFeeInput.value) || 0;
                totalCostInput.value = (lateReturnFee + damageFee + rentalCost).toFixed(2);
                totalPriceInput.value = (lateReturnFee + damageFee + rentalCost).toFixed(2);
                totalPriceAfterAdvance.value = (lateReturnFee + damageFee + rentalCost - advanceAmount).toFixed(2);
            }

            function updatePaymentSection() {
                const totalCost = parseFloat(totalCostInput.value) || 0;
                const paidAmount = parseFloat(paidAmountInput.value) || 0;

                // Update total price
                totalPriceInput.value = totalCost.toFixed(2) - advanceAmount;

                // Update due amount
                const dueAmount = totalCost - paidAmount - advanceAmount;
                dueAmountInput.value = dueAmount.toFixed(2);
            }

            function updateDueAmount() {
                const totalCost = parseFloat(totalCostInput.value) || 0;
                const paidAmount = parseFloat(paidAmountInput.value) || 0;
                const payableAmount = parseFloat(payableAmountInput.value) || 0;

                const dueAmount = totalCost - paidAmount - payableAmount;
                dueAmountInput.value = dueAmount.toFixed(2);
            }

            // Add event listener for payable_amount changes
            payableAmountInput.addEventListener('input', updateDueAmount);

            // Add event listeners to trigger updates
            totalCostInput.addEventListener('input', updatePaymentSection);
            paidAmountInput.addEventListener('input', updatePaymentSection);

            // Attach event listeners
            lateReturnFeeInput.addEventListener('input', updateTotalCost);
            damageFeeInput.addEventListener('input', updateTotalCost);

            lateReturnFeeInput.addEventListener('input', updateDueAmount);
            damageFeeInput.addEventListener('input', updateDueAmount);
        });
    </script>

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
