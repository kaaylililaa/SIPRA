@extends('layouts.app')

@section('title', 'Edit Anggota - SIPRA')
@section('header-title', 'EDIT ANGGOTA')
@section('header-description', 'Perbarui data anggota perpustakaan.')
@section('header-icon', 'bi bi-pencil-square')

@section('content')

<div class="anggota-form-container">

    <div class="anggota-form-card">

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data"x>
            @csrf
            @method('PUT')

            <div class="anggota-form-grid">

                {{-- NAMA --}}
                <div class="anggota-form-group full-width">
                    <label for="nama">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama', $anggota->nama) }}"
                        required
                    >
                    @error('nama')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- NIK --}}
                <div class="anggota-form-group full-width">
                    <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                    <input
                        type="text"
                        id="nik"
                        name="nik"
                        value="{{ old('nik', $anggota->nik) }}"
                        maxlength="16"
                        minlength="16"
                        inputmode="numeric"
                        pattern="[0-9]{16}"
                        required
                    >
                    @error('nik')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- TEMPAT LAHIR --}}
                <div class="anggota-form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input
                        type="text"
                        id="tempat_lahir"
                        name="tempat_lahir"
                        value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}"
                        required
                    >
                    @error('tempat_lahir')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- TANGGAL LAHIR --}}
                <div class="anggota-form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input
                        type="date"
                        id="tanggal_lahir"
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $anggota->tanggal_lahir->format('Y-m-d')) }}"
                        required
                    >
                    @error('tanggal_lahir')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="anggota-form-group full-width">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="4"
                        required
                    >{{ old('alamat', $anggota->alamat) }}</textarea>

                    @error('alamat')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>
</div>

            {{-- FOTO ANGGOTA --}}
<div class="form-group">
    <label for="foto">Foto Anggota</label>

    {{-- Menampilkan foto yang sudah tersimpan --}}
    @if ($anggota->foto)
        <div style="margin-bottom: 12px;">
            <img
                src="{{ asset('images/anggota/' . $anggota->foto) }}"
                alt="Foto Anggota"
                width="100"
                style="height: 100px; object-fit: cover; border-radius: 10px;"
            >
        </div>
    @endif

    {{-- Upload foto baru --}}
    <input
        type="file"
        name="foto"
        id="foto"
        accept="image/*"
    >

    @error('foto')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
            {{-- TOMBOL --}}
            <div class="anggota-form-footer">

                <a href="{{ route('anggota.index') }}" class="btn-kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn-simpan-anggota">
                    <i class="bi bi-check-lg"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

{{-- CSS HALAMAN EDIT --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/anggota-create.css') }}">
@endpush