@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Menu</h2>

        @if (Auth::user()->role === 'merchant')
            <a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($menus->count())
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if ($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top"
                                    alt="{{ $menu->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top"
                                    alt="No Image">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p>
                                <p class="card-text"><strong>Rp {{ number_format($menu->price, 0, ',', '.') }}</strong></p>

                                @if (Auth::user()->role === 'merchant')
                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @endif
                                @if (Auth::user()->role === 'customer')
                                    <form action="{{ route('orders.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <div class="mb-2">
                                            <label for="quantity">Jumlah Porsi:</label>
                                            <input type="number" name="quantity" min="1" value="1"
                                                class="form-control mb-2" required>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm">Pesan</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada menu tersedia.</p>
        @endif
    </div>
@endsection
