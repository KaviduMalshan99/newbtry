@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
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
    <li class="breadcrumb-item active">Add New Battery Purchase</li>
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
                                <h2 class="content-title">Add New Battery Purchase</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ route('purchases.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                            </div>
                        </div>
                        <form id="saveForm" action="{{ route('purchases.store_battery') }}" method="POST">
                            @csrf

                            <input type="hidden" name="items" id="items">

                            <!-- Supplier -->
                            <div class="mb-4">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-select" required>
                                    <option value="" disabled selected>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product -->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <label for="battery_id" class="form-label">Battery</label>
                                    <select id="battery_id" name="battery_id" class="form-select" required>
                                        <option value="" disabled selected>Select Battery</option>
                                        @foreach ($batteries as $battery)
                                            <option value="{{ $battery->id }}">{{ $battery->type }} | {{ $battery->type }}
                                                |
                                                {{ $battery->brand }} | {{ $battery->model_number }} |
                                                RS :{{ $battery->purchase_price }}</option>
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
                            <div class="row gx-3">
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
                                <tbody></tbody>
                            </table>

                            <div class="mb-4">
                                <br>
                                <button type="submit" form="saveForm" class="btn btn-success col-md-3">Save</button>
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
        });

        document.getElementById('productTable').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-row')) {
                event.target.closest('tr').remove();
                updateItems();
            }
        });

        function updateItems() {
            const productTable = document.getElementById('productTable').querySelector('tbody');
            const rows = productTable.querySelectorAll('tr');
            const items = Array.from(rows).map(row => ({
                supplier_id: row.getAttribute('data-supplier-id'),
                battery_id: row.getAttribute('data-battery-id'),
                quantity: row.getAttribute('data-quantity'),
                purchase_price: row.getAttribute('data-price')
            }));
            document.getElementById('items').value = JSON.stringify(items);
        }
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