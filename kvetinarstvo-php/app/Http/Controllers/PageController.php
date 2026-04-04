<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() { return view('home'); }
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
