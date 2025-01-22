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
                                <a href="{{ route('lubricants.create') }}" class="btn btn-primary btn-sm rounded">Add New Lubricant
                                    </a>
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr class="border-bottom-primary">
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Purchase Price</th>
                                        <th scope="col">Sale Price</th>
                                        <th scope="col">Stock Quantity</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lubricants as $lubricant)
                                    <tr>
                                        <td>{{ $lubricant->id }}</td>
                                        <td>{{ $lubricant->name }}</td>
                                        <td>{{ $lubricant->brand }}</td>
                                        <td>{{ $lubricant->purchase_price }}</td>
                                        <td>{{ $lubricant->sale_price }}</td>
                                        <td>{{ $lubricant->stock_quantity }}</td>
                                        <td>{{ $lubricant->type }}</td>
                                        <td>{{ $lubricant->unit }}</td>
                                        <td>
                                            @if($lubricant->image)
                                            <img src="{{ asset('storage/' . $lubricant->image) }}" alt="Lubricant Image" width="50" height="50">
    
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-4"><a href="{{ route('lubricants.show', $lubricant->id) }}" class="btn btn-info p-1"><i class="fa fa-dedent"></i></a></div>
                                                <div class="col-sm-4"><a href="{{ route('lubricants.edit', $lubricant->id) }}" class="btn btn-warning p-1"><i class="fa fa-edit"></i></a></div>
                                                <div class="col-sm-4"><form action="{{ route('lubricants.destroy', $lubricant->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger p-1" onclick="return confirm('Are you sure you want to delete this lubricant?')"><i class="fa fa-trash-o"></i></button>
                                                </form></div>
                                            </div>
                                            
                                            
                                            
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
