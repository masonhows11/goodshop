<?php


//// Admin Normal Controllers
use App\Http\Controllers\Dash\Address\AdminCityController;
use App\Http\Controllers\Dash\Banner\AmazingOfferBannerController;
use App\Http\Controllers\Dash\Banner\BottomBannerController;
use App\Http\Controllers\Dash\Banner\MainSliderController;
use App\Http\Controllers\Dash\Banner\ProductByCategorySliderController;
use App\Http\Controllers\Dash\Banner\TopBannerController;
use App\Http\Controllers\Dash\Comments\AdminCommentController;
use App\Http\Controllers\Dash\AdminController;
use App\Http\Controllers\Dash\AdminPermAssignController;
use App\Http\Controllers\Dash\AdminRoleAssignController;
use App\Http\Controllers\Dash\Auth\AdminLoginController;
use App\Http\Controllers\Dash\Auth\AdminProfileController;
use App\Http\Controllers\Dash\Auth\AdminValidateController;
use App\Http\Controllers\Dash\NotificationController;
use App\Http\Controllers\Dash\Notifications\AdminEmailNoticeFileController;
use App\Http\Controllers\Dash\Notifications\AdminEmailNoticesController;
use App\Http\Controllers\Dash\Notifications\AdminSMSNoticeController;
use App\Http\Controllers\Dash\Product\ProductCreateController;
use App\Http\Controllers\Dash\Product\ProductCreateColorController;
use App\Http\Controllers\Dash\Product\ProductCreateImageController;
use App\Http\Controllers\Dash\Product\ProductCreateTagController;
use App\Http\Controllers\Dash\Product\ProductMetaController;
use App\Http\Controllers\Dash\Product\ProductEditController;
use App\Http\Controllers\Dash\Discount\AmazingSalesController;
use App\Http\Controllers\Dash\Discount\CommonDiscountController;
use App\Http\Controllers\Dash\Discount\CouponDiscountController;
use App\Http\Controllers\Dash\Order\AdminOrderController;
use App\Http\Controllers\Dash\Payment\PaymentController;
use App\Http\Controllers\Dash\Delivery\DeliveryController;
use App\Http\Controllers\Dash\Product\ProductWarrantyController;
use App\Http\Controllers\Dash\Setting\SettingController;
use App\Http\Controllers\Dash\StockProduct\StockController;

//// Admin City & Province Controllers
// use App\Http\Controllers\Dash\AdminCityController;
use App\Http\Controllers\Dash\Address\AdminProvinceController;
use App\Http\Controllers\Dash\Ticket\AdminAdminTicketController;
use App\Http\Controllers\Dash\Ticket\AdminCategoryTicketController;
use App\Http\Controllers\Dash\Ticket\AdminPriorityTicketController;
use App\Http\Controllers\Dash\Ticket\AdminTicketController;
use App\Http\Controllers\Front\Profile\CompareController;
use App\Http\Controllers\Front\Profile\FavoritesController;
use App\Http\Controllers\Front\Profile\FrontAddressController;
use App\Http\Controllers\Front\Profile\FrontTicketController;

//// Admin Livewire Controllers
use App\Http\Livewire\Admin\Users\AdminUsers;
use App\Http\Livewire\Admin\Users\AdminAdmins;
//
use App\Http\Livewire\Admin\ProductFeatures\AdminCategoryAttribute;
use App\Http\Livewire\Admin\ProductFeatures\AdminCategoryAttributeValue;
//
use App\Http\Livewire\Admin\Category\AdminCategoryCreate;
use App\Http\Livewire\Admin\Category\AdminCategoryEdit;
use App\Http\Livewire\Admin\Category\AdminCategoryList;
//
use App\Http\Livewire\Admin\ProductFeatures\AdminTag;
use App\Http\Livewire\Admin\ProductFeatures\AdminColors;
//
use App\Http\Livewire\Admin\Brand\AdminBrands;
use App\Http\Livewire\Admin\Brand\AdminCreateBrand;
use App\Http\Livewire\Admin\Brand\AdminEditBrand;
//
use App\Http\Livewire\Admin\Permissions\AdminPerms;
use App\Http\Livewire\Admin\Permissions\AdminRoles;
//
use App\Http\Livewire\Admin\Banner\AdminAmazingOfferBanner;
use App\Http\Livewire\Admin\Banner\AdminBottomTwoBanner;
use App\Http\Livewire\Admin\Banner\AdminMainSlider;
use App\Http\Livewire\Admin\Banner\AdminTopBanner;
//
use App\Http\Livewire\Admin\Comment\AdminSingleComment;
use App\Http\Livewire\Admin\IndexProduct\IndexProduct;
//
use App\Http\Livewire\Admin\Permissions\ListUsersForPerm;
use App\Http\Livewire\Admin\Permissions\ListUsersForRole;
//
use App\Http\Livewire\Admin\Orders\AdminAllOrders;
use App\Http\Livewire\Admin\Delivery\AdminDelivery;
use App\Http\Livewire\Admin\Setting\AdminSetting;

