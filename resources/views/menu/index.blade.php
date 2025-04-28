@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Daftar Menu</h2>


    @if (Auth::user()->role === 'merchant')
    <div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                ← Kembali ke Dashboard
            </a>
        </div>
        <div class="col-md-6 text-end">
            @if (Auth::user()->role === 'merchant')
                <a href="{{ route('menu.create') }}" class="btn btn-primary">
                    + Tambah Menu
                </a>
            @endif
        </div>
    </div>    
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($menus->count())
        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text flex-grow-1">{{ $menu->description }}</p>
                            <p class="card-text fw-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

                            @if (Auth::user()->role === 'merchant')
                                <div class="d-flex gap-2">
                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm flex-fill">Edit</a>
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                    </form>
                                </div>
                            @endif

                            @if (Auth::user()->role === 'customer')
                                <form action="{{ route('orders.store') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <div class="mb-2">
                                        <label for="quantity">Jumlah Porsi:</label>
                                        <input type="number" name="quantity" min="1" value="1" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Pesan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Tidak ada menu tersedia.
        </div>
    @endif
</div>
@endsection
