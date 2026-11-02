 @extends('layouts.app')

@section('title', 'Detail Anggota - SIPRA')
@section('header-title', 'DETAIL ANGGOTA')
@section('header-description', 'Informasi lengkap anggota Perpustakaan Desa Rajeg Bersatu.')

@section('content')

<div class="anggota-form-container">

    <div class="anggota-detail-card">

        <div class="anggota-detail-heading">
            <div class="anggota-detail-avatar">
                <i class="bi bi-person-fill"></i>
            </div>

            <div>
                <h3>{{ $anggota->nama }}</h3>
                <p>Anggota Perpustakaan Desa Rajeg Bersatu</p>
            </div>
        </div>

        <div class="anggota-detail-content">

            <div class="anggota-detail-item">
                <span>Nama Lengkap</span>
                <strong>{{ $anggota->nama }}</strong>
            </div>

            <div class="anggota-detail-item">
                <span>Nomor Induk Kependudukan</span>
                <strong>{{ $anggota->nik }}</strong>
            </div>

            <div class="anggota-detail-item">
                <span>Tempat Lahir</span>
                <strong>{{ $anggota->tempat_lahir }}</strong>
            </div>

            <div class="anggota-detail-item">
                <span>Tanggal Lahir</span>
                <strong>{{ $anggota->tanggal_lahir->translatedFormat('d F Y') }}</strong>
            </div>

            <div class="anggota-detail-item full-width">
                <span>Alamat Lengkap</span>
                <strong>{{ $anggota->alamat }}</strong>
            </div>

        </div>

        <div class="anggota-form-footer">

            <a href="{{ route('anggota.index') }}" class="btn-kembali">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn-simpan-anggota">
                <i class="bi bi-pencil-square"></i>
                Edit Anggota
            </a>

        </div>

    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/anggota-create.css') }}">
@endpush