@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Hasil Pencarian: "{{ $query }}"</h2>

    @if ($menus->isEmpty())
        <div class="alert alert-warning">
            Menu tidak ditemukan.
        </div>
    @else
        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">
                                Katering: <strong>{{ $menu->merchant->name }}</strong><br>
                                Harga: Rp{{ number_format($menu->price, 0, ',', '.') }}
                            </p>
                            <a href="{{ route('menu.show', $menu->id) }}" class="btn btn-success">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
