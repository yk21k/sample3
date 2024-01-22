<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProductController;

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

});

Route::match(['GET', 'POST'], 'admin/login', [AdminController::class, 'login']);

