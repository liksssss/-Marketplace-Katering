@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Edit Profil</h1>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="address" class="form-label font-weight-bold">Alamat</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="form-control @error('address') is-invalid @enderror">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label font-weight-bold">Kontak</label>
            <input type="text" id="contact" name="contact" value="{{ old('contact', $user->contact) }}" class="form-control @error('contact') is-invalid @enderror">
            @error('contact')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label font-weight-bold">Deskripsi</label>
            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $user->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
