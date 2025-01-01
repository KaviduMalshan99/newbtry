@extends('layouts.simple.master')

@section('title', 'Add Brand')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="my-3">Add Brand</h1>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group  my-2">
                        <label for="type" class="pb-2">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="battery">Battery</option>
                            <option value="lubricant">Lubricant</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="brand_name" class="pb-2">Brand Name</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <label for="image" class="pb-2">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <label for="date" class="pb-2">Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary my-2">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
