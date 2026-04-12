<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('/', function () { return view('home'); });
Route::get('/about', function () { return view('about'); });

// Cart
Route::get('/cart',         [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add',    [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout — dostupný aj pre hostí
Route::get('/checkout',                      [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout',                     [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/payment',              [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/checkout/payment',             [CheckoutController::class, 'processPayment'])->name('checkout.payment.process');
Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Products
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search',         [ProductController::class, 'index'])->name('search');

// Wishlist
Route::get('/wishlist', function () { return view('wishlist'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',  function () { return view('profile'); })->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';
