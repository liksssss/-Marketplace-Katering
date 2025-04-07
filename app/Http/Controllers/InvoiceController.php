<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    
    public function customerIndex()
    {
        $invoices = Invoice::whereHas('order', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('order.menu')->get();

        return view('invoices.customer_index', compact('invoices'));
    }


    public function merchantIndex()
    {
        $invoices = Invoice::whereHas('order.menu', function ($q) {
            $q->where('merchant_id', Auth::id());
        })->with('order.user')->get();

        return view('invoices.merchant_index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('order.menu')->findOrFail($id);


        if ($invoice->order->user_id !== Auth::id() && $invoice->order->menu->merchant_id !== Auth::id()) {
            abort(403);
        }

        return view('invoices.show', compact('invoice'));
    }
}
