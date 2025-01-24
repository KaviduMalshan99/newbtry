@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Replacement Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Replacement Report</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                    </div>
                    <div class="card-body">

                        <div class="dt-ext table-responsive">
                            <table class="display" id="tableData">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Order Id</th>
                                        <th>Bought Battery</th>
                                        <th>Bought Battery Price</th>
                                        <th>Bought Battery Quantity</th>
                                        <th>Replace Battery</th>
                                        <th>Replace Battery Price</th>
                                        <th>Replace Battery Quantity</th>
                                        <th>Replacement Reason</th>
                                        <th>Price Ajustment</th>
                                        <th>Battery Discount</th>
                                        <th>Old Battery Discount</th>
                                        <th>Sub Total</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Replacement Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($replacements as $order)
                                        <tr>
                                            <td>C{{ $order->id }}</td>
                                            <td>C{{ $order->order->order_id }}</td>
                                            <td>{{ $order->boughtOldBattery->model_name }} </td>
                                            <td>{{ $order->bought_old_battery_price }}</td>
                                            <td>{{ $order->bought_old_battery_quantity }}</td>
                                            <td>{{ $order->newBattery->model_name }}</td>
                                            <td>{{ $order->new_battery_price }}</td>
                                            <td>{{ $order->new_battery_quantity }}</td>
                                            <td>{{ $order->replacement_reason }}</td>
                                            <td>{{ $order->price_adjustment ?? 'N/A' }}</td>
                                            <td>{{ $order->battery_discount ?? 'N/A' }}</td>
                                            <td>{{ $order->old_battery_discount ?? 'N/A' }}</td>
                                            <td>{{ $order->subtotal }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>{{ $order->replacement_date }}</td>

                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#tableData').DataTable({
                dom: 'Bfrtip', // Layout for DataTables with Buttons
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        title: 'Customer Report',
                        customize: function(doc) {
                            // Set a margin for the footer
                            doc.content[1].margin = [0, 0, 0, 20];
                        }
                    },
                    {
                        extend: 'print',
                        footer: true,
                        title: 'Customer Report',
                    }
                ],

            });


        });
    </script>
@endsection

@section('script')
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


@endsection
