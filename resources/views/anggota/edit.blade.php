@extends('layouts.app')

@section('title', 'Edit Anggota - SIPRA')
@section('header-title', 'EDIT ANGGOTA')
@section('header-description', 'Perbarui informasi anggota perpustakaan.')

@section('content')

<div class="anggota-form-container">

    <div class="anggota-form-card">

        <div class="anggota-form-heading">
            <div class="anggota-form-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div>
                <h3>Formulir Edit Anggota</h3>
                <p>Perbarui data anggota berikut.</p>
            </div>
        </div>

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
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