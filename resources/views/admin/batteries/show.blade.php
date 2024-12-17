

@extends('layouts.simple.master')


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


@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection



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
     


@section('script')

@endsection

@extends('layouts.simple.master')


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


@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection



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
     


@section('script')

@endsection