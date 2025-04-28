@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Customer</h2>

    @if ($customers->isEmpty())
        <p>Tidak ada customer yang melakukan pemesanan.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Total Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->orders_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
