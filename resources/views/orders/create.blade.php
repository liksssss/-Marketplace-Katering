@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Pesanan</h2>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <label>Menu:</label>
        <select name="menu_id" class="form-control">
            @foreach ($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->name }} - Rp{{ number_format($menu->price) }}</option>
            @endforeach
        </select><br>

        <label>Jumlah:</label>
        <input type="number" name="quantity" class="form-control"><br>

        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>
@endsection
