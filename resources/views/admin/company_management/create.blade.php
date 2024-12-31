@extends('layouts.simple.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Comapany Management</h3>
@endsection

@section('breadcrumb-items')

    <li class="breadcrumb-item active">Comapany</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Company Details</h2>
                            </div>
                        </div>

                        <form id="companyForm" action="{{ route('company.storeOrUpdate') }}"
                            method="POST"enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if (!empty($company->company_logo))
                                <div class="mb-4">
                                    <div><img class="img-fluid"
                                            src="{{ $company->company_logo ? asset('storage/' . $company->company_logo) : asset('assets/images/banner/3.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                            @endif
                            <div class=" mb-4">
                                <label for="company_logo" class="form-label">Company Logo</label>
                                <div>
                                    <input class="form-control" name="company_logo" type="file" aria-label="file example"
                                        required="">
                                    <div class="invalid-feedback">Example invalid form file feedback</div>
                                </div>
                            </div>

                            <div class=" mb-4">
                                <label for="company_name my-2">Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ old('company_name', $company->company_name ?? '') }}" required>

                            </div>
                            <div class=" mb-4">
                                <label for="address my-2">Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $company->address ?? '') }}" required>
                            </div>

                            <div class=" mb-4">
                                <label for="contact my-2">Contact</label>
                                <input type="tel" name="contact" class="form-control"
                                    value="{{ old('contact', $company->contact ?? '') }}" required>
                            </div>

                            <div class=" mb-4">
                                <label for="email my-2">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $company->email ?? '') }}" required>
                            </div>

                            <div class="mb-4">
                                <button type="submit" form="companyForm" class="btn btn-success col-md-3">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection
