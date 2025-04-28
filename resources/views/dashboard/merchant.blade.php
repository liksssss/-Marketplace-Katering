@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">👋 Selamat Datang, {{ $user->name }} (Merchant)</h2>
    <p class="text-center mb-5">Kelola menu, pesanan, dan pelanggan Anda dengan mudah.</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-card-list display-4 mb-3 text-primary"></i>
                    <h5 class="card-title">Kelola Menu</h5>
                    <p class="card-text">Tambah, ubah, atau hapus menu makanan Anda.</p>
                    <a href="{{ route('menu.index') }}" class="btn btn-primary">Kelola Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-basket display-4 mb-3 text-success"></i>
                    <h5 class="card-title">Pesanan Masuk</h5>
                    <p class="card-text">Cek dan proses pesanan dari pelanggan Anda.</p>
                    <a href="{{ route('orders.index.merchant') }}" class="btn btn-success">Lihat Pesanan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people display-4 mb-3 text-secondary"></i>
                    <h5 class="card-title">Customer</h5>
                    <p class="card-text">Lihat daftar pelanggan Anda.</p>
                    <a href="{{ route('merchant.customers') }}" class="btn btn-secondary">Lihat Customer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
