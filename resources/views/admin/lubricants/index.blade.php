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
    <li class="breadcrumb-item active">Lubricant</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Lubricant List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <a href="{{ route('lubricants.create') }}" class="btn btn-primary btn-sm rounded">Create new</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr class="border-bottom-primary">
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Purchase Price</th>
                                        <th scope="col">Sale Price</th>
                                        <th scope="col">Stock Quantity</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lubricants as $lubricant)
                                        <tr class="border-bottom-secondary">
                                            <td>{{ $lubricant->id }}</td>
                                            <td>
                                                @if($lubricant->image)
                                                    <img src="{{ asset('storage/' . $lubricant->image) }}" alt="Lubricant Image" width="50">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $lubricant->name }}</td>
                                            <td>{{ $lubricant->brand }}</td>
                                            <td>{{ $lubricant->purchase_price }}</td>
                                            <td>{{ $lubricant->sale_price }}</td>
                                            <td>{{ $lubricant->stock_quantity }}</td>
                                            <td>
                                                {{-- <a href="{{ route('lubricants.edit', $lubricant->id) }}" class="edit btn-sm btn-warning">
                                                    <i class="icon-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('lubricants.destroy', $lubricant->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                      
                                                            <i class="icon-trash"></i>
                                                    </button>
                                                </form> --}}

                                                <ul class="action d-flex align-items-center">
                                                    <li class="edit me-2">
                                                        <a href="{{ route('lubricants.edit', $lubricant->id) }}" class="edit btn-sm">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ route('lubricants.destroy', $lubricant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this battery?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete btn btn-sm">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                        
                                                        
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No lubricants found.</td>
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
