<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});


Route::get('/', function () {return view('home');});

Route::get('/about', function () {return view('about');});
Route::get('/cart', function () {return view('cart');});
Route::get('/checkout', function () {return view('checkout');});
Route::get('/history', function () {return view('history');});
Route::get('/login', function () {return view('login');});
Route::get('/product', function () {return view('product');});
Route::get('/profile', function () {return view('profile');});
Route::get('/register', function () {return view('register');});
Route::get('/search', function () {return view('search');});
Route::get('/wishlist', function () {return view('wishlist');});
