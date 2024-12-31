@extends('layouts.simple.master')
@section('title', 'Edit Lubricant Purchase')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Edit Lubricant Purchase</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('lubricant_purchases.update', $purchase->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="lubricant_id">Lubricant</label>
                        <select name="lubricant_id" class="form-control">
                            @foreach($lubricants as $lubricant)
                                <option value="{{ $lubricant->id }}" {{ $lubricant->id == $purchase->lubricant_id ? 'selected' : '' }}>{{ $lubricant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" class="form-control">
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="purchase_date">Purchase Date</label>
                        <input type="date" name="purchase_date" value="{{ $purchase->purchase_date }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity_purchased">Quantity Purchased</label>
                        <input type="number" name="quantity_purchased" value="{{ $purchase->quantity_purchased }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_type">Unit Type</label>
                        <input type="text" name="unit_type" value="{{ $purchase->unit_type }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="total_cost">Total Cost</label>
                        <input type="number" name="total_cost" value="{{ $purchase->total_cost }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select name="payment_status" class="form-control">
                            <option value="full payment" {{ $purchase->payment_status == 'full payment' ? 'selected' : '' }}>Full Payment</option>
                            <option value="half payment" {{ $purchase->payment_status == 'half payment' ? 'selected' : '' }}>Half Payment</option>
                            <option value="online payment" {{ $purchase->payment_status == 'online payment' ? 'selected' : '' }}>Online Payment</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
