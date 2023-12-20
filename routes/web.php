<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;

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
    Route::match(['GET', 'POST'], 'admin/add-edit-cms-page', [CmsController::class, 'edit']);

});

Route::match(['GET', 'POST'], 'admin/login', [AdminController::class, 'login']);