//// Front Controllers
use App\Http\Controllers\Front\Payment\PaymentController as FrontPaymentController;
use App\Http\Controllers\Front\AddressController;
use App\Http\Controllers\Front\Cart\CartController;
use App\Http\Controllers\Front\Profile\ProfileController;
use App\Http\Controllers\Front\Product\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\ValidateUserController;

//// Unused Controllers

//use App\Http\Livewire\Admin\Comment\AdminComment;
//use App\Http\Livewire\Admin\AdminAddSpecification;
//use App\Http\Livewire\Admin\AdminAddSpecificationOption;
//use App\Http\Livewire\Admin\AdminAttribute;
//use App\Http\Livewire\Admin\AdminAttributeCreate;
//use App\Http\Livewire\Admin\AdminAttributeEdit;
//use App\Http\Livewire\Admin\AdminAttributeValue;
//use App\Http\Livewire\Admin\AdminAttributeValueCreate;
//use App\Http\Livewire\Admin\AdminSpecification;
//use App\Http\Livewire\Admin\AdminSpecificationOption;
//use App\Http\Livewire\Admin\AdminTag;
//use App\Http\Livewire\Admin\Warranty\AdminWarranty;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/not-found',[HomeController::class, 'notFound'])->name('not_found');

Route::get('/sitemap.xml',[\App\Http\Controllers\SiteMapController::class,'index'])->name('sitemap.xml');
Route::get('/sitemap.xml/products',[\App\Http\Controllers\SiteMapController::class,'products'])->name('sitemap.xml.products');
Route::get('/sitemap.xml/categories',[\App\Http\Controllers\SiteMapController::class,'categories'])->name('sitemap.xml.categories');
Route::get('/sitemap.xml/tags',[\App\Http\Controllers\SiteMapController::class,'tags'])->name('sitemap.xml.tags');
Route::get('/sitemap.xml/static',[\App\Http\Controllers\SiteMapController::class,'static'])->name('sitemap.xml.static');

Route::get('/storage-link', function () {
    symlink(storage_path('app/public'), $_SERVER['DOCUMENT_ROOT'] . '/storage');
});


/**--------------------------auth routes---------------------**/
Route::prefix('auth')->name('auth.')->group(function (){

    Route::get('/register', [RegisterUserController::class, 'registerForm'])->name('register.form');
    Route::post('/register-user', [RegisterUserController::class, 'register'])->name('register.user');

    Route::get('/login', [LoginUserController::class, 'loginForm'])->name('login.form');
    Route::post('/login-user', [LoginUserController::class, 'login'])->middleware('throttle:auth-login-limiter')->name('login.user');

    Route::get('/validate-user-form', [ValidateUserController::class, 'validateForm'])->name('validate.user.form');
    Route::post('/validate-user', [ValidateUserController::class, 'validate_user'])->middleware('throttle:auth-validate-limiter')->name('validate.user');

    Route::get('/resend-token/{token_guid}', [ValidateUserController::class, 'resendToken'])->middleware('throttle:auth-resend-token-limiter')->name('resend.token');
});

Route::get('/log-out', [LoginUserController::class, 'logOut'])->middleware('auth', 'web')->name('auth.log.out');

