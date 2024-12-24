@extends('layouts.simple.master')

@section('title', 'Add New Battery')

@section('content')
<div class="container">
    <h2 class="my-3">Add New Battery</h2>

    <form action="{{ route('admin.old-batteries.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="order_id">Order ID</label>
            <input type="text" name="order_id" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="old_battery_type">Battery Type</label>
            <input type="text" name="old_battery_type" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="old_battery_condition">Battery Condition</label>
            <input type="text" name="old_battery_condition" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="old_battery_value">Battery Value</label>
            <input type="number" name="old_battery_value" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="notes">Notes (Optional)</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Battery</button>
    </form>
</div>
@endsection
