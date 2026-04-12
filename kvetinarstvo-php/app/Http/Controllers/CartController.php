<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            $items = Cart::where('user_id', Auth::id())->get();
            $cart = [];
            foreach ($items as $item) {
                $cart[$item->product_id] = [
                    'name'     => $item->product->name,
                    'price'    => $item->product->price,
                    'quantity' => $item->quantity,
                    'image'    => $item->product->images->first()->path ?? '',
                    'slug'     => $item->product->slug,
                ];
            }
            return $cart;
        }

        return session()->get('cart', []);
    }

    public function index()
    {
        $cart = $this->getCart();
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $product  = Product::with('images')->findOrFail($request->product_id);
        $quantity = max(1, (int) $request->quantity);

        $alreadyInCart = 0;

        if (Auth::check()) {
            $existing = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)->first();
            $alreadyInCart = $existing ? $existing->quantity : 0;
        } else {
            $cart = session()->get('cart', []);
            $alreadyInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
        }

        if (($alreadyInCart + $quantity) > $product->quantity_available) {
            return redirect()->back()->with('error',
                "Ľutujeme, máme k dispozícii iba {$product->quantity_available} ks produktu \"{$product->name}\""
            );
        }

        if (Auth::check()) {
            $item = Cart::firstOrNew([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
            ]);
            $item->quantity = ($item->exists ? $item->quantity : 0) + $quantity;
            $item->save();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    'name'     => $product->name,
                    'price'    => $product->price,
                    'quantity' => $quantity,
                    'image'    => $product->images->first()->path ?? '',
                    'slug'     => $product->slug,
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produkt bol pridaný do košíka.');
    }

    public function update(Request $request)
    {
        $quantity = (int) $request->quantity;

        if (Auth::check()) {
            if ($quantity < 1) {
                Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)->delete();
            } else {
                $product = Product::findOrFail($request->product_id);
                if ($quantity > $product->quantity_available) {
                    return redirect()->route('cart.index')->with('error',
                        "Maximálne dostupné množstvo je {$product->quantity_available} ks."
                    );
                }
                Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->update(['quantity' => $quantity]);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->product_id])) {
                if ($quantity < 1) {
                    unset($cart[$request->product_id]);
                } else {
                    $product = Product::findOrFail($request->product_id);
                    if ($quantity > $product->quantity_available) {
                        return redirect()->route('cart.index')->with('error',
                            "Maximálne dostupné množstvo je {$product->quantity_available} ks."
                        );
                    }
                    $cart[$request->product_id]['quantity'] = $quantity;
                }
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function addBundle(Request $request): RedirectResponse
    {
        $ids = [$request->product1_id, $request->product2_id];

        foreach ($ids as $productId) {
            if (Auth::check()) {
                $item = \App\Models\Cart::firstOrNew([
                    'user_id'    => Auth::id(),
                    'product_id' => $productId,
                ]);
                $item->quantity = ($item->exists ? $item->quantity : 0) + 1;
                $item->save();
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += 1;
                } else {
                    $product = \App\Models\Product::find($productId);
                    $cart[$productId] = ['quantity' => 1, 'price' => $product->price];
                }
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('bundle_success', 'Oba produkty boli pridané do košíka!');
    }
}
