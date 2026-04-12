<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['orderContains.product'])
            ->where('user_id', Auth::id())
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'date-asc'   => $query->reorder('created_at', 'asc'),
                'price-desc' => $query->reorder('price_total', 'desc'),
                'price-asc'  => $query->reorder('price_total', 'asc'),
                default      => $query->reorder('created_at', 'desc'),
            };
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('history', compact('orders'));
    }
}
