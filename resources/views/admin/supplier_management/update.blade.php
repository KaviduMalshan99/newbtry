@extends('master')
@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">
                    <h2 class="content-title">Update Suppliers</h2>
                    <div>
                        <a href="{{ route('suppliers.show', "view") }}" class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                            Back
                        </a>                        
                        <button type="submit" form="supplierForm" class="btn btn-md rounded font-sm hover-up">Update</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="supplierForm" action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $supplier->name }}" placeholder="Type here"
                                    class="form-control" id="name" required />
                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $supplier->email }}"
                                        placeholder="Type here" class="form-control" id="email" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" name="phone_number" value="{{ $supplier->phone_number }}"
                                        placeholder="Type here" class="form-control" id="phone_number" required />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" value="{{ $supplier->address }}" name="address"
                                    placeholder="Type here" class="form-control" id="address" required />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Product Type</label>
                                <select name="product_type" class="form-select" required>
                                    @foreach ($productTypes as $type)
                                        <option value="{{ $type }}"
                                            {{ $supplier->product_type == $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
