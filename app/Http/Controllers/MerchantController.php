<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class MerchantController extends Controller
{
    public function listCustomers()
    {
        $merchantId = Auth::id();

        $customers = User::whereHas('orders.menu', function ($q) use ($merchantId) {
            $q->where('merchant_id', $merchantId);
        })->distinct()->get();

        return view('merchant.customers', compact('customers'));
    }
    public function showCustomers()
    {
        $merchantId = Auth::id();

        // Ambil customer yang pernah order menu milik merchant
        $customers = \App\Models\User::whereHas('orders.menu', function ($q) use ($merchantId) {
            $q->where('merchant_id', $merchantId);
        })
            ->withCount(['orders' => function ($q) use ($merchantId) {
                $q->whereHas('menu', function ($q2) use ($merchantId) {
                    $q2->where('merchant_id', $merchantId);
                });
            }])
            ->get();

        return view('merchant.customers', compact('customers'));
    }
}
