@extends('master')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Suppliers List</h2>
                <p>Manage your suppliers efficiently.</p>
            </div>
            <div>
                <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm rounded">Create new</a>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-2 col-2 me-auto mb-md-0 mb-3">
                        <label class="form-label">Supplier Name</label>
                    </div>
                    <div class="col-md-2 col-2">
                        <label class="form-label">Phone Number</label>
                    </div>
                    <div class="col-md-2 col-2">
                        <label class="form-label">Email</label>
                    </div>
                    <div class="col-md-2 col-2">
                        <label class="form-label">Address</label>
                    </div>
                    <div class="col-md-2 col-2">
                        <label class="form-label">Product Type</label>
                    </div>
                    <div class="col-md-1 col-1">
                        <label class="form-label">Date</label>
                    </div>
                    <div class="col-md-1 col-1">
                        <label class="form-label"></label>
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                @forelse ($suppliers as $supplier)
                    <article class="itemlist">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-sm-2 col-2 col-name"><span>{{ $supplier->name }}</span></div>
                            <div class="col-lg-2 col-sm-2 col-2 col-name"><span>{{ $supplier->phone_number }}</span></div>
                            <div class="col-lg-2 col-sm-2 col-2 col-name"><span>{{ $supplier->email ?? 'N/A' }}</span></div>
                            <div class="col-lg-2 col-sm-2 col-2 col-name"><span>{{ $supplier->address }}</span></div>
                            <div class="col-lg-2 col-sm-2 col-2 col-name">
                                <span>{{ ucfirst($supplier->product_type) }}</span></div>
                            <div class="col-lg-1 col-sm-1 col-1 col-date">
                                <span>{{ $supplier->created_at->format('d.m.Y') }}</span>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-1 col-action text-end">
                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                    class="btn btn-sm font-sm rounded btn-brand">
                                    <i class="material-icons md-edit"
                                        href="{{ route('suppliers.edit', $supplier->id) }}"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm font-sm btn-light rounded">
                                        <i class="material-icons md-delete_forever"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-center">No suppliers found.</p>
                @endforelse

            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
        <div class="pagination-area mt-30 mb-50">
            {{ $suppliers->links() }}
        </div>

    </section>
@endsection
