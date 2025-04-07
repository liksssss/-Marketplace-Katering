@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoice</h2>

    <div class="card">
        <div class="card-body">
            <h5>Invoice Number: <strong>{{ $invoice->invoice_number }}</strong></h5>
            <p>Tanggal: {{ $invoice->invoice_date }}</p>

            <hr>
            <h5>Detail Pesanan</h5>
            <p><strong>Nama Menu:</strong> {{ $invoice->order->menu->name }}</p>
            <p><strong>Deskripsi:</strong> {{ $invoice->order->menu->description }}</p>
            <p><strong>Jumlah:</strong> {{ $invoice->order->quantity }}</p>
            <p><strong>Harga Satuan:</strong> Rp{{ number_format($invoice->order->menu->price, 0, ',', '.') }}</p>

            <hr>
            <h5>Total Bayar:</h5>
            <h4 class="text-success">Rp{{ number_format($invoice->total, 0, ',', '.') }}</h4>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
