@extends('layouts.simple.master')
@section('title', 'View Lubricant Purchase')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Lubricant Purchase Details</h5>
                <a href="{{ route('lubricant_purchases.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $purchase->id }}</td>
                    </tr>
                    <tr>
                        <th>Lubricant</th>
                        <td>{{ $purchase->lubricant->name }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>{{ $purchase->supplier->name }}</td>
                    </tr>
                    <tr>
                        <th>Purchase Date</th>
                        <td>{{ $purchase->purchase_date }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $purchase->quantity_purchased }}</td>
                    </tr>
                    <tr>
                        <th>Unit Type</th>
                        <td>{{ $purchase->unit_type }}</td>
                    </tr>
                    <tr>
                        <th>Total Cost</th>
                        <td>{{ $purchase->total_cost }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{ $purchase->payment_status }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
