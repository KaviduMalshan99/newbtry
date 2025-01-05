<?php



use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BatteryController;
use App\Http\Controllers\BatteryPurchaseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LubricantController;
use App\Http\Controllers\LubricantPurchaseController;
use App\Http\Controllers\OldBatteryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('admin.index'); // Redirects to the admin dashboard
});

// Show Registration Form
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registration');

// Handle Registration Form Submission
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Show Login Form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle Login Form Submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Handle Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard - Accessible only to authenticated users
Route::get('/admin/index', [AdminController::class, 'index'])->middleware('auth')->name('admin.index');

// Redirecting after registration, login, and logout actions
Route::get('/', function () {
    return redirect()->route('login');
});




use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;



Route::get('/', function () {
    return redirect()->route('index');
})->name('/');

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'de', 'es', 'fr', 'pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');

// Route::prefix('dashboard')->group(function () {
//     Route::view('index', 'dashboard.index')->name('index');
//     Route::view('dashboard-02', 'dashboard.dashboard-02')->name('dashboard-02');
// });

Route::prefix('widgets')->group(function () {
    Route::view('general-widget', 'widgets.general-widget')->name('general-widget');
    Route::view('chart-widget', 'widgets.chart-widget')->name('chart-widget');
});




Route::prefix('ecommerce')->group(function () {
    Route::view('product', 'apps.product')->name('product');
    Route::view('page-product', 'apps.product-page')->name('product-page');
    Route::view('list-products', 'apps.list-products')->name('list-products');
    Route::view('payment-details', 'apps.payment-details')->name('payment-details');
    Route::view('order-history', 'apps.order-history')->name('order-history');
    Route::view('invoice-template', 'apps.invoice-template')->name('invoice-template');
    Route::view('cart', 'apps.cart')->name('cart');
    Route::view('list-wish', 'apps.list-wish')->name('list-wish');
    Route::view('checkout', 'apps.checkout')->name('checkout');
    Route::view('pricing', 'apps.pricing')->name('pricing');
});

Route::prefix('email')->group(function () {
    Route::view('email-application', 'apps.email-application')->name('email-application');
    Route::view('email-compose', 'apps.email-compose')->name('email-compose');
});

Route::prefix('chat')->group(function () {
    Route::view('chat', 'apps.chat')->name('chat');
    Route::view('video-chat', 'apps.video-chat')->name('chat-video');
});

Route::prefix('users')->group(function () {
    Route::view('user-profile', 'apps.user-profile')->name('user-profile');
    Route::view('edit-profile', 'apps.edit-profile')->name('edit-profile');
    Route::view('user-cards', 'apps.user-cards')->name('user-cards');
});


Route::view('bookmark', 'apps.bookmark')->name('bookmark');
Route::view('contacts', 'apps.contacts')->name('contacts');
Route::view('task', 'apps.task')->name('task');
Route::view('calendar-basic', 'apps.calendar-basic')->name('calendar-basic');
Route::view('social-app', 'apps.social-app')->name('social-app');
Route::view('to-do', 'apps.to-do')->name('to-do');
Route::view('search', 'apps.search')->name('search');

Route::prefix('ui-kits')->group(function () {
    Route::view('state-color', 'ui-kits.state-color')->name('state-color');
    Route::view('typography', 'ui-kits.typography')->name('typography');
    Route::view('avatars', 'ui-kits.avatars')->name('avatars');
    Route::view('helper-classes', 'ui-kits.helper-classes')->name('helper-classes');
    Route::view('grid', 'ui-kits.grid')->name('grid');
    Route::view('tag-pills', 'ui-kits.tag-pills')->name('tag-pills');
    Route::view('progress-bar', 'ui-kits.progress-bar')->name('progress-bar');
    Route::view('modal', 'ui-kits.modal')->name('modal');
    Route::view('alert', 'ui-kits.alert')->name('alert');
    Route::view('popover', 'ui-kits.popover')->name('popover');
    Route::view('tooltip', 'ui-kits.tooltip')->name('tooltip');
    Route::view('loader', 'ui-kits.loader')->name('loader');
    Route::view('dropdown', 'ui-kits.dropdown')->name('dropdown');
    Route::view('accordion', 'ui-kits.accordion')->name('accordion');
    Route::view('tab-bootstrap', 'ui-kits.tab-bootstrap')->name('tab-bootstrap');
    Route::view('tab-material', 'ui-kits.tab-material')->name('tab-material');
    Route::view('box-shadow', 'ui-kits.box-shadow')->name('box-shadow');
    Route::view('list', 'ui-kits.list')->name('list');
});

