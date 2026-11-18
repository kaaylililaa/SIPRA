@extends('layouts.app')

@section('title', 'Tambah Anggota - SIPRA')
@section('header-title', 'TAMBAH ANGGOTA')
@section('header-description', 'Tambahkan data anggota baru Perpustakaan Desa Rajeg Bersatu.')
@section('header-icon', 'bi bi-plus-circle-fill')

@section('content')

<div class="anggota-form-container">

    <div class="anggota-form-card">

        <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
    <label for="foto">Foto Anggota</label>
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

        @csrf

            <div class="anggota-form-grid">

                {{-- NAMA --}}
                <div class="anggota-form-group full-width">
                    <label for="nama">Nama Lengkap</label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('nama') }}"
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
                        placeholder="Masukkan 16 digit NIK"
                        value="{{ old('nik') }}"
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
                        placeholder="Contoh: Tangerang"
                        value="{{ old('tempat_lahir') }}"
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
                        value="{{ old('tanggal_lahir') }}"
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
                        placeholder="Masukkan alamat lengkap anggota"
                        required
                    >{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- TOMBOL --}}
            <div class="anggota-form-footer">

                <a href="{{ route('anggota.index') }}" class="btn-kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn-simpan-anggota">
                    <i class="bi bi-check-lg"></i>
                    Simpan Anggota
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/anggota-create.css') }}">
@endpush