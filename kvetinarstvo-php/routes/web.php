<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WishlistController;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', function () { return view('about'); });
Route::post('/cart/add-bundle', [CartController::class, 'addBundle'])->name('cart.addBundle');

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
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category.show');


// Wishlist
Route::middleware('auth')->group(function () {
    Route::get('/wishlist',         [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add',    [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',  function () { return view('profile'); })->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

// Admin
Route::get('/admin/login', function () { return view('admin.login'); })->middleware('guest')->name('admin.login');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', function () { return view('admin.profile'); })->name('profile');
    Route::get('/products',                [\App\Http\Controllers\AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create',         [\App\Http\Controllers\AdminProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}/edit', [\App\Http\Controllers\AdminProductController::class, 'edit'])->name('products.edit');
});

require __DIR__.'/auth.php';
