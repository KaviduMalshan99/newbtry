<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{ route('index') }}"><img class="img-fluid for-light" src=""
                    alt=""><img class="img-fluid for-dark" src="" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            
            
            
            @if(Auth::check())
            @php
                $userType = Auth::user()->user_type;
            @endphp
        
            @if($userType === 'User')
                {{-- Do not show anything --}}
                <p  >Please wait for SuperAdmin to grant permission.</p>

            @elseif(in_array($userType, ['Admin', 'Cashier', 'SuperAdmin']))
            {{-- Show everything --}}
            <p id="welcome-message"  class="ps-5">Welcome, {{ $userType }}. You have access to all features.</p>
            {{-- Add your content here --}}
          
            <script>
                // Hide the welcome message after 10 seconds
                setTimeout(() => {
                    const message = document.getElementById('welcome-message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 10000); // 10000 milliseconds = 10 seconds
            </script>
        

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ route('index') }}"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <label class="badge badge-light-primary">5</label><a class="sidebar-link sidebar-title"
                            href="{{ route('index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span class="lan-3">Dashboard</span></a>

                    </li>
                    {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-widget') }}"></use>
                            </svg><span class="lan-6">Widgets</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('general-widget') }}">General</a></li>
                            <li><a href="{{ route('chart-widget') }}">Chart</a></li>
                        </ul>
                    </li> --}}

                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-8">Applications</h6>
                        </div>
                    </li>

                    {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Ecommerce</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('product') }}">Product</a></li>
                            <li><a href="{{ route('product-page') }}">Product page</a></li>
                            <li><a href="{{ route('list-products') }}">Product list</a></li>

                        </ul>
                    </li> --}}

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M6 20c0-2.21 1.79-4 4-4h4c2.21 0 4 1.79 4 4"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg><span>Customers</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('customers.create') }}">Add Customer</a></li>
                            <li><a
                                    href="{{ request()->query('ref') === 'view' ? route('customers.show', $customer->id) : route('customers.index') }}">View
                                    Customer</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M6 20c0-2.21 1.79-4 4-4h4c2.21 0 4 1.79 4 4"></path>
                                <rect x="3" y="13" width="18" height="7" rx="2" ry="2"></rect>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg><span>Supplier</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('suppliers.create') }}">Add Supplier</a></li>
                            <li><a
                                    href="{{ request()->query('ref') === 'view' ? route('suppliers.show', $customer->id) : route('suppliers.index') }}">View
                                    Supplier</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M6 2L3 6v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6l-3-4z"></path>
                                <path d="M3 6h18"></path>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Purchase</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('purchases.create_battery') }}">Add New Battery Purchase</a></li>
                            <li><a
                                    href="{{ request()->query('ref') === 'view' ? route('purchases.show', $purchase->id) : route('purchases.index') }}">View
                                    Battery Purchase</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 7l-4 4"></path>
                                <path
                                    d="M14.5 2.5a2.121 2.121 0 0 1 3 0l4 4a2.121 2.121 0 0 1 0 3L16 17a2 2 0 0 1-2.83 0L8 11.83a2 2 0 0 1 0-2.83l6.5-6.5z">
                                </path>
                                <path d="M4 20l1.5-1.5"></path>
                                <path d="M2 22l1.5-1.5"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Repair</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('repairs.create') }}">Add New Repair Battery</a></li>
                            <li><a
                                    href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}">View
                                    Repair Battery</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="16" height="10" rx="2" ry="2">
                                </rect>
                                <line x1="22" y1="11" x2="22" y2="13"></line>
                                <path d="M6 10v4"></path>
                                <path d="M10 10v4"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Old Battery</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('oldBatteries.create') }}">Add New Old Battery</a></li>
                            <li><a
                                    href="{{ request()->query('ref') === 'view' ? route('oldBatteries.show', $oldBattery->id) : route('oldBatteries.index') }}">View
                                    Old Battery</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 10l9-7 9 7"></path>
                                <path d="M9 21V11h6v10"></path>
                                <circle cx="16" cy="17" r="2"></circle>
                                <path d="M18 15l2-2"></path>
                                <path d="M20 17l-2-2"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Rental</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('rentals.create') }}">Add New Rental</a></li>
                            <li><a
                                    href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}">View
                                    Rental</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 21h8a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2z">
                                </path>
                                <path d="M8 10V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"></path>
                                <line x1="12" y1="14" x2="12" y2="18"></line>
                                <line x1="10" y1="16" x2="14" y2="16"></line>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Reports</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('reports.customerIndex') }}">Customer Report</a></li>
                            <li><a href="{{ route('reports.supplierIndex') }}">Supplier Report</a></li>
                            <li><a href="{{ route('reports.batteryPurchaseIndex') }}">Battery Purchase Report</a></li>
                            <li><a href="{{ route('reports.repairIndex') }}">Repair Report</a></li>
                            <li><a href="{{ route('reports.repairCompleteIndex') }}">Complete Repair Report</a></li>
                            <li><a href="{{ route('reports.RentalIndex') }}">Rental Report</a></li>
                            <li><a href="{{ route('reports.completeRentalIndex') }}">Complete Rental Report</a></li>
                            <li><a href="{{ route('reports.batteryIndex') }}">Battery Report</a></li>
                            <li><a href="{{ route('reports.LubricantIndex') }}">Lubricant Report</a></li>
                            <li><a href="{{ route('reports.batteryOrderIndex') }}">Battery POS Report</a></li>
                            <li><a href="{{ route('reports.lubricantOrderIndex') }}">Lubricant POS Report</a></li>
                            <li><a href="{{ route('reports.replacementOrderIndex') }}">Replacement Report</a></li>



                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="10" width="18" height="11" rx="2" ry="2">
                                </rect>
                                <path d="M7 10V6h10v4"></path>
                                <line x1="7" y1="6" x2="17" y2="6"></line>
                                <line x1="9" y1="14" x2="9" y2="16"></line>
                                <line x1="15" y1="14" x2="15" y2="16"></line>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>POS</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('POS.index') }}">Battery POS</a></li>
                            <li><a href="{{ route('POS.lubricant') }}">Lubricant POS</a></li>
                            {{-- <li><a
                                href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}">View
                                Rental</a></li> --}}

                        </ul>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="{{ route('company.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="18"></rect>
                                <rect x="14" y="6" width="7" height="15"></rect>
                                <line x1="6.5" y1="9" x2="6.5" y2="9"></line>
                                <line x1="6.5" y1="13" x2="6.5" y2="13"></line>
                                <line x1="17.5" y1="9" x2="17.5" y2="9"></line>
                                <line x1="17.5" y1="13" x2="17.5" y2="13"></line>
                                <line x1="6.5" y1="17" x2="6.5" y2="17"></line>
                                <line x1="17.5" y1="17" x2="17.5" y2="17"></line>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Company</span></a>

                    </li>


                    {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg><span>Users</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('user-profile') }}">Users Profile</a></li>
                            <li><a href="{{ route('edit-profile') }}">Users Edit</a></li>
                            <li><a href="{{ route('user-cards') }}">Users Cards</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('bookmark') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bookmark') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bookmark') }}"> </use>
                            </svg><span>Bookmarks</span></a></li> --}}
                    {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('contacts') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-contact') }}"> </use>
                            </svg><span>Contacts</span></a>
                    </li> --}}

                    {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('calendar-basic') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-calendar') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-calender') }}"></use>
                            </svg><span>Calendar</span></a></li> --}}



