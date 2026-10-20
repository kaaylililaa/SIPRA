@extends('layouts.app')

@section('header-title', 'Edit Buku')
@section('header-description', 'Perbarui informasi koleksi buku perpustakaan.')
@section('header-icon', 'bi bi-pencil-square')

@section('header-actions')
    <a href="{{ route('buku.index') }}" class="edit-back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
@endsection

@section('content')

<div class="edit-page">

    <div class="edit-card">

        <form
            action="{{ route('buku.update', $buku->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="cover-section">
                <h3>Sampul Buku</h3>

                <div class="cover-preview">
                    @if ($buku->gambar_sampul)
                        <img
                            src="{{ asset('uploads/sampul/' . basename($buku->gambar_sampul)) }}"
                            alt="Sampul {{ $buku->judul_buku }}"
                            id="coverPreview"
                        >

                        <div class="empty-cover" id="emptyCover" style="display:none;">
                            <i class="bi bi-book"></i>
                            <span>Tidak ada sampul</span>
                        </div>
                    @else
                        <div class="empty-cover" id="emptyCover">
                            <i class="bi bi-book"></i>
                            <span>Tidak ada sampul</span>
                        </div>

                        <img
                            src=""
                            alt=""
                            id="coverPreview"
                            style="display:none;"
                        >
                    @endif
                </div>

                <label for="gambar_sampul" class="change-cover-button">
                    <i class="bi bi-cloud-arrow-up"></i>
                    Ubah Sampul
                </label>

                <input
                    type="file"
                    name="gambar_sampul"
                    id="gambar_sampul"
                    accept=".jpg,.jpeg,.png,.webp"
                    hidden
                >

                @error('gambar_sampul')
                    <small class="error-message">{{ $message }}</small>
                @enderror

                <button
                    type="button"
                    class="remove-cover-button"
                    id="removeCoverButton"
                >
                    <i class="bi bi-trash3"></i>
                    Hapus Sampul
                </button>

                <div class="format-info">
                    Format yang didukung:<br>
                    JPG, PNG, JPEG, WEBP<br>
                    Maks. ukuran 2MB
                </div>
            </div>

            <div class="form-section">
                <div class="form-grid">

                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input
                            type="text"
                            name="judul_buku"
                            id="judul_buku"
                            value="{{ old('judul_buku', $buku->judul_buku) }}"
                            required
                        >
                        @error('judul_buku')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_pengarang">Nama Pengarang</label>
                        <input
                            type="text"
                            name="nama_pengarang"
                            id="nama_pengarang"
                            value="{{ old('nama_pengarang', $buku->nama_pengarang) }}"
                            required
                        >
                        @error('nama_pengarang')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_penerbit">Nama Penerbit</label>
                        <input
                            type="text"
                            name="nama_penerbit"
                            id="nama_penerbit"
                            value="{{ old('nama_penerbit', $buku->nama_penerbit) }}"
                            required
                        >
                        @error('nama_penerbit')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input
                            type="number"
                            name="tahun_terbit"
                            id="tahun_terbit"
                            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                            min="1000"
                            max="{{ date('Y') }}"
                            required
                        >
                        @error('tahun_terbit')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_perpus">Kode Perpus</label>
                        <input
                            type="text"
                            name="kode_perpus"
                            id="kode_perpus"
                            value="{{ old('kode_perpus', $buku->kode_perpus) }}"
                            placeholder="Masukkan kode perpus"
                        >
                        @error('kode_perpus')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input
                            type="text"
                            name="isbn"
                            id="isbn"
                            value="{{ old('isbn', $buku->isbn) }}"
                        >
                        @error('isbn')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="kategori_id">Kategori Buku</label>
                        <select name="kategori_id" id="kategori_id" required>
                            <option value="" disabled>Pilih kategori</option>

                            @foreach ($kategoris as $kategori)
                                <option
                                    value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="form-buttons">
                    <a href="{{ route('buku.index') }}" class="btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="btn-update">
                        <i class="bi bi-check-lg"></i>
                        Perbarui Buku
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('gambar_sampul');
    const coverPreview = document.getElementById('coverPreview');
    const emptyCover = document.getElementById('emptyCover');
    const removeButton = document.getElementById('removeCoverButton');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (event) {
            coverPreview.src = event.target.result;
            coverPreview.style.display = 'block';

            if (emptyCover) {
                emptyCover.style.display = 'none';
            }
        };

        reader.readAsDataURL(file);
    });

    removeButton.addEventListener('click', function () {
        imageInput.value = '';
        coverPreview.src = '';
        coverPreview.style.display = 'none';

        if (emptyCover) {
            emptyCover.style.display = 'flex';
        }
    });
});
</script>

@endsection