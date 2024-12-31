@extends('layouts.simple.master')

@section('title', 'Battery Details')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
<h3>Battery Details</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Batteries </li>
<li class="breadcrumb-item active">Battery Details</li>
@endsection

@section('content')
<div class="container">
    <h2>Battery Details</h2>
    <table class="table">
        <tr>
            <th>Type</th>
            <td>{{ $battery->type }}</td>
        </tr>
        <tr>
            <th>Brand</th>
            <td>{{ $battery->brand }}</td>
        </tr>
        <tr>
            <th>Model Number</th>
            <td>{{ $battery->model_number }}</td>
        </tr>
        <tr>
            <th>Purchase Price</th>
            <td>{{ $battery->purchase_price }}</td>
        </tr>
        <tr>
            <th>Sale Price</th>
            <td>{{ $battery->sale_price }}</td>
        </tr>
        <tr>
            <th>Stock Quantity</th>
            <td>{{ $battery->stock_quantity }}</td>
        </tr>
        <tr>
            <th>Rental Price/Day</th>
            <td>{{ $battery->rental_price_per_day }}</td>
        </tr>
    </table>

    <a href="{{ route('batteries.index') }}" class="btn btn-secondary">Back to Batteries</a>
</div>
@endsection

@section('script')
@endsection
