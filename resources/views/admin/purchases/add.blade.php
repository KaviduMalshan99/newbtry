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
    <li class="breadcrumb-item active">Add New Purchase</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">
                    {{-- <button type="submit" form="saveForm" class="btn btn-md rounded font-sm hover-up">Save</button> --}}
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Add New Purchase</h2>

                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('purchases.show', $purchase->id) : route('purchases.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>
                        <form id="saveForm" action="{{ route('purchases.store') }}" method="POST">
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

                            <!-- Product Type -->
                            <div class="mb-4">
                                <label for="product_type" class="form-label">Product Type</label>
                                <select id="product_type" class="form-select" required>
                                    <option value="" disabled selected>Select Product Type</option>
                                    @foreach ($productTypes as $type)
                                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product -->
                            <div class="mb-4">
                                <label for="product_id" class="form-label">Product</label>
                                <select id="product_id" class="form-select" required>
                                    <option value="" disabled>Select Products</option>
                                </select>
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
                                        <th>Product</th>
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
        let productTypeLocked = false;

        document.getElementById('product_type').addEventListener('change', function() {
            if (productTypeLocked) return;

            fetch(`/purchases/products/${this.value}`)
                .then(response => response.json())
                .then(data => {
                    const productDropdown = document.getElementById('product_id');
                    productDropdown.innerHTML = '<option value="" disabled>Select Products</option>';
                    data.forEach(product => {
                        productDropdown.innerHTML +=
                            `<option value="${product.id}">${product.type}</option>`;
                    });
                });
        });

        document.getElementById('addProduct').addEventListener('click', function() {
            const supplier = document.getElementById('supplier_id');
            const product = document.getElementById('product_id');
            const quantity = document.getElementById('quantity').value;
            const price = document.getElementById('purchase_price').value;

            if (product.value && quantity && price) {
                const table = document.getElementById('productTable').querySelector('tbody');
                table.innerHTML += `
            <tr data-product-id="${product.value}">
                <td>${supplier.options[supplier.selectedIndex].text}</td>
                <td>${product.options[product.selectedIndex].text}</td>
                <td>${quantity}</td>
                <td>${price}</td>
                <td><button type="button" class="btn btn-sm btn-danger">Remove</button></td>
            </tr>
        `;

                // Lock the product type dropdown to prevent changes
                document.getElementById('product_type').disabled = true;
                productTypeLocked = true;

                // Collect all rows and prepare the items array for submission
                const rows = table.querySelectorAll('tr');
                const items = [];
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const productId = row.getAttribute(
                        'data-product-id'); // Get the product_id from the data attribute

                    const item = {
                        product_type: document.getElementById('product_type')
                            .value, // product type (batteries/lubricants)
                        product_id: productId, // Get the correct product_id from the row's data attribute
                        quantity: cells[2].innerText, // quantity from the table
                        purchase_price: cells[3].innerText, // price from the table
                    };
                    items.push(item);
                });

                // Update the hidden input with the items data
                document.getElementById('items').value = JSON.stringify(items);
            }
        });




        // Handle removal of rows and update hidden input accordingly
        document.getElementById('productTable').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-danger')) {
                const row = e.target.closest('tr');
                row.remove();

                // Update hidden input after removal
                const items = JSON.parse(document.getElementById('items').value || '[]');
                const productId = row.cells[1].textContent; // Assuming product name is in the second column
                const index = items.findIndex(item => item.product_id === productId);
                if (index !== -1) {
                    items.splice(index, 1);
                }
                document.getElementById('items').value = JSON.stringify(items);
            }
        });
    </script>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
