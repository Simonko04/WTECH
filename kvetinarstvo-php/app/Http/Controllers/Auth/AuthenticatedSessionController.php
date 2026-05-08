<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->mergeSessionCartToDb();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.products.index');
        }

        return redirect()->intended(url('/'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function mergeSessionCartToDb(): void
    {
        $sessionCart = session()->get('cart', []);
        if (empty($sessionCart)) return;

        foreach ($sessionCart as $productId => $item) {
            $cartItem = \App\Models\Cart::firstOrNew([
                'user_id'    => Auth::id(),
                'product_id' => $productId,
            ]);
            $cartItem->quantity = ($cartItem->exists ? $cartItem->quantity : 0) + $item['quantity'];
            $cartItem->save();
        }

        session()->forget('cart');
    }
}