/*------------------------route user profile-----------------**/
Route::prefix('profile')->middleware(['auth','web'])->group(function(){


    Route::get('/user-profile', [ProfileController::class,'Profile'])->name('user.profile');

    Route::get('/account-information', [ProfileController::class,'accountInformation'])->name('user.account.information');
    Route::post('/account-information',[ProfileController::class,'updateProfile'])->name('user.update.account.information');



    Route::get('/mobile-update', [ProfileController::class,'updateMobileForm'])->name('mobile.update.form');
    Route::post('/mobile-update', [ProfileController::class,'updateMobile'])->name('mobile.update');


    Route::get('/email-update', [ProfileController::class,'updateEmailForm'])->name('email.update.form');
    Route::post('/email-update', [ProfileController::class,'updateEmail'])->name('email.update');

    Route::get('/all-orders/{status?}/{type?}',[ProfileController::class,'allOrders'])->name('all.orders');

    Route::get('/order-details/{order}',[ProfileController::class,'orderDetails'])->name('order.details');

    Route::get('/comments',[ProfileController::class,'comments'])->name('comments');


    Route::get('/favorites',[FavoritesController::class,'favorites'])->name('favorites');
    Route::get('/favorites/delete/{product}',[FavoritesController::class,'favoritesDelete'])->name('favorites.delete');

    Route::get('/compare-products',[CompareController::class,'index'])->name('compare.products');



    Route::get('/addresses',[FrontAddressController::class,'addresses'])->name('addresses');

    Route::post('/address/store',[FrontAddressController::class,'store'])->name('profile.address.store');
    Route::post('/address/update',[FrontAddressController::class,'update'])->name('profile.address.update');

    Route::get('/address/delete/{address}',[FrontAddressController::class,'delete'])->name('profile.address.delete');

    Route::get('/order-returned/request',[ProfileController::class,'orderReturnedRequest'])->name('order.returned.request');

    Route::get('/tickets',[FrontTicketController::class,'index'])->name('tickets');

    Route::get('/show-ticket/{ticket}',[FrontTicketController::class,'showTicket'])->name('show.ticket');
    Route::post('/answer-ticket/{ticket}',[FrontTicketController::class,'answerTicket'])->name('answer.ticket');

    Route::get('/new-ticket',[FrontTicketController::class,'newTicket'])->name('new.ticket');
    Route::post('/new-ticket/store',[FrontTicketController::class,'ticketStore'])->name('new.ticket.store');
    Route::get('/ticket-download/{ticket}',[FrontTicketController::class,'downloadTicketFile'])->name('ticket.download');



});

Route::get('/about_us',[\App\Http\Controllers\Front\AboutUs\AboutUsController::class,'aboutUs'])->name('about_us');
Route::get('/contact_us',[\App\Http\Controllers\Front\ContactUs\ContactUsController::class,'contactUs'])->name('contact_us');





/* ------------------- Products Front Routes -----------------**/

Route::get('/product/{product:slug}',[ProductController::class,'show'])->name('product.details');

Route::post('/product/add-to-favorites',[ProductController::class,'addToFavoriteProducts'])->middleware('auth', 'web')->name('product.add.to.favorites');

Route::post('/product/add-to-compare',[ProductController::class,'addToCompareProducts'])->middleware('auth', 'web')->name('product.add.to.compares');

Route::get('/search/products',[HomeController::class,'products'])->name('search.products');


Route::get('/search/category/{slug?}',[HomeController::class,'searchCategory'])->name('search.category');


/* ------------------- Basket Front Routes -----------------**/

Route::prefix('shopping')->middleware(['auth','web'])->group(function(){


    Route::get('/cart/check', [CartController::class, 'checkoutCart'])->name('cart.check');

    Route::get('/check/address',[AddressController::class,'checkAddress'])->name('check.address');

    Route::get('/get-city',[AddressController::class,'getCities'])->name('get.cities');

    Route::post('/address/store',[AddressController::class,'store'])->name('address.store');

    Route::post('/address/update',[AddressController::class,'update'])->name('address.update');

    Route::get('/address/delete/{address}',[AddressController::class,'delete'])->name('address.delete');

    Route::post('/choose-address-delivery',[AddressController::class,'chooseAddressDelivery'])->name('choose.address.delivery');

    Route::post('/coupon-discount',[FrontPaymentController::class,'couponDiscount'])->name('coupon-discount');

    Route::get('/payment',[FrontPaymentController::class,'payment'])->name('payment');

    Route::post('/payment-submit',[FrontPaymentController::class,'paymentSubmit'])->name('payment.submit');

    Route::get('/payment-callback/{order}/{onlinePayment}',[FrontPaymentController::class,'paymentCallback'])->name('payment.callback');

    Route::get('/payment-result/{orderNumber}',[FrontPaymentController::class,'paymentResult'])->name('payment.result');

});



