@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Tambah Menu</h2>

    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Menu</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Menu (opsional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Simpan Menu</button>
        </div>
    </form>
</div>
@endsection
