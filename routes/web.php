<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\NewsController;

// ============================================
// ROUTE USER (KHÔNG LOGIN)
// ============================================
Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');
Route::get('/about-us', [Controller::class, 'about']);
Route::get('/products', [Controller::class, 'product']);
Route::get('/product-detail/{id}', [Controller::class, 'productDetail']);
Route::get('/news', [Controller::class, 'news']);
Route::get('/news-detail/{id}', [Controller::class, 'newsDetail']);


// ============================================
// ADMIN
// ============================================

Route::prefix('admin')->group(function () {

    // ----- Login -----
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);

    // ----- Protected routes -----
    Route::middleware('auth:admin')->group(function () {

        // dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('adminDashboard');
        Route::get('/dashboard', [AdminController::class, 'getInformation'])->name('get.information');
        Route::post('/dashboard', [AdminController::class, 'updateInformation'])->name('update.information');
        Route::get('/dashboard/banner', [AdminController::class, 'getBanner'])->name('get.banner');
        Route::post('/dashboard/banner', [AdminController::class, 'updateBanner'])->name('update.banner');

        // Product
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/insert', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/insert', [ProductController::class, 'store'])->name('products.insert');
        Route::get('/products/update/{id}', [ProductController::class, 'getUpdate'])->name('getUpdate');
        Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');

        // Vendor
        Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
        Route::post('/vendor/insert', [VendorController::class, 'store'])->name('vendor.insert');
        Route::post('/vendor/update/{id}', [VendorController::class, 'update'])->name('vendor.update');
        Route::delete('/vendor/delete/{id}', [VendorController::class, 'delete'])->name('vendor.delete');

        // News
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/insert', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news/insert', [NewsController::class, 'store'])->name('news.insert');
        Route::get('/news/update/{id}', [NewsController::class, 'getUpdate'])->name('news.getUpdate');
        Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');

        // logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });

});
