@extends('layouts.app')

@section('content')

<div class="create-book-page">

    {{-- HEADER --}}
    <div class="create-book-header">

        <div class="create-book-title-icon">
            <i class="bi bi-plus-lg"></i>
        </div>

        <div>
            <h1>Tambah Buku</h1>
            <p>Tambahkan koleksi buku baru ke Perpustakaan Desa Rajeg Bersatu.</p>
        </div>

    </div>


    {{-- FORM CARD --}}
    <div class="create-book-card">

        <form action="{{ route('buku.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="create-book-layout">

                {{-- ================= LEFT ================= --}}
                <div class="book-cover-section">

                    <label class="section-label">Sampul Buku</label>

                    {{-- UPLOAD BOX --}}
                    <label for="gambar_sampul" class="upload-box">

                        <div class="upload-icon">
                            <i class="bi bi-image"></i>
                        </div>

                        <strong>Tambahkan Sampul Buku</strong>

                        <span>
                            Drag & drop gambar di sini<br>
                            atau klik untuk memilih file
                        </span>

                        <small>
                            Format: JPG, PNG, JPEG (Maks. 2MB)
                        </small>

                    </label>

                    <input
                        type="file"
                        id="gambar_sampul"
                        name="gambar_sampul"
                        accept=".jpg,.jpeg,.png"
                        hidden
                    >

                    {{-- PREVIEW --}}
                    <div class="cover-preview-box" id="previewBox">

                        <div class="preview-header">
                            <span>Preview</span>

                            <button
                                type="button"
                                id="removePreview"
                                class="remove-preview"
                                title="Hapus gambar">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>

                        <div class="preview-image-wrapper">

                            <img
                                id="previewImage"
                                src=""
                                alt="Preview Sampul Buku"
                            >

                        </div>

                    </div>

                </div>


                {{-- ================= RIGHT ================= --}}
                <div class="book-form-section">

                    {{-- ROW 1 --}}
                    <div class="form-row">

                        <div class="form-group">
                            <label for="judul_buku">
                                Judul Buku
                            </label>

                            <input
                                type="text"
                                id="judul_buku"
                                name="judul_buku"
                                value="{{ old('judul_buku') }}"
                                required
                            >

                            @error('judul_buku')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="nama_pengarang">
                                Nama Pengarang
                            </label>

                            <input
                                type="text"
                                id="nama_pengarang"
                                name="nama_pengarang"
                                value="{{ old('nama_pengarang') }}"
                                required
                            >

                            @error('nama_pengarang')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>


                    {{-- ROW 2 --}}
                    <div class="form-row">

                        <div class="form-group">
                            <label for="nama_penerbit">
                                Nama Penerbit
                            </label>

                            <input
                                type="text"
                                id="nama_penerbit"
                                name="nama_penerbit"
                                value="{{ old('nama_penerbit') }}"
                                required
                            >

                            @error('nama_penerbit')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="tahun_terbit">
                                Tahun Terbit
                            </label>

                            <input
                                type="number"
                                id="tahun_terbit"
                                name="tahun_terbit"
                                value="{{ old('tahun_terbit') }}"
                                min="1000"
                                max="9999"
                                required
                            >

                            @error('tahun_terbit')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>


                    {{-- ROW 3 --}}
                    <div class="form-row">

                        <div class="form-group">
                            <label for="kode_perpus">
                                Kode Perpus
                            </label>

                            <input
                                type="text"
                                id="kode_perpus"
                                name="kode_perpus"
                                value="{{ old('kode_perpus') }}"
                            >
                        </div>


                        <div class="form-group">
                            <label for="isbn">
                                ISBN
                            </label>

                            <input
                                type="text"
                                id="isbn"
                                name="isbn"
                                value="{{ old('isbn') }}"
                            >

                            @error('isbn')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>


                    {{-- CATEGORY --}}
                    <div class="form-group category-group">

                        <label for="kategori_id">
                            kategori Buku
                        </label>

                        <div class="select-wrapper">

                            <select
                                id="kategori_id"
                                name="kategori_id"
                                required
                            >

                                <option value="" disabled selected>
                                </option>

                                @foreach($kategoris as $kategori)

                                    <option
                                        value="{{ $kategori->id }}"
                                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}
                                    >
                                        {{ $kategori->nama_kategori }}
                                    </option>

                                @endforeach

                            </select>

                            <i class="bi bi-chevron-down"></i>

                        </div>

                        @error('kategori_id')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="create-book-actions">

                <a
                    href="{{ route('buku.index') }}"
                    class="btn-cancel">
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn-save">
                    <i class="bi bi-check-lg"></i>
                    Simpan Buku
                </button>

            </div>

        </form>

    </div>

</div>


{{-- PREVIEW SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('gambar_sampul');
    const previewBox = document.getElementById('previewBox');
    const previewImage = document.getElementById('previewImage');
    const removeButton = document.getElementById('removePreview');

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            previewBox.classList.remove('show');
            previewImage.src = '';
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Format gambar harus JPG, JPEG, atau PNG.');
            input.value = '';
            previewBox.classList.remove('show');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 2MB.');
            input.value = '';
            previewBox.classList.remove('show');
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            previewImage.src = event.target.result;

            previewBox.classList.add('show');

        };

        reader.readAsDataURL(file);
    });


    removeButton.addEventListener('click', function () {

        input.value = '';

        previewImage.src = '';

        previewBox.classList.remove('show');

    });

});
</script>

@endsection