Route::prefix('bonus-ui')->group(function () {
    Route::view('scrollable', 'bonus-ui.scrollable')->name('scrollable');
    Route::view('tree', 'bonus-ui.tree')->name('tree');
    Route::view('bootstrap-notify', 'bonus-ui.bootstrap-notify')->name('bootstrap-notify');
    Route::view('rating', 'bonus-ui.rating')->name('rating');
    Route::view('dropzone', 'bonus-ui.dropzone')->name('dropzone');
    Route::view('tour', 'bonus-ui.tour')->name('tour');
    Route::view('sweet-alert2', 'bonus-ui.sweet-alert2')->name('sweet-alert2');
    Route::view('modal-animated', 'bonus-ui.modal-animated')->name('modal-animated');
    Route::view('owl-carousel', 'bonus-ui.owl-carousel')->name('owl-carousel');
    Route::view('ribbons', 'bonus-ui.ribbons')->name('ribbons');
    Route::view('pagination', 'bonus-ui.pagination')->name('pagination');
    Route::view('breadcrumb', 'bonus-ui.breadcrumb')->name('breadcrumb');
    Route::view('range-slider', 'bonus-ui.range-slider')->name('range-slider');
    Route::view('image-cropper', 'bonus-ui.image-cropper')->name('image-cropper');
    Route::view('sticky', 'bonus-ui.sticky')->name('sticky');
    Route::view('basic-card', 'bonus-ui.basic-card')->name('basic-card');
    Route::view('creative-card', 'bonus-ui.creative-card')->name('creative-card');
    Route::view('tabbed-card', 'bonus-ui.tabbed-card')->name('tabbed-card');
    Route::view('dragable-card', 'bonus-ui.dragable-card')->name('dragable-card');
    Route::view('timeline-v-1', 'bonus-ui.timeline-v-1')->name('timeline-v-1');
    Route::view('timeline-v-2', 'bonus-ui.timeline-v-2')->name('timeline-v-2');
    Route::view('timeline-small', 'bonus-ui.timeline-small')->name('timeline-small');
});

Route::prefix('builders')->group(function () {
    Route::view('form-builder-1', 'builders.form-builder-1')->name('form-builder-1');
    Route::view('form-builder-2', 'builders.form-builder-2')->name('form-builder-2');
    Route::view('pagebuild', 'builders.pagebuild')->name('pagebuild');
    Route::view('button-builder', 'builders.button-builder')->name('button-builder');
});

Route::prefix('animation')->group(function () {
    Route::view('animate', 'animation.animate')->name('animate');
    Route::view('scroll-reval', 'animation.scroll-reval')->name('scroll-reval');
    Route::view('aos', 'animation.aos')->name('aos');
    Route::view('tilt', 'animation.tilt')->name('tilt');
    Route::view('wow', 'animation.wow')->name('wow');
});


Route::prefix('icons')->group(function () {
    Route::view('flag-icon', 'icons.flag-icon')->name('flag-icon');
    Route::view('font-awesome', 'icons.font-awesome')->name('font-awesome');
    Route::view('ico-icon', 'icons.ico-icon')->name('ico-icon');
    Route::view('themify-icon', 'icons.themify-icon')->name('themify-icon');
    Route::view('feather-icon', 'icons.feather-icon')->name('feather-icon');
    Route::view('whether-icon', 'icons.whether-icon')->name('whether-icon');
    Route::view('simple-line-icon', 'icons.simple-line-icon')->name('simple-line-icon');
    Route::view('material-design-icon', 'icons.material-design-icon')->name('material-design-icon');
    Route::view('pe7-icon', 'icons.pe7-icon')->name('pe7-icon');
    Route::view('typicons-icon', 'icons.typicons-icon')->name('typicons-icon');
    Route::view('ionic-icon', 'icons.ionic-icon')->name('ionic-icon');
});

