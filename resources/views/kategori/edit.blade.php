@extends('layouts.app')

@section('header-title', 'Edit Kategori')
@section('header-description', 'Perbarui informasi koleksi kategori buku perpustakaan.')
@section('header-icon', 'bi bi-pencil-square')

@section('header-actions')
    <a href="{{ route('kategori.index') }}" class="edit-back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
@endsection


@section('content')

    <div class="kategori-card form-kategori-card">
        <form action="{{ route('kategori.update', $kategori->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            @if($errors->any())
                <div class="alert-error-kategori">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="field-kategori">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text"
                       name="nama_kategori"
                       id="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       maxlength="100"
                       required>
                <small>Pastikan nama kategori sudah benar.</small>
            </div>

            <div class="form-kategori-actions">
                <a href="{{ route('kategori.index') }}" class="btn-batal">
                    Batal
                </a>
                <button type="submit" class="btn-simpan">
                    <i class="bi bi-check-lg"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
@endpush
