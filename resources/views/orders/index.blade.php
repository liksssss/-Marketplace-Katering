@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pesanan Saya</h2>

    @foreach ($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Menu:</strong> {{ $order->menu->name }}</p>
                <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                <p><strong>Status Order:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Status Pembayaran:</strong> {{ ucfirst($order->payment_status) }}</p>

                @if($order->payment_status == 'unpaid')
                    <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success">Bayar Sekarang</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
