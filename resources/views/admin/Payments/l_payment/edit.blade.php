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
        <h2>Edit Payment</h2>
        <form action="{{ route('l_payment.update', $l_payment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product_type">Product Type</label>
                <select name="product_type" id="product_type" class="form-control" required>
                    <option value="batteries" {{ $l_payment->product_type == 'batteries' ? 'selected' : '' }}>Batteries</option>
                    <option value="lubricant" {{ $l_payment->product_type == 'lubricant' ? 'selected' : '' }}>Lubricant</option>
                    <option value="both" {{ $l_payment->product_type == 'both' ? 'selected' : '' }}>Both</option>
                </select>
                @error('product_type')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $l_payment->amount) }}" required>
                @error('amount')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ old('payment_method', $l_payment->payment_method) }}" required>
                @error('payment_method')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $l_payment->status) }}">
                @error('status')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', $l_payment->discount) }}">
                @error('discount')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $l_payment->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Payment</button>
        </form>
    </div>
    @endsection

    @section('script')
    <!-- Add custom scripts if needed -->
    @endsection
    