/* ------------------- admin Routes ------------------------**/

// Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|admin'])->group(function () {
//
// });

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AdminLoginController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');

    Route::get('/validate', [AdminValidateController::class, 'validateEmailForm'])->name('admin.validate.email.form');
    Route::post('/validate', [AdminValidateController::class, 'validateEmail'])->name('admin.validate.email');


});
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [AdminProfileController::class, 'profile'])->name('profile');
    Route::post('/update/profile', [AdminProfileController::class, 'update'])->name('update.profile');

    Route::get('/edit/mobile',[AdminProfileController::class,'editMobile'])->name('edit.mobile');
    Route::post('/update/mobile',[AdminProfileController::class,'updateMobile'])->name('update.mobile');

    Route::get('/logout', [AdminLoginController::class, 'logOut'])->name('logout');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/users/index', AdminUsers::class)->name('users');
    Route::get('/admins/index', AdminAdmins::class)->name('admins');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/perms/index', AdminPerms::class)->name('perms');
    Route::get('/roles/index', AdminRoles::class)->name('roles');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/roles/list/users', ListUsersForRole::class)->name('role.list.users');
    Route::get('/roles/assign/form', [AdminRoleAssignController::class, 'create'])->name('roles.assign.form');
    Route::post('/roles/assign', [AdminRoleAssignController::class, 'store'])->name('roles.assign');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/perms/list/users', ListUsersForPerm::class)->name('perm.list.users');
    Route::get('/perms/assign/form', [AdminPermAssignController::class, 'create'])->name('perms.assign.form');
    Route::post('/perms/assign', [AdminPermAssignController::class, 'store'])->name('perms.assign');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {
    Route::get('/category/index', AdminCategoryList::class)->name('category.index');
    Route::get('/category/create', AdminCategoryCreate::class)->name('category.create');
    Route::get('/category/edit/{id}', AdminCategoryEdit::class)->name('category.edit');
});

// crud brands
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/brand/index', AdminBrands::class)->name('brand.index');
    Route::get('/brand/create', AdminCreateBrand::class)->name('brand.create');
    Route::get('/brand/edit/{id}', AdminEditBrand::class)->name('brand.edit');

});

// crud tags
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/tag/index', AdminTag::class)->name('tag.index');
    // Route::get('/tag/create', AdminCreateBrand::class)->name('tag.create');
    // Route::get('/tag/edit/{id}', AdminEditBrand::class)->name('tag.edit');

});
// crud colors
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/colors/index', AdminColors::class)->name('colors.index');

});
// crud attribute
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/category/attribute/index', AdminCategoryAttribute::class)->name('category.attribute.index');

});
// crud attribute value
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/category/attribute/value/index/{attribute}', AdminCategoryAttributeValue::class)->name('category.attribute.value.index');

});

// crud product routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/product/index', IndexProduct::class)->name('product.index');
    // new product
    Route::get('/product/create/basic', [ProductCreateController::class, 'create'])->name('product.create.basic');
    Route::post('/product/store/basic', [ProductCreateController::class, 'store'])->name('product.store.basic');
    // edit product
    Route::get('/product/edit/basic/{product}', [ProductEditController::class, 'edit'])->name('product.edit.basic');
    Route::post('/product/update/basic', [ProductEditController::class, 'update'])->name('product.update.basic');
    // crud other product feathers
    Route::get('/product/create/meta/{product}', [ProductMetaController::class, 'index'])->name('product.create.meta');
    Route::get('/product/create/images/{product}', [ProductCreateImageController::class, 'create'])->name('product.create.images');
    Route::get('/product/create/colors/{product}', [ProductCreateColorController::class, 'create'])->name('product.create.colors');
    Route::get('/product/create/tags/{product}',[ProductCreateTagController::class,'create'])->name('product.create.tags');
    Route::get('/product-guarantee/index/{product}',[ProductWarrantyController::class,'create'])->name('product.guarantee.index');
});

