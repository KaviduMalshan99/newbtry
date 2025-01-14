@foreach ($products as $battery)
    <div class="col-xxl-3 col-sm-4">
        <div class="our-product-wrapper h-100 widget-hover" data-id="{{ $battery->id }}" data-name="Repair Battery"
            data-type="{{ $battery->type }}" data-price="{{ $battery->selling_price }}">
            <div class="our-product-content">
                <div class="battery-info mb-2">
                    <span class="badge {{ $battery->isForSelling ? 'bg-success' : 'bg-secondary' }}">
                        {{ $battery->isForSelling ? 'For Sale' : 'Not for Sale' }}
                    </span>
                    <span class="badge {{ $battery->isActive ? 'bg-primary' : 'bg-danger' }}">
                        {{ $battery->isActive ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="battery-details">
                    <h6 class="f-14 f-w-500 pt-2">{{ $battery->type }}</h6>
                    <p class="text-muted mb-2">Model: {{ $battery->model_number }}</p>
                </div>
                <div class="stock-info mb-2">
                    <span class="badge bg-info">
                        Stock: {{ $battery->stock_quantity || 0 }}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="txt-primary">RS {{ number_format($battery->selling_price, 2, '.', ',') }}</h6>
                        <small class="text-muted">Added: {{ date('M d, Y', strtotime($battery->added_date)) }}</small>
                    </div>
                    <div class="add-quantity btn border text-gray f-12 f-w-500">
                        <i class="fa fa-minus remove-minus count-decrease"></i>
                        <button class="btn add-btn btn-sm p-1">Add</button>
                        <i class="fa fa-plus count-increase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
