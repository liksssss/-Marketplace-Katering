<?php

namespace App\Http\Controllers;

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
}

