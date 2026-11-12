
@extends('layouts.app')

@section('title', 'Profil Saya - SIPRA')
@section('header-title', 'Profil Saya')
@section('header-description', 'Kelola informasi akun SIPRA Anda.')
@section('header-icon', 'bi bi-person-circle')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container">

    @if (session('success'))
        <div class="profile-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-layout">

        {{-- KARTU PROFIL --}}
        <div class="profile-card">

            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>

            <span class="profile-role">
                <i class="bi bi-shield-check"></i>
                {{ ucfirst($user->role) }}
            </span>

            <div class="profile-divider"></div>

            <div class="profile-detail">
                <span>Status Akun</span>
                <strong>Aktif</strong>
            </div>

            <div class="profile-detail">
                <span>Bergabung Sejak</span>
                <strong>
                    {{ $user->created_at->format('d M Y') }}
                </strong>
            </div>

        </div>

        {{-- FORM EDIT PROFIL --}}
        <div class="profile-form-card">

            <div class="profile-heading">
                <h3>Informasi Akun</h3>
                <p>Perbarui informasi akun perpustakaan Anda.</p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="profile-section-title">
                    <i class="bi bi-person-lines-fill"></i>
                    Data Pribadi
                </div>

                <div class="profile-input-group">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                    @error('name')
                        <small class="profile-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="profile-input-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <small class="profile-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="profile-divider"></div>

                <div class="profile-section-title">
                    <i class="bi bi-lock-fill"></i>
                    Ganti Password
                </div>

                <p class="profile-hint">
                    Kosongkan jika tidak ingin mengganti password.
                </p>

                <div class="profile-input-group">
                    <label>Password Baru</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password baru"
                    >
                    @error('password')
                        <small class="profile-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="profile-input-group">
                    <label>Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                    >
                </div>

                <div class="profile-actions">
                    <button type="submit" class="profile-save-btn">
                        <i class="bi bi-check-lg"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
