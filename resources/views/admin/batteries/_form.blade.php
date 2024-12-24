@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Battery</h1>
    <form action="{{ route('batteries.store') }}" method="POST">
        @csrf
        <!-- Include the form partial for reusable fields -->
        @include('batteries._form')
        <!-- Submit button -->
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
