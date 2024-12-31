@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Lubricant Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Lubricant Purchases</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Lubricant Purchases</h3>
                            </div>
                            <div class="col-md-2 mb-4 text-end">
                                <a href="{{ route('lubricant_purchases.create') }}" class="btn btn-primary btn-sm rounded">
                                    Add New Purchase
                                </a>
                            </div>
                            @if(session('success'))
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr class="border-bottom-primary">
                                        <th>ID</th>
                                        <th>Purchase Id</th>
                                        <th>Lubricant</th>
                                        <th>Supplier</th>
                                        <th>Purchase Date</th>
                                        <th>Quantity</th>
                                        <th>Unit Type</th>
                                        <th>Total Cost</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->purchase_id }}</td>
                                            <td>{{ $purchase->lubricant->name }}</td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->purchase_date }}</td>
                                            <td>{{ $purchase->quantity_purchased }}</td>
                                            <td>{{ $purchase->unit_type }}</td>
                                            <td>{{ $purchase->total_cost }}</td>
                                            <td>{{ ucfirst($purchase->payment_status) }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('lubricant_purchases.show', $purchase->id) }}" class="view btn-info btn-sm pt-2" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('lubricant_purchases.edit', $purchase->id) }}" class="edit btn-warning btn-sm pt-2" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('lubricant_purchases.destroy', $purchase->id) }}" method="POST" style="display:inline;">
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
                            {{-- Display pagination links --}}
                            <div class="mt-3">
                                {{ $purchases->links('pagination::bootstrap-4') }}
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
    
    <!-- Initialize the DataTable -->
    <script>
        $(document).ready(function() {
            $('#keytable').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search box
                ordering: true, // Enable sorting
                responsive: true, // Enable responsive design for mobile devices
                lengthChange: true, // Allow changing the number of rows displayed
                pageLength: 10, // Set default page length to 10 rows
                language: {
                    search: "Search records:", // Customize search label
                    lengthMenu: "Display _MENU_ records per page" // Customize per-page dropdown
                }
            });
        });
    </script>
@endsection
