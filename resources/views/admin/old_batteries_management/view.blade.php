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
    <h3>Old Battery Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Old Batteries</li>
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
                                <h3>Old Battery List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div>
                                    <a href="{{ route('oldBatteries.create') }}"
                                        class="btn btn-primary btn-sm rounded">Create
                                        new</a>
                                </div>
                            </div>
                        </div>

                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Battery Type</th>
                                        <th>Battery Condition</th>
                                        <th>Battery Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($oldBatteries as $oldBattery)
                                        <tr>
                                            <td>{{ $oldBattery->customer->first_name }}
                                                {{ $oldBattery->customer->last_name }} </td>
                                            <td>{{ $oldBattery->old_battery_type }}</td>
                                            <td>{{ $oldBattery->old_battery_condition }}</td>
                                            <td>RS : {{ $oldBattery->old_battery_value }}</td>
                                            <td>
                                                <ul
                                                    class="action d-flex justify-content-center align-items-center gap-1 p-0 m-0">
                                                    <li class="edit btn btn-sm">
                                                        <a href="{{ route('oldBatteries.edit', $oldBattery->id) }}"
                                                            class="text-decoration-none">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="btn btn-sm">
                                                        <a href="{{ route('oldBatteries.view-old-battery-details', $oldBattery->id) }}"
                                                            class="text-decoration-none">
                                                            <i class="icon-receipt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form id="deleteForm{{ $oldBattery->id }}"
                                                            action="{{ route('oldBatteries.destroy', $oldBattery->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="delete btn btn-sm"
                                                                onclick="confirmDelete('deleteForm{{ $oldBattery->id }}', 'Are you sure you want to delete this old battery?')">
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
