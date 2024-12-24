@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Repair Full List</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}">
            Repair
        </a></li>
    <li class="breadcrumb-item active">Repair Full List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h3>Manage your Repair efficiently.</h3>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="row gx-3">

                            <div class="col-md-3 mb-4">
                                <h6>Change Repair Status</h6>
                            </div>

                            <div class="col-md-8 mb-4">
                                <form id="repairStatusUpdateForm" action="{{ route('repairs.updateStatus', $repair->id) }}"
                                    method="POST">
                                    @csrf <!-- Laravel's CSRF protection -->
                                    @method('PUT')
                                    <select name="repair_status" id="repair_status" class="form-select" required>
                                        <option value="In Progress"
                                            {{ $repair->repair_status == 'In Progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                        <option value="Completed"
                                            {{ $repair->repair_status == 'Completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </form>

                            </div>
                            <div class="col-md-1 mb-4">
                                <button form="repairStatusUpdateForm" type="submit"
                                    class="btn btn-success rounded font-sm mr-5 text-body hover-up">
                                    Apply
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>Diagnostic Report</th>
                                        <th>Items Used</th>
                                        <th>Repair Cost</th>
                                        <th>Labor Charges</th>
                                        <th>Total Cost</th>
                                        <th>Repair Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $repair->diagnostic_report ?? 'N/A' }}</td>
                                        <td>
                                            {{ $repair->items_used }}
                                        </td>
                                        <td>{{ number_format($repair->repair_cost, 2) }}</td>
                                        <td>{{ number_format($repair->labor_charges, 2) }}</td>
                                        <td>{{ number_format($repair->total_cost, 2) }}</td>
                                        <td>{{ $repair->repair_status }}</td>
                                    </tr>
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