// stock product routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/stock-product/index', [StockController::class, 'index'])->name('stock.product.index');

    Route::get('/add_to_stock/{product}', [StockController::class, 'addToStockForm'])->name('add_to_stock.form');
    Route::post('/add_to_stock', [StockController::class, 'addToStock'])->name('add_to_stock');

    Route::get('/modify_stock/{product}', [StockController::class, 'modifyStockForm'])->name('modify_stock.form');
    Route::post('/modify_stock', [StockController::class, 'modifyStock'])->name('modify_stock');

});

// payments routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/payments-all/index', [PaymentController::class, 'index'])->name('payments.all.index');

    Route::get('/payments-offline/index', [PaymentController::class, 'offline'])->name('payments.offline.index');
    Route::get('/payments-online/index', [PaymentController::class, 'online'])->name('payments.online.index');
    Route::get('/payments-cash/index', [PaymentController::class, 'cash'])->name('payments.cash.index');

    Route::get('/payment-canceled/{payment}', [PaymentController::class, 'canceled'])->name('payment.canceled');
    Route::get('/payment-returned/{payment}', [PaymentController::class, 'retuned'])->name('payment.returned');

    Route::get('/payment-show/{payment}', [PaymentController::class, 'show'])->name('payment.show');

});

// common discount routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/common-discount/index', [CommonDiscountController::class, 'index'])->name('common.discount.index');

    Route::get('/common-discount/create', [CommonDiscountController::class, 'create'])->name('common.discount.create');
    Route::post('/common-discount/store', [CommonDiscountController::class, 'store'])->name('common.discount.store');

    Route::get('/common-discount/edit/{discount}', [CommonDiscountController::class, 'edit'])->name('common.discount.edit');
    Route::post('/common-discount/update', [CommonDiscountController::class, 'update'])->name('common.discount.update');

});

// amazing sale routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/amazing-sale/index', [AmazingSalesController::class, 'index'])->name('amazing.sale.index');

    Route::get('/amazing-sale/create', [AmazingSalesController::class, 'create'])->name('amazing.sale.create');
    Route::post('/amazing-sale/store', [AmazingSalesController::class, 'store'])->name('amazing.sale.store');

    Route::get('/amazing-sale/edit/{amazingSale}', [AmazingSalesController::class, 'edit'])->name('amazing.sale.edit');
    Route::post('/amazing-sale/update', [AmazingSalesController::class, 'update'])->name('amazing.sale.update');

});

// coupon routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/coupons/index', [CouponDiscountController::class, 'index'])->name('coupons.index');

    Route::get('/coupons/create', [CouponDiscountController::class, 'create'])->name('coupons.create');
    Route::post('/coupons/store', [CouponDiscountController::class, 'store'])->name('coupons.store');

    Route::get('/coupons/edit/{coupon}', [CouponDiscountController::class, 'edit'])->name('coupons.edit');
    Route::post('/coupons/update', [CouponDiscountController::class, 'update'])->name('coupons.update');

});


// order routes

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/all-orders', AdminAllOrders::class)->name('orders.index');

    Route::get('/orders-new', [AdminOrderController::class, 'newOrders'])->name('orders.new');

    Route::get('/orders-sending', [AdminOrderController::class, 'sending'])->name('orders.sending');

    Route::get('/orders-unpaid', [AdminOrderController::class, 'unpaid'])->name('orders.unpaid');

    Route::get('/orders-canceled', [AdminOrderController::class, 'canceled'])->name('orders.canceled');

    Route::get('/orders-returned', [AdminOrderController::class, 'returned'])->name('orders.returned');

    Route::get('/show-order/{order}', [AdminOrderController::class, 'show'])->name('order.show');

    Route::get('/order-details/{order}', [AdminOrderController::class, 'details'])->name('order.details');

});

// shipment routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/delivery/index', AdminDelivery::class)->name('delivery.index');
    Route::get('/delivery/create', [DeliveryController::class, 'create'])->name('delivery.create');
    Route::post('/delivery/store', [DeliveryController::class, 'store'])->name('delivery.store');
    Route::get('/delivery/edit/{delivery}', [DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::post('/delivery/update', [DeliveryController::class, 'update'])->name('delivery.update');

});

