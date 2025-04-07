@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Selamat Datang, {{ $user->name }} (Merchant)</h2>
    <p>Silakan kelola menu, pesanan, dan invoice Anda.</p>

    <a href="{{ route('menu.index') }}" class="btn btn-primary mb-2">Kelola Menu</a><br>

    <a href="{{ route('orders.index.merchant') }}">Lihat Pesanan Masuk</a>

</div>
@endsection
