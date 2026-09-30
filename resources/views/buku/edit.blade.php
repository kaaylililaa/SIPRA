@extends('layouts.app')

@section('content')

<div class="edit-page">

    <div class="edit-header">

        <div class="edit-title-wrapper">

            <div class="edit-icon">
                <i class="bi bi-pencil"></i>
            </div>

            <div>
                <h1 class="edit-title">Edit Buku</h1>

                <p class="edit-subtitle">
                    Edit Data Buku Terbaru Perpustakaan Desa Rajeg Bersatu
                </p>
            </div>

        </div>

        <a href="{{ route('buku.index') }}" class="edit-back">
            ← Kembali
        </a>

    </div>


    <div class="edit-card">

<div class="edit-cover-section">
    <h3 class="edit-cover-title">Sampul Buku</h3>

    <div class="edit-cover-image">
        <div class="edit-cover-preview">
    @if($buku->gambar_sampul)
        <img
            src="{{ asset('images/' . $buku->gambar_sampul) }}"
            alt="Sampul Buku"
            class="edit-cover-image"
        >
    @else
        <div class="no-cover">
            Tidak ada sampul
        </div>
    @endif
</div>

    <label for="gambar_sampul" class="edit-change-cover">
        <i class="bi bi-cloud-arrow-up-fill"></i>
        Ubah Sampul
    </label>

    <input
        type="file"
        id="gambar_sampul"
        name="gambar_sampul"
        accept=".jpg,.jpeg,.png"
        hidden
    >

    <button type="button" class="edit-delete-cover">
        <i class="bi bi-trash3"></i>
        Hapus Sampul
    </button>

    <div class="edit-format-info">
        Format yang didukung:<br>
        JPG, PNG, JPEG<br>
        Maks. ukuran 2MB
    </div>
</div>


        <div class="edit-form-section">

            <form
                action="{{ route('buku.update', $buku->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <input
                    type="file"
                    name="gambarsampul"
                    id="gambarsampul"
                    hidden
                >

                <div class="edit-form-grid">

                    <div class="edit-form-group">
                        <label>Judul Buku</label>
                        <input
                            type="text"
                            name="judul_buku"
                            value="{{ old('judul_buku', $buku->judul_buku) }}"
                        >
                    </div>

                    <div class="edit-form-group">
                        <label>Nama Pengarang</label>
                        <input
                            type="text"
                            name="nama_pengarang"
                            value="{{ old('nama_pengarang', $buku->nama_pengarang) }}"
                        >
                    </div>

                    <div class="edit-form-group">
                        <label>Nama Penerbit</label>
                        <input
                            type="text"
                            name="nama_penerbit"
                            value="{{ old('nama_penerbit', $buku->nama_penerbit) }}"
                        >
                    </div>

                    <div class="edit-form-group">
                        <label>Tahun Terbit</label>
                        <input
                            type="number"
                            name="tahun_terbit"
                            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                        >
                    </div>

                    <div class="edit-form-group">
                        <label>Kode Perpus</label>
                        <input
                            type="text"
                            name="kode_perpus"
                            value="{{ old('kode_perpus', $buku->kode_perpus) }}"
                        >
                    </div>

                    <div class="edit-form-group">
                        <label>ISBN</label>
                        <input
                            type="text"
                            name="isbn"
                            value="{{ old('isbn', $buku->isbn) }}"
                        >
                    </div>

                    <div class="edit-form-group full">
                        <label>Kategori Buku</label>

                        <select name="kategori_id">

                            @foreach($kategoris as $kategori)

                                <option
                                    value="{{ $kategori->id }}"
                                    {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama_kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="edit-actions">

                    <a
                        href="{{ route('buku.index') }}"
                        class="edit-btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="edit-btn-save"
                    >
                        ✓ Perbarui Buku
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection