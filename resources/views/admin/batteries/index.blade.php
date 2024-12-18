



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

@section('breadcrumb-items')
<li class="breadcrumb-item">Bootstrap Tables</li>

@endsection

@section('content')
 <div class="container-fluid basic_table">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ route('batteries.create') }}" class="btn btn-primary mb-3">Add New Battery</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="border-bottom-primary">
                          <th scope="col">ID</th>
                          <th scope="col">Type</th>
                          <th scope="col">Brand</th>
                          <th scope="col">Model Number</th>
                          <th scope="col">Purchase Price</th>
                          <th scope="col">Sale Price</th>
                          <th scope="col">Stock Quantity</th>
                          <th scope="col">Rental Price/Day</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($batteries as $battery)
                        <tr class="border-bottom-secondary">
                          <th scope="row">1</th>
                          <td> <img class="img-30 me-2" src="{{ asset('assets/images/user/1.jpg') }}" alt="profile"></td>
                          <td>{{ $battery->id }}</td>
                          <td>{{ $battery->type }}</td>
                          <td>{{ $battery->brand }}</td>
                          <td>{{ $battery->model_number }}</td>
                          <td>{{ $battery->purchase_price }}</td>
                          <td>{{ $battery->stock_quantity }}</td>
                          <td>{{ $battery->rental_price_per_day }}</td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
             
         
@endsection

@section('script')
@endsection