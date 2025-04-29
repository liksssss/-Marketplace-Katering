@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="bi bi-info-circle me-2"></i> Detail Menu</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        @if ($menu->image)
        <img src="{{ asset('storage/' . $menu->image) }}" 
             alt="{{ $menu->name }}" 
             class="img-fluid w-100 object-fit-cover" 
             style="max-height: 400px; object-fit: cover;">
        @else
            <img src="https://via.placeholder.com/800x400?text=No+Image" 
                alt="No Image" 
                class="img-fluid w-100 object-fit-cover" 
                style="max-height: 400px; object-fit: cover;">
        @endif
        <div class="card-body">
            <h3 class="card-title">{{ $menu->name }}</h3>
            <p class="text-muted">Katering: <strong>{{ $menu->merchant->name }}</strong></p>
            <p class="card-text">{{ $menu->description ?? 'Tidak ada deskripsi.' }}</p>
            <h4 class="text-primary">Rp {{ number_format($menu->price, 0, ',', '.') }}</h4>

            @if (Auth::check() && Auth::user()->role === 'customer')
                <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah Porsi</label>
                        <input type="number" name="quantity" min="1" value="1" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-cart-plus"></i> Pesan Sekarang
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
