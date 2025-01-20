@extends('layouts.simple.master')
@section('title', 'Battery Order Summary')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Battery Order Summary</h3>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Battery List</h3>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="keytable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Phone Number</th>
                                    <th>Payment Method</th>
                                    <th>Order Type</th>
                                    <th>Items</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Batteries</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($batteryOrdersGrouped as $order)
                                    <tr>
                                        <td>{{ $order['order_id'] }}</td>
                                        <td>{{ $order['customer_name'] }}</td>
                                        <td>{{ $order['customer_phone'] }}</td>
                                        <td>{{ $order['payment_method'] }}</td>
                                        <td>{{ $order['order_type'] }}</td>
                                        <td>{{ $order['items'] }}</td>
                                        <td>{{ number_format($order['subtotal'], 2) }}</td>
                                        <td>{{ number_format($order['total'], 2) }}</td>
                                        <td>
                                            @if(!empty($order['batteries']))
                                                @foreach($order['batteries'] as $battery)
                                                    <div>
                                                        <strong>Model:</strong> {{ $battery['model_name'] }} <br>
                                                        <strong>Brand ID:</strong> {{ $battery['brand_id'] }}
                                                    </div>
                                                @endforeach
                                            @else
                                                <span>No batteries available</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Uncomment and update routes if needed --}}
                                            {{-- <a href="{{ route('battery.edit', $order['order_id']) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                            {{-- <form action="{{ route('battery.destroy', $order['order_id']) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No orders available.</td>
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
<script>
    $(document).ready(function() {
        $('#keytable').DataTable({
            // You can add more options here, e.g., pagination, search, etc.
        });
    });
</script>
@endsection
