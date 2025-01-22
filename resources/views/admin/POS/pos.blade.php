

@extends('layouts.simple.master')

@section('title', 'Default')

@section('css')

@endsection


<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
<!-- Plugins css start-->

</head>

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-1.css') }}">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}"> --}}
@endsection

@section('breadcrumb-title')
    <h3>Default</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Default</li>
@endsection

@section('content')





          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>POS</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">POS</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>



          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xxl-9 col-xl-8">
                <div class="row">
                  <div class="col-xl-12">
                    <div class="card">
                      <div class="card-header card-no-border">
                        <div class="header-top">
                          <h5>Shop by Categories</h5>
                          <div class="card-header-right-btn"><a class="font-dark f-12" href="javascript:void(0)">View All </a></div>
                        </div>
                      </div>
                      <div class="card-body pt-0">

                        <div class="slider-wrapper arrow-round">
                            <div class="swiper shop-category-slider">
                              <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/battery.png" alt="Battery"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Battery</span>
                                </div>
                                <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/lubricant.png" alt="Lubricant"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Lubricant</span>
                                </div>
                                <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/charger.png" alt="Charger"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Charger</span>
                                </div>
                                {{-- <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/inverter.png" alt="Inverter"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Inverter</span>
                                </div> --}}
                                {{-- <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/solar-panel.png" alt="Solar Panel"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Solar Panel</span>
                                </div> --}}
                                <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/old-battery.png" alt="Old Battery"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Old Battery</span>
                                </div>
                                <div class="swiper-slide">
                                  <a class="shop-box" href="#"><img src="../assets/images/dashboard-8/shop-categories/accessories.png" alt="Accessories"></a>
                                  <span class="m-t-10 category-title f-w-500 text-gray">Accessories</span>
                                </div>
                              </div>
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
                            <h5>Our Product</h5>
                            <p class="f-m-light mt-1 text-gray f-w-500">Browse & Discover Thousands of products here!</p>
                          </div>
                          <div class="product-body">
                            <div class="input-group product-search"><span class="input-group-text"><i class="search-icon text-gray" data-feather="search"></i></span>
                              <input class="form-control" type="text" placeholder="Search here.." list="datalistOptionssearch" id="exampleDataList1">
                              <datalist id="datalistOptionssearch">
                                <option value="Bluetooth Calling Smartwatch"></option>
                                <option value="Microsoft Surface Laptop"></option>
                                <option value="Gaming Over Ear Headphone"></option>
                                <option value="Apple iPhone 14 Plus"></option>
                              </datalist>
                            </div>
                            <div class="dropdown product-search-bar">
                              <button class="btn dropdown-toggle border text-gray" id="popularButton-8" type="button" data-bs-toggle="dropdown" aria-expanded="false">Select Category</button>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-block" aria-labelledby="popularButton-8">
                                <li><a class="dropdown-item" href="#">Mac-book</a></li>
                                <li><a class="dropdown-item" href="#">Headphones</a></li>
                                <li><a class="dropdown-item" href="#">HD TV</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body main-our-product">
                        <div class="row g-3 scroll-product">
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/watch-2.png" alt="watch"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Bluetooth Calling Smartwatch</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$109.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/laptop.png" alt="laptop"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Microsoft Surface Laptop</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$187.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/headphone.png" alt="headphone"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Gaming Over Ear Headphone</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$76.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/phone.png" alt="phone"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Apple iPhone 14 Plus</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$132.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/dvd.png" alt="DVD player"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Apple Smart HD TV</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$789.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/mac-laptop.png" alt="pink laptop"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Apple iPhone 14 Plus</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$809.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/speaker.png" alt="speaker"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Speakers wireless</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$541.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/mouse.png" alt="mouse"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">M185 Compact Wireless Mouse</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$200.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/wireless-headphone.png" alt="wireless-headphone"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">Wireless headphone</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$333.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/keyboard.png" alt="keyboard"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">RGB Gaming Keyboard</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$198.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/ipad.png" alt="ipad"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">MacBook Air 13.3-inch</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$409.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-3 col-sm-4">
                            <div class="our-product-wrapper h-100 widget-hover">
                              <div class="our-product-img"><img src="../assets/images/dashboard-8/product-categories/drone.png" alt="drone"></div>
                              <div class="our-product-content">
                                <h6 class="f-14 f-w-500 pt-2 pb-1">SYMA X5SW remote control..</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h6 class="txt-primary">$341.00</h6>
                                  <div class="add-quantity btn border text-gray f-12 f-w-500"><i class="fa fa-minus remove-minus count-decrease"></i><span class="add-btn">Add</span>
                                    <input class="countdown-remove" type="number" value="0"><i class="fa fa-plus count-increase"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-4 customer-sidebar-left">
                <div class="md-sidebar h-100"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">Order Details</a>
                  <div class="md-sidebar-aside custom-scrollbar responsive-order-details">
                    <div class="card customer-sticky">
                      <div class="card-header card-no-border pb-3">
                        <div class="header-top border-bottom pb-3">
                          <h5 class="m-0">Customer </h5>
                          <div class="card-header-right-icon create-right-btn"><a class="btn btn-light-primary f-w-500 f-12" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#dashboard8">Create +</a></div>
                          <!-- Modal-->
                          <div class="modal fade" id="dashboard8" tabindex="-1" aria-labelledby="dashboard8" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modaldashboard">Create Customer</h5>
                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                  <div class="text-start dark-sign-up">
                                    <div class="modal-body">
                                      <form class="row g-3 needs-validation" novalidate="">
                                        <div class="col-md-6">
                                          <label class="form-label" for="validationCustom-8">First Name<span class="txt-danger">*</span></label>
                                          <input class="form-control" id="validationCustom-8" type="text" placeholder="Enter your first-name" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label" for="validationCustom09">Last Name<span class="txt-danger">*</span></label>
                                          <input class="form-control" id="validationCustom09" type="text" placeholder="Enter your last-name" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label" for="validationCustom08">Mobile Number<span class="txt-danger">*</span></label>
                                          <input class="form-control" id="validationCustom08" type="number" placeholder="Mobile number" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="mb-3">
                                            <label class="form-label" for="exampleFormControlInput8">Email<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="exampleFormControlInput8" type="email" placeholder="customername@gmail.com">
                                          </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-end">
                                          <button class="btn btn-primary" type="submit">Create +</button>
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
                        <select class="form-select f-w-400 f-14 text-gray py-2" aria-label="Select Customer">
                          <option selected="" disabled="">Select Customer</option>
                          <option value="1">Brooklyn Simmons</option>
                          <option value="2">Savannah Nguyen</option>
                          <option value="3">Esther </option>
                        </select>
                        <h5 class="m-0">Order Details</h5>
                        <div class="order-quantity p-b-20 border-bottom">
                          <div class="order-details-wrapper">
                            <div class="left-details">
                              <div class="order-img widget-hover"><img src="../assets/images/dashboard-8/product-categories/phone.png" alt="phone"></div>
                            </div>
                            <div class="category-details">
                              <div class="order-details-right"><span class="text-gray mb-1">Category : <span class="font-dark">Phone</span></span>
                                <h6 class="f-14 f-w-500 mb-3">Apple iPhone 14 Plus</h6>
                                <div class="last-order-detail">
                                  <h6 class="txt-primary">$987.00</h6><a href="javascript:void(0)"> <i class="fa fa-trash trash-remove"></i></a>
                                </div>
                              </div>
                              <div class="right-details">
                                <div class="touchspin-wrapper">
                                  <button class="decrement-touchspin btn-touchspin"><i class="fa fa-minus text-gray"></i></button>
                                  <input class="input-touchspin" id="inputData" type="number" value="9">
                                  <button class="increment-touchspin btn-touchspin"><i class="fa fa-plus text-gray"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="order-details-wrapper">
                            <div class="left-details">
                              <div class="order-img widget-hover"><img src="../assets/images/dashboard-8/product-categories/watch-2.png" alt="watch"></div>
                            </div>
                            <div class="category-details">
                              <div class="order-details-right"><span class="text-gray mb-1">Category : <span class="font-dark">Watch</span></span>
                                <h6 class="f-14 f-w-500 mb-3">Bluetooth Calling Smartwatch</h6>
                                <div class="last-order-detail">
                                  <h6 class="txt-primary">$109.00</h6><a href="javascript:void(0)"><i class="fa fa-trash trash-remove"></i></a>
                                </div>
                              </div>
                              <div class="right-details">
                                <div class="touchspin-wrapper">
                                  <button class="decrement-touchspin btn-touchspin"><i class="fa fa-minus text-gray"></i></button>
                                  <input class="input-touchspin" id="inputData1" type="number" value="9">
                                  <button class="increment-touchspin btn-touchspin"><i class="fa fa-plus text-gray"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body p-0 empty-card trash-items">
                            <div class="empty-cart-wrapper">
                              <div class="empty-cart-content"><img src="../assets/images/dashboard-8/order-trash.gif" alt="order-trash"></div>
                              <h6 class="text-gray">Your cart is empty!!!</h6><a href="product.html"> </a>
                            </div>
                          </div>
                        </div>
                        <div class="total-item">
                          <div class="item-number"><span class="text-gray">Item</span><span class="f-w-500">3 (Items)</span></div>
                          <div class="item-number"><span class="text-gray">Subtotal</span><span class="f-w-500">$1,186</span></div>
                          <div class="item-number border-bottom"><span class="text-gray">Fees</span><span class="f-w-500">$20</span></div>
                          <div class="item-number pt-3 pb-0"><span class="f-w-500">Total</span>
                            <h6 class="txt-primary">$1,186</h6>
                          </div>
                        </div>
                        <h5 class="m-0 p-t-40">Payment Method</h5>
                        <div class="payment-methods">
                          <div>
                            <div class="bg-payment widget-hover"> <img src="../assets/images/dashboard-8/payment-option/cash.svg" alt="cash"></div><span class="f-w-500 text-gray">Cash</span>
                          </div>
                          <div>
                            <div class="bg-payment widget-hover"> <img src="../assets/images/dashboard-8/payment-option/card.svg" alt="card"></div><span class="f-w-500 text-gray">Card</span>
                          </div>
                          <div>
                            <div class="bg-payment widget-hover"> <img src="../assets/images/dashboard-8/payment-option/wallet.svg" alt="wallet"></div><span class="f-w-500 text-gray">E-Wallet</span>
                          </div>
                        </div>
                        <div class="place-order">
                          <button class="btn btn-primary btn-hover-effect w-100 f-w-500" type="button">Place Order</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>


        <script type="text/javascript">
            var session_layout = '{{ session()->get('layout') }}';
        </script>
    @endsection

    @section('script')
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
    @endsection



