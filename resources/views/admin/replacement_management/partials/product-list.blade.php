@foreach ($products as $product)
    <div class="col-xxl-3 col-sm-4">
        <div class="our-product-wrapper h-100 widget-hover"
            dataId="{{ $product->id }} data-name="{{ $product->model_name ?? $product->name }}"
            data-price="{{ number_format($product->selling_price ?? $product->sale_price, 2) }}"
            data-image="{{ asset('storage/' . $product->image) }}">
            <div class="our-product-img">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->model_name ?? $product->name }}">
            </div>
            <div class="our-product-content">
                <h6 class="f-14 f-w-500 pt-2 pb-1">{{ $product->model_name ?? $product->name }}</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="txt-primary">RS {{ number_format($product->selling_price ?? $product->sale_price, 2) }}
                    </h6>
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