<<<<<<< HEAD
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Battery & Lubricant</h6>
                                </div>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="7" width="16" height="10" rx="2" ry="2"></rect>
                                        <line x1="20" y1="12" x2="20" y2="12"></line>
                                        <path d="M4 8h16"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"> </use>
                                    </svg><span>Battery</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a class="submenu-title" href="{{ route('batteries.create') }}">Add Battery<span
                                                class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                                    </li>
                                    <li><a class="submenu-title" href="{{ route('batteries.index') }}">View Battery<span
                                                class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                                    </li>
                                    <li><a class="submenu-title" href="#">Brand<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>
                                        <ul class="nav-sub-childmenu submenu-content">
                                            <li><a href="{{ route('brand.index') }}">View Brand</a></li>
                                            <li><a href="{{ route('brand.create') }}">Add Brand </a></li>


                                        </ul>
                                    </li>
                                </ul>
                            </li>


                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="6" y="4" width="12" height="16" rx="2" ry="2"></rect>
                                        <path d="M12 1v3"></path>
                                        <circle cx="12" cy="18" r="3"></circle>
                                        <path d="M9 18h6"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                                    </svg><span>Lubricant</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a class="submenu-title" href="{{ route('lubricants.create') }}">Add Lubricant<span
                                                class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                                    </li>
                                    <li><a class="submenu-title" href="{{ route('lubricants.index') }}"> View Lubricant<span
                                                class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                                    </li>

                                    <li><a class="submenu-title" href="{{ route('lubricant_purchases.index') }}"> View purchases<span
                                        class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                                   </li>

                                </ul>
                            </li>




                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M8 12l4-4l4 4"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                                    </svg><span>Brand</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('brand.index') }}">View Brand</a></li>
                                    <li><a href="{{ route('brand.create') }}">Add Brand </a></li>

                                </ul>
                            </li>
