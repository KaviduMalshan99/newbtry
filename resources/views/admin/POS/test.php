

<div class="order-quantity p-b-20 border-bottom">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const orderCardContainer = document.querySelector(".order-quantity");
            const totalItemElement = document.querySelector(".total-item");

            // Function to format price based on conditions
            function formatPrice(price) {
    // Ensure price is a number and format with commas at every thousand
    if (typeof price === "number") {
        return new Intl.NumberFormat('en-US').format(price);
    } else {
        throw new Error("Input must be a number");
    }
}

            // Function to calculate totals
            function calculateTotals() {
                let totalItems = 10;
                let subtotal = 70;
                const fee = 0; // Example fixed fee

                document.querySelectorAll(".order-details-wrapper").forEach(orderItem => {
                    const quantity = parseInt(orderItem.querySelector(".input-touchspin").value);
                    const priceText = orderItem.querySelector(".txt-primary").textContent.replace("Rs", "").replace(",", "").trim();
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
                    `Rs ${formattedSubtotal}`;
                totalItemElement.querySelector(".item-number:nth-child(3) .f-w-500").textContent =
                    `Rs ${formattedFee}`;
                totalItemElement.querySelector(".item-number:nth-child(4) h6").textContent = `RS${formattedTotal}`;
            }

            // Listen for click events on all "Add" buttons
            document.querySelectorAll(".add-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const productWrapper = this.closest(".our-product-wrapper");

                    // Extract product details from data attributes
                    const name = productWrapper.getAttribute("data-name");
                    const price = parseFloat(productWrapper.getAttribute("data-price"));
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
                                        <h6 class="txt-primary">Rs ${formattedPrice}</h6>
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
                });
            });

            // Event delegation for increment, decrement, and remove buttons
            orderCardContainer.addEventListener("click", function (event) {
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




// send data



</script>


</div>






                                <div class="total-item">
                                    <div class="item-number" name="items"><span class="text-gray">Item</span><span class="f-w-500">0
                                            (Items)</span></div>
                                    <div class="item-number" name="subtotal"><span class="text-gray">Subtotal</span><span
                                            class="f-w-500">0</span></div>
                                    <div class="item-number border-bottom"><span class="text-gray">Fees</span><span
                                            class="f-w-500">0</span></div>
                                    <div class="item-number pt-3 pb-0" name="total"><span class="f-w-500">Total</span>
                                        <h6 class="txt-primary">0</h6>
                                    </div>
                                </div>

                                <input type="hidden" name="items" id="items">
                                <input type="hidden" name="subtotal" id="subtotal">
                                <input type="hidden" name="total" id="total">





                                <h5 class="m-0 p-t-40">Payment Method</h5>
                                <div class="payment-methods d-flex justify-content-between align-items-center">
                                    <label for="payment-method" class="me-2">Select Payment Method:</label>
                                    <select  name="payment_method" class="form-select" style="width: auto;">
                                        <option value="" disabled selected>Choose an option</option>
                                        <option value="Card">Credit Card</option>
                                        <option value="Full_Payment">Full Payment</option>
                                        <option value="Half_Payment">Half Payment</option>
                                    </select>
                                </div>


                                <div class="place-order">
                                    <button type="button" id="place-order-button" class="btn btn-primary btn-hover-effect w-100 f-w-500">
                                        Place Order
                                    </button>
                                </div>

