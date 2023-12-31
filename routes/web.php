<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
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




});

Route::match(['GET', 'POST'], 'admin/login', [AdminController::class, 'login']);

