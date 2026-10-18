
@extends('layouts.app')

@section('title', 'Edit Kategori - SIPRA')

@section('content')
<div class="kategori-page">
    <div class="kategori-header">
        <div>
            <h1>EDIT KATEGORI</h1>
            <p>Perbarui informasi kategori buku perpustakaan.</p>
        </div>
    </div>

    <div class="kategori-card form-kategori-card">
        <form action="{{ route('kategori.update', $kategori->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="form-kategori-heading">
                <div class="modal-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <h2>Informasi Kategori</h2>
                    <p>Ubah nama kategori sesuai kebutuhan.</p>
                </div>
            </div>

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
