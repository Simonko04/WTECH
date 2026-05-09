<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductImage;;

class AdminProductController extends Controller
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

        return view('admin.products', compact('products', 'categories', 'colors', 'priceMin', 'priceMax'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $colors = \App\Models\Color::all();
        return view('admin.create', compact('categories', 'colors'));
    }

    public function store(Request $request)
    {
        // 1. Validácia formulára
        $request->validate([
                'name'               => 'required|string|max:255',
                'price'              => 'required|numeric|min:0',
                'category_id'        => 'required|exists:categories,id',
                'color_id'           => 'required|exists:colors,id',
                'quantity_available' => 'required|integer|min:0', // <-- TOTO PRIBUDLO
                'short_description'  => 'required|string',
                'full_description'   => 'required|string',
                'images'             => 'required|array|min:1|max:4',
                'images.*'           => 'image|mimes:jpeg,png,jpg,webp|max:2048'
            ]);

        // 2. Vygenerovanie unikátneho slugu z názvu
        $slug = Str::slug($request->name);

        // Ochrana, aby nebol duplicitný slug (pridá -1, -2 atď.)
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

         $product = Product::create([
                'name'               => $request->name,
                'slug'               => $slug,
                'price'              => $request->price,
                'category_id'        => $request->category_id,
                'color_id'           => $request->color_id,
                'short_description'  => $request->short_description,
                'full_description'   => $request->full_description,
                'quantity_available' => $request->quantity_available,
            ]);

        if ($request->hasFile('images')) {
            $index = 1;
            foreach ($request->file('images') as $file) {


                $extension = $file->getClientOriginalExtension();


                $filename = $slug . '_' . $index . '.' . $extension;

                $file->move(public_path('img'), $filename);


                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => 'img/' . $filename
                ]);

                $index++;
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produkt bol úspešne pridaný a obrázky boli uložené do zložky img!');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = \App\Models\Category::all();
        $colors = \App\Models\Color::all();
        return view('admin.edit', compact('product', 'categories', 'colors'));
    }

        public function update(Request $request, Product $product)
        {
            $request->validate([
                'name'               => 'required|string|max:255|unique:products,name,' . $product->id,
                'price'              => 'required|numeric|min:0',
                'category_id'        => 'required|exists:categories,id',
                'color_id'           => 'required|exists:colors,id',
                'quantity_available' => 'required|integer|min:0',
                'short_description'  => 'required|string',
                'full_description'   => 'required|string',
                'image_0'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'image_1'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'image_2'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'image_3'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $slug = $product->slug;
            if ($product->name !== $request->name) {
                $slug = \Illuminate\Support\Str::slug($request->name);
                $originalSlug = $slug;
                $counter = 1;
                while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }

            $product->update([
                'name'               => $request->name,
                'slug'               => $slug,
                'price'              => $request->price,
                'category_id'        => $request->category_id,
                'color_id'           => $request->color_id,
                'short_description'  => $request->short_description,
                'full_description'   => $request->full_description,
                'quantity_available' => $request->quantity_available,
            ]);

            for ($i = 0; $i < 4; $i++) {
                $fileInputName = 'image_' . $i;

                if ($request->hasFile($fileInputName)) {
                    $file = $request->file($fileInputName);

                    if ($file->isValid()) {
                        $existingImage = $product->images->get($i);
                        if ($existingImage) {
                            $existingImage->delete();
                        }

                        $extension = $file->getClientOriginalExtension();
                        $filename = $slug . '_' . ($i + 1) . '_' . time() . '.' . $extension;

                        $file->move(public_path('img'), $filename);

                        \App\Models\ProductImage::create([
                            'product_id' => $product->id,
                            'path'       => 'img/' . $filename
                        ]);
                    }
                }
            }

            return redirect()->route('admin.products.index')->with('success', 'Produkt bol úspešne upravený!');
        }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            $filePath = public_path($image->path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produkt bol vymazaný.');
    }
}
