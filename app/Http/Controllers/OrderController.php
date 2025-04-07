<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('menu')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'status' => 'pending'
        ]);

        Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . time() . '-' . $order->id,
            'total_price' => $menu->price * $request->quantity
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat dan invoice dibuat!');
    }


    public function merchantOrders()
    {
        $orders = Order::whereHas('menu', function ($query) {
            $query->where('merchant_id', Auth::id());
        })->with('menu', 'user')->get();

        return view('orders.merchant_index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);


        if ($order->menu->merchant_id !== Auth::id()) {
            abort(403);
        }

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan diperbarui.');
    }

    public function create()
    {
        $menus = Menu::all();
        return view('orders.create', compact('menus'));
    }
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->update(['payment_status' => 'waiting']);
        return back()->with('success', 'Status pembayaran dikirim, menunggu konfirmasi merchant.');
    }


    public function confirm($id)
    {
        $order = Order::whereHas('menu', function ($q) {
            $q->where('merchant_id', Auth::id());
        })->findOrFail($id);
    
        $order->update(['payment_status' => 'paid']);
    
        Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'invoice_date' => now(),
            'total_amount' => $order->quantity * $order->menu->price,
        ]);
    
        return back()->with('success', 'Pembayaran dikonfirmasi!');
    }
}    