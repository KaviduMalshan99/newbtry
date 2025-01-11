@extends('layouts.simple.master')
@section('title', 'POS')

@section('css')

@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pos/css/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pos/css/swiper/swiper.min.css') }}">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pos/css/style.css') }}">

@endsection

@section('breadcrumb-title')
    <h3>POS</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">POS</li>
@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-9 col-xl-8">
                <div class="row">
                    <div class="col-xl-12">


                        <div class="card">
                            <div class="card-header card-no-border">
                                <div class="header-top">
                                    <h5>All battery Brands</h5>
                                    <div class="card-header-right-btn">
                                        <a class="font-dark f-12" href="javascript:void(0)">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="slider-wrapper arrow-round">
                                    <div class="swiper shop-category-slider">
                                        {{-- @if ($brands->isEmpty())
                                        <p>No lubricant brands found.</p>
                                    @else --}}
                                        <div class="swiper-wrapper">
                                            @foreach ($brands as $brand)
                                                <div class="swiper-slide">
                                                    <div class="shop-box">
                                                        <a class="" data-brand-id="{{ $brand->id }} href="#">

                                                            <img src="{{ asset('storage/' . $brand->image) }}"
                                                                alt="{{ $brand->brand_name }}" style="width:100px;">
                                                        </a>
                                                    </div>
                                                    <span
                                                        class="m-t-10 category-title f-w-500 text-gray">{{ $brand->brand_name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- @endif --}}

                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>



                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-header card-no-border">
                                <div class="main-product-wrapper">
                                    <div class="product-header">
                                        <h5>Our Products</h5>
                                        <p class="f-m-light mt-1 text-gray f-w-500">Browse & Discover Thousands of products
                                            here!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body main-our-product">
                                <div class="row g-3 scroll-product">
                                    <!-- Displaying Batteries -->
                                    @foreach ($batteries as $battery)
                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="our-product-wrapper h-100 widget-hover" dataId="{{ $battery->id }}"
                                                data-name="{{ $battery->model_name }}"
                                                data-price="{{ number_format($battery->selling_price, 2) }}"
                                                data-image="{{ asset('storage/' . $battery->image) }}">
                                                <div class="our-product-img">
                                                    <img src="{{ asset('storage/' . $battery->image) }}"
                                                        alt="{{ $battery->model_name }}">
                                                </div>
                                                <div class="our-product-content">
                                                    <h6 class="f-14 f-w-500 pt-2 pb-1">{{ $battery->model_name }}</h6>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="txt-primary">RS
                                                            {{ number_format($battery->selling_price, 2) }}</h6>
                                                        <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                            <i class="fa fa-minus remove-minus count-decrease"></i>
                                                            <button class="btn add-btn btn-sm p-1  ">Add</button>
                                                            <i class="fa fa-plus count-increase"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach





                                    <!-- Displaying Lubricants -->

                                    {{-- @foreach ($lubricants as $lubricant)
                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="our-product-wrapper h-100 widget-hover"
                                                dataId="{{ $lubricant->id }}" data-name="{{ $lubricant->name }}"
                                                data-price="{{ number_format($lubricant->sale_price, 2) }}"
                                                data-image="{{ asset('storage/' . $lubricant->image) }}">
                                                <div class="our-product-img">
                                                    <img src="{{ asset('storage/' . $lubricant->image) }}"
                                                        alt="{{ $lubricant->name }}">
                                                </div>
                                                <div class="our-product-content">
                                                    <h6 class="f-14 f-w-500 pt-2 pb-1">{{ $lubricant->name }}</h6>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="txt-primary">RS
                                                            {{ number_format($lubricant->sale_price, 2) }}</h6>
                                                        <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                            <i class="fa fa-minus remove-minus count-decrease"></i>
                                                            <button class="btn add-btn btn-sm p-1  ">Add</button>
                                                            <i class="fa fa-plus count-increase"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach --}}


                                    <!-- Displaying Lubricants  end -->



                                    {{-- @foreach ($lubricants as $lubricant)
                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="our-product-wrapper h-100 widget-hover">
                                                <div class="our-product-img">
                                                    <img src="{{ asset('storage/' . $lubricant->image) }}"
                                                        alt="{{ $lubricant->name }}">
                                                </div>
                                                <div class="our-product-content">
                                                    <h6 class="f-14 f-w-500 pt-2 pb-1">{{ $lubricant->name }}</h6>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="txt-primary">RS
                                                            {{ number_format($lubricant->sale_price, 2) }}</h6>
                                                        <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                            <i class="fa fa-minus remove-minus count-decrease"></i>
                                                            <span class="add-btn">Add</span>
                                                            <input class="countdown-remove" type="number" value="0">
                                                            <i class="fa fa-plus count-increase"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>






            <div class="col-xxl-3 col-md-4 customer-sidebar-left">
                <div class="md-sidebar h-100"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">Order
                        Details</a>
                    <div class="md-sidebar-aside custom-scrollbar responsive-order-details">
                        <div class="card customer-sticky">
                            <div class="card-header card-no-border pb-3">
                                <div class="header-top border-bottom pb-3">
                                    <h5 class="m-0">Customer </h5>






                                </div>
                            </div>
                            <div class="card-body pt-0 order-details">
                                <select class="form-select f-w-400 f-14 text-gray py-2" aria-label="Select Customer"
                                    id="customer-select" required onchange="loadCustomerOrders()">
                                    <option value="" selected disabled>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->phone_number }} - {{ $customer->first_name }}
                                            {{ $customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <h5 class="m-0">Customer's Orders</h5>

                                <select class=" form-select f-w-400 f-14 text-gray py-2" aria-label="Select Order Id"
                                    id="order-select" required>
                                    <option value="" selected disabled>Select Order Id</option>
                                </select>

                                <h5 class="m-0">Order Items</h5>

                                <select class=" form-select f-w-400 f-14 text-gray py-2" aria-label="Select Order Item"
                                    id="order-item-select" required>
                                    <option value="" selected disabled>Select Order Item</option>
                                </select>

                                <style>
                                    .order-quantity {
                                        max-height: 400px;
                                        overflow-y: auto;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }

                                    .order-history {
                                        max-height: 400px;
                                        overflow-y: auto;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }


                                    .order-history::-webkit-scrollbar {
                                        width: 8px;
                                    }

                                    .order-quantity::-webkit-scrollbar {
                                        width: 8px;
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;
                                        /* Round the corners of the thumb */
                                    }

                                    .order-history::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;
                                        /* Round the corners of the thumb */
                                    }

                                    .order-history::-webkit-scrollbar-thumb:hover {
                                        background-color: #555;
                                        /* Change color on hover */
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb:hover {
                                        background-color: #555;
                                        /* Change color on hover */
                                    }
                                </style>

                                <div class="order-history p-b-20 border-bottom mt-3" id="order-history">

                                    <!-- Order details will be loaded here -->

                                </div>

                                <h5 class="m-0">Order Details</h5>



                                <div class="order-quantity p-b-20 border-bottom">



                                </div>






                                <div class="total-item">
                                    <div class="item-number"><span class="text-gray">Item</span><span class="f-w-500">0
                                            (Items)</span></div>
                                    <div class="item-number"><span class="text-gray">Subtotal</span><span
                                            class="f-w-500">0</span></div>
                                    <div class="item-number border-bottom"><span class="text-gray">Fees</span><span
                                            class="f-w-500">0</span></div>
                                    <div class="item-number pt-3 pb-0"><span class="f-w-500">Total</span>
                                        <h6 class="txt-primary">0</h6>
                                    </div>
                                </div>

                                <!-- Old Battery Discount Section -->
                                <div class="widget-hover">
                                    <h5 class="m-0 p-t-40">Old Battery Discount</h5>
                                    <div class="header-top pb-3">
                                        <div class="mb-4 card-header-right-icon create-right-btn">
                                            <a class="btn btn-light-primary f-w-500 f-12" href="javascript:void(0)"
                                                data-bs-toggle="modal" data-bs-target="#dashboard82">
                                                Add Old Battery
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="old_battery_discount" class="form-label">Old Battery Discount</label>
                                        <input type="number" id="old_battery_discount" name="old_battery_discount"
                                            class="form-control" placeholder="Old Battery Discount" value="0"
                                            readonly />
                                    </div>
                                </div>

                                <!-- Modal for Adding Old Battery -->
                                <div class="modal fade" id="dashboard82" tabindex="-1" aria-labelledby="dashboard82"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modaldashboard2">Add Old Battery</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="text-start dark-sign-up">
                                                    <div class="modal-body">
                                                        <form class="row g-3 needs-validation" id="oldBatteryForm"
                                                            novalidate>
                                                            @csrf
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="old_battery_type">Old
                                                                    Battery Type<span class="txt-danger">*</span></label>
                                                                <input class="form-control" id="old_battery_type"
                                                                    name="old_battery_type" type="text"
                                                                    placeholder="Enter old Battery Type" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="old_battery_condition">Old
                                                                    Battery Condition<span
                                                                        class="txt-danger">*</span></label>
                                                                <select name="old_battery_condition"
                                                                    id="old_battery_condition" class="form-select"
                                                                    required>
                                                                    <option value="" disabled selected>Select
                                                                        Condition</option>
                                                                    @foreach ($old_battery_conditions as $condition)
                                                                        <option value="{{ $condition }}">
                                                                            {{ $condition }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="old_battery_value">Old
                                                                    Battery Value<span class="txt-danger">*</span></label>
                                                                <input class="form-control old_battery_value"
                                                                    id="old_battery_value" name="old_battery_value"
                                                                    type="number" placeholder="Value" required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="notes">Notes<span
                                                                        class="txt-danger"></span></label>
                                                                <textarea name="notes" placeholder="Type here" class="form-control" id="notes" required></textarea>
                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-end">
                                                                <button class="btn btn-primary" type="button"
                                                                    id="submitOldBatteryForm">Add</button>
                                                            </div>
                                                        </form>
                                                        <div id="formMessage" class="mt-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form id="order-form" method="POST"
                                    action="{{ route('replacements.storeReplacement') }}">
                                    @csrf

                                    <div class="widget-hover">
                                        <h5 class="m-0 p-t-40">Replace Details</h5>
                                        <div class="mb-4">
                                            <label for="price_adjustment" class="form-label">Replace Battery Price</label>
                                            <input type="number" id="price_adjustment" name="price_adjustment"
                                                class="form-control" placeholder="" readonly />
                                        </div>

                                        <div class="mb-4">
                                            <label for="replacement_reason" class="form-label">Payment Type</label>
                                            <select id="replacement_reason" name="replacement_reason" class="form-select"
                                                required>
                                                @foreach ($replacementReasons as $replacementReason)
                                                    <option value="{{ $replacementReason }}">{{ $replacementReason }}
                                                    </option>)
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="widget-hover">
                                        <h5 class="m-0 p-t-40">Payment Section</h5>

                                        <div class="mb-4">
                                            <label for="total_price" class="form-label">Total Price</label>
                                            <input type="number" id="total_price" name="total_price"
                                                class="form-control" placeholder="Total Price" readonly />
                                        </div>

                                        <div class="mb-4">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="number" id="discount" name="discount" class="form-control"
                                                step="0.01" placeholder="Enter discount" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="paid_amount" class="form-label">Paid Amount</label>
                                            <input type="number" id="paid_amount" name="paid_amount"
                                                class="form-control" step="0.01" placeholder="Enter price" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="due_amount" class="form-label">Due Amount</label>
                                            <input type="number" id="due_amount" name="due_amount" class="form-control"
                                                step="0.01" placeholder="Due Amount" readonly />
                                        </div>
                                        <div class="mb-4">
                                            <label for="payment_type" class="form-label">Payment Type</label>
                                            <select id="payment_type" name="payment_type" class="form-select" required>
                                                @foreach ($paymentTypes as $paymentType)
                                                    <option value="{{ $paymentType }}">{{ $paymentType }}</option>)
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="place-order">


                                        <input type="hidden" name="customer_id" id="customer_id">
                                        <input type="hidden" name="total_items" id="total_items">
                                        <input type="hidden" name="subtotal" id="subtotal">
                                        <input type="hidden" name="battery_discount" id="battery_discount">
                                        <input type="hidden" name="old_battery_discount_value"
                                            id="old_battery_discount_value">
                                        <button id="place-order-btn"
                                            class="btn btn-primary btn-hover-effect w-100 f-w-500" type="submit">Place
                                            Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript for Fetch -->
        <script>
            function loadCustomerOrders() {
                const customerId = document.getElementById("customer-select").value;
                const orderSelect = document.getElementById("order-select");
                const orderHistory = document.getElementById("order-history");

                // Clear the previous options and history
                orderSelect.innerHTML = '<option value="" selected disabled>Select Order Id</option>';
                orderHistory.innerHTML = '';

                // Send an AJAX request to fetch orders
                fetch(`/admin/replacement/get-customer-orders/${customerId}`)
                    .then(response => response.json())
                    .then(orders => {
                        if (orders.length > 0) {
                            // Populate the orders dropdown
                            orders.forEach(order => {
                                const option = document.createElement("option");
                                option.value = order.id;
                                option.textContent =
                                    `${order.order_id} - ${order.order_type} (${order.order_date})`;
                                orderSelect.appendChild(option);
                            });
                        } else {
                            // Show a message if no orders are found
                            orderHistory.innerHTML = '<p>No orders found for this customer.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching customer orders:', error);
                        orderHistory.innerHTML = '<p>An error occurred while fetching orders. Please try again later.</p>';
                    });
            }

            // Function to load order items into the dropdown
            function loadOrderItemsIntoDropdown(orderId) {
                const orderItemSelect = document.getElementById("order-item-select");

                // Reset the dropdown
                orderItemSelect.innerHTML = '<option value="" selected disabled>Select Order Item</option>';

                // Fetch order items
                fetch(`/admin/replacement/get-order-items/${orderId}`)
                    .then(response => response.json())
                    .then(order => {
                        if (order && order.items && order.items.length > 0) {
                            // Populate dropdown with items
                            order.items.forEach(item => {
                                const option = document.createElement('option');
                                option.value = JSON.stringify({
                                    battery_id: item.battery_id,
                                    quantity: item.quantity,
                                    price: item.price,
                                    image: item.image,
                                    name: item.name
                                });
                                option.textContent = `${item.name} (Qty: ${item.quantity})`;
                                orderItemSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error loading order items:", error);
                        orderItemSelect.innerHTML = '<option value="" disabled>Error loading items</option>';
                    });
            }

            // Function to display selected item details
            function displaySelectedItemDetails(itemData) {
                const orderHistory = document.getElementById("order-history");
                const item = JSON.parse(itemData);
                const imageUrl = `/storage/${item.image}`;
                const formattedPrice = parseFloat(item.price).toFixed(2);

                const customerOrderItem = `

                        <style>
                                    .customer-order-wrapper {
                                        display: flex;
                                        flex-wrap: wrap;
                                        justify-content: space-between;
                                        padding: 10px;
                                        border: 1px solid #ddd;
                                        margin-bottom: 15px;
                                        background-color: #fff;
                                        border-radius: 8px;
                                    }

                                    .left-details1 {
                                        flex: 1;
                                        padding-right: 10px;
                                    }

                                    .order-img1 img {
                                        width: 59px;
                                        height: 49px;
                                        object-fit: cover;
                                        border-radius: 5px;
                                    }

                                    .category-details1 {
                                        flex: 2;
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                    }

                                    .order-details-right1 {
                                        flex: 1;
                                        padding-left: 10px;
                                    }

                                    .f-141 {
                                        font-size: 14px;
                                    }

                                    .f-w-5001 {
                                        font-weight: 500;
                                    }

                                    .mb-31 {
                                        margin-bottom: 10px;
                                    }

                                    .battery-id1 {
                                        color: #333;
                                    }

                                    .last-order-detail1 {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                    }

                                    .txt-primary1 {
                                        color: #007bff;
                                    }

                                    .item-price1 {
                                        font-size: 16px;
                                        font-weight: 600;
                                    }

                                    .trash-remove1 i {
                                        color: #ff4d4f;
                                        font-size: 18px;
                                        cursor: pointer;
                                    }

                                    .right-details1 {
                                        display: flex;
                                        align-items: center;
                                    }


                                    .btn-touchspin1 {
                                        background-color: #f0f0f0;
                                        border: 1px solid #ddd;
                                        padding: 5px 10px;
                                        cursor: pointer;
                                        font-size: 16px;
                                    }


                                    .decrement-touchspin1, .increment-touchspin1 {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                    }

                                    /* Hover effects */
                                    .trash-remove1:hover i {
                                        color: #d9534f;
                                    }

                                    .btn-touchspin1:hover {
                                        background-color: #e0e0e0;
                                    }

                                    .customer-order-wrapper:hover {
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    }

                                    .touchspin-wrapper1 {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        width: 100%; /* Ensure the parent container has full width */
                                        overflow: hidden; /* Prevent the input from overflowing */
                                    }

                                    .input-touchspin1 {
                                        width: 100%; /* Make the input take up the full width of its parent */
                                        max-width: 100px; /* Limit the max width of the input */
                                        text-align: center;
                                        border: 1px solid #ddd;
                                        padding: 5px;
                                        font-size: 14px;
                                        border-radius: 4px;
                                        box-sizing: border-box; /* Ensure padding is included in the element's total width */
                                        margin: 0;
                                    }

                                    /* Optional: Make the input field more responsive on small screens */
                                    @media (max-width: 576px) {
                                        .input-touchspin1 {
                                            max-width: 80px;
                                        }
                                    }
                                </style>

                    <div class="customer-order-wrapper">
                        <div class="left-details1">
                            <div class="order-img1 widget-hover">
                                <img src="${imageUrl}" alt="${item.name}" width="59" height="49">
                            </div>
                        </div>
                        <div class="category-details1 item-row">
                            <div class="order-details-right1">
                                <span class="text-gray mb-1">Category: <span class="font-dark">Product</span></span>
                                <h6 class="f-141 f-w-5001 mb-31 battery-id1" data-order-id="${item.battery_id}">${item.name}</h6>
                                <div class="last-order-detail1">
                                    <h6 class="txt-primary1 item-price1">RS${formattedPrice}</h6>
                                    <a href="javascript:void(0)" class="trash-remove1 trash-remove-product" data-order-id="${item.battery_id}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <div class="right-details1">
                                    <div class="touchspin-wrapper1">
                                        <input class="input-touchspin1 item-quantity1" type="number" value="${item.quantity}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                orderHistory.innerHTML = customerOrderItem;
            }

            let oldBatteryBackendData = null;

            document.getElementById("submitOldBatteryForm").addEventListener("click", async function(e) {
                e.preventDefault();

                // Get the form and its data
                const form = document.getElementById("oldBatteryForm");
                const formData = new FormData(form);

                // Get selected customer ID from the dropdown
                const customerSelect = document.getElementById("customer-select");
                const customerId = customerSelect.value;

                if (customerId == "") {
                    const messageContainer = document.getElementById("formMessage");
                    messageContainer.innerHTML =
                        `<div class="alert alert-danger">Please select a customer.</div>`;
                    return;
                }

                // Append customer ID to the form data
                formData.append("customer_id", customerId);

                try {
                    // Send data to the server using fetch
                    const response = await fetch("{{ route('pos.oldBatteryCreate') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        body: formData,
                    });

                    const result = await response.json();

                    // Handle success or error messages
                    const messageContainer = document.getElementById("formMessage");
                    if (response.ok) {
                        oldBatteryBackendData = result.data;
                        document.getElementById("old_battery_discount").value = result.data.old_battery_value;
                        messageContainer.innerHTML =
                            `<div class="alert alert-success">Old battery added successfully!</div>`;
                        form.reset(); // Reset the form
                    } else {
                        messageContainer.innerHTML =
                            `<div class="alert alert-danger">${result.message || "Something went wrong!"}</div>`;
                    }
                } catch (error) {
                    console.error("Error:", error);
                    const messageContainer = document.getElementById("formMessage");
                    messageContainer.innerHTML =
                        `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                }
            });
        </script>

        <script>
            const csrfToken = "{{ csrf_token() }}";
            const placeOrderBtn = document.getElementById("place-order-btn");
            // console.log(placeOrderBtn); // Check if this logs the button element

            document.getElementById("place-order-btn").addEventListener("click", function(e) {
                e.preventDefault(); // Prevent form submission until fields are populated

                const orderId = document.querySelector("#order-select").value;

                // Get the values from the DOM
                const customerId = document.querySelector("#customer-select").value;
                if (customerId == "") {
                    alert("Please select a customer.");
                    return;
                }

                if (!orderId) {
                    alert("Please select an order.");
                    return;
                }

                // Prepare the items array for current order items
                const items = [];
                const orderDetailsWrappers = document.querySelectorAll(".order-details-wrapper");
                orderDetailsWrappers.forEach(wrapper => {
                    const batteryId = wrapper.querySelector(".battery-id")?.getAttribute("data-id");
                    const quantity = wrapper.querySelector(".input-touchspin")?.value || 0;
                    const priceText = wrapper.querySelector(".txt-primary")?.textContent || "0";
                    const price = priceText.replace("RS", "").replace(/,/g, "").trim();

                    if (batteryId && quantity > 0 && price) {
                        items.push({
                            battery_id: batteryId,
                            quantity: parseInt(quantity, 10),
                            price: parseFloat(price)
                        });
                    }
                });

                // Get customer's order history items
                const customerOrderItems = [];
                const orderHistoryWrappers = document.querySelectorAll(".customer-order-wrapper");

                orderHistoryWrappers.forEach(wrapper => {
                    const batteryId = wrapper.querySelector(".battery-id1")?.getAttribute("data-order-id");
                    const quantity = wrapper.querySelector(".input-touchspin1")?.value || 0;
                    const priceText = wrapper.querySelector(".txt-primary1")?.textContent || "0";
                    const price = priceText.replace("RS", "").replace(/,/g, "").trim();

                    if (batteryId && quantity > 0 && price) {
                        customerOrderItems.push({
                            battery_id: batteryId,
                            quantity: parseInt(quantity, 10),
                            price: parseFloat(price)
                        });
                    }
                });

                const totalItems = document.querySelector(".item-number:nth-child(1) .f-w-500")?.textContent.trim() ||
                    "0";
                const subtotal = document.querySelector(".item-number:nth-child(2) .f-w-500")?.textContent.trim() ||
                    "0";
                const totalPrice = document.querySelector(".item-number:nth-child(4) h6")?.textContent.trim() || "0";
                const paidAmount = document.querySelector("#paid_amount").value || 0;
                const paymentType = document.querySelector("#payment_type").value;
                const discount = document.querySelector("#discount").value || 0;
                const oldBatteryDiscount = document.querySelector("#old_battery_discount").value || 0;

                // Ensure proper formatting and parsing of values
                const subtotalValue = parseFloat(subtotal.replace("RS", "").replace(",", "").trim()) || 0;
                const totalPriceValue = parseFloat(totalPrice.replace("RS", "").replace(",", "").trim()) || 0;
                const paidAmountValue = parseFloat(paidAmount) || 0;
                const dueAmountValue = totalPriceValue - paidAmountValue;

                // Check if totalPrice is correctly calculated
                if (isNaN(totalPriceValue)) {
                    alert("Total price is not calculated correctly. Please check the totals.");
                    return; // Stop form submission if total price is invalid
                }

                // Get old battery details
                const oldBattery = {
                    type: document.getElementById("old_battery_type")?.value || null,
                    condition: document.getElementById("old_battery_condition")?.value || null,
                    value: document.getElementById("old_battery_value")?.value || null,
                    notes: document.getElementById("notes")?.value || null,
                };

                // Populate hidden fields in the form
                document.getElementById("customer_id").value = customerId;
                document.getElementById("total_items").value = totalItems.replace(" (Items)", "").trim();
                document.getElementById("subtotal").value = subtotalValue;
                document.getElementById("total_price").value = totalPriceValue;
                document.getElementById("paid_amount").value = paidAmountValue;
                // document.getElementById("due_amount").value = dueAmountValue;
                document.getElementById("payment_type").value = paymentType;
                document.getElementById("battery_discount").value = discount;
                document.getElementById("old_battery_discount_value").value = oldBatteryDiscount;

                const orderIdInput = document.createElement("input");
                orderIdInput.type = "hidden";
                orderIdInput.name = "order_id";
                orderIdInput.value = orderId;
                document.getElementById("order-form").appendChild(orderIdInput);

                // Add the items details to the form as a hidden input
                const itemsInput = document.createElement("input");
                itemsInput.type = "hidden";
                itemsInput.name = "items";
                itemsInput.value = JSON.stringify(items); // Convert items array to JSON string
                document.getElementById("order-form").appendChild(itemsInput);


                // Include old battery data as hidden input
                const oldBatteryInput = document.createElement("input");
                oldBatteryInput.type = "hidden";
                oldBatteryInput.name = "old_battery";
                oldBatteryInput.value = JSON.stringify(oldBatteryBackendData);
                document.getElementById("order-form").appendChild(oldBatteryInput);

                // Add customer order items to the form as hidden input
                const customerOrderInput = document.createElement("input");
                customerOrderInput.type = "hidden";
                customerOrderInput.name = "customer_order_items";
                customerOrderInput.value = JSON.stringify(customerOrderItems);
                document.getElementById("order-form").appendChild(customerOrderInput);

                // Submit the form after populating the hidden fields
                document.getElementById("order-form").submit();
            });

            document.addEventListener("DOMContentLoaded", function() {
                const placeOrderBtn = document.getElementById("place-order-btn");

                const totalPriceField = document.getElementById("total_price");
                const paidAmountField = document.getElementById("paid_amount");
                const dueAmountField = document.getElementById("due_amount");
                const oldBatteryDiscountValue = document.getElementById("old_battery_discount");
                const discountField = document.getElementById("discount");



                const orderCardContainer = document.querySelector(".order-quantity");
                const orderHistory = document.querySelector(".order-history");
                const totalItemElement = document.querySelector(".total-item");

                document.getElementById("order-select").addEventListener("change", function() {
                    const orderId = this.value;
                    if (orderId) {
                        loadOrderItemsIntoDropdown(orderId);
                        // Clear the order history when a new order is selected
                        document.getElementById("order-history").innerHTML = '';
                    }
                });

                // Event listener for order item selection
                document.getElementById("order-item-select").addEventListener("change", function() {
                    const selectedItem = this.value;
                    if (selectedItem) {
                        displaySelectedItemDetails(selectedItem);
                        calculateAdjestment();
                        calculateTotals();
                    }
                });

                calculateTotals();
                calculateAdjestment();

                // Event delegation for increment, decrement, and remove buttons in the order details
                orderHistory.addEventListener("click", function(event) {
                    const target = event.target;

                    if (target.closest(".trash-remove-product")) {
                        // Remove item
                        const customerOrderItem = target.closest(".customer-order-wrapper");
                        customerOrderItem.remove();
                        calculateAdjestment();
                        calculateTotals();
                        // Show empty cart message if no items are left
                        if (!document.querySelectorAll(".customer-order-wrapper").length) {
                            document.querySelector(".empty-card").style.display = "block";
                        }
                        // Recalculate totals

                    }
                });



                // Function to format price based on conditions
                function formatPrice(price) {
                    return new Intl.NumberFormat('en-US').format(parseFloat(price || 0));
                }

                function calculateAdjestment() {
                    let adjestment = 0; // Initialize adjustment to 0

                    // Iterate through all customer-order-wrapper elements
                    document.querySelectorAll(".customer-order-wrapper").forEach(customerOrderItem => {
                        const quantityInput = customerOrderItem.querySelector(".input-touchspin1");
                        const priceTextElement = customerOrderItem.querySelector(".txt-primary1");

                        // Parse quantity and price
                        const quantity = parseInt(quantityInput?.value ||
                            0); // Use 0 as default if value is null/undefined
                        const priceText = priceTextElement?.textContent.replace("RS", "").trim() || "0";
                        const price = parseFloat(priceText); // Ensure proper parsing of price

                        if (!isNaN(quantity) && !isNaN(price)) {
                            adjestment += quantity * price; // Accumulate adjustment
                        }
                    });

                    // Format adjustment value
                    const formattedAdjestment = adjestment.toFixed(2); // Use `toFixed(2)` for 2 decimal places

                    // Get the adjustment field
                    const adjestmentField = document.getElementById("price_adjustment");

                    if (adjestmentField) {
                        adjestmentField.value = formattedAdjestment; // Set adjustment value to the input field
                    } else {
                        console.error("Adjustment field not found! Ensure #price_adjustment exists in the DOM.");
                    }
                }



                // Function to calculate totals
                function calculateTotals() {
                    const oldBatteryDiscount = parseFloat(document.getElementById("old_battery_discount").value || 0);
                    const discount = parseFloat(document.getElementById("discount").value || 0);
                    let totalItems = 0;
                    let subtotal = 0;
                    const fee = 0;

                    // Calculate from current order items
                    document.querySelectorAll(".order-details-wrapper").forEach(orderItem => {
                        const quantity = parseInt(orderItem.querySelector(".input-touchspin")?.value || 0);
                        const priceText = orderItem.querySelector(".txt-primary")?.textContent.replace("RS", "")
                            .replace(/,/g, "").trim();
                        const price = parseFloat(priceText || 0);

                        if (!isNaN(quantity) && !isNaN(price)) {
                            totalItems += quantity;
                            subtotal += (quantity * price);
                        }
                    });

                    // Calculate from order history items
                    document.querySelectorAll(".customer-order-wrapper").forEach(historyItem => {
                        const quantity = parseInt(historyItem.querySelector(".input-touchspin1")?.value || 0);
                        const priceText = historyItem.querySelector(".txt-primary1")?.textContent.replace("RS",
                            "").replace(/,/g, "").trim();
                        const price = parseFloat(priceText || 0);

                        if (!isNaN(quantity) && !isNaN(price)) {
                            // totalItems += quantity;
                            subtotal -= (quantity * price);
                        }
                    });

                    const total = subtotal + fee;

                    subtotal += fee - discount - oldBatteryDiscount;

                    // Calculate final totals

                    // Format numbers for display
                    const formattedSubtotal = formatPrice(subtotal);
                    const formattedFee = formatPrice(fee);
                    const formattedTotal = formatPrice(total);

                    // Update DOM elements
                    const totalItemElement = document.querySelector(".total-item");
                    if (totalItemElement) {
                        totalItemElement.querySelector(".item-number:nth-child(1) .f-w-500").textContent =
                            `${totalItems} (Items)`;
                        totalItemElement.querySelector(".item-number:nth-child(2) .f-w-500").textContent =
                            `RS${formattedSubtotal}`;
                        totalItemElement.querySelector(".item-number:nth-child(3) .f-w-500").textContent =
                            `RS${formattedFee}`;
                        totalItemElement.querySelector(".item-number:nth-child(4) h6").textContent =
                            `RS${formattedTotal}`;
                    }

                    // Update form fields
                    const totalPriceField = document.getElementById("total_price");
                    if (totalPriceField) {
                        totalPriceField.value = total.toFixed(2);
                    }

                    // Recalculate due amount
                    calculateDueAmount();

                    // Update price adjustment
                    // const priceAdjustmentField = document.getElementById("price_adjustment");
                    // if (priceAdjustmentField) {
                    //     priceAdjustmentField.value = subtotal.toFixed(2);
                    // }
                }




                // Function to calculate due amount
                function calculateDueAmount() {
                    const totalPrice = parseFloat(totalPriceField.value || 0);
                    const paidAmount = parseFloat(paidAmountField.value || 0);
                    const oldBatteryDiscount = parseFloat(oldBatteryDiscountValue.value || 0);
                    const discount = parseFloat(discountField.value || 0);
                    // const adjestment = parseFloat(document.getElementById("price_adjustment").value || 0);
                    const dueAmount = totalPrice - (paidAmount + oldBatteryDiscount + discount);


                    dueAmountField.value = dueAmount > 0 ? dueAmount.toFixed(2) : "0.00";
                }

                // Event listener for Paid Amount input field
                paidAmountField.addEventListener("input", calculateTotals);
                paidAmountField.addEventListener("input",
                    calculateDueAmount);
                paidAmountField.addEventListener("input",
                    calculateAdjestment);
                document.getElementById("discount").addEventListener("input",
                    calculateTotals);
                document.getElementById("discount").addEventListener("input",
                    calculateDueAmount);
                document.getElementById("discount").addEventListener("input",
                    calculateAdjestment);
                document.getElementById("old_battery_discount").addEventListener("input",
                    calculateTotals);
                document.getElementById("old_battery_discount").addEventListener("input",
                    calculateDueAmount);
                document.getElementById("old_battery_discount").addEventListener("input",
                    calculateAdjestment);
                document.getElementById("order-history").addEventListener("change",
                    calculateAdjestment);
                document.getElementById("order-select").addEventListener("change",
                    calculateAdjestment);

                // Event delegation for the Add button (works for dynamically added products too)
                document.querySelector('.scroll-product').addEventListener("click", function(event) {
                    const target = event.target;

                    // Check if the clicked target is an "Add" button
                    if (target.classList.contains("add-btn")) {

                        const productWrapper = target.closest(".our-product-wrapper");

                        // Extract product details from data attributes
                        const name = productWrapper.getAttribute("data-name");
                        const id = productWrapper.getAttribute("dataId");
                        const priceString = productWrapper.getAttribute("data-price");
                        const price = parseFloat(priceString.replace(/,/g, '')); // Remove commas before parsing
                        const formattedPrice = formatPrice(price); // Format price based on conditions
                        const image = productWrapper.getAttribute("data-image");

                        // Create an order card item
                        const orderItem = `
                                <div class="order-details-wrapper">
                                    <div class="left-details">
                                        <div class="order-img widget-hover">
                                            <img src="${image}" alt="${name}">
                                        </div>
                                    </div>
                                    <div class="category-details item-row">
                                        <div class="order-details-right">
                                            <span class="text-gray mb-1">Category: <span class="font-dark">Product</span></span>
                                            <h6 class="f-14 f-w-500 mb-3 battery-id" data-id="${id}">${name}</h6>
                                            <div class="last-order-detail">
                                                <h6 class="txt-primary item-price">RS${formattedPrice}</h6>
                                                <a href="javascript:void(0)" class="trash-remove"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="right-details">
                                            <div class="touchspin-wrapper">
                                                <button class="decrement-touchspin btn-touchspin"><i class="fa fa-minus text-gray"></i></button>
                                                <input class="input-touchspin item-quantity" type="number" value="1" readonly>
                                                <button class="increment-touchspin btn-touchspin"><i class="fa fa-plus text-gray"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                        // Append the order item to the order card
                        orderCardContainer.insertAdjacentHTML("beforeend", orderItem);
                        // Recalculate totals
                        calculateTotals();
                        checkAndDisableAddButton();


                        // Hide "Your cart is empty" message
                        document.querySelector(".empty-card").style.display = "none";


                    }
                });

                // Function to check and disable Add button
                function checkAndDisableAddButton() {
                    console.log("Checking and disabling Add button...");
                    const totalItemElement = document.querySelector(".total-item");
                    const itemText = totalItemElement.querySelector(".item-number:nth-child(1) .f-w-500").textContent;

                    // Extract number from "X (Items)" format
                    const totalItems = parseInt(itemText.split('(')[0].trim());

                    // Get all add buttons
                    const addButtons = document.querySelectorAll('.add-btn');

                    // Disable/enable based on total items
                    if (totalItems === 1) {
                        addButtons.forEach(button => {
                            button.disabled = true;
                            button.classList.add('disabled'); // Optional: add a disabled class for styling
                        });
                    } else {
                        addButtons.forEach(button => {
                            button.disabled = false;
                            button.classList.remove('disabled');
                        });
                    }
                }

                // Event delegation for increment, decrement, and remove buttons in the order details
                orderCardContainer.addEventListener("click", function(event) {
                    const target = event.target;

                    if (target.closest(".increment-touchspin")) {
                        // Increment quantity
                        const input = target.closest(".touchspin-wrapper").querySelector(".input-touchspin");
                        input.value = parseInt(input.value) + 1;

                        // Recalculate totals
                        calculateTotals();
                    }

                    if (target.closest(".decrement-touchspin")) {
                        // Decrement quantity
                        const input = target.closest(".touchspin-wrapper").querySelector(".input-touchspin");
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;

                            // Recalculate totals
                            calculateTotals();
                        }
                    }

                    if (target.closest(".trash-remove")) {
                        // Remove item
                        const orderItem = target.closest(".order-details-wrapper");
                        orderItem.remove();

                        // Recalculate totals
                        calculateTotals();
                        checkAndDisableAddButton();

                        // Show empty cart message if no items are left
                        if (!document.querySelectorAll(".order-details-wrapper").length) {
                            document.querySelector(".empty-card").style.display = "block";
                        }


                    }
                });

                const brandLinks = document.querySelectorAll('.swiper-slide');

                brandLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Get the brand ID from the clicked element
                        const brandId = this.querySelector('a').getAttribute('data-brand-id');

                        // Send an AJAX request to fetch products by brand
                        fetch(`/products-by-brand/${brandId}`)
                            .then(response => response.text())
                            .then(html => {
                                // Update the product list container with the new products
                                document.querySelector('.scroll-product').innerHTML = html;
                            })
                            .catch(error => console.error('Error fetching products:', error));

                        calculateTotals();
                    });
                });

                calculateTotals();
            });
        </script>


    </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/pos/js/custom_touchspin.js') }}"></script>
    <script src="{{ asset('assets/pos/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/pos/js/dashboard_8.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#customer-select').select2({
                placeholder: "Select Customer",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

@endsection
