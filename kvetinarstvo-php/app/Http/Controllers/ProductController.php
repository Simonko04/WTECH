<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['images', 'category', 'color'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('images')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->limit(3)
            ->get();

        // fallback ak nejsu 3 v danej katogorii, dopln random
        if ($relatedProducts->count() < 3) {
            $exclude = $relatedProducts->pluck('id')->push($product->id);
            $fill = Product::with('images')
                ->whereNotIn('id', $exclude)
                ->inRandomOrder()
                ->limit(3 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->concat($fill);
        }


        return view('product', compact('product','relatedProducts'));
    }
}