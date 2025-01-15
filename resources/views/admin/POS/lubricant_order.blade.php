@extends('layouts.simple.master')
@section('title', 'Lubricant Orders')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Lubricant Orders</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Order List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr class="border-bottom-primary">
                                        <th>ID</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Order Type</th>


                                        <th>Total Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>mesurement type</th>
                                        <th>Quantity</th>
                                      
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lubricantOrders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->first_name }}</td>
                                            <td>{{ $order->phone_number }}</td>
                                            <td>{{ $order->order_type }}</td>


                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->mesurement_type }}</td>
                                            <td>{{ $order->unit }}</td>
                                            
                                            <td>{{ $order->payment_type }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            {{-- Add actions or other columns as needed --}}
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{ route('POS.lubricant_bill', ['id' => $order->id]) }}" class="btn btn-warning btn-sm">Invoice</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this battery?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>


                                            </td>

                                        </tr>
                                    @empty
                                        <tr class="my-2">
                                            <td colspan="12" class="text-center">No Orders Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $lubricantOrders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#keytable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search box
                "ordering": true, // Enable sorting
                "responsive": true, // Enable responsive design for mobile devices
                "lengthChange": true, // Allow changing the number of rows displayed
                "pageLength": 10, // Set default page length to 10 rows
                "language": {
                    "search": "Search records:", // Customize search label
                    "lengthMenu": "Display _MENU_ records per page", // Customize per-page dropdown
                    "info": "Showing _START_ to _END_ of _TOTAL_ records", // Customize record information
                    "infoEmpty": "No records available", // Message when no data is available
                    "infoFiltered": "(filtered from _MAX_ total records)", // Message for filtered records
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "zeroRecords": "No matching records found" // Message when no search results
                }
            });
        });
    </script>
@endsection
