<?php

namespace App\Http\Controllers;

use App\Models\BillingAddress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderContains;
use App\Models\Product;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private function getCart(): array
    {
        if (Auth::check()) {
            $items = Cart::where('user_id', Auth::id())->get();
            $cart  = [];
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

    private function shippingCost(string $method): float
    {
        return match($method) {
            'express' => 7.99,
            'pickup'  => 0.00,
            default   => 3.99,
        };
    }

    public function index()
    {
        $cart = $this->getCart();
        if (empty($cart)) return redirect()->route('cart.index');

        $shipping     = session('checkout.shipping_method', 'standard');
        $shippingCost = $this->shippingCost($shipping);
        $subtotal     = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        $total        = round($subtotal + $shippingCost, 2);

        return view('checkout.index', compact('cart', 'subtotal', 'shippingCost', 'total', 'shipping'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'            => [Auth::guest() ? 'required' : 'nullable', 'email', 'max:255'],
            'billing_name'     => ['required', 'string', 'max:255'],
            'billing_surname'  => ['required', 'string', 'max:255'],
            'billing_country'  => ['required', 'string', 'max:255'],
            'billing_street'   => ['required', 'string', 'max:255'],
            'billing_city'     => ['required', 'string', 'max:255'],
            'billing_state'    => ['nullable', 'string', 'max:255'],
            'billing_psc'      => ['required', 'string', 'max:15'],
            'shipping_method'  => ['required', 'in:standard,express,pickup'],
            'shipping_name'    => ['required_without:same_address', 'nullable', 'string', 'max:255'],
            'shipping_surname' => ['required_without:same_address', 'nullable', 'string', 'max:255'],
            'shipping_country' => ['required_without:same_address', 'nullable', 'string', 'max:255'],
            'shipping_street'  => ['required_without:same_address', 'nullable', 'string', 'max:255'],
            'shipping_city'    => ['required_without:same_address', 'nullable', 'string', 'max:255'],
            'shipping_state'   => ['nullable', 'string', 'max:255'],
            'shipping_psc'     => ['required_without:same_address', 'nullable', 'string', 'max:15'],
        ]);

        session(['checkout' => $request->except('_token')]);

        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $cart = $this->getCart();
        if (empty($cart))         return redirect()->route('cart.index');
        if (!session('checkout')) return redirect()->route('checkout.index');

        $shipping     = session('checkout.shipping_method', 'standard');
        $shippingCost = $this->shippingCost($shipping);
        $subtotal     = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        $total        = round($subtotal + $shippingCost, 2);

        return view('checkout.payment', compact('cart', 'subtotal', 'shippingCost', 'total'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => ['required', 'in:card,apple,google,bank'],
        ]);

        $cart = $this->getCart();
        if (empty($cart)) return redirect()->route('cart.index');

        $data = session('checkout');
        if (!$data) return redirect()->route('checkout.index');

        $shippingCost = $this->shippingCost($data['shipping_method']);
        $subtotal     = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        $total        = round($subtotal + $shippingCost, 2);
        $sameAddress  = isset($data['same_address']);

        $order = null;

        DB::transaction(function () use ($cart, $data, $request, $total, $sameAddress, &$order) {

            $billing = BillingAddress::create([
                'name'    => $data['billing_name'],
                'surname' => $data['billing_surname'],
                'country' => $data['billing_country'],
                'street'  => $data['billing_street'],
                'city'    => $data['billing_city'],
                'state'   => $data['billing_state'] ?? null,
                'psc'     => $data['billing_psc'],
            ]);

            $shipping = null;
            if (!$sameAddress) {
                $shipping = ShippingAddress::create([
                    'name'    => $data['shipping_name'],
                    'surname' => $data['shipping_surname'],
                    'country' => $data['shipping_country'],
                    'street'  => $data['shipping_street'],
                    'city'    => $data['shipping_city'],
                    'state'   => $data['shipping_state'] ?? null,
                    'psc'     => $data['shipping_psc'],
                ]);
            }

            $order = Order::create([
                'user_id'                   => Auth::id(),
                'email'                     => Auth::check() ? Auth::user()->email : $data['email'],
                'billing_address_id'        => $billing->id,
                'shipping_address_id'       => $shipping?->id,
                'status'                    => 'pending',
                'price_total'               => $total,
                'shipping_method'           => $data['shipping_method'],
                'shipping_customer_name'    => $data['billing_name'],
                'shipping_customer_surname' => $data['billing_surname'],
                'payment_method'            => $request->payment_method,
                'paid_at'                   => now(),
            ]);

            foreach ($cart as $productId => $item) {
                OrderContains::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
                Product::where('id', $productId)
                    ->decrement('quantity_available', $item['quantity']);
            }

            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                session()->forget('cart');
            }

            session()->forget('checkout');
        });

        return redirect()->route('checkout.confirmation', $order->id);
    }

    public function confirmation(Order $order)
    {
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!Auth::check() && $order->user_id !== null) {
            abort(403);
        }

        $order->load('orderContains.product', 'billingAddress', 'shippingAddress');
        return view('checkout.confirmation', compact('order'));
    }
}
