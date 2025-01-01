@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">

    <style>
        .action {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            /* Adjust spacing between buttons */
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .action .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            padding: 0;
            border: none;
            background-color: transparent;
        }

        .action .btn i {
            font-size: 16px;
            /* Adjust icon size */
        }

        .action form {
            margin: 0;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Customer Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Customers</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                    </div>
                    <div class="card-body">

                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Customer List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div>
                                    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm rounded">Create
                                        new</a>
                                </div>
                            </div>
                        </div>

                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $customer)
                                        <tr>
                                            <td>C{{ $customer->id }}</td>
                                            <td>{{ $customer->first_name }} {{ $customer->last_name }} </td>
                                            <td>{{ $customer->phone_number }}</td>
                                            <td>{{ $customer->email ?? 'N/A' }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->created_at->format('d.m.Y') }}</td>
                                            <td>
                                                <ul
                                                    class="action d-flex justify-content-center align-items-center gap-1 p-0 m-0">
                                                    <li class="edit btn btn-sm">
                                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                                            class="text-decoration-none">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="btn btn-sm">
                                                        <a href="{{ route('customers.purchase-history', $customer->id) }}"
                                                            class="text-decoration-none">
                                                            <i class="icon-list"></i>
                                                        </a>
                                                    </li>
                                                    <li class="btn btn-sm">
                                                        <a href="{{ route('customers.indexByCustomer', $customer->id) }}"
                                                            class="text-decoration-none">
                                                            <i class="icon-receipt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form id="deleteForm{{ $customer->id }}"
                                                            action="{{ route('customers.destroy', $customer->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="delete btn btn-sm"
                                                                onclick="confirmDelete('deleteForm{{ $customer->id }}', 'Are you sure you want to delete this customer?')">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
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
