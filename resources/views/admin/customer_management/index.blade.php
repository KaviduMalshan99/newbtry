

@extends('layouts.simple.master')
@section('title', 'Users List')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Users List</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Users List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Users  List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr class="border-bottom-primary">
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Submit</th>
                                        <th>Date</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <form action="{{ route('update.user.type', ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <select name="user_type" class="form-control btn btn-outline-info float-start">
                                                    <option  value="User" {{ $user->user_type == 'User' ? 'selected' : '' }}>User</option>
                                                    <option value="Cashier" {{ $user->user_type == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                                                    <option value="Admin" {{ $user->user_type == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="SuperAdmin" {{ $user->user_type == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
                                                    
                                                </select>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-success btn-md ">Submit</button>
                                            </form>
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            {{-- <div class="row">
                                                <div class="col-6">
                                                    <a href="" class="btn btn-warning btn-sm">Invoice</a>
                                                </div>
                                                <div class="col-6">
                                                    
                                                </div>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="my-2">
                                        <td colspan="7" class="text-center">No Users Available</td>
                                    </tr>
                                @endforelse
                                
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $users->links() }}
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
                    "lengthMenu": "Display _MENU_ records per page", // Customize per-page dropdown
                    "info": "Showing _START_ to _END_ of _TOTAL_ records", // Customize record information
                    "infoEmpty": "No records available", // Message when no data is available
                    "infoFiltered": "(filtered from _MAX_ total records)", // Message for filtered records
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "zeroRecords": "No matching records found" // Message when no search results
                }
            });
        });
    </script>
@endsection
