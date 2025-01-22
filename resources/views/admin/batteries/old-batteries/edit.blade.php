@extends('layouts.simple.master')

@section('title', 'Edit Battery')

@section('content')
<div class="container">
    <h2 class="my-3">Edit Battery</h2>

    <form action="{{ route('admin.old-batteries.update', $battery->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="order_id">Order ID</label>
            <input type="text" name="order_id" class="form-control" value="{{ $battery->order_id }}" required>
        </div>

        <div class="form-group">
            <label for="old_battery_type">Battery Type</label>
            <input type="text" name="old_battery_type" class="form-control" value="{{ $battery->old_battery_type }}" required>
        </div>

        <div class="form-group">
            <label for="old_battery_condition">Battery Condition</label>
            <input type="text" name="old_battery_condition" class="form-control" value="{{ $battery->old_battery_condition }}" required>
        </div>

        <div class="form-group">
            <label for="old_battery_value">Battery Value</label>
            <input type="number" name="old_battery_value" class="form-control" value="{{ $battery->old_battery_value }}" required>
        </div>

        <div class="form-group">
            <label for="notes">Notes (Optional)</label>
            <textarea name="notes" class="form-control">{{ $battery->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update Battery</button>
    </form>
</div>
@endsection