Route::prefix('buttons')->group(function () {
    Route::view('buttons', 'buttons.buttons')->name('buttons');
    Route::view('flat-buttons', 'buttons.flat-buttons')->name('flat-buttons');
    Route::view('edge-buttons', 'buttons.buttons-edge')->name('buttons-edge');
    Route::view('raised-button', 'buttons.raised-button')->name('raised-button');
    Route::view('button-group', 'buttons.button-group')->name('button-group');
});

Route::prefix('forms')->group(function () {
    Route::view('form-validation', 'forms.form-validation')->name('form-validation');
    Route::view('base-input', 'forms.base-input')->name('base-input');
    Route::view('radio-checkbox-control', 'forms.radio-checkbox-control')->name('radio-checkbox-control');
    Route::view('input-group', 'forms.input-group')->name('input-group');
    Route::view('megaoptions', 'forms.megaoptions')->name('megaoptions');
    Route::view('datepicker', 'forms.datepicker')->name('datepicker');
    Route::view('time-picker', 'forms.time-picker')->name('time-picker');
    Route::view('datetimepicker', 'forms.datetimepicker')->name('datetimepicker');
    Route::view('daterangepicker', 'forms.daterangepicker')->name('daterangepicker');
    Route::view('touchspin', 'forms.touchspin')->name('touchspin');
    Route::view('select2', 'forms.select2')->name('select2');
    Route::view('switch', 'forms.switch')->name('switch');
    Route::view('typeahead', 'forms.typeahead')->name('typeahead');
    Route::view('clipboard', 'forms.clipboard')->name('clipboard');
    Route::view('default-form', 'forms.default-form')->name('default-form');
    Route::view('form-wizard', 'forms.form-wizard')->name('form-wizard');
    Route::view('form-two-wizard', 'forms.form-wizard-two')->name('form-wizard-two');
    Route::view('wizard-form-three', 'forms.form-wizard-three')->name('form-wizard-three');
    Route::post('form-wizard-three', function () {
        return redirect()->route('form-wizard-three');
    })->name('form-wizard-three-post');
});

Route::prefix('tables')->group(function () {
    Route::view('bootstrap-basic-table', 'tables.bootstrap-basic-table')->name('bootstrap-basic-table');
    Route::view('bootstrap-sizing-table', 'tables.bootstrap-sizing-table')->name('bootstrap-sizing-table');
    Route::view('bootstrap-border-table', 'tables.bootstrap-border-table')->name('bootstrap-border-table');
    Route::view('bootstrap-styling-table', 'tables.bootstrap-styling-table')->name('bootstrap-styling-table');
    Route::view('table-components', 'tables.table-components')->name('table-components');
    Route::view('datatable-basic-init', 'tables.datatable-basic-init')->name('datatable-basic-init');
    Route::view('datatable-advance', 'tables.datatable-advance')->name('datatable-advance');
    Route::view('datatable-styling', 'tables.datatable-styling')->name('datatable-styling');
    Route::view('datatable-ajax', 'tables.datatable-ajax')->name('datatable-ajax');
    Route::view('datatable-server-side', 'tables.datatable-server-side')->name('datatable-server-side');
    Route::view('datatable-plugin', 'tables.datatable-plugin')->name('datatable-plugin');
    Route::view('datatable-api', 'tables.datatable-api')->name('datatable-api');
    Route::view('datatable-data-source', 'tables.datatable-data-source')->name('datatable-data-source');
    Route::view('datatable-ext-autofill', 'tables.datatable-ext-autofill')->name('datatable-ext-autofill');
    Route::view('datatable-ext-basic-button', 'tables.datatable-ext-basic-button')->name('datatable-ext-basic-button');
    Route::view('datatable-ext-col-reorder', 'tables.datatable-ext-col-reorder')->name('datatable-ext-col-reorder');
    Route::view('datatable-ext-fixed-header', 'tables.datatable-ext-fixed-header')->name('datatable-ext-fixed-header');
    Route::view('datatable-ext-html-5-data-export', 'tables.datatable-ext-html-5-data-export')->name('datatable-ext-html-5-data-export');
    Route::view('datatable-ext-key-table', 'tables.datatable-ext-key-table')->name('datatable-ext-key-table');
    Route::view('datatable-ext-responsive', 'tables.datatable-ext-responsive')->name('datatable-ext-responsive');
    Route::view('datatable-ext-row-reorder', 'tables.datatable-ext-row-reorder')->name('datatable-ext-row-reorder');
    Route::view('datatable-ext-scroller', 'tables.datatable-ext-scroller')->name('datatable-ext-scroller');
    Route::view('jsgrid-table', 'tables.jsgrid-table')->name('jsgrid-table');
});

