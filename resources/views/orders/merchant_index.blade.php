@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Kelola Pesanan Masuk</h2>

    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    @foreach ($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $order->menu->name }}</h5>

                <ul class="list-unstyled mb-3">
                    <li><strong>Pemesan:</strong> {{ $order->user->name }}</li>
                    <li><strong>Jumlah:</strong> {{ $order->quantity }}</li>
                    <li><strong>Status Order:</strong> 
                        <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                    </li>
                    <li><strong>Status Pembayaran:</strong> 
                        <span class="badge bg-warning text-dark">{{ ucfirst($order->payment_status) }}</span>
                    </li>
                </ul>

                <form action="{{ route('merchant.orders.updateStatus', $order->id) }}" method="POST" class="d-flex align-items-center gap-2 mb-3">
                    @csrf
                    @method('POST')
                    <select name="status" class="form-select w-auto">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>

                @if($order->payment_status == 'waiting')
                    <form action="{{ route('merchant.orders.confirm', $order->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success">Konfirmasi Pembayaran</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
