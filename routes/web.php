<?php

use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainPageController::class, 'index'])->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/order/create', [CartController::class, 'create'])->name('order.create');
    Route::get('/order/confirmation/{id}', [CartController::class, 'confirmation'])->name('order.confirmation');
});

Route::group(['middleware' => isAdmin::class], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        Route::resource('categories', AdminCategoriesController::class);
        Route::resource('orders', AdminOrdersController::class);
        Route::resource('products', AdminProductsController::class);
    });
});

Auth::routes();
