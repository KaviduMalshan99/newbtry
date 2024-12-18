



@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

{{-- 
@section('content')
<div class="container">
    <h1>Batteries</h1>
    <a href="{{ route('batteries.create') }}" class="btn btn-primary mb-3">Add New Battery</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Model Number</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
                <th>Stock Quantity</th>
                <th>Rental Price/Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($batteries as $battery)
            <tr>
                <td>{{ $battery->id }}</td>
                <td>{{ $battery->type }}</td>
                <td>{{ $battery->brand }}</td>
                <td>{{ $battery->model_number }}</td>
                <td>{{ $battery->purchase_price }}</td>
                <td>{{ $battery->sale_price }}</td>
                <td>{{ $battery->stock_quantity }}</td>
                <td>{{ $battery->rental_price_per_day }}</td>
                <td>
                    <a href="{{ route('batteries.edit', $battery) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('batteries.destroy', $battery) }}" method="POST" class="d-inline">
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
@endsection --}}



@extends('layouts.simple.master')
@section('title', 'Bootstrap Basic Tables')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bootstrap Basic Tables</h3>
@endsection

{{-- @section('breadcrumb-items')
<li class="breadcrumb-item">Bootstrap Tables</li>

@endsection --}}

@section('content')
 <div class="container-fluid basic_table">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  


                    <div class="container  card-body">
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