Route::prefix('charts')->group(function () {
    Route::view('echarts', 'charts.echarts')->name('echarts');
    Route::view('chart-apex', 'charts.chart-apex')->name('chart-apex');
    Route::view('chart-google', 'charts.chart-google')->name('chart-google');
    Route::view('chart-sparkline', 'charts.chart-sparkline')->name('chart-sparkline');
    Route::view('chart-flot', 'charts.chart-flot')->name('chart-flot');
    Route::view('chart-knob', 'charts.chart-knob')->name('chart-knob');
    Route::view('chart-morris', 'charts.chart-morris')->name('chart-morris');
    Route::view('chartjs', 'charts.chartjs')->name('chartjs');
    Route::view('chartist', 'charts.chartist')->name('chartist');
    Route::view('chart-peity', 'charts.chart-peity')->name('chart-peity');
});

Route::view('sample-page', 'pages.sample-page')->name('sample-page');
Route::view('internationalization', 'pages.internationalization')->name('internationalization');

// Route::prefix('starter-kit')->group(function () {
// });

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});

Route::prefix('authentication')->group(function () {
    Route::view('login', 'authentication.login')->name('login');
    Route::view('login-one', 'authentication.login-one')->name('login-one');
    Route::view('login-two', 'authentication.login-two')->name('login-two');
    Route::view('login-bs-validation', 'authentication.login-bs-validation')->name('login-bs-validation');
    Route::view('login-bs-tt-validation', 'authentication.login-bs-tt-validation')->name('login-bs-tt-validation');
    Route::view('login-sa-validation', 'authentication.login-sa-validation')->name('login-sa-validation');
    Route::view('sign-up', 'authentication.sign-up')->name('sign-up');
    Route::view('sign-up-one', 'authentication.sign-up-one')->name('sign-up-one');
    Route::view('sign-up-two', 'authentication.sign-up-two')->name('sign-up-two');
    Route::view('sign-up-wizard', 'authentication.sign-up-wizard')->name('sign-up-wizard');
    Route::view('unlock', 'authentication.unlock')->name('unlock');
    Route::view('forget-password', 'authentication.forget-password')->name('forget-password');
    Route::view('reset-password', 'authentication.reset-password')->name('reset-password');
    Route::view('maintenance', 'authentication.maintenance')->name('maintenance');
});

Route::view('comingsoon', 'comingsoon.comingsoon')->name('comingsoon');
Route::view('comingsoon-bg-video', 'comingsoon.comingsoon-bg-video')->name('comingsoon-bg-video');
Route::view('comingsoon-bg-img', 'comingsoon.comingsoon-bg-img')->name('comingsoon-bg-img');

Route::view('basic-template', 'email-templates.basic-template')->name('basic-template');
Route::view('email-header', 'email-templates.email-header')->name('email-header');
Route::view('template-email', 'email-templates.template-email')->name('template-email');
Route::view('template-email-2', 'email-templates.template-email-2')->name('template-email-2');
Route::view('ecommerce-templates', 'email-templates.ecommerce-templates')->name('ecommerce-templates');
Route::view('email-order-success', 'email-templates.email-order-success')->name('email-order-success');


Route::prefix('gallery')->group(function () {
    Route::view('index', 'apps.gallery')->name('gallery');
    Route::view('with-gallery-description', 'apps.gallery-with-description')->name('gallery-with-description');
    Route::view('gallery-masonry', 'apps.gallery-masonry')->name('gallery-masonry');
    Route::view('masonry-gallery-with-disc', 'apps.masonry-gallery-with-disc')->name('masonry-gallery-with-disc');
    Route::view('gallery-hover', 'apps.gallery-hover')->name('gallery-hover');
});

