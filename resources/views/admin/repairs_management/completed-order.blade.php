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
    <li class="breadcrumb-item active">Battery Repair</li>
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
                                <h2 class="content-title">Battery Repairs</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="repairForm" action="{{ route('repairs.updateCompletedRepair', $repair) }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            @method('PUT')
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" disabled>
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
                                        onclick="window.location.href='{{ route('customers.create') }}'" disabled />
                                </div>
                            </div>

                            <!-- Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="type my-2">Type</label>
                                    <input type="text" name="type" class="form-control"
                                        value="{{ old('type', $repair->repairBattery->type) }}" disabled>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ old('brand', $repair->repairBattery->brand->brand_name ?? '') }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="model_number my-2">Model Number</label>
                                <input type="text" name="model_number" class="form-control"
                                    value="{{ old('model_number', $repair->repairBattery->model_number ?? '') }}" disabled>
                            </div>


                            <div class="mb-4">
                                <label for="diagnostic_report" class="form-label">Diagnostic Report</label>
                                <textarea name="diagnostic_report" placeholder="Type here" class="form-control" id="diagnostic_report" disabled>{{ old('diagnostic_report', $repair->diagnostic_report) }}</textarea>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="repair_order_end_date" class="form-label">Repair Order End Date</label>
                                    <input type="date" name="repair_order_end_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('model_number', $repair->repair_order_end_date ?? '') }}" disabled>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" id="advance_amount" class="form-control"
                                        value="{{ old('advance_amount', $repair->advance_amount) }}" readonly>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label for="items_used" class="form-label">Items Used</label>
                                <textarea name="items_used" placeholder="Type here" required class="form-control" id="items_used"> {{ old('items_used', is_array($repair->items_used) ? implode(', ', $repair->items_used) : $repair->items_used) }}</textarea>

                            </div>
                            <div class="row gx-3">
                                <div class="col-md-4 mb-4">
                                    <label for="repair_cost" class="form-label">Repair Cost</label>
                                    <input type="number" name="repair_cost" placeholder="Type here" class="form-control"
                                        required id="repair_cost" value="{{ old('repair_cost', $repair->repair_cost) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="labor_charges" class="form-label">Labor Charges</label>
                                    <input type="number" name="labor_charges" placeholder="Type here"
                                        class="form-control" required id="labor_charges"
                                        value="{{ old('labor_charges', $repair->labor_charges) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="total_cost" class="form-label">Total Cost</label>
                                    <input type="number" name="total_cost" placeholder="Type here" class="form-control"
                                        required id="total_cost" readonly
                                        value="{{ old('total_cost', $repair->total_cost) }}" />
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="repair_status" class="form-label">Repair Status</label>
                                    <select name="repair_status" id="repair_status" class="form-select" required>
                                        <option value="In Progress"
                                            {{ $repair->repair_status == 'In Progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                        <option value="Completed"
                                            {{ $repair->repair_status == 'Completed' ? 'selected' : '' }}>Completed
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="delivery_status" class="form-label">Delivery Status</label>
                                    <select name="delivery_status" id="delivery_status" class="form-select" required>
                                        <option value="Not Delivered"
                                            {{ $repair->delivery_status == 'Not Delivered' ? 'selected' : '' }}>Not
                                            Delivered
                                        </option>
                                        <option value="Delivered"
                                            {{ $repair->delivery_status == 'Delivered' ? 'selected' : '' }}>
                                            Delivered</option>

                                    </select>
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
                                placeholder="Total Cost" value="{{ $repair->total_cost }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="adavancePrice" class="form-label">Advance Amount</label>
                            <input type="number" id="adavancePrice" name="adavancePrice" class="form-control"
                                placeholder="advance Cost" value="{{ $repair->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="total_price" class="form-label">Total Amount (after reduce advance
                                amount)</label>
                            <input type="number" id="total_price_after_advance" name="total_price_after_advance"
                                class="form-control" placeholder="Total Cost"
                                value="{{ $repair->total_cost - $repair->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" id="paid_amount" name="paid_amount"
                                value="{{ $repair->paid_amount }}" class="form-control" step="0.01"
                                placeholder="Enter price" readonly />
                        </div>

                        <!-- payment -->
                        <div class="mb-4">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01"
                                placeholder="Due Amount" readonly value="{{ $repair->due_amount }}" />
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
                            <button type="submit" form="repairForm" class="btn btn-success col-md-6">Proceed</button>
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
            const advanceAmount = parseFloat({{ $repair->advance_amount ?? 0 }});
            const totalPriceInput = document.getElementById('total_price');
            const repairCostInput = document.getElementById('repair_cost');
            const laborChargesInput = document.getElementById('labor_charges');
            const dueAmountInput = document.getElementById('due_amount');
            const payableAmountInput = document.getElementsByName('payable_amount')[0];


            function updateTotalCost() {
                const repairCost = parseFloat(repairCostInput.value) || 0;
                const laborCharges = parseFloat(laborChargesInput.value) || 0;
                totalCostInput.value = (repairCost + laborCharges).toFixed(2);
                totalPriceInput.value = (repairCost + laborCharges).toFixed(2);
                totalPriceAfterAdvance.value = (repairCost + laborCharges - advanceAmount).toFixed(2);
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

                const dueAmount = totalCost - paidAmount - advanceAmount - payableAmount;
                dueAmountInput.value = dueAmount.toFixed(2);
            }

            // Add event listener for payable_amount changes
            payableAmountInput.addEventListener('input', updateDueAmount);

            // Add event listeners to trigger updates
            totalCostInput.addEventListener('input', updatePaymentSection);
            paidAmountInput.addEventListener('input', updatePaymentSection);

            // Attach event listeners
            repairCostInput.addEventListener('input', updateTotalCost);
            laborChargesInput.addEventListener('input', updateTotalCost);
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
