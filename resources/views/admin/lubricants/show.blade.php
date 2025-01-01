@extends('layouts.simple.master')
@section('title', 'Lubricant Details')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Lubricant Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('lubricants.show', $lubricant->id) : route('lubricants.index') }}">
            Lubricant
        </a></li>
    <li class="breadcrumb-item active">Lubricant Details</li>
@endsection

@section('content')
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="container card-body">
                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Lubricant Details</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ route('lubricants.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                            </div>
                        </div>
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
                                    @if ($lubricant->image)
                                        <img src="{{ asset('storage/' . $lubricant->image) }}" alt="Lubricant Image"
                                            width="150">
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
