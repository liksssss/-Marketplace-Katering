@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kelola Pesanan</h2>

    @foreach ($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Menu:</strong> {{ $order->menu->name }}</p>
                <p><strong>Pemesan:</strong> {{ $order->user->name }}</p>
                <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                <form action="{{ route('merchant.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <select name="status" class="form-select mb-2">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
