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
        $orders = Order::where('user_id', Auth::id())
            ->with('menu') // Tidak perlu 'user' karena customer cuma lihat pesanan sendiri
            ->get();
    
        return view('orders.index', compact('orders')); // Ganti view menjadi 'orders.index'
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $menu = Menu::findOrFail($request->menu_id);
        $totalPrice = $menu->price * $request->quantity; // Menghitung total_price berdasarkan quantity dan harga menu
    
        $order = Order::create([
            'user_id' => Auth::id(),
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'status' => 'pending',
            'payment_status' => 'unpaid', // Default unpaid
        ]);
    
        // Menyimpan invoice dengan total_price
        Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . time() . '-' . $order->id,
            'total_price' => $totalPrice,  // Menambahkan total_price
            'status' => 'unpaid', // Default status invoice
        ]);
    
        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }
    

    // Merchant: Lihat semua pesanan ke merchant ini
    public function merchantOrders()
    {
        $orders = Order::whereHas('menu', function ($query) {
            $query->where('merchant_id', Auth::id());
        })->with('menu', 'user')->get();

        return view('orders.merchant_index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi status yang diterima
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);
    
        $order = Order::findOrFail($id);
    
        // Cek apakah merchant yang sedang login adalah pemilik menu
        if ($order->menu->merchant_id !== Auth::id()) {
            abort(403);  // Jika merchant tidak sesuai, tampilkan error 403
        }
    

    
        // Update status
        $order->status = $request->status;
        $order->save();  // Simpan perubahan ke database
    
        return back()->with('success', 'Status pesanan diperbarui.');
    }
    

    // Customer: Tampilkan form order
    public function create()
    {
        $menus = Menu::all();
        return view('orders.create', compact('menus'));
    }

    // Customer: Ajukan pembayaran
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        $order->update(['payment_status' => 'waiting']);

        return back()->with('success', 'Status pembayaran dikirim. Menunggu konfirmasi merchant.');
    }

    public function confirm($id)
    {
        $order = Order::whereHas('menu', function ($q) {
            $q->where('merchant_id', Auth::id());
        })->findOrFail($id);
    
        // Update status payment di order
        $order->update(['payment_status' => 'paid']);
    
        // Jika Anda ingin menambahkan informasi di invoice saat konfirmasi
        $invoice = Invoice::where('order_id', $order->id)->first();
        $invoice->update(['status' => 'paid']);  // Update status invoice menjadi paid
    
        return back()->with('success', 'Pembayaran dikonfirmasi!');
    }
    

    // Merchant: Lihat daftar pelanggan
    public function customers()
    {
        $merchantId = Auth::id();

        $customers = \App\Models\User::whereHas('orders.menu', function ($query) use ($merchantId) {
            $query->where('merchant_id', $merchantId);
        })->distinct()->get();

        return view('merchant.customers', compact('customers'));
    }
}
