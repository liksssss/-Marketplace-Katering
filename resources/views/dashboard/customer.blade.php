@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <h2>Halo, {{ $user->name }} (Customer)</h2>
            <p>Silakan pilih menu katering favoritmu dan lakukan pemesanan.</p>

            <a href="{{ route('menu.index') }}" class="btn btn-primary mb-2"> Menu</a><br>

            <a href="{{ route('orders.index.customer') }}" class="btn btn-info mb-2">Lihat Pesanan Masuk</a><br>

        </div>
        <a href="{{ route('logout') }}">Logout</a>
    </div>
@endsection
