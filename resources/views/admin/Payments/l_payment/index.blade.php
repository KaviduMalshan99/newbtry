@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Batteries Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Batteries</li>
@endsection

@section('content')
<div class="container">
    <h1>Payments</h1>
    <a href="{{ route('l_payment.create') }}" class="btn btn-primary mb-3">Add Payment</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Payment ID</th>
                <th>Product Type</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->payment_id }}</td>
                <td>{{ $payment->product_type }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->status }}</td>
                {{-- <td>
                    <a href="{{ route('l_payment.edit', $payment->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('l_payment.destroy', $payment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td> --}}

                <td>
                    <div class="d-flex gap-2">
                        <a href="" class="view btn-info btn-sm pt-2" title="View">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('l_payment.edit', $payment->id) }}" class="edit btn-warning btn-sm pt-2" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('l_payment.destroy', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this purchase?')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>
                    </div>
                </td>




            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    
    <!-- Initialize the DataTable -->
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
                    "lengthMenu": "Display _MENU_ records per page" // Customize per-page dropdown
                }
            });
        });
    </script>
@endsection

{{-- http://127.0.0.1:8000/admin/payment --}}