@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Customer</h2>
    @foreach ($customers as $customer)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $customer->name }}</h5>
                <p>Email: {{ $customer->email }}</p>
                <p>Telepon: {{ $customer->phone ?? '-' }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection