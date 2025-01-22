@extends('layouts.simple.master')
@section('title', 'Lubricant Details')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('content')
<div class="container-fluid basic_table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="container card-body">
                    <h2>Lubricant Details</h2>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $lubricant->name }}</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td>{{ $lubricant->brand }}</td>
                        </tr>
                        <tr>
                            <th>Purchase Price</th>
                            <td>{{ $lubricant->purchase_price }}</td>
                        </tr>
                        <tr>
                            <th>Sale Price</th>
                            <td>{{ $lubricant->sale_price }}</td>
                        </tr>
                        <tr>
                            <th>Stock Quantity</th>
                            <td>{{ $lubricant->stock_quantity }}</td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <td>{{ $lubricant->unit }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $lubricant->type }}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                @if($lubricant->image)
                                    <img src="{{ asset('storage/' . $lubricant->image) }}" alt="Lubricant Image" width="150">
                                @else
                                    <span>No Image Available</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('lubricants.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
