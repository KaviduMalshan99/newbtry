@extends('layouts.simple.master')
@section('title', 'Battery Management')

@section('style')
<!-- Add any custom styles here if needed -->
@endsection

@section('breadcrumb-title')
<h3 class="my-3">Battery Management</h3>
@endsection

@section('content')
<div class="container">
    <h1>Create Payment</h1>
    <form action="{{ route('l_payment.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="product_type" class="form-label">Product Type</label>
            <select name="product_type" id="product_type" class="form-select">
                <option value="batteries">Batteries</option>
                <option value="lubricant">Lubricant</option>
                <option value="both">Batteries and Lubricant </option>
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        {{-- <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control" required>
        </div> --}}


        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-select">
                <option value="online">Online Payment</option>
                <option value="bank transfer">Bank Transfer</option>
               
            </select>
        </div>




        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" name="discount" id="discount" class="form-control">
        </div>
        {{-- <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div> --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection

@section('script')
<!-- Add custom scripts if needed -->
@endsection
