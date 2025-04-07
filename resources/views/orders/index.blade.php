@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pesanan Saya</h2>
        @foreach ($orders as $order)
            <div class="card mb-2">
                <div class="card-body">
                    <h5>{{ $order->menu->name }}</h5>
                    <p>Jumlah: {{ $order->quantity }}</p>
                    <p>Status: {{ ucfirst($order->status) }}</p>
                </div>
            </div>
            @if ($order->payment_status == 'unpaid')
                <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-sm">Saya Sudah Bayar</button>
                </form>
            @elseif($order->payment_status == 'waiting')
                <span class="text-warning">Menunggu konfirmasi</span>
            @else
                <span class="text-success">Lunas</span>
            @endif
        @endforeach
    </div>
@endsection
