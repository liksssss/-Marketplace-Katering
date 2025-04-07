@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Invoice</h2>
    @foreach ($invoices as $invoice)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Invoice #{{ $invoice->invoice_number }}</h5>
                <p>Tanggal: {{ $invoice->invoice_date }}</p>
                <p>Menu: {{ $invoice->order->menu->name }}</p>
                <p>Jumlah: {{ $invoice->order->quantity }}</p>
                <p>Status: {{ $invoice->order->status }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