Route::prefix('blog')->group(function () {
    Route::view('index', 'apps.blog')->name('blog');
    Route::view('blog-single', 'apps.blog-single')->name('blog-single');
    Route::view('add-post', 'apps.add-post')->name('add-post');
});


Route::view('faq', 'apps.faq')->name('faq');

Route::prefix('job-search')->group(function () {
    Route::view('job-cards-view', 'apps.job-cards-view')->name('job-cards-view');
    Route::view('job-list-view', 'apps.job-list-view')->name('job-list-view');
    Route::view('job-details', 'apps.job-details')->name('job-details');
    Route::view('job-apply', 'apps.job-apply')->name('job-apply');
});

Route::prefix('learning')->group(function () {
    Route::view('learning-list-view', 'apps.learning-list-view')->name('learning-list-view');
    Route::view('learning-detailed', 'apps.learning-detailed')->name('learning-detailed');
});

Route::prefix('maps')->group(function () {
    Route::view('map-js', 'apps.map-js')->name('map-js');
    Route::view('vector-map', 'apps.vector-map')->name('vector-map');
});

Route::prefix('editors')->group(function () {
    Route::view('summernote', 'apps.summernote')->name('summernote');
    Route::view('ckeditor', 'apps.ckeditor')->name('ckeditor');
    Route::view('simple-mde', 'apps.simple-mde')->name('simple-mde');
    Route::view('ace-code-editor', 'apps.ace-code-editor')->name('ace-code-editor');
});

Route::view('knowledgebase', 'apps.knowledgebase')->name('knowledgebase');
Route::view('support-ticket', 'apps.support-ticket')->name('support-ticket');
Route::view('landing-page', 'pages.landing-page')->name('landing-page');

Route::prefix('layouts')->group(function () {
    Route::view('compact-sidebar', 'admin_unique_layouts.compact-sidebar'); //default //Dubai
    Route::view('box-layout', 'admin_unique_layouts.box-layout');    //default //New York //
    Route::view('dark-sidebar', 'admin_unique_layouts.dark-sidebar');

    Route::view('default-body', 'admin_unique_layouts.default-body');
    Route::view('compact-wrap', 'admin_unique_layouts.compact-wrap');
    Route::view('enterprice-type', 'admin_unique_layouts.enterprice-type');

    Route::view('compact-small', 'admin_unique_layouts.compact-small');
    Route::view('advance-type', 'admin_unique_layouts.advance-type');
    Route::view('material-layout', 'admin_unique_layouts.material-layout');

    Route::view('color-sidebar', 'admin_unique_layouts.color-sidebar');
    Route::view('material-icon', 'admin_unique_layouts.material-icon');
    Route::view('modern-layout', 'admin_unique_layouts.modern-layout');
});

Route::get('layout-{light}', function ($light) {
    session()->put('layout', $light);
    session()->get('layout');
    if ($light == 'vertical-layout') {
        return redirect()->route('pages-vertical-layout');
    }
    return redirect()->route('index');
    return 1;
});
Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');


Route::resource('suppliers', SupplierController::class);