// province routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/province/index',[AdminProvinceController::class,'index'])->name('province.index');
    Route::post('/province/store',[AdminProvinceController::class,'store'])->name('province.store');

    Route::get('/province/edit/{province}',[AdminProvinceController::class,'edit'])->name('province.edit');
    Route::post('/province/update',[AdminProvinceController::class,'update'])->name('province.update');

    Route::get('/province/delete/{province}',[AdminProvinceController::class,'delete'])->name('province.delete');

});
// cities routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/city/create',[AdminCityController::class,'create'])->name('city.create');
    Route::post('/city/store',[AdminCityController::class,'store'])->name('city.store');

    Route::get('/city/edit/{city}',[AdminCityController::class,'edit'])->name('city.edit');
    Route::post('/city/update',[AdminCityController::class,'update'])->name('city.update');

    Route::post('/city/delete/{city}',[AdminCityController::class,'delete'])->name('city.delete');

});
// ticket routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/category-tickets',[AdminCategoryTicketController::class,'categoryTickets'])->name('category.tickets');
    Route::get('/category-ticket/create',[AdminCategoryTicketController::class,'create'])->name('category.ticket.create');
    Route::post('/category-ticket/store',[AdminCategoryTicketController::class,'store'])->name('category.ticket.store');
    Route::get('/category-ticket/edit/{ticketCategory}',[AdminCategoryTicketController::class,'edit'])->name('category.ticket.edit');
    Route::post('/category-ticket/update',[AdminCategoryTicketController::class,'update'])->name('category.ticket.update');

    Route::get('/priority-tickets',[AdminPriorityTicketController::class,'priorityTickets'])->name('priority.tickets');
    Route::get('/priority-ticket/create',[AdminPriorityTicketController::class,'create'])->name('priority.ticket.create');
    Route::post('/priority-ticket/store',[AdminPriorityTicketController::class,'store'])->name('priority.ticket.store');
    Route::get('/priority-ticket/edit/{ticketPriority}',[AdminPriorityTicketController::class,'edit'])->name('priority.ticket.edit');
    Route::post('/priority-ticket/update',[AdminPriorityTicketController::class,'update'])->name('priority.ticket.update');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/all-tickets', [AdminTicketController::class, 'allTickets'])->name('all.tickets');
    Route::get('/new-tickets', [AdminTicketController::class, 'newTickets'])->name('new.tickets');
    Route::get('/open-tickets', [AdminTicketController::class, 'openTickets'])->name('open.tickets');
    Route::get('/close-tickets', [AdminTicketController::class, 'closeTickets'])->name('close.tickets');
    Route::get('/show-ticket/{ticket}', [AdminTicketController::class, 'showTicket'])->name('show.ticket');
    Route::post('/answer-ticket/{ticket}', [AdminTicketController::class,'answer'])->name('answer.ticket');
    Route::get('/change-status/ticket/{ticket}', [AdminTicketController::class,'changeStatus'])->name('change.status.ticket');

});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verify_admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/admin-tickets/index', [AdminAdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/set/admin-ticket/{admin}', [AdminAdminTicketController::class, 'setAdmin'])->name('set.admin.ticket');

});

// comments routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/product_comments/index', [AdminCommentController::class, 'productIndexComments'])->name('product_comments.index');
    Route::get('/comments/index/product/{product}', [AdminCommentController::class, 'productComments'])->name('comments.index.product');
    Route::get('/comment/show/{comment}', AdminSingleComment::class)->name('comment.show');

});


// setting routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/setting/index', AdminSetting::class)->name('setting.index');
    Route::get('/setting/edit/{setting}',[SettingController::class,'edit'])->name('setting.edit');
    Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');

});

