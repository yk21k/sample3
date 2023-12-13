<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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
});

Route::match(['GET', 'POST'], 'admin/login', [AdminController::class, 'login']);

