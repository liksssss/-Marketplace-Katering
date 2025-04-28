@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-person-circle fs-1 me-3 text-primary"></i>
            <div>
                <h2 class="mb-1">Halo, {{ $user->name }} (Customer)</h2>
                <p class="text-muted mb-0">Silakan pilih menu katering favoritmu dan lakukan pemesanan.</p>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row gap-3 my-4">
            <a href="{{ route('menu.index') }}" class="btn btn-primary flex-fill d-flex align-items-center justify-content-center">
                <i class="bi bi-card-list me-2"></i> Lihat Menu
            </a>

            <a href="{{ route('orders.index') }}" class="btn btn-info flex-fill d-flex align-items-center justify-content-center">
                <i class="bi bi-receipt me-2"></i> Lihat Pesanan Saya
            </a>
        </div>
    </div>
</div>
@endsection
