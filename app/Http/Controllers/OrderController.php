<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('success', 'Keranjang masih kosong.');
        }

        return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'payment_method' => 'required',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('success', 'Keranjang masih kosong.');
        }

        $totalPrice = 0;
        $totalEcoPoints = 0;

        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->withErrors([
                    'stock' => 'Stok produk ' . $item->product->name . ' tidak cukup.'
                ]);
            }

            $totalPrice += $item->product->price * $item->quantity;
            $totalEcoPoints += $item->product->eco_points_reward * $item->quantity;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => 'RCY-' . strtoupper(Str::random(8)),
            'total_price' => $totalPrice,
            'total_eco_points' => $totalEcoPoints,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        $user = Auth::user();
        $user->increment('eco_points', $totalEcoPoints);

        $cart->items()->delete();

        return redirect()->route('orders.success', $order->order_code);
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.success', compact('order'));
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }
}