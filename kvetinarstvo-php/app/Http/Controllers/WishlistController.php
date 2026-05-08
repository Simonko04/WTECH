<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private function getWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $items = Wishlist::where('user_id', Auth::id())->get();
        $wishlist = [];

        foreach ($items as $item) {
            if (!$item->product) continue;
            $wishlist[$item->product_id] = [
                'name'     => $item->product->name,
                'price'    => $item->product->price,
                'image'    => $item->product->images->first()->path ?? '',
                'slug'     => $item->product->slug,
            ];
        }
        return $wishlist;
    }

    // Zobraziť wishlist
    public function index()
    {
        $wishlist = $this->getWishlist();
        return view('wishlist', compact('wishlist'));
    }

    // Pridať do wishlistu
    public function add(Request $request)
    {
        $product = Product::with('images')->findOrFail($request->product_id);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Produkt je už v zozname želaní.');
        }

        Wishlist::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Produkt bol pridaný do zoznam želaní.');
    }

    // Odstrániť z wishlistu
    public function remove(Request $request)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->delete();

        return redirect()->back()->with('success', 'Produkt bol odstránený zo zoznam želaní.');
    }

    // Presunúť z wishlistu do košíka
    public function moveToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = max(1, (int) $request->quantity ?? 1);

        // Pridať do košíka
        $cartController = new CartController();
        $cartController->add(new Request([
            'product_id' => $product->id,
            'quantity'   => $quantity,
        ]));

        // Odstrániť z wishlistu
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->back()->with('success', 'Produkt bol presunutý do košíka.');
    }
}