=======
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Battery & Lubricant</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="7" width="16" height="10" rx="2" ry="2">
                                </rect>
                                <line x1="20" y1="12" x2="20" y2="12"></line>
                                <path d="M4 8h16"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"> </use>
                            </svg><span>Battery</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="submenu-title" href="{{ route('batteries.create') }}">Add Battery<span
                                        class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                            </li>
                            <li><a class="submenu-title" href="{{ route('batteries.index') }}">View Battery<span
                                        class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                            </li>
                            <li><a class="submenu-title" href="#">Brand<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('brand.index') }}">View Brand</a></li>
                                    <li><a href="{{ route('brand.create') }}">Add Brand </a></li>


                                </ul>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="6" y="4" width="12" height="16" rx="2" ry="2">
                                </rect>
                                <path d="M12 1v3"></path>
                                <circle cx="12" cy="18" r="3"></circle>
                                <path d="M9 18h6"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                            </svg><span>Lubricant</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="submenu-title" href="{{ route('lubricants.create') }}">Add Lubricant<span
                                        class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                            </li>
                            <li><a class="submenu-title" href="{{ route('lubricants.index') }}"> View Lubricant<span
                                        class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                            </li>

                            <li><a class="submenu-title" href="{{ route('lubricant_purchases.index') }}"> View
                                    purchases<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>

                            </li>

                        </ul>
                    </li>




                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 12l4-4l4 4"></path>
                            </svg>

                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                            </svg><span>Brand</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('brand.index') }}">View Brand</a></li>
                            <li><a href="{{ route('brand.create') }}">Add Brand </a></li>

                        </ul>
                    </li>
