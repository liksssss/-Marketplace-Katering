@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="bi bi-list-ul me-2"></i>Daftar Menu</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    @if (Auth::user()->role === 'merchant')
        <div class="text-end mb-4">
            <a href="{{ route('menu.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Menu
            </a>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($menus->count())
        <div class="row g-4">
            @foreach ($menus as $menu)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-shadow">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top img-fluid" alt="{{ $menu->name }}">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top img-fluid" alt="No Image">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($menu->description, 100) }}</p>
                            <p class="fw-bold text-primary">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

                            @if (Auth::user()->role === 'merchant')
                                <div class="d-flex gap-2">
                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm flex-fill">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if (Auth::user()->role === 'customer')
                                <form action="{{ route('orders.store') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <div class="mb-2">
                                        <label for="quantity" class="small mb-1">Jumlah Porsi</label>
                                        <input type="number" name="quantity" min="1" value="1" class="form-control form-control-sm" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-cart-plus"></i> Pesan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center mt-5">
            <i class="bi bi-info-circle"></i> Tidak ada menu tersedia.
        </div>
    @endif
</div>
@endsection
