@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Purchase Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('purchases.show', $purchase->id) : route('purchases.index') }}">
            Purchase
        </a></li>
    <li class="breadcrumb-item active">Update Battery Purchase</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header"></div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Update Battery Purchase</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ route('purchases.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                            </div>
                        </div>

                        <form id="updateForm" action="{{ route('purchases.update_battery', $purchase->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="items" id="items">

                            <!-- Supplier -->
                            <div class="mb-4">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-select" required>
                                    <option value="" disabled>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product -->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <label for="battery_id" class="form-label">Battery</label>
                                    <select id="battery_id" name="battery_id" class="form-select">
                                        <option value="" disabled>Select Battery</option>
                                        @foreach ($batteries as $battery)
                                            <option value="{{ $battery->id }}">
                                                {{ $battery->type }} | {{ $battery->brand->brand_name }} |
                                                {{ $battery->model_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="add_product_view" class="form-label">Create New Battery</label>
                                    <input type="button" id="add_product_view" class="form-control"
                                        value="Create New Battery"
                                        onclick="window.location.href='{{ route('batteries.create') }}'" />
                                </div>
                            </div>

                            <!-- Quantity & Price -->
                            <div class="mt-4 row gx-3">
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" id="quantity" class="form-control"
                                        placeholder="Enter quantity" />
                                </div>
                                <div class="col-md-6">
                                    <label for="purchase_price" class="form-label">Purchase Price</label>
                                    <input type="number" id="purchase_price" class="form-control" step="0.01"
                                        placeholder="Enter price" />
                                </div>
                            </div>

                            <!-- Add Button -->
                            <div class="mb-4">
                                <br>
                                <button type="button" id="addProduct" class="btn btn-primary col-md-3">Add</button>
                            </div>

                            <!-- Dynamic Table -->
                            <table class="table table-bordered mt-4" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Battery</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase->batteryPurchaseItems as $item)
                                        <tr id="row{{ $item->id }}" data-battery-id="{{ $item->battery_id }}"
                                            data-quantity="{{ $item->quantity }}"
                                            data-price="{{ $item->purchase_price }}">
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $item->battery->type }} | {{ $item->battery->brand->brand_name }} |
                                                {{ $item->battery->model_number }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->purchase_price }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>





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
                            <label for="total_price" class="form-label">Total Price</label>
                            <input type="number" id="total_price" name="total_price" class="form-control"
                                placeholder="Total Price" value="{{ $purchase->total_price }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" id="paid_amount" name="paid_amount"
                                value="{{ $purchase->paid_amount }}" class="form-control" step="0.01"
                                placeholder="Enter price" readonly />
                        </div>

                        <!-- payment -->
                        <div class="mb-4">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01"
                                placeholder="Due Amount" readonly value="{{ $purchase->due_amount }}" />
                        </div>

                        <div class="mb-4">
                            <label for="payable_amount" class="form-label">Payable Amount</label>
                            <input type="number" id="payable_amount" name="payable_amount" class="form-control"
                                step="0.01" placeholder="Enter price" />
                        </div>
                        <div class="mb-4">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select id="payment_type" name="payment_type" class="form-select" required>
                                @foreach ($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType }}">{{ $paymentType }}</option>)
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <br>
                            <button type="submit" form="updateForm" class="btn btn-success col-md-6">Update</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('addProduct').addEventListener('click', function() {
            const supplierSelect = document.getElementById('supplier_id');
            const batterySelect = document.getElementById('battery_id');
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('purchase_price');
            const productTable = document.getElementById('productTable').querySelector('tbody');

            const supplierId = supplierSelect.value;
            const supplierName = supplierSelect.options[supplierSelect.selectedIndex].text;
            const batteryId = batterySelect.value;
            const batteryName = batterySelect.options[batterySelect.selectedIndex].text;
            const quantity = quantityInput.value;
            const price = priceInput.value;

            // Validate inputs
            if (!supplierId || !batteryId || !quantity || !price) {
                alert('Please fill out all fields.');
                return;
            }

            // Add row to the table
            const newRow = `
            <tr data-supplier-id="${supplierId}" data-battery-id="${batteryId}" data-quantity="${quantity}" data-price="${price}">
                <td>${supplierName}</td>
                <td>${batteryName}</td>
                <td>${quantity}</td>
                <td>${price}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
                </td>
            </tr>
        `;
            productTable.insertAdjacentHTML('beforeend', newRow);

            // Clear inputs
            // supplierSelect.value = '';
            // batterySelect.value = '';
            quantityInput.value = '';
            priceInput.value = '';

            // Update hidden input with JSON data
            updateItems();
            updateTotals();
        });

        document.getElementById('productTable').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-row')) {
                event.target.closest('tr').remove();
                updateItems();
                updateTotals();
            }
        });

        // Trigger updateTotals when paid_amount changes
        document.getElementById('paid_amount').addEventListener('input', function() {
            updateTotals();
        });

        // Trigger updateTotals when payable_amount changes
        document.getElementById('payable_amount').addEventListener('input', function() {
            const payableAmount = parseFloat(this.value) || 0;
            const totalPrice = parseFloat(document.getElementById('total_price').value) || 0;
            const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
            const newPaidAmount = payableAmount;
            const dueAmount = Math.max(totalPrice - paidAmount - newPaidAmount, 0);

            document.getElementById('due_amount').value = dueAmount.toFixed(2);
        });

        function updateItems() {
            const rows = document.querySelectorAll('#productTable tbody tr');
            const items = Array.from(rows).map(row => {
                const baseItem = {
                    supplier_id: document.getElementById('supplier_id').value,
                    battery_id: row.getAttribute('data-battery-id'),
                    quantity: row.getAttribute('data-quantity') || row.querySelector('td:nth-child(3)')
                        .textContent,
                    purchase_price: row.getAttribute('data-price') || row.querySelector('td:nth-child(4)')
                        .textContent
                };

                if (row.id.startsWith('row')) {
                    baseItem.id = row.id.replace('row', '');
                }

                return baseItem;
            }).filter(item => item.battery_id && item.quantity && item.purchase_price);

            document.getElementById('items').value = JSON.stringify(items);
        }

        function removeRow(button) {
            const row = button.closest('tr');
            const itemId = row.id.replace('row', '');
            const purchaseId = window.location.pathname.split('/')[3]; // Gets the purchase ID from URL

            if (itemId) {
                fetch(`/purchases/battery/${purchaseId}/battery-purchase-item/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            row.remove();
                            updateItems();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                row.remove();
                updateItems();
            }
        }

        // Update total_price, due_amount, and payable_amount dynamically
        function updateTotals() {
            const rows = document.querySelectorAll('#productTable tbody tr');
            let totalPrice = 0;

            // Calculate the total price
            rows.forEach(row => {
                const quantity = parseFloat(row.getAttribute('data-quantity')) || 0;
                const price = parseFloat(row.getAttribute('data-price')) || 0;
                totalPrice += quantity * price;
            });

            // Update the total_price input
            document.getElementById('total_price').value = totalPrice.toFixed(2);

            // Update payable_amount and recalculate due_amount
            const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
            const dueAmount = Math.max(totalPrice - paidAmount, 0);

            document.getElementById('due_amount').value = dueAmount.toFixed(2);
            // document.getElementById('payable_amount').value = dueAmount.toFixed(
            // 2); // Update payable_amount to match the new due_amount
        }

        // Initial calculation on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateItems();
            updateTotals();
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
