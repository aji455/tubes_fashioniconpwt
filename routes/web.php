<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// ==============================
// CART — dapat digunakan oleh Guest & Customer
// ==============================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::match(['put', 'post'], '/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// ==============================
// FRONTEND (Customer Only)
// ==============================
Route::middleware(\App\Http\Middleware\CustomerOnly::class)->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Products
    Route::get('/product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product/category/{slug}', [ProductController::class, 'byCategory'])->name('products.byCategory');

    // Categories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/category/{slug}', [CategoriesController::class, 'show'])->name('categories.show');

    // Auth (login/register customer)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ==============================
    // PROTECTED (HARUS LOGIN CUSTOMER)
    // ==============================
    Route::middleware('auth')->group(function () {

        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/checkout/confirm/{id}', [CheckoutController::class, 'confirm'])
            ->name('checkout.confirm');

        Route::get('/payment/success/{order_id}', [CheckoutController::class, 'success'])
            ->name('payment.success');







        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});
