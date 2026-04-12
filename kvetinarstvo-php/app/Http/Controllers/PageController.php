<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $products = \App\Models\Product::with('images')->latest()->take(4)->get();

        $bundleProducts = \App\Models\Product::with('images')->latest()->take(6)->get();
        $bundles = $bundleProducts->chunk(2)->filter(fn($chunk) => $chunk->count() === 2)->values();

        return view('home', compact('products', 'bundles'));
    }
    public function about() { return view('about'); }
    public function cart() { return view('cart'); }
    public function checkout() { return view('checkout'); }
    public function history() { return view('history'); }
    public function login() { return view('login'); }
    public function product() { return view('product'); }
    public function profile() { return view('profile'); }
    public function register() { return view('register'); }
    public function search() { return view('search'); }
    public function wishlist() { return view('wishlist'); }
}