Route::prefix('customers')->group(function () {
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/{customer}/battery-repair', [CustomerController::class, 'indexByCustomer'])->name('customers.indexByCustomer');
    Route::get('/{customer}/purchase-history', [CustomerController::class, 'viewPurchaseHistory'])->name('customers.purchase-history');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

Route::get('user/add', [UserController::class, 'create'])->name('users.create');
Route::post('user/store', [UserController::class, 'store'])->name('users.store');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('sales', SaleController::class);

Route::prefix('purchases')->group(function () {
    Route::get('/products/{type}', [PurchaseController::class, 'getProducts']); //remove
    Route::get('/add', [PurchaseController::class, 'create'])->name('purchases.create'); //remove
    Route::post('/store', [PurchaseController::class, 'store'])->name('purchases.store'); // remove

    Route::get('/battery/create', [BatteryPurchaseController::class, 'createBatteryPurchase'])->name('purchases.create_battery');
    Route::post('/battery/store', [BatteryPurchaseController::class, 'storeBatteryPurchase'])->name('purchases.store_battery');
    Route::get('/{purchase}/grn', [BatteryPurchaseController::class, 'generateGrn'])->name('purchases.grn');
    Route::get('/', [BatteryPurchaseController::class, 'index'])->name('purchases.index');
    Route::delete('/{purchase}', [BatteryPurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('/battery/{purchase}/edit', [BatteryPurchaseController::class, 'editBatteryPurchase'])->name('purchases.edit_battery');
    Route::put('/battery/{purchase}', [BatteryPurchaseController::class, 'update_battery'])->name('purchases.update_battery');
    Route::delete('/battery/{purchase}/battery-purchase-item/{item}', [BatteryPurchaseController::class, 'removeBatteryPurchaseItem'])->name('purchases.remove_battery_item');
    Route::get('/battery/{purchase}/purchase-items', [BatteryPurchaseController::class, 'viewPurchaseItems'])->name('purchases.purchase-items');

    Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit'); //remove
});

Route::prefix('admin/rentals')->group(function () {
    Route::get('/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/store', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
    Route::put('/{rental}', [RentalController::class, 'update'])->name('rentals.update');
    Route::delete('/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');
    Route::get('/{rental}/completed-rental', [RentalController::class, 'completedRental'])->name('rentals.completedRental');
    Route::put('/{rental}/completed-rental', [RentalController::class, 'updateCompletedRental'])->name('rentals.updateCompletedRental');
    Route::get('/{rental}/view-rental-details', [RentalController::class, 'viewRentalDetails'])->name('rentals.view-rental-details');
    Route::get('/{rental}/completed-rental/bill', [RentalController::class, 'generateBill'])->name('rentals.bill');
});


Route::prefix('admin/repairs')->group(function () {
    Route::get('/create', [RepairController::class, 'create'])->name('repairs.create');
    Route::post('/store', [RepairController::class, 'store'])->name('repairs.store');
    Route::get('', [RepairController::class, 'index'])->name('repairs.index');
    Route::get('/{repair}/view-repair-details', [RepairController::class, 'viewRepairDetails'])->name('repairs.view-repair-details');
    Route::put('/{repair}/view-repair-details/update-status', [RepairController::class, 'changeStatus'])->name('repairs.updateStatus');
    Route::put('/{repair}/view-repair-details/update-delivery-status', [RepairController::class, 'changeDeliveryStatus'])->name('repairs.updateDeliveryStatus');
    Route::get('/{repair}/edit', [RepairController::class, 'edit'])->name('repairs.edit');
    Route::get('/{repair}/completed-order', [RepairController::class, 'completedOrder'])->name('repairs.completedOrder');
    Route::put('/{repair}', [RepairController::class, 'update'])->name('repairs.update');
    Route::put('/{repair}/completed-order', [RepairController::class, 'updateCompletedRepair'])->name('repairs.updateCompletedRepair');
    Route::delete('/{repair}', [RepairController::class, 'destroy'])->name('repairs.destroy');
    Route::get('/{repair}/completed-order/bill', [RepairController::class, 'generateBill'])->name('repairs.bill');
});

Route::prefix('admin/old-battery')->group(function () {
    Route::get('/create', [OldBatteryController::class, 'create'])->name('oldBatteries.create');
    Route::post('/store', [OldBatteryController::class, 'store'])->name('oldBatteries.store');
    Route::get('', [OldBatteryController::class, 'index'])->name('oldBatteries.index');
    Route::get('/{oldBattery}/view-old-battery-details', [OldBatteryController::class, 'viewOldBatteryDetails'])->name('oldBatteries.view-old-battery-details');
    Route::get('/{oldBattery}/edit', [OldBatteryController::class, 'edit'])->name('oldBatteries.edit');
    Route::put('/{oldBattery}', [OldBatteryController::class, 'update'])->name('oldBatteries.update');
    Route::delete('/{oldBattery}', [OldBatteryController::class, 'destroy'])->name('oldBatteries.destroy');
    Route::get('/{oldBattery}/bill', [OldBatteryController::class, 'generateBill'])->name('oldBatteries.bill');
});

Route::prefix('admin/company')->group(function () {
    Route::get('/', [CompanyController::class, 'create'])->name('company.create');
    Route::put('/', [CompanyController::class, 'storeOrUpdate'])->name('company.storeOrUpdate');
});

Route::prefix('admin/reports')->group(function () {
    Route::get('/customer-report', [ReportController::class, 'customerIndex'])->name('reports.customerIndex');
    Route::get('/supplier-report', [ReportController::class, 'supplierIndex'])->name('reports.supplierIndex');
    Route::get('/battery-purchase-report', [ReportController::class, 'batteryPurchaseIndex'])->name('reports.batteryPurchaseIndex');
    Route::get('/battery-report', [ReportController::class, 'batteryIndex'])->name('reports.batteryIndex');
    Route::get('/lubricant-report', [ReportController::class, 'LubricantIndex'])->name('reports.LubricantIndex');
    Route::get('/complete-rental-report', [ReportController::class, 'completeRentalIndex'])->name('reports.completeRentalIndex');
    Route::get('/rental-report', [ReportController::class, 'RentalIndex'])->name('reports.RentalIndex');
    Route::get('/complete-repair-report', [ReportController::class, 'repairCompleteIndex'])->name('reports.repairCompleteIndex');
    Route::get('/repair-report', [ReportController::class, 'repairIndex'])->name('reports.repairIndex');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::view('dashboard-02', 'dashboard.dashboard-02')->name('dashboard-02');
});


// Route::resource('rentals', RentalController::class);

// Route::prefix('admin/batteries')->group(function () {
//     Route::get('/', [BatteryController::class, 'index'])->name('batteries.index');
//     Route::get('/create', [BatteryController::class, 'create'])->name('batteries.create');
//     Route::post('/store', [BatteryController::class, 'store'])->name('batteries.store');
//     Route::get('/{id}', [BatteryController::class, 'show'])->name('batteries.show');
//     Route::get('/{id}/edit', [BatteryController::class, 'edit'])->name('batteries.edit');
//     Route::post('/{id}/update', [BatteryController::class, 'update'])->name('batteries.update');
//     Route::delete('/{id}', [BatteryController::class, 'destroy'])->name('batteries.destroy');
// });


// // Lubricant Management


// Route::prefix('admin/lubricants')->group(function () {
//     Route::get('/', [LubricantController::class, 'index'])->name('lubricants.index');
//     Route::get('/create', [LubricantController::class, 'create'])->name('lubricants.create');
//     Route::post('/', [LubricantController::class, 'store'])->name('lubricants.store');
//     Route::get('/{id}', [LubricantController::class, 'show'])->name('lubricants.show');
//     Route::get('/{id}/edit', [LubricantController::class, 'edit'])->name('lubricants.edit');
//     Route::put('/{id}', [LubricantController::class, 'update'])->name('lubricants.update');
//     Route::delete('/{id}', [LubricantController::class, 'destroy'])->name('lubricants.destroy');
// });

//new


Route::prefix('admin/batteries')->group(function () {
    Route::get('/', [BatteryController::class, 'index'])->name('batteries.index');
    Route::get('/create', [BatteryController::class, 'create'])->name('batteries.create');
    Route::post('/store', [BatteryController::class, 'store'])->name('batteries.store');
    Route::get('/{id}', [BatteryController::class, 'show'])->name('batteries.show');
    Route::get('/{id}/edit', [BatteryController::class, 'edit'])->name('batteries.edit');
    Route::put('/{id}/update', [BatteryController::class, 'update'])->name('batteries.update');
    Route::delete('/{id}', [BatteryController::class, 'destroy'])->name('batteries.destroy');
});


// Route::prefix('admin/batteries')->name('admin.old-batteries.')->group(function () {
//     Route::get('old-batteries/', [OldBatteryController::class, 'index'])->name('index');
//     Route::get('old-batteries/create', [OldBatteryController::class, 'create'])->name('create');
//     Route::post('old-batteries/', [OldBatteryController::class, 'store'])->name('store');
//     Route::get('old-batteries/{id}', [OldBatteryController::class, 'show'])->name('show');
//     Route::get('old-batteries/{id}/edit', [OldBatteryController::class, 'edit'])->name('edit');
//     Route::put('old-batteries/{id}', [OldBatteryController::class, 'update'])->name('update');
//     Route::delete('old-batteries/{id}', [OldBatteryController::class, 'destroy'])->name('destroy');
// });



// Lubricant Management


Route::prefix('admin/lubricants')->group(function () {
    Route::get('/', [LubricantController::class, 'index'])->name('lubricants.index');
    Route::get('/create', [LubricantController::class, 'create'])->name('lubricants.create');
    Route::post('/', [LubricantController::class, 'store'])->name('lubricants.store');
    Route::get('/{id}', [LubricantController::class, 'show'])->name('lubricants.show');
    Route::get('/{id}/edit', [LubricantController::class, 'edit'])->name('lubricants.edit');
    Route::put('/{id}', [LubricantController::class, 'update'])->name('lubricants.update');
    Route::delete('/{id}', [LubricantController::class, 'destroy'])->name('lubricants.destroy');
});


// pos

// Define the route for accessing the POS interface
Route::get('/admin/POS', [PosController::class, 'index'])->name('POS.index');
Route::get('/products-by-brand/{brandId}', [PosController::class, 'loadProductsByBrand'])->name('POS.loadProductsByBrand');


// Define the route for placing an order via POST request
// Route::post('/admin/POS/place-order', [PosController::class, 'placeOrder'])->name('POS.place');

Route::post('/admin/POS/place-order', [PosController::class, 'storeOrder'])->name('POS.placeOrder');

Route::post('/store-battery-order', [PosController::class, 'storeBatteryOrder'])->name('POS.storeBatteryOrder');

Route::post('/create-customer', [PosController::class, 'createCustomer'])->name('customer.create');
Route::post('/show', [PosController::class, 'show'])->name('show');


use App\Http\Controllers\OrderController;

Route::post('/admin/submit-order', [OrderController::class, 'submitOrder'])->name('submit.order');
Route::get('/admin/POS/summary', [OrderController::class, 'summary'])->name('POS.summary');


// brand





Route::prefix('admin/brand')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/{brand}', [BrandController::class, 'show'])->name('brand.show');
    Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/{brand}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
});




// Lubricant Purchase


// Route::resource('lubricant_purchases', LubricantPurchaseController::class);

Route::prefix('admin/lubricant_purchases')->group(function () {
    Route::get('/', [LubricantPurchaseController::class, 'index'])->name('lubricant_purchases.index');
    Route::get('/create', [LubricantPurchaseController::class, 'create'])->name('lubricant_purchases.create');
    Route::post('/', [LubricantPurchaseController::class, 'store'])->name('lubricant_purchases.store');
    Route::get('/{lubricant_purchase}', [LubricantPurchaseController::class, 'show'])->name('lubricant_purchases.show');
    Route::get('/{lubricant_purchase}/edit', [LubricantPurchaseController::class, 'edit'])->name('lubricant_purchases.edit');
    Route::put('/{lubricant_purchase}', [LubricantPurchaseController::class, 'update'])->name('lubricant_purchases.update');
    Route::delete('/{lubricant_purchase}', [LubricantPurchaseController::class, 'destroy'])->name('lubricant_purchases.destroy');
});



// payment
use App\Http\Controllers\LpaymentController;

Route::prefix('admin/payment')->group(function () {
    Route::get('/', [LpaymentController::class, 'index'])->name('l_payment.index');
    Route::get('/create', [LpaymentController::class, 'create'])->name('l_payment.create');
    Route::post('/', [LpaymentController::class, 'store'])->name('l_payment.store');
    Route::get('/{l_payment}/edit', [LpaymentController::class, 'edit'])->name('l_payment.edit');
    Route::put('/{l_payment}', [LpaymentController::class, 'update'])->name('l_payment.update');
    Route::delete('/{l_payment}', [LpaymentController::class, 'destroy'])->name('l_payment.destroy');
});
