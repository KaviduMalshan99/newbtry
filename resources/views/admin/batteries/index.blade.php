{{-- @section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection --}}

{{--
@section('content')
<div class="container">
    <h1>Batteries</h1>
    <a href="{{ route('batteries.create') }}" class="btn btn-primary mb-3">Add New Battery</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Model Number</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
                <th>Stock Quantity</th>
                <th>Rental Price/Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($batteries as $battery)
            <tr>
                <td>{{ $battery->id }}</td>
                <td>{{ $battery->type }}</td>
                <td>{{ $battery->brand }}</td>
                <td>{{ $battery->model_number }}</td>
                <td>{{ $battery->purchase_price }}</td>
                <td>{{ $battery->sale_price }}</td>
                <td>{{ $battery->stock_quantity }}</td>
                <td>{{ $battery->rental_price_per_day }}</td>
                <td>
                    <a href="{{ route('batteries.edit', $battery) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('batteries.destroy', $battery) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}



{{-- @extends('layouts.simple.master')
@section('title', 'Bootstrap Basic Tables')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bootstrap Basic Tables</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Bootstrap Tables</li>

@endsection

@section('content')
 <div class="container-fluid basic_table">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ route('batteries.create') }}" class="btn btn-primary mb-3">Add New Battery</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="border-bottom-primary">
                          <th scope="col">ID</th>
                          <th scope="col">Type</th>
                          <th scope="col">Brand</th>
                          <th scope="col">Model Number</th>
                          <th scope="col">Purchase Price</th>
                          <th scope="col">Sale Price</th>
                          <th scope="col">Stock Quantity</th>
                          <th scope="col">Rental Price/Day</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($batteries as $battery)
                        <tr class="border-bottom-secondary">
                          <th scope="row">1</th>
                          <td> <img class="img-30 me-2" src="{{ asset('assets/images/user/1.jpg') }}" alt="profile"></td>
                          <td>{{ $battery->id }}</td>
                          <td>{{ $battery->type }}</td>
                          <td>{{ $battery->brand }}</td>
                          <td>{{ $battery->model_number }}</td>
                          <td>{{ $battery->purchase_price }}</td>
                          <td>{{ $battery->stock_quantity }}</td>
                          <td>{{ $battery->rental_price_per_day }}</td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


@endsection

@section('script')
@endsection --}}


@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Battery Management</h3>
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

                    </div>
                    <div class="card-body">

                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Battery List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div>
                                    <a href="{{ route('batteries.create') }}" class="btn btn-primary btn-sm rounded">Create
                                        new</a>
                                </div>
                            </div>
                        </div>

                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Brand</th>
                                        <th>Model Number</th>
                                        <th>Purchase Price</th>
                                        <th>Sale Price</th>
                                        <th>Stock Quantity</th>
                                        <th>Rental Price/Day</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($batteries as $battery)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td> <img class="img-30 me-2" src="{{ asset('assets/images/user/1.jpg') }}"
                                                    alt="profile"></td>
                                            <td>{{ $battery->id }}</td>
                                            <td>{{ $battery->type }}</td>
                                            <td>{{ $battery->brand }}</td>
                                            <td>{{ $battery->model_number }}</td>
                                            <td>{{ $battery->purchase_price }}</td>
                                            <td>{{ $battery->stock_quantity }}</td>
                                            <td>{{ $battery->rental_price_per_day }}</td>
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
