@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="kategori-card tambah-card">

        {{-- HEADER --}}
        <div class="kategori-header">

            <div class="header-title">

                <div class="header-icon">
                    <i class="bi bi-plus-circle-fill"></i>
                </div>

                <div>
                    <h4>Tambah Kategori Buku</h4>
                    <p>Masukkan data kategori buku yang baru</p>
                </div>

            </div>

            <a
                href="{{ route('kategori.index') }}"
                class="back-link"
            >
                ← Kembali
            </a>

        </div>


        {{-- FORM --}}
        <div class="form-content">

            <form
                action="{{ route('kategori.store') }}"
                method="POST"
            >

                @csrf

                <div class="form-group">

                    <label for="nama_kategori">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        id="nama_kategori"
                        name="nama_kategori"
                        value="{{ old('nama_kategori') }}"
                        placeholder="Masukkan nama kategori..."
                        required
                    >

                    @error('nama_kategori')

                        <small class="error-message">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn-simpan"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection