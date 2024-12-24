@extends('layouts.simple.master')

@section('title', 'Old Battery Details')

@section('content')
<div class="container">
    <h2 class="my-3">Old Battery Details</h2>

    <div class="card">
        <div class="card-header">
            Battery ID: {{ $oldBattery->old_battery_id }}
        </div>
        <div class="card-body">
            <p><strong>Order ID:</strong> {{ $oldBattery->order_id }}</p>
            <p><strong>Battery Type:</strong> {{ $oldBattery->old_battery_type }}</p>
            <p><strong>Condition:</strong> {{ $oldBattery->old_battery_condition }}</p>
            <p><strong>Value:</strong> {{ $oldBattery->old_battery_value }}</p>
            <p><strong>Notes:</strong> {{ $oldBattery->notes }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.old-batteries.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