//// banners routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin|super_admin'])->group(function () {

    // top banner
    Route::get('/top-banner/index', AdminTopBanner::class)->name('top.banner.index');

    Route::get('/top-banner/create',[TopBannerController::class,'create'])->name('top.banner.create');
    Route::post('/top-banner/store', [TopBannerController::class,'store'])->name('top.banner.store');

    Route::get('/top-banner/edit/{banner}', [TopBannerController::class, 'edit'])->name('top.banner.edit');
    Route::post('/top-banner/update', [TopBannerController::class, 'update'])->name('top.banner.update');

    // main slider banner

    Route::get('/main-slider/index', AdminMainSlider::class)->name('main.slider.index');

    Route::get('/main-slider/create',[MainSliderController::class,'create'])->name('main.slider.create');
    Route::post('/main-slider/store', [MainSliderController::class,'store'])->name('main.slider.store');

    Route::get('/main-slider/edit/{banner}', [MainSliderController::class, 'edit'])->name('main.slider.edit');
    Route::post('/main-slider/update', [MainSliderController::class, 'update'])->name('main.slider.update');

    // amazing_offer_banner

    Route::get('/amazing-banner/index', AdminAmazingOfferBanner::class)->name('amazing.banner.index');

    Route::get('/amazing-banner/create',[AmazingOfferBannerController::class,'create'])->name('amazing.banner.create');
    Route::post('/amazing-banner/store', [AmazingOfferBannerController::class,'store'])->name('amazing.banner.store');

    Route::get('/amazing-banner/edit/{banner}', [AmazingOfferBannerController::class, 'edit'])->name('amazing.banner.edit');
    Route::post('/amazing-banner/update', [AmazingOfferBannerController::class, 'update'])->name('amazing.banner.update');

    // bottom two banner

    Route::get('/bottom-banner/index', AdminBottomTwoBanner::class)->name('bottom.banner.index');

    Route::get('/bottom-banner/create',[BottomBannerController::class,'create'])->name('bottom.banner.create');
    Route::post('/bottom-banner/store', [BottomBannerController::class,'store'])->name('bottom.banner.store');

    Route::get('/bottom-banner/edit/{banner}', [BottomBannerController::class, 'edit'])->name('bottom.banner.edit');
    Route::post('/bottom-banner/update', [BottomBannerController::class, 'update'])->name('bottom.banner.update');


    // product by category slider
    Route::get('/product-category/index', [ProductByCategorySliderController::class, 'index'])->name('product.category.index');
    Route::post('/product-category/store', [ProductByCategorySliderController::class, 'store'])->name('product.category.store');
    Route::get('/product-category/destroy/{category}', [ProductByCategorySliderController::class, 'destroy'])->name('product.category.destroy');


});

// notification routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/notification/read-all', [NotificationController::class, 'readNotifications'])->name('notification.read.all');

});

// Notifications email& sms
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin|super_admin'])->group(function () {


    //// email notices routes
    Route::get('/email-notices/index',[AdminEmailNoticesController::class,'index'])->name('email.notices.index');
    // create
    Route::get('/email-notices/create',[AdminEmailNoticesController::class,'create'])->name('email.notices.create');
    Route::post('/email-notices/store',[AdminEmailNoticesController::class,'store'])->name('email.notices.store');
    // edit
    Route::get('/email-notices/edit/{publicMail}',[AdminEmailNoticesController::class,'edit'])->name('email.notices.edit');
    Route::post('/email-notices/update',[AdminEmailNoticesController::class,'update'])->name('email.notices.update');
    // send mail
    Route::get('/send-mail/{mail}',[AdminEmailNoticesController::class,'sendMail'])->name('notices.send.mail');

    //// sms notices routes
    Route::get('/sms-notices/index',[AdminSMSNoticeController::class,'index'])->name('sms.notices.index');
    // create
    Route::get('/sms-notices/create',[AdminSMSNoticeController::class,'create'])->name('sms.notices.create');
    Route::post('/sms-notices/store',[AdminSMSNoticeController::class,'store'])->name('sms.notices.store');
    // edit
    Route::get('/sms-notices/edit/{publicSms}',[AdminSMSNoticeController::class,'edit'])->name('sms.notices.edit');
    Route::post('/sms-notices/update',[AdminSMSNoticeController::class,'update'])->name('sms.notices.update');
    // send sms
    Route::get('/send-sms/{publicSms}',[AdminSMSNoticeController::class,'sendSms'])->name('notices.send.sms');

});


// email notices  file routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin|super_admin'])->group(function () {

    Route::get('/email-notice-file/index',[AdminEmailNoticeFileController::class,'emailFileIndex'])->name('email.notice.file.index');
    Route::get('/email-notice-file/create',[AdminEmailNoticeFileController::class,'create'])->name('email.notice.file.create');
    Route::post('/email-notice-file/store',[AdminEmailNoticeFileController::class,'store'])->name('email.notice.file.store');

});
