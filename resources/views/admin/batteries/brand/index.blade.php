@extends('layouts.simple.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Brand Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Brand</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Brand </h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <a href="{{ route('brand.create') }}" class="btn btn-primary btn-sm rounded">Create
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
                <th>Type</th>
                <th>Brand ID</th>
                <th>Brand Name</th>
                <th>Image</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ ucfirst($brand->type) }}</td>
                <td>{{ $brand->brand_id }}</td>
                <td>{{ $brand->brand_name }}</td>
                <td>
                    @if ($brand->image)
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->brand_name }}" width="50">

                    

                    @else
                    N/A
                    @endif
                </td>
                <td>{{ $brand->date }}</td>
                <td>
                    <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
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
