



@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

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

@section('content')
 <div class="container-fluid basic_table">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ route('lubricants.create') }}" class="btn btn-success mb-3">Add New Lubricant</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="border-bottom-primary">
                          

                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Brand</th>
                          <th scope="col">Purchase Price</th>
                          <th scope="col">Sale Price</th>
                          <th scope="col">Stock Quantity</th>
                          <th scope="col">Unit</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($lubricants as $lubricant)
                            <tr>
                                <td>{{ $lubricant->id }}</td>
                                <td>{{ $lubricant->name }}</td>
                                <td>{{ $lubricant->brand }}</td>
                                <td>{{ $lubricant->purchase_price }}</td>
                                <td>{{ $lubricant->sale_price }}</td>
                                <td>{{ $lubricant->stock_quantity }}</td>
                                <td>{{ $lubricant->unit }}</td>
                                <td>
                                    <a href="{{ route('lubricants.show', $lubricant->id) }}" class="btn btn-info p-1"><i class="fa fa-dedent"></i></a>
                                    <a href="{{ route('lubricants.edit', $lubricant->id) }}" class="btn btn-warning p-1"><i class="fa fa-edit"></i></a>
            
                                    <form action="{{ route('lubricants.destroy', $lubricant->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger  p-1 " onclick="return confirm('Are you sure you want to delete this lubricant?')"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No lubricants found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
          </div>
         
     
@endsection

@section('script')
@endsection