>>>>>>> 31f1b7f7097faa3be54840befc052da54845d04d




                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Forms & Table</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-form') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"> </use>
                            </svg><span>Forms</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="submenu-title" href="#">Form Controls<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('form-validation') }}">Form Validation</a></li>
                                    <li><a href="{{ route('base-input') }}">Base Inputs</a></li>
                                    <li><a href="{{ route('radio-checkbox-control') }}">Checkbox & Radio</a></li>
                                    <li><a href="{{ route('input-group') }}">Input Groups</a></li>
                                    <li><a href="{{ route('megaoptions') }}">Mega Options</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="#">Form Widgets<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('datepicker') }}">Datepicker</a></li>
                                    <li><a href="{{ route('time-picker') }}">Timepicker</a></li>
                                    <li><a href="{{ route('datetimepicker') }}">Datetimepicker</a></li>
                                    <li><a href="{{ route('daterangepicker') }}">Daterangepicker</a></li>
                                    <li><a href="{{ route('touchspin') }}">Touchspin</a></li>
                                    <li><a href="{{ route('select2') }}">Select2</a></li>
                                    <li><a href="{{ route('switch') }}">Switch</a></li>
                                    <li><a href="{{ route('typeahead') }}">Typeahead</a></li>
                                    <li><a href="{{ route('clipboard') }}">Clipboard</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="#">Form layout<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('default-form') }}">Default Forms</a></li>
                                    <li><a href="{{ route('form-wizard') }}">Form Wizard 1</a></li>
                                    <li><a href="{{ route('form-wizard-two') }}">Form Wizard 2</a></li>
                                    <li><a href="{{ route('form-wizard-three') }}">Form Wizard 3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-table') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                            </svg><span>Tables</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="submenu-title" href="#">Bootstrap Tables<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('bootstrap-basic-table') }}">Basic Tables</a></li>
                                    <li><a href="{{ route('table-components') }}">Table components</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="#">Data Tables<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('datatable-basic-init') }}">Basic Init</a></li>
                                    <li><a href="{{ route('datatable-api') }}">API</a></li>
                                    <li><a href="{{ route('datatable-data-source') }}">Data Sources</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('datatable-ext-autofill') }}">Ex. Data Tables</a></li>
                            <li><a href="{{ route('jsgrid-table') }}">Js Grid Table </a></li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Components</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ui-kits') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ui-kits') }}"></use>
                            </svg><span>Ui Kits</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('typography') }}">Typography</a></li>
                            <li><a href="{{ route('avatars') }}">Avatars</a></li>
                            <li><a href="{{ route('helper-classes') }}">helper classes</a></li>
                            <li><a href="{{ route('grid') }}">Grid</a></li>
                            <li><a href="{{ route('tag-pills') }}">Tag & pills</a></li>
                            <li><a href="{{ route('progress-bar') }}">Progress</a></li>
                            <li><a href="{{ route('modal') }}">Modal</a></li>
                            <li><a href="{{ route('alert') }}">Alert</a></li>
                            <li><a href="{{ route('popover') }}">Popover</a></li>
                            <li><a href="{{ route('tooltip') }}">Tooltip</a></li>
                            <li><a href="{{ route('loader') }}">Spinners</a></li>
                            <li><a href="{{ route('dropdown') }}">Dropdown</a></li>
                            <li><a href="{{ route('accordion') }}">Accordion</a></li>
                            <li><a class="submenu-title" href="#">Tabs<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('tab-bootstrap') }}">Bootstrap Tabs</a></li>
                                    <li><a href="{{ route('tab-material') }}">Line Tabs</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('box-shadow') }}">Shadow</a></li>
                            <li><a href="{{ route('list') }}">Lists</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bonus-kit') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bonus-kit') }}"></use>
                            </svg><span>Bonus Ui</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('scrollable') }}">Scrollable</a></li>
                            <li><a href="{{ route('tree') }}">Tree view</a></li>
                            <li><a href="{{ route('bootstrap-notify') }}">Bootstrap Notify</a></li>
                            <li><a href="{{ route('rating') }}">Rating</a></li>
                            <li><a href="{{ route('dropzone') }}">dropzone</a></li>
                            <li><a href="{{ route('tour') }}">Tour</a></li>
                            <li><a href="{{ route('sweet-alert2') }}">SweetAlert2</a></li>
                            <li><a href="{{ route('modal-animated') }}">Animated Modal</a></li>
                            <li><a href="{{ route('owl-carousel') }}">Owl Carousel</a></li>
                            <li><a href="{{ route('ribbons') }}">Ribbons</a></li>
                            <li><a href="{{ route('pagination') }}">Pagination</a></li>
                            <li><a href="{{ route('breadcrumb') }}">Breadcrumb</a></li>
                            <li><a href="{{ route('range-slider') }}">Range Slider</a></li>
                            <li><a href="{{ route('image-cropper') }}">Image cropper</a></li>
                            <li><a href="{{ route('sticky') }}">Sticky</a></li>
                            <li><a href="{{ route('basic-card') }}">Basic Card</a></li>
                            <li><a href="{{ route('creative-card') }}">Creative Card</a></li>
                            <li><a href="{{ route('tabbed-card') }}">Tabbed Card</a></li>
                            <li><a href="{{ route('dragable-card') }}">Draggable Card</a></li>
                            <li><a class="submenu-title" href="#">Timeline<span class="sub-arrow"><i
                                            class="fa fa-angle-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="{{ route('timeline-v-1') }}">Timeline 1</a></li>
                                    <li><a href="{{ route('timeline-v-2') }}">Timeline 2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-builders') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-builders') }}"></use>
                            </svg><span>Builders</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('form-builder-1') }}"> Form Builder 1</a></li>
                            <li><a href="{{ route('form-builder-2') }}"> Form Builder 2</a></li>
                            <li><a href="{{ route('pagebuild') }}">Page Builder</a></li>
                            <li><a href="{{ route('button-builder') }}">Button Builder</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-animation') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-animation') }}"></use>
                            </svg><span>Animation</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('animate') }}">Animate</a></li>
                            <li><a href="{{ route('scroll-reval') }}">Scroll Reveal</a></li>
                            <li><a href="{{ route('aos') }}">AOS animation</a></li>
                            <li><a href="{{ route('tilt') }}">Tilt Animation</a></li>
                            <li><a href="{{ route('wow') }}">Wow Animation</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-icons') }}"></use>
                            </svg><span>Icons</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('flag-icon') }}">Flag icon</a></li>
                            <li><a href="{{ route('font-awesome') }}">Fontawesome Icon</a></li>
                            <li><a href="{{ route('ico-icon') }}">Ico Icon</a></li>
                            <li><a href="{{ route('themify-icon') }}">Themify Icon</a></li>
                            <li><a href="{{ route('feather-icon') }}">Feather icon</a></li>
                            <li><a href="{{ route('whether-icon') }}">Whether Icon</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-button') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-botton') }}"></use>
                            </svg><span>Buttons</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('buttons') }}">Default Style</a></li>
                            <li><a href="{{ route('flat-buttons') }}">Flat Style</a></li>
                            <li><a href="{{ route('buttons-edge') }}">Edge Style</a></li>
                            <li><a href="{{ route('raised-button') }}">Raised Style</a></li>
                            <li><a href="{{ route('button-group') }}">Button Group</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-charts') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-charts') }}"></use>
                            </svg><span>Charts</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('echarts') }}">Echarts</a></li>
                            <li><a href="{{ route('chart-apex') }}">Apex Chart</a></li>
                            <li><a href="{{ route('chart-google') }}">Google Chart</a></li>
                            <li><a href="{{ route('chart-sparkline') }}">Sparkline chart</a></li>
                            <li><a href="{{ route('chart-flot') }}">Flot Chart</a></li>
                            <li><a href="{{ route('chart-knob') }}">Knob Chart</a></li>
                            <li><a href="{{ route('chart-morris') }}">Morris Chart</a></li>
                            <li><a href="{{ route('chartjs') }}">Chatjs Chart</a></li>
                            <li><a href="{{ route('chartist') }}">Chartist Chart</a></li>
                            <li><a href="{{ route('chart-peity') }}">Peity Chart</a></li>
                        </ul>
                    </li>
                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Pages</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('landing-page') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-landing-page') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-landing-page') }}"></use>
                            </svg><span>Landing page</span></a></li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('sample-page') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-sample-page') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-sample-page') }}"></use>
                            </svg><span>Sample page</span></a></li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('internationalization') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-internationalization') }}">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-internationalization') }}">
                                </use>
                            </svg><span>Internationalization</span></a></li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="#" target="_blank">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-starter-kit') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-starter-kit') }}"></use>
                            </svg><span>Starter kit</span></a></li>
                    <li class="mega-menu sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-others') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-others') }}"></use>
                            </svg><span>Others</span></a>
                        <div class="mega-menu-container menu-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Error Page</h5>
                                            </div>
                                            <ul class="submenu-content opensubmegamenu">
                                                <li><a href="{{ route('error-400') }}">Error 400</a></li>
                                                <li><a href="{{ route('error-401') }}">Error 401</a></li>
                                                <li><a href="{{ route('error-403') }}">Error 403</a></li>
                                                <li><a href="{{ route('error-404') }}">Error 404</a></li>
                                                <li><a href="{{ route('error-500') }}">Error 500</a></li>
                                                <li><a href="{{ route('error-503') }}">Error 503</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5> Authentication</h5>
                                            </div>
                                            <ul class="submenu-content opensubmegamenu">
                                                <li><a href="{{ route('login') }}" target="_blank">Login
                                                        Simple</a></li>
                                                <li><a href="{{ route('login-one') }}" target="_blank">Login
                                                        with bg image</a>
                                                </li>
                                                <li><a href="{{ route('login-two') }}" target="_blank">Login
                                                        with image two </a>
                                                </li>
                                                <li><a href="{{ route('login-bs-validation') }}"
                                                        target="_blank">Login With
                                                        validation</a></li>
                                                <li><a href="{{ route('login-bs-tt-validation') }}"
                                                        target="_blank">Login with
                                                        tooltip</a></li>
                                                <li><a href="{{ route('login-sa-validation') }}"
                                                        target="_blank">Login with
                                                        sweetalert</a></li>
                                                <li><a href="{{ route('sign-up') }}" target="_blank">Register
                                                        Simple</a></li>
                                                <li><a href="{{ route('sign-up-one') }}" target="_blank">Register
                                                        with Bg Image
                                                    </a></li>
                                                <li><a href="{{ route('sign-up-two') }}" target="_blank">Register
                                                        with image
                                                        two</a></li>
                                                <li><a href="{{ route('sign-up-wizard') }}" target="_blank">Register
                                                        wizard</a>
                                                </li>
                                                <li><a href="{{ route('unlock') }}">Unlock User</a></li>
                                                <li><a href="{{ route('forget-password') }}">Forget Password</a>
                                                </li>
                                                <li><a href="{{ route('reset-password') }}">Reset Password</a>
                                                </li>
                                                <li><a href="{{ route('maintenance') }}">Maintenance</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Coming Soon</h5>
                                            </div>
                                            <ul class="submenu-content opensubmegamenu">
                                                <li><a href="{{ route('comingsoon') }}">Coming Simple</a></li>
                                                <li><a href="{{ route('comingsoon-bg-video') }}">Coming with Bg
                                                        video</a></li>
                                                <li><a href="{{ route('comingsoon-bg-img') }}">Coming with Bg
                                                        Image</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Miscellaneous</h6>
                        </div>
                    </li>


                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('faq') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-faq') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-faq') }}"></use>
                            </svg><span>FAQ</span></a></li>


                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-maps') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-maps') }}"></use>
                            </svg><span>Maps</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('map-js') }}">Maps JS</a></li>
                            <li><a href="{{ route('vector-map') }}">Vector Maps</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-editors') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-editors') }}"></use>
                            </svg><span>Editors</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('summernote') }}">Summer Note</a></li>
                            <li><a href="{{ route('ckeditor') }}">CK editor</a></li>
                            <li><a href="{{ route('simple-mde') }}">MDE editor</a></li>
                            <li><a href="{{ route('ace-code-editor') }}">ACE code editor </a></li>
                        </ul>
                    </li> --}}

                </ul>
            </div>

            @else
            {{-- Fallback for unexpected user_type --}}
            <p>Unauthorized access.</p>
        @endif
    @else
        <p>You need to log in to access this page.</p>
    @endif


            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
