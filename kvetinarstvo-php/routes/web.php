<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () { return view('home'); });
Route::get('/about', function () { return view('about'); });
Route::get('/cart',           [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add',      [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',   [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',   [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', function () { return view('checkout'); });
Route::get('/history', function () { return view('history'); });
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [ProductController::class, 'index'])->name('search');
Route::get('/wishlist', function () { return view('wishlist'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () { return view('profile'); })->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
