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

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Supplier List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <a href="{{ route('batteries.create') }}" class="btn btn-primary btn-sm rounded">Create
                                    new</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Model Name</th>
                                        <th>Brand</th>
                                        <th>Capacity (Ah)</th>
                                        <th>Voltage (V)</th>
                                        <th>Type</th>
                                        <th>Purchase Price</th>
                                        <th>Selling Price</th>
                                        <th>Warranty (Months)</th>
                                        <th>Image</th>
                                        <th>Manufacturing Date</th>
                                        <th>Expiry Date</th>
                                        <th>Stock Quantity</th>
                                        <th>Added Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($batteries as $battery)
                                        <tr>
                                            <td>{{ $battery->id }}</td>
                                            <td>{{ $battery->model_name }}</td>
                                            <td>{{ $battery->brand->brand_name }}</td>
                                            <td>{{ $battery->capacity }}</td>
                                            <td>{{ $battery->voltage }}</td>
                                            <td>{{ $battery->type }}</td>
                                            <td>{{ $battery->purchase_price }}</td>
                                            <td>{{ $battery->selling_price }}</td>
                                            <td>{{ $battery->warranty_period }}</td>
                                            <td>
                                                @if ($battery->image)
                                                    <img src="{{ asset('storage/' . $battery->image) }}"
                                                        alt="Battery Image" width="50" height="50">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $battery->manufacturing_date }}</td>
                                            <td>{{ $battery->expiry_date }}</td>
                                            <td>{{ $battery->stock_quantity }}</td>
                                            <td>{{ $battery->added_date }}</td>
                                            <td>{{ $battery->status }}</td>

                                            <td>
                                                <a href="{{ route('batteries.edit', $battery->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('batteries.destroy', $battery->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this battery?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="15" class="text-center">No batteries available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- Display pagination links if available --}}
                            {{-- {{ $batteries->links() }} --}}
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
