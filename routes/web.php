<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/merchant/customers', [DashboardController::class, 'showCustomers'])->name('merchant.customers');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('menu', MenuController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/merchant/orders', [OrderController::class, 'merchantOrders'])->name('orders.index.merchant');
    Route::get('/merchant/customers', [MerchantController::class, 'listCustomers'])->name('merchant.customers');
    Route::post('/merchant/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('merchant.orders.confirm');
    Route::post('/merchant/orders/{id}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/merchant/orders/{id}/update', [OrderController::class, 'updateStatus'])->name('merchant.orders.updateStatus');
});


Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::post('/invoices/{order_id}', [InvoiceController::class, 'store'])->name('invoices.store');

Route::post('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');

Route::middleware(['auth'])->group(function () {
    Route::get('/merchant/customers', [MerchantController::class, 'listCustomers'])->name('merchant.customers');
});



