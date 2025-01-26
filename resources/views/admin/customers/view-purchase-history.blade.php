@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Purchase History List</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('customers.show', $customer->id) : route('customers.index') }}">
            Customers
        </a></li>
    <li class="breadcrumb-item active">Purchase History List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h3>Manage your Customer efficiently.</h3>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('customers.show', $customer->id) : route('customers.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Item Details</th>
                                        <th>Total Amount</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($validOrders as $order)
                                        <tr>
                                            <td>{{ $order['order_id'] }}</td>
                                            {{-- <td>
                                                <ul>
                                                    @if (is_array($order['items']))
                                                        @foreach ($order['items'] as $item)
                                                            <li>
                                                                @if (isset($item['battery_id']))
                                                                    New Battery ID: {{ $item['battery_id'] }} |
                                                                @endif

                                                                @if (isset($item['old_battery_id']))
                                                                    Old Battery ID: {{ $item['old_battery_id'] }} |
                                                                @endif

                                                                @if (isset($item['repair_battery_id']))
                                                                    Repair Battery ID: {{ $item['repair_battery_id'] }} |
                                                                @endif
                                                                Quantity: {{ $item['quantity'] }} |
                                                                Price: {{ number_format($item['price'], 2) }} |
                                                                Model Numbers : @foreach ($item['model_numbers'] as $model)
                                                                    {{ $model }} @if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li>No items found</li>
                                                    @endif
                                                </ul>
                                            </td> --}}

                                            <td>
                                                <button class="btn btn-primary btn-sm view-item-details"
                                                    data-items="{{ json_encode($order['items']) }}">View Details</button>
                                            </td>


                                            <td>{{ number_format($order['total_price'], 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order['order_date'])->format('d.m.Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No purchase history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Item Details Modal -->
    <div class="modal fade" id="itemDetailsModal" tabindex="-1" aria-labelledby="itemDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemDetailsModalLabel">Item Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Battery ID</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Model Numbers</th>
                                </tr>
                            </thead>
                            <tbody id="itemDetailsTableBody">
                                <!-- Dynamic rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle item details button click
            document.querySelectorAll('.view-item-details').forEach(button => {
                button.addEventListener('click', function() {
                    const items = JSON.parse(this.getAttribute('data-items'));
                    const tableBody = document.getElementById('itemDetailsTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    if (Array.isArray(items) && items.length > 0) {
                        items.forEach(item => {
                            let batteryType = '';
                            let batteryID = '';

                            // Determine the type of battery and set the appropriate details
                            if (item.battery_id) {
                                batteryType = 'New Battery';
                                batteryID = item.battery_id;
                            } else if (item.old_battery_id) {
                                batteryType = 'Old Battery';
                                batteryID = item.old_battery_id;
                            } else if (item.repair_battery_id) {
                                batteryType = 'Repair Battery';
                                batteryID = item.repair_battery_id;
                            } else {
                                batteryType = 'N/A';
                                batteryID = 'N/A';
                            }

                            // Append row to the table
                            const row = `
                            <tr>
                                <td>${batteryID}</td>
                                <td>${batteryType}</td>
                                <td>${item.quantity || 0}</td>
                                <td>${Number(item.price).toFixed(2)}</td>
                                <td>${item.model_numbers ? item.model_numbers.join(', ') : 'N/A'}</td>
                            </tr>
                        `;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        const emptyRow = `
                        <tr>
                            <td colspan="5" class="text-center">No items found</td>
                        </tr>
                    `;
                        tableBody.insertAdjacentHTML('beforeend', emptyRow);
                    }

                    // Show the modal
                    const itemDetailsModal = new bootstrap.Modal(document.getElementById(
                        'itemDetailsModal'));
                    itemDetailsModal.show();
                });
            });
        });
    </script>



    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
