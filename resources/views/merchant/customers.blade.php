@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Daftar Customer</h2>

    @if ($customers->isEmpty())
        <div class="alert alert-info text-center">
            <i class="bi bi-people"></i> Belum ada customer yang melakukan pemesanan.
        </div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-person-circle"></i> Nama</th>
                        <th><i class="bi bi-envelope"></i> Email</th>
                        <th><i class="bi bi-geo-alt"></i> Alamat</th>
                        <th><i class="bi bi-telephone"></i> Kontak</th>
                        <th><i class="bi bi-card-text"></i> Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address ?? '-' }}</td>
                            <td>{{ $customer->contact ?? '-' }}</td>
                            <td>{{ $customer->description ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
