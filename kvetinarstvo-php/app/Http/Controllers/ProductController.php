<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{   
    public function index(Request $request)
    {
        $query = Product::with('images');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->whereRaw("unaccent(name) ILIKE unaccent(?)", ["%{$search}%"])
                ->orWhereRaw("unaccent(short_description) ILIKE unaccent(?)", ["%{$search}%"])
                ->orWhereRaw("unaccent(full_description) ILIKE unaccent(?)", ["%{$search}%"]);
            });
        }

        if ($request->filled('category')) {
            $categories = (array) $request->category;
            $query->whereIn('category_id', $categories);
        }

        if ($request->filled('color')) {
            $colors = (array) $request->color;
            $query->whereIn('color_id', $colors);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        if ($request->filled('in_stock')) {
            $query->where('quantity_available', '>', 0);
        }

        $priceBaseQuery = clone $query;
        $priceMin = (clone $priceBaseQuery)->min('price');
        $priceMax = (clone $priceBaseQuery)->max('price');

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }


        $products = $query->paginate(9)->withQueryString();
        $categories = \App\Models\Category::all();
        $colors = \App\Models\Color::all();

        return view('search', compact('products', 'categories', 'colors', 'priceMin', 'priceMax'));
    }


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

    public function category(Request $request, $slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $allCategories = \App\Models\Category::all();

        $query = Product::with('images')
            ->where('category_id', $category->id);

        if ($request->filled('color')) {
            $colors = (array) $request->color;
            $query->whereIn('color_id', $colors);
        }

        if ($request->filled('in_stock')) {
            $query->where('quantity_available', '>', 0);
        }

        $priceBaseQuery = clone $query;
        $priceMin = (clone $priceBaseQuery)->min('price');
        $priceMax = (clone $priceBaseQuery)->max('price');

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = $allCategories;
        $colors = \App\Models\Color::all();

        return view('category', compact(
            'products', 'categories', 'colors',
            'priceMin', 'priceMax', 'category', 'allCategories'
        ));
    }

}