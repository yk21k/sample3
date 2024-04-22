<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\UsersProfileController;
use App\Http\Controllers\Admin\CustomerContactsController;
use App\Http\Controllers\Admin\ChatContorller;

use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\AddressController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\UserProfileController;
use App\Http\Controllers\Front\CustomerContactController;
use App\Http\Controllers\Front\PaypalController;


use App\Models\Category;

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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', [IndexController::class, 'index']);

    // Listing/Categories Routes
    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url');
    // dd($catUrls);
    foreach($catUrls as $key => $url){
        Route::get($url, [ProductController::class, 'listing']);
    }

    // Product Detail Page
    Route::get('product/{id}', [ProductController::class, 'detail']);

    // Get Product Attribute Price
    Route::post('get-attribute-price', [ProductController::class, 'getAttributePrice']);

    // Add to Cart
    Route::post('/add-to-cart', [ProductController::class, 'addToCart']);

    // Shopping Cart
    Route::get('cart', [ProductController::class, 'cart']);

    // Update Cart Item Quantity
    Route::post('update-cart-item-qty', [ProductController::class, 'updateCartItemQty']);

    // Delete Cart Item
    Route::post('delete-cart-item', [ProductController::class, 'deleteCartItem']);

    // Empty Cart
    Route::post('empty-cart', [ProductController::class, 'emptyCart']);

    // User Login
    Route::match(['get', 'post'], 'user/login', [UserController::class, 'loginUser'])->name('login');

    // User Register
    Route::match(['get', 'post'], 'user/register', [UserController::class, 'registerUser']);

    // User Comfirm Account
    Route::match(['get', 'post'], 'user/confirm/{code}', [UserController::class, 'confirmAccount']);

    Route::group(['middleware'=>['auth']], function(){
        
        // User Account
        Route::match(['get', 'post'], 'user/account', [UserController::class, 'account']);

        // User Change Password
        Route::match(['get', 'post'], 'user/update-password', [UserController::class, 'updatePassword']);

        // User Logout
        Route::get('user/logout', [UserController::class, 'logoutUser']);

        // Delete Account
        Route::get('user/delete-page', [UserController::class, 'deleteUserAccountPage']);
        Route::post('user/delete', [UserController::class, 'deleteUserAccount'])->name('user.withdrawal');

        // Apply Coupon
        Route::post('/apply-coupon', [ProductController::class, 'applyCoupon']);

        // Checkout
        Route::match(['get', 'post'], '/checkout', [ProductController::class, 'checkout']);

        // Save Delivery Address
        Route::post('save-delivery-address', [AddressController::class, 'saveDeliveryAddress']);

        // Get Delivery Address
        Route::post('get-delivery-address', [AddressController::class, 'getDeliveryAddress']);

        // Remove Delivery Address
        Route::post('remove-delivery-address', [AddressController::class, 'removeDeliveryAddress']);

        // Set Default Delivery Address
        Route::post('set-default-delivery-address', [AddressController::class, 'setDefaultDeliveryAddress']);

        // Order Thanks Page
        Route::get('/thanks', [ProductController::class, 'thanks']);

        // My Orders
        Route::get('user/orders', [OrderController::class, 'orders']);
        Route::get('user/orders/{id}', [OrderController::class, 'orderDetails']);

        // Paypal 
        Route::get('/paypal', [PaypalController::class, 'paypal']);
        Route::post('/pay', [PaypalController::class, 'pay'])->name('payment');
        Route::get('success', [PaypalController::class, 'success']);
        Route::get('error', [PaypalController::class, 'error']);



        // Upload ID
        Route::get('user/upload_page', [UserProfileController::class, 'uploadPage']);
        Route::post('user/upload_page_confirm', [UserProfileController::class, 'uploadConfirm']);
        Route::post('user/upload_page_complete', [UserProfileController::class, 'uploadComplete']);

        // Customer Inquiry
        Route::match(['get', 'post'], 'user/customer-inquiries', [CustomerContactController::class, 'inquiryAnswer']);
        Route::get('user/your-inquiries/{user_id}', [CustomerContactController::class, 'pastInquiry']);


    });

    // Forgot Password
    Route::match(['get', 'post'], 'user/forgot-password', [UserController::class, 'forgotPassword']);

    // Reset Pasword
    Route::match(['get', 'post'], 'user/reset-password/{code?}', [UserController::class, 'resetPassword']);

    // 3Dtest page
    Route::get('3dtest', [IndexController::class, 'dtest']);

    // Privacy policy page
    Route::get('privacy-policy', [IndexController::class, 'privacypoliPage']);

    // Terms service page
    Route::get('terms-service', [IndexController::class, 'termsofservicePage']);

    // Cookie policy page
    Route::get('cookie-policy', [IndexController::class, 'cookiepoliPage']);

    // Search Page
    Route::match(['get', 'post'], '/search', [IndexController::class, 'searchTest']);


});



