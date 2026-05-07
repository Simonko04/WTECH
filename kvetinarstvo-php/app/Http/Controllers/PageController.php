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
}
