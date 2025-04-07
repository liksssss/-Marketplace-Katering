@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Menu</h2>

    <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" value="{{ $menu->price }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ganti Gambar (opsional)</label><br>
            @if ($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" width="150" class="mb-2"><br>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Menu</button>
    </form>
</div>
@endsection
