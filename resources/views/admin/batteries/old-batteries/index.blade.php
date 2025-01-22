@extends('layouts.simple.master')

@section('title', 'Old Batteries')

@section('content')
<div class="container">
    <h2 class="my-3">Old Batteries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.old-batteries.create') }}" class="btn btn-primary mb-3">Add New Battery</a>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Type</th>
                <th>Condition</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batteries as $battery)
                <tr>
                    <td>{{ $battery->order_id }}</td>
                    <td>{{ $battery->old_battery_type }}</td>
                    <td>{{ $battery->old_battery_condition }}</td>
                    <td>{{ $battery->old_battery_value }}</td>
                    <td>
                        <a href="{{ route('admin.old-batteries.edit', $battery->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.old-batteries.destroy', $battery->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