Route::middleware('admin')->group(function(){
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin/logout', [AdminController::class, 'logout']);
    Route::match(['GET', 'POST'], 'admin/update-password', [AdminController::class, 'updatePassword']);
    Route::match(['GET', 'POST'], 'admin/update-details', [AdminController::class, 'updateDetails']);
    Route::post('admin/check-current-password', [AdminController::class, 'checkCurrentPassword']);
      

    // Display CMS Pages (CRUD - READ)
    Route::get('admin/cms-pages', [CmsController::class, 'index']);
    Route::post('admin/update-cms-page-status', [CmsController::class, 'update']);
    Route::match(['GET', 'POST'], 'admin/add-edit-cms-page/{id?}', [CmsController::class, 'edit']);
    Route::get('admin/delete-cms-page/{id?}', [CmsController::class, 'destroy']);

    // Sub Admins
    Route::get('admin/subadmins', [AdminController::class, 'subadmins']);
    Route::post('admin/update-subadmin-status', [AdminController::class, 'updateSubadminStatus']);
    Route::match(['GET', 'POST'], 'admin/add-edit-subadmin/{id?}', [AdminController::class, 'addEditSubadmin']);
    Route::get('admin/delete-subadmin/{id?}', [AdminController::class, 'deleteSubadmin']);
    Route::match(['GET', 'POST'], 'admin/update-role/{id?}', [AdminController::class, 'updateRole']);

    // Categories
    Route::get('admin/categories', [CategoryController::class, 'categories']);
    Route::post('admin/update-category-status', [CategoryController::class, 'updateCategoryStatus']);
    Route::get('admin/delete-category/{id?}', [CategoryController::class, 'deleteCategory']);
    Route::get('admin/delete-category-image/{id?}', [CategoryController::class, 'deleteCategoryImage']);
    Route::match(['get', 'post'], 'admin/add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);

    // Products
    Route::get('admin/products', [ProductsController::class, 'products']);
    Route::post('admin/update-product-status', [ProductsController::class, 'updateProductStatus']);
    Route::get('admin/delete-product/{id?}', [ProductsController::class, 'deleteProduct']);
    Route::match(['get', 'post'], 'admin/add-edit-product/{id?}', [ProductsController::class, 'addEditProduct']);

    // Product Images
    Route::get('admin/delete-product-image/{id?}', [ProductsController::class, 'deleteProductsImage']);

    // Product Video
    Route::get('admin/delete-product-video/{id?}', [ProductsController::class, 'deleteProductsVideo']);

    // Product Attritubes
    Route::post('admin/update-attribute-status', [ProductsController::class, 'updateAttributeStatus']);
    Route::get('admin/delete-attribute/{id?}', [ProductsController::class, 'deleteAttribute']);

    // Brands
    Route::get('admin/brands', [BrandController::class, 'brands']);
    Route::post('admin/update-brand-status', [BrandController::class, 'updateBrandStatus']);
    Route::get('admin/delete-brand/{id?}', [BrandController::class, 'deleteBrand']);
    Route::match(['get', 'post'], 'admin/add-edit-brand/{id?}', [BrandController::class, 'addEditBrand']);
    Route::get('admin/delete-brand-image/{id?}', [BrandController::class, 'deleteBrandImage']);
    Route::get('admin/delete-brand-logo/{id?}', [BrandController::class, 'deleteBrandLogo']);

    // Banners
    Route::get('admin/banners', [BannersController::class, 'banners']);
    Route::post('admin/update-banner-status', [BannersController::class, 'updateBannerStatus']);
    Route::get('admin/delete-banner/{id?}', [BannersController::class, 'deleteBanner']);
    Route::match(['get', 'post'], 'admin/add-edit-banner/{id?}', [BannersController::class, 'addEditBanner']);

    // Coupons
    Route::get('admin/coupons', [CouponsController::class, 'coupons']);
    Route::post('admin/update-coupon-status', [CouponsController::class, 'updateCouponStatus']);
    Route::get('admin/delete-coupon/{id?}', [CouponsController::class, 'deleteCoupon']);
    Route::match(['get', 'post'], 'admin/add-edit-coupon/{id?}', [CouponsController::class, 'addEditCoupon']);

    // User
    Route::get('admin/users', [UsersController::class, 'users']);
    Route::post('admin/update-user-status', [UsersController::class, 'updateUserStatus']);

    // View Order
    Route::get('admin/orders', [OrdersController::class, 'orders']);

    // Orders Detail
    Route::get('admin/orders/{id}', [OrdersController::class, 'orderDetails']);

    // Print HTML Order Invoice
    Route::get('admin/print-order-invoice/{id}', [OrdersController::class, 'printHTMLOrderInvoice']);

    // Print PDF Order Invoice
    Route::get('admin/print-pdf-order-invoice/{id}', [OrdersController::class, 'printPDFOrderInvoice']);

    // Update Order Status
    Route::post('admin/update-order-status', [OrdersController::class, 'updateOrderStatus']);

    // ID
    Route::get('admin/users-prof', [UsersProfileController::class, 'usersProfile']);

    // Customer Inq
    Route::get('admin/users-inquiries', [CustomerContactsController::class, 'inquiryAnswers']);

    Route::match(['get', 'post'], 'admin/users-inquiries/{user_id}', [CustomerContactsController::class, 'inquiryAnswersDetails']);

    // Chat
    Route::get('admin/chat', [ChatContorller::class, 'chatIndex']);

    Route::post('admin/chat-send-message', [ChatContorller::class, 'sendMessage']);
    Route::post('admin/chat-receive-message', [ChatContorller::class, 'receiveMessage']);






});

Route::match(['GET', 'POST'], 'admin/login', [AdminController::class, 'login']);
Route::get('download-order-pdf-invoice/{id}', [OrdersController::class, 'printPDFOrderInvoice']);

