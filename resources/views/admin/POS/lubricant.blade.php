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
    <li class="breadcrumb-item active">POS (point of sale)</li>
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
                                    <h5>All Lubricant  Brands</h5>
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
                                            @if(isset($brands) && count($brands) > 0)
    @foreach ($brands as $brand)
        <div class="swiper-slide">
            <div class="shop-box">
                <a class="" data-brand-id="{{ $brand->id }}" href="#">
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->brand_name }}" style="width:100px;">
                </a>
            </div>
            <span class="m-t-10 category-title f-w-500 text-gray">{{ $brand->brand_name }}</span>
        </div>
    @endforeach
@else
    <p>No brands available.</p>
@endif

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






                                    <!-- Displaying Lubricants -->

                                    @foreach ($lubricants as $lubricant)
                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="our-product-wrapper h-100 widget-hover"
                                                dataId="{{ $lubricant->id }}" data-name="{{ $lubricant->name }}"
                                                stock_quantity="{{ $lubricant->total_count }}"
                                                volume="{{ $lubricant->volume }}"
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
                                <div class="form-group">
                                    <label for="phonenumber" class="form-label">Select Customer</label>
                                    <select class="form-select f-w-400 f-14 text-gray py-2" id="phonenumber" name="phonenumber" required>
                                        <option selected disabled>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" data-phone="{{ $customer->phone_number }}">
                                                {{ $customer->phone_number }} - {{ $customer->first_name }} {{ $customer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                {{-- <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Phone Number" readonly> --}}

                                <!-- Add jQuery and Select2 -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/select2.min.js"></script>
                                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/select2.min.css" rel="stylesheet" />

                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2
                                        $('#phonenumber').select2({
                                            placeholder: 'Search by Phone Number or Name',
                                            allowClear: true
                                        });

                                        // Event listener for dropdown changes
                                        $('#phonenumber').on('change', function () {
                                            // Get the selected option
                                            const selectedOption = $(this).find(':selected');

                                            // Get the customer ID and phone number from the selected option
                                            const customerId = selectedOption.val();
                                            const customerPhone = selectedOption.data('phone');

                                            // Update the input fields
                                            $('#customer_id').val(customerId);
                                            $('#customer_phone').val(customerPhone);
                                        });
                                    });
                                </script>


                        {{-- <script>
                            // Add an event listener to the dropdown
                            document.getElementById("phonenumber").addEventListener("change", function() {
                                // Get the selected phone number
                                const selectedPhoneNumber = this.value;

                                // Update the input field with the selected phone number
                                document.querySelector(".coustomer").value = selectedPhoneNumber;
                            });
                        </script> --}}


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



                                <form id="order-form" method="POST" action="{{ route('POS.lubricant.placeOrder') }}">


                                    @csrf
                                    <div class="widget-hover">
                                        <h5 class="m-0 p-t-40">Payment Section</h5>


                                        <div class="mb-4">
                                            <label for="order_type" class="form-label">Order Type</label>
                                            <select id="order_type" name="order_type" class="form-select" required>
                                                <option value="New Order">New Order</option>
                                                <option value="Old Battery">Old Battery</option>
                                                <option value="Repair">Repair</option>
                                            </select>
                                        </div>

                                        <!-- Measurement Section -->
                                        <div class="mb-4">
                                            <label for="measurement_type" class="form-label">Measurement Type</label>
                                            <select id="measurement_type" name="measurement_type" class="form-select" required>
                                                <option value="bottle">Bottle</option>
                                                <option value="mililiter">mili - Liter</option>
                                                <option value="drum">Drum</option>
                                            </select>
                                        </div>

                                        <!-- Unit Section -->
                                        <div class="mb-4">
                                            <label for="unit" class="form-label">Quantity</label>
                                            <input type="number" id="unit" name="unit" class="form-control" placeholder="Enter Quantity "  required>
                                        </div>


                                     



                                        <div class="mb-4">

                                            <input type="hidden" id="total_items" name="total_items" class="total_items form-control" placeholder="Enter all_id" required>
                                        </div>

                                        <div class="mb-4">

                                            <input type="hidden" id="all_id" name="all_id" class="battery-id form-control" placeholder="Enter all_id" required>
                                        </div>

                                        <!-- Total Price Section -->
                                        <div class="mb-4">
                                            <label for="total_price" class="form-label">Total Price</label>
                                            <input type="number" id="total_price" name="total_price" class="form-control" placeholder="Total Price" readonly>
                                        </div>

                                        <!-- Paid Amount Section -->
                                        <div class="mb-4">
                                            <label for="paid_amount" class="form-label">Paid Amount</label>
                                            <input type="number" id="paid_amount" name="paid_amount" class="form-control" step="0.01" placeholder="Enter Paid Amount" required>
                                        </div>


                                        {{-- <input type="text" name="customer_id" class="form-control coustomer"
                                        placeholder="Phone Number" readonly>  --}}

                                        <input type="hidden" id="customer_id" name="customer_id" class="form-control" placeholder="Customer ID" readonly>

                                        {{-- <input type="hidden" id="customer_id" name="customer_id" class="form-control" placeholder="Customer ID" readonly>

                                        <input type="hidden" id="customer_id" name="customer_id" class="form-control" placeholder="Customer ID" readonly> --}}

                                        <!-- Due Amount Section -->
                                        <div class="mb-4">
                                            <label for="due_amount" class="form-label">Due Amount</label>
                                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01" placeholder="Due Amount" readonly>
                                        </div>






                                        <!-- Payment Type Section -->
                                        <div class="mb-4">
                                            <label for="payment_type" class="form-label">Payment Type</label>
                                            <select id="payment_type" name="payment_type" class="form-select" required>
                                                <option value="Cash">Cash</option>
                                                <option value="Card">Card</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Hidden Inputs for Order Management -->
                                    {{-- <input type="hidden" name="customer_id" id="customer_id">
                                    <input type="hidden" name="total_items" id="total_items">
                                    <input type="hidden" name="subtotal" id="subtotal"> --}}


                                    <!-- Submit Button -->
                                    <div class="place-order">
                                        <p id="place-order-btn" >

                                        </p>
                                        <button  class="btn btn-primary btn-hover-effect w-100 f-w-500" type="submit">
                                            Place Order
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const csrfToken = "{{ csrf_token() }}";
            const placeOrderBtn = document.getElementById("place-order-btn");
            // console.log(placeOrderBtn); // Check if this logs the button element

            document.getElementById("place-order-btn").addEventListener("click", function(e) {
                e.preventDefault(); // Prevent form submission until fields are populated

                // Get the values from the DOM
                const customerId = document.querySelector("#customer-select").value;
                const totalItems = document.querySelector(".item-number:nth-child(1) .f-w-500")?.textContent.trim() ||
                    "0";
                const subtotal = document.querySelector(".item-number:nth-child(2) .f-w-500")?.textContent.trim() ||
                    "0";
                const totalPrice = document.querySelector(".item-number:nth-child(4) h6")?.textContent.trim() || "0";
                const paidAmount = document.querySelector("#paid_amount").value || 0;
                const paymentType = document.querySelector("#payment_type").value;

                // Ensure proper formatting and parsing of values
                const subtotalValue = parseFloat(subtotal.replace("RS", "").replace(",", "").trim()) || 0;
                const totalPriceValue = parseFloat(totalPrice.replace("RS", "").replace(",", "").trim()) || 0;
                const paidAmountValue = parseFloat(paidAmount) || 0;
                const dueAmountValue = totalPriceValue - paidAmountValue;

                // Check if totalPrice is correctly calculated
                if (isNaN(totalPriceValue) || totalPriceValue === 0) {
                    alert("Total price is not calculated correctly. Please check the totals.");
                    return; // Stop form submission if total price is invalid
                }

                // Prepare the items array
                const items = [];
                const itemRows = document.querySelectorAll(
                    ".item-row"); // Replace with actual class or selector for item rows
                itemRows.forEach(row => {
                    const batteryId = row.querySelector(".battery-id").getAttribute("data-id");
                    const quantity = row.querySelector(".item-quantity")?.value || 0;
                    const price = row.querySelector(".item-price")?.textContent.trim().replace("RS", "")
                        .replace(",", "").trim() || "0";

                    if (batteryId && quantity > 0 && price) {
                        items.push({
                            battery_id: batteryId,
                            quantity: parseInt(quantity, 10),
                            price: parseFloat(price)
                        });
                    }
                });

                // Populate hidden fields in the form
                document.getElementById("customer_id").value = customerId;
                document.getElementById("total_items").value = totalItems.replace(" (Items)", "").trim();
                document.getElementById("subtotal").value = subtotalValue;
                document.getElementById("total_price").value = totalPriceValue;
                document.getElementById("paid_amount").value = paidAmountValue;
                document.getElementById("due_amount").value = dueAmountValue;
                document.getElementById("payment_type").value = paymentType;

                document.getElementById("stockQuantity").value = stock_quantity;
                document.getElementById("volumeField").value = volume;



                // Add the items details to the form as a hidden input
                const itemsInput = document.createElement("input");
                itemsInput.type = "hidden";
                itemsInput.name = "items";
                itemsInput.value = JSON.stringify(items); // Convert items array to JSON string
                document.getElementById("order-form").appendChild(itemsInput);

                // Submit the form after populating the hidden fields
                document.getElementById("order-form").submit();
            });




            document.addEventListener("DOMContentLoaded", function() {
                const placeOrderBtn = document.getElementById("place-order-btn");

                const totalPriceField = document.getElementById("total_price");
                const paidAmountField = document.getElementById("paid_amount");
                const dueAmountField = document.getElementById("due_amount");

                const orderCardContainer = document.querySelector(".order-quantity");
                const totalItemElement = document.querySelector(".total-item");

                calculateTotals();
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

                    totalPriceField.value = subtotal + fee;
                    calculateDueAmount();


                    // Collect all product IDs
                const orderIds = Array.from(document.querySelectorAll('.battery-id')).map(item => item.getAttribute('data-id'));

                // Display IDs in the input field separated by commas
                document.getElementById("all_id").value = orderIds.join(", ");

                document.getElementById("total_items").value = totalItems;



                }




                // Function to calculate due amount
                function calculateDueAmount() {
                    const totalPrice = parseFloat(totalPriceField.value || 0);
                    const paidAmount = parseFloat(paidAmountField.value || 0);
                    const dueAmount = totalPrice - paidAmount;

                    dueAmountField.value = dueAmount > 0 ? dueAmount.toFixed(2) : "0.00";
                }

                // Event listener for Paid Amount input field
                paidAmountField.addEventListener("input", calculateTotals);
                paidAmountField.addEventListener("input", calculateDueAmount);

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
                        const stock_quantity = productWrapper.getAttribute("stock_quantity");
                        const volume = productWrapper.getAttribute("volume");



                        // Create an order card item
                        const orderItem = `
                <div class="order-details-wrapper">
                    <div class="left-details">
                        <div class="order-img widget-hover">
                            <img src="${image}" alt="${name}"  data-bs-toggle="popover" title=" ${id} - ${volume} ml and stock_quantity is ${stock_quantity} " data-bs-content="And here's some amazing content. It's very engaging. Right?">
                        </div>
                    </div>
                    <div class="category-details item-row">
                        <div class="order-details-right">
                            <span class="text-gray mb-1">Category: <span class="font-dark">Product</span></span>
                            <h6 class="f-14 f-w-500 mb-3 battery-id" data-id="${id}">${name}</h6>
                            <h6 class="f-14 f-w-500 mb-3 " data-id="${id}"> volume : ${volume} ml</h6>
                            <h6 class="f-14 f-w-500 mb-3 " data-id="${id}">Available : ${stock_quantity}</h6>


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

                        // Hide "Your cart is empty" message
                        document.querySelector(".empty-card").style.display = "none";

                        // Recalculate totals
                        calculateTotals();
                    }
                    calculateTotals();
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

                    calculateTotals();
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