<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'merchant') {
            return view('dashboard.merchant', compact('user'));
        } else {
            return view('dashboard.customer', compact('user'));
        }
    }
    public function showCustomers()
    {
        $merchantId = Auth::id();

        $customers = User::whereHas('orders.menu', function ($query) use ($merchantId) {
            $query->where('merchant_id', $merchantId);
        })
            ->withCount(['orders' => function ($query) use ($merchantId) {
                $query->whereHas('menu', function ($q) use ($merchantId) {
                    $q->where('merchant_id', $merchantId);
                });
            }])
            ->get();

        return view('merchant.customers', compact('customers'));
    }
}
