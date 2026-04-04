<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); });
Route::get('/about', function () { return view('about'); });
Route::get('/cart', function () { return view('cart'); });
Route::get('/checkout', function () { return view('checkout'); });
Route::get('/history', function () { return view('history'); });
Route::get('/product', function () { return view('product'); });
Route::get('/search', function () { return view('search'); });
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
