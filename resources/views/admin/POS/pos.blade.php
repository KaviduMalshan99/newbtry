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
                                            <div class="our-product-wrapper h-100 widget-hover"
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

                                    @foreach ($lubricants as $lubricant)
                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="our-product-wrapper h-100 widget-hover"
                                                data-name="{{ $lubricant->name }}"
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
                                    @endforeach


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
                                    <div class="card-header-right-icon create-right-btn"><a
                                            class="btn btn-light-primary f-w-500 f-12" href="javascript:void(0)"
                                            data-bs-toggle="modal" data-bs-target="#dashboard8">Create +</a></div>
                                    <!-- Modal-->
                                    <div class="modal fade" id="dashboard8" tabindex="-1" aria-labelledby="dashboard8"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaldashboard">Create Customer</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <div class="text-start dark-sign-up">
                                                        <div class="modal-body">

                                                            <form class="row g-3 needs-validation"
                                                                action="{{ route('customer.create') }}" method="POST"
                                                                novalidate>
                                                                @csrf
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="validationCustom-8">First Name<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom-8"
                                                                        name="first_name" type="text"
                                                                        placeholder="Enter your first name" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="validationCustom09">Last Name<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom09"
                                                                        name="last_name" type="text"
                                                                        placeholder="Enter your last name" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="validationCustom08">Mobile Number<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom08"
                                                                        name="phone_number" type="text"
                                                                        placeholder="Mobile number" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="exampleFormControlInput8">Email<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control"
                                                                        id="exampleFormControlInput8" name="email"
                                                                        type="email"
                                                                        placeholder="customername@gmail.com">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label"
                                                                        for="validationCustom08">Address<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom08"
                                                                        name="address" type="text"
                                                                        placeholder="Address" required>
                                                                </div>
                                                                <div class="col-md-12 d-flex justify-content-end">
                                                                    <button class="btn btn-primary" type="submit">Create
                                                                        +</button>
                                                                </div>
                                                            </form>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                            <div class="card-body pt-0 order-details">
                                <select class="form-select f-w-400 f-14 text-gray py-2" aria-label="Select Customer"
                                    id="customer-select">
                                    <option selected="" disabled="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->phone_number }} - {{ $customer->first_name }}
                                            {{ $customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <h5 class="m-0">Order Details</h5>

                                <style>
                                    .order-quantity {
                                        max-height: 400px;
                                        overflow-y: auto;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }


                                    .order-quantity::-webkit-scrollbar {
                                        width: 8px;
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;
                                        /* Round the corners of the thumb */
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb:hover {
                                        background-color: #555;
                                        /* Change color on hover */
                                    }
                                </style>

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








                                <h5 class="m-0 p-t-40">Payment Method</h5>
                                <div class="payment-methods">
                                    <div>
                                        <div class="bg-payment widget-hover"> <img
                                                src="../assets/images/dashboard-8/payment-option/cash.svg" alt="cash">
                                        </div><span class="f-w-500 text-gray">Cash</span>
                                    </div>
                                    <div>
                                        <div class="bg-payment widget-hover"> <img
                                                src="../assets/images/dashboard-8/payment-option/card.svg" alt="card">
                                        </div><span class="f-w-500 text-gray">Card</span>
                                    </div>
                                    <div>
                                        <div class="bg-payment widget-hover"> <img
                                                src="../assets/images/dashboard-8/payment-option/wallet.svg"
                                                alt="wallet"></div><span class="f-w-500 text-gray">E-Wallet</span>
                                    </div>
                                </div>
                                <div class="place-order">
                                    <button id="place-order-btn" class="btn btn-primary btn-hover-effect w-100 f-w-500"
                                        type="button">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const placeOrderBtn = document.getElementById("place-order-btn");

                    placeOrderBtn.addEventListener("click", function() {
                        const totalItems = parseInt(document.querySelector(".item-number:nth-child(1) .f-w-500")
                            .textContent);
                        const formattedSubtotal = document.querySelector(".item-number:nth-child(2) .f-w-500")
                            .textContent.replace("RS", "").trim();
                        const formattedTotal = document.querySelector(".item-number:nth-child(4) h6").textContent
                            .replace("RS", "").trim();

                        // Sending data to the server using fetch
                        fetch("/submit-order", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute("content") // Ensure CSRF token is present
                                },
                                body: JSON.stringify({
                                    totalItems: totalItems,
                                    formattedSubtotal: formattedSubtotal,
                                    formattedTotal: formattedTotal
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Redirect to summary.blade.php
                                    window.location.href = "/admin/POS/summary";
                                } else {
                                    alert("Failed to place the order. Please try again.");
                                }
                            })
                            .catch(error => console.error("Error:", error));
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
                        });
                    });
                });
            </script>


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const orderCardContainer = document.querySelector(".order-quantity");
                    const totalItemElement = document.querySelector(".total-item");

                    // Function to format price based on conditions
                    function formatPrice(price) {
                        if (typeof price === "number") {
                            return new Intl.NumberFormat('en-US').format(price);
                        } else {
                            throw new Error("Input must be a number");
                        }
                    }

                    // Function to calculate totals
                    function calculateTotals() {
                        let totalItems = 0;
                        let subtotal = 0;
                        const fee = 0; // Example fixed fee

                        document.querySelectorAll(".order-details-wrapper").forEach(orderItem => {
                            const quantity = parseInt(orderItem.querySelector(".input-touchspin").value);
                            const priceText = orderItem.querySelector(".txt-primary").textContent.replace("RS", "")
                                .replace(",", "").trim();
                            const price = parseFloat(priceText); // Ensure proper parsing of price

                            totalItems += quantity;
                            subtotal += quantity * price;
                        });

                        const formattedSubtotal = formatPrice(subtotal);
                        const formattedFee = formatPrice(fee);
                        const formattedTotal = formatPrice(subtotal + fee);

                        // Update totals in the DOM
                        totalItemElement.querySelector(".item-number:nth-child(1) .f-w-500").textContent =
                            `${totalItems} (Items)`;
                        totalItemElement.querySelector(".item-number:nth-child(2) .f-w-500").textContent =
                            `RS${formattedSubtotal}`;
                        totalItemElement.querySelector(".item-number:nth-child(3) .f-w-500").textContent =
                            `RS${formattedFee}`;
                        totalItemElement.querySelector(".item-number:nth-child(4) h6").textContent = `RS${formattedTotal}`;
                    }

                    // Event delegation for the Add button (works for dynamically added products too)
                    document.querySelector('.scroll-product').addEventListener("click", function(event) {
                        const target = event.target;

                        // Check if the clicked target is an "Add" button
                        if (target.classList.contains("add-btn")) {
                            const productWrapper = target.closest(".our-product-wrapper");

                            // Extract product details from data attributes
                            const name = productWrapper.getAttribute("data-name");
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
                    <div class="category-details">
                        <div class="order-details-right">
                            <span class="text-gray mb-1">Category: <span class="font-dark">Product</span></span>
                            <h6 class="f-14 f-w-500 mb-3">${name}</h6>
                            <div class="last-order-detail">
                                <h6 class="txt-primary">RS${formattedPrice}</h6>
                                <a href="javascript:void(0)" class="trash-remove"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        <div class="right-details">
                            <div class="touchspin-wrapper">
                                <button class="decrement-touchspin btn-touchspin"><i class="fa fa-minus text-gray"></i></button>
                                <input class="input-touchspin" type="number" value="1" readonly>
                                <button class="increment-touchspin btn-touchspin"><i class="fa fa-plus text-gray"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                            // Append the order item to the order card
                            orderCardContainer.insertAdjacentHTML("beforeend", orderItem);

                            // Hide "Your cart is empty" message
                            document.querySelector(".empty-card").style.display = "none";

                            // Recalculate totals
                            calculateTotals();
                        }
                    });

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

                            // Show empty cart message if no items are left
                            if (!document.querySelectorAll(".order-details-wrapper").length) {
                                document.querySelector(".empty-card").style.display = "block";
                            }

                            // Recalculate totals
                            calculateTotals();
                        }
                    });
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
