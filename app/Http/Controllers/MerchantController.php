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
}