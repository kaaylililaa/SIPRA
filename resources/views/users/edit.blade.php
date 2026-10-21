
@extends('layouts.app')

@section('title', 'Edit User | SIPRA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endpush

@section('content')
<div class="users-page">

    <div class="users-header">
        <div>
            <h2>Edit User</h2>
            <p>Perbarui informasi akun pengguna SIPRA.</p>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum valid.</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="user-form-heading">
                <div class="user-form-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
                <div>
                    <h3>Informasi Akun</h3>
                    <p>Ubah data akun sesuai kebutuhan.</p>
                </div>
            </div>

            <form action="{{ route('users.update', $user->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="user-form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Masukkan nama lengkap"
                        maxlength="255"
                        required
                    >
                    @error('name')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="user-form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}"
                        placeholder="contoh@email.com"
                        maxlength="255"
                        required
                    >
                    @error('email')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="user-form-group">
                    <label for="password">Password Baru</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                        minlength="8"
                    >
                    @error('password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                    <small class="user-form-help">
                        Password lama tetap digunakan jika kolom ini dikosongkan.
                    </small>
                </div>

                <div class="user-form-actions">
                    <a href="{{ route('users.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
