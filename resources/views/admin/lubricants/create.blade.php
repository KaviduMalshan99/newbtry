@extends('layouts.simple.master')
@section('title', 'Add Lubricant')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="my-3 pb-3">Add New Lubricant</h3>
                <form action="{{ route('lubricants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3 ">
                        <label for="name" class="pb-2">Lubricant Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="brand" class="pb-2">Brand</label>
                                <input type="text" class="form-control" name="brand" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="purchase_price" class="pb-2">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price" required>
                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="sale_price" class="pb-2">Sale Price</label>
                                <input type="number" class="form-control" name="sale_price" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="stock_quantity" class="pb-2">Stock Quantity</label>
                                <input type="number" class="form-control" name="stock_quantity" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="type" class="pb-2">Type</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-3">
                                <label for="unit" class="pb-2">Unit</label>
                                <input type="text" class="form-control" name="unit" required>
                            </div>
                        </div>
                    </div>



                    <div class="form-group my-3">
                        <label for="image" class="pb-2">Lubricant Image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
