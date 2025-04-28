@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Pesanan Saya</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Kamu belum memiliki pesanan.
        </div>
    @else
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->menu->name }}</h5>

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Jumlah:</strong> {{ $order->quantity }}</li>
                                <li class="list-group-item">
                                    <strong>Status Order:</strong> 
                                    <span class="badge 
                                        {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'paid' ? 'bg-success' : 'bg-danger') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Status Pembayaran:</strong> 
                                    <span class="badge 
                                        {{ $order->payment_status == 'unpaid' ? 'bg-danger' : 'bg-success' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </li>
                            </ul>

                            @if($order->payment_status == 'unpaid')
                                <form action="{{ route('orders.pay', $order->id) }}" method="POST" class="d-grid">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-cash-coin"></i> Bayar Sekarang
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-success p-2 text-center">
                                    <i class="bi bi-check-circle-fill"></i> Sudah Dibayar
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
