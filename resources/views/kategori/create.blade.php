@extends('layouts.app')

@section('header-title', 'Tambah Kategori')
@section('header-description', 'Tambahkan koleksi kategori buku baru ke perpustakaan.')
@section('header-icon', 'bi bi-plus-circle-fill')

@section('header-actions')
    <a href="{{ route('kategori.index') }}" class="create-back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
@endsection

@section('content')
<div class="kategori-page">

    {{-- FORM KATEGORI --}}
    <div class="kategori-card form-kategori-card">

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            {{-- PESAN ERROR --}}
            @if($errors->any())
                <div class="alert-error-kategori">
                    <i class="bi bi-exclamation-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- NAMA KATEGORI --}}
            <div class="field-kategori">
                <label for="nama_kategori">Nama Kategori</label>

                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    placeholder="Contoh: Novel"
                    maxlength="100"
                    autocomplete="off"
                    required
                    autofocus
                >

                <small>
                    Gunakan nama yang mudah dikenali.
                </small>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="form-kategori-actions">
                <a href="{{ route('kategori.index') }}"
                   class="btn-batal">
                    Batal
                </a>

                <button type="submit" class="btn-simpan">
                    <i class="bi bi-check-lg"></i>
                    Simpan Kategori
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
@endpush
