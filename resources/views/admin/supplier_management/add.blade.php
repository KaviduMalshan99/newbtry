@extends('master')
@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">
                    <h2 class="content-title">Add New Suppliers</h2>
                    <div>
                        <a href="{{ route('suppliers.show', 'view') }}" class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                            Back
                        </a>
                        <button type="submit" form="supplierForm" class="btn btn-md rounded font-sm hover-up">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="supplierForm" action="{{ route('suppliers.store') }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" placeholder="Type here" class="form-control"
                                    id="name" required />
                            </div>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" placeholder="Type here" class="form-control"
                                        id="email" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel" name="phone_number" placeholder="Type here" class="form-control"
                                        id="phone_number" required />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" placeholder="Type here" class="form-control"
                                    id="address" required />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Product Type</label>
                                <select name="product_type" class="form-select" required>
                                    <option value="" disabled selected>Select Product Type</option>
                                    @foreach ($productTypes as $type)
                                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
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
