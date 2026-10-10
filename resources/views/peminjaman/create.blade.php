@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')

<link rel="stylesheet" href="{{ asset('css/peminjaman-create.css') }}">

<div class="peminjaman-create-page">

    {{-- HEADER --}}
    <div class="create-header">

        <div class="create-title-wrapper">

            <div class="create-title-icon">
                <i class="bi bi-plus-circle-fill"></i>
            </div>

            <div>
                <h1>Tambah Peminjaman</h1>
                <p>Masukkan data peminjaman buku</p>
            </div>

        </div>

    </div>


    {{-- FORM --}}
    <div class="create-card">

        <form
            action="{{ route('peminjaman.store') }}"
            method="POST"
            id="formPeminjaman"
        >

            @csrf


            {{-- PILIH BUKU --}}
            <div class="form-group buku-group">

                <label for="searchBuku">
                    Pilih Buku
                </label>

                <div class="book-search-wrapper">

                    <i class="bi bi-search-heart"></i>

                    <input
                        type="text"
                        id="searchBuku"
                        class="book-search-input"
                        placeholder="Cari judul buku..."
                        autocomplete="off"
                    >

                </div>


                {{-- DAFTAR BUKU --}}
                <div
                    class="book-list"
                    id="bookList"
                >

                  @forelse ($bukus as $buku)

    <div
        class="book-item"
        data-id="{{ $buku->id }}"
        data-title="{{ strtolower($buku->judul_buku) }}"
        data-author="{{ strtolower($buku->nama_pengarang ?? '') }}"
    >

        <div class="book-cover">

            @if ($buku->gambar_sampul)

                <img
                    src="{{ asset('uploads/' . $buku->gambar_sampul) }}"
                    alt="{{ $buku->judul_buku }}"
                >

            @else

                <div class="book-cover-empty">
                    <i class="bi bi-book"></i>
                </div>

            @endif

        </div>


        <div class="book-information">

            <h3>
                {{ $buku->judul_buku }}
            </h3>

            <p>
                {{ $buku->nama_pengarang ?? 'Tidak diketahui' }}
                <span>•</span>
                {{ $buku->tahun_terbit ?? '-' }}
            </p>

        </div>


        <button
            type="button"
            class="btn-pilih-buku"
            data-id="{{ $buku->id }}"
        >
            Pilih
        </button>

    </div>

@empty

    <div class="book-empty">

        <i class="bi bi-book"></i>

        <p>Belum ada data buku.</p>

    </div>

@endforelse

                </div>


                {{-- BUKU TERPILIH --}}
                <div
                    class="selected-book"
                    id="selectedBook"
                    style="display: none;"
                >

                    <div class="selected-book-info">

                        <i class="bi bi-check-circle-fill"></i>

                        <div>
                            <strong id="selectedBookTitle"></strong>
                            <small id="selectedBookAuthor"></small>
                        </div>

                    </div>

                    <button
                        type="button"
                        id="changeBook"
                        class="btn-change-book"
                    >
                        Ganti
                    </button>

                </div>


                <input
                    type="hidden"
                    name="buku_id"
                    id="buku_id"
                    value="{{ old('buku_id') }}"
                >

                @error('buku_id')
                    <small class="error-message">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- NAMA PEMINJAM --}}
            <div class="form-group">

                <label for="nama_peminjam">
                    Nama Peminjam
                </label>

                <input
                    type="text"
                    name="nama_peminjam"
                    id="nama_peminjam"
                    class="form-input"
                    value="{{ old('nama_peminjam') }}"
                    placeholder="Masukkan nama peminjam"
                    autocomplete="off"
                >

                @error('nama_peminjam')
                    <small class="error-message">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- TANGGAL --}}
            <div class="date-row">

                {{-- TANGGAL PINJAM --}}
                <div class="form-group">

                    <label for="tanggal_pinjam">
                        Tanggal Pinjam
                    </label>

                    <div class="date-input-wrapper">

                        <input
                            type="date"
                            name="tanggal_pinjam"
                            id="tanggal_pinjam"
                            class="form-input date-input"
                            value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        >

                    </div>

                    @error('tanggal_pinjam')
                        <small class="error-message">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- TANGGAL KEMBALI --}}
                <div class="form-group">

                    <label for="tanggal_kembali">
                        Tanggal Kembali
                    </label>

                    <div class="date-input-wrapper">

                        <input
                            type="date"
                            name="tanggal_kembali"
                            id="tanggal_kembali"
                            class="form-input date-input"
                            value="{{ old('tanggal_kembali') }}"
                        >

                    </div>

                    @error('tanggal_kembali')
                        <small class="error-message">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="form-actions">

                <a
                    href="{{ route('peminjaman.index') }}"
                    class="btn-kembali"
                >
                    Kembali
                </a>

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


<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchBuku');
    const bookList = document.getElementById('bookList');

    const selectedBook = document.getElementById('selectedBook');
    const selectedBookTitle = document.getElementById('selectedBookTitle');
    const selectedBookAuthor = document.getElementById('selectedBookAuthor');

    const bukuIdInput = document.getElementById('buku_id');
    const changeBookButton = document.getElementById('changeBook');

    const bookItems = document.querySelectorAll('.book-item');


    /*
    |--------------------------------------------------------------------------
    | SEARCH BUKU
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        bookItems.forEach(function (item) {

            const title = item.dataset.title;
            const author = item.dataset.author;

            if (
                title.includes(keyword) ||
                author.includes(keyword)
            ) {

                item.style.display = 'flex';

            } else {

                item.style.display = 'none';

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | PILIH BUKU
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.btn-pilih-buku').forEach(function (button) {

        button.addEventListener('click', function () {

            const id = this.dataset.id;

            const bookItem = this.closest('.book-item');

            const title = bookItem.querySelector('.book-information h3').textContent.trim();

            const author = bookItem.querySelector('.book-information p').textContent.trim();


            bukuIdInput.value = id;

            selectedBookTitle.textContent = title;
            selectedBookAuthor.textContent = author;


            bookList.style.display = 'none';
            searchInput.parentElement.style.display = 'none';

            selectedBook.style.display = 'flex';

        });

    });


    /*
    |--------------------------------------------------------------------------
    | GANTI BUKU
    |--------------------------------------------------------------------------
    */

    changeBookButton.addEventListener('click', function () {

        bukuIdInput.value = '';

        selectedBook.style.display = 'none';

        searchInput.parentElement.style.display = 'flex';
        bookList.style.display = 'block';

        searchInput.value = '';

        bookItems.forEach(function (item) {
            item.style.display = 'flex';
        });

    });


    /*
    |--------------------------------------------------------------------------
    | SET TANGGAL KEMBALI
    |--------------------------------------------------------------------------
    |
    | Sistem peminjaman SIPRA menggunakan batas peminjaman 7 hari.
    |
    */

    const tanggalPinjam = document.getElementById('tanggal_pinjam');
    const tanggalKembali = document.getElementById('tanggal_kembali');


    function setTanggalKembali() {

        if (!tanggalPinjam.value) {
            return;
        }

        const tanggal = new Date(tanggalPinjam.value + 'T00:00:00');

        tanggal.setDate(tanggal.getDate() + 7);

        const year = tanggal.getFullYear();

        const month = String(
            tanggal.getMonth() + 1
        ).padStart(2, '0');

        const day = String(
            tanggal.getDate()
        ).padStart(2, '0');

        tanggalKembali.value =
            year + '-' + month + '-' + day;

    }


    tanggalPinjam.addEventListener(
        'change',
        setTanggalKembali
    );


    /*
    |--------------------------------------------------------------------------
    | VALIDASI FORM
    |--------------------------------------------------------------------------
    */

    document.getElementById('formPeminjaman')
        .addEventListener('submit', function (event) {

            if (!bukuIdInput.value) {

                event.preventDefault();

                alert('Silakan pilih buku terlebih dahulu.');

                return;
            }


            if (!document.getElementById('nama_peminjam').value.trim()) {

                event.preventDefault();

                alert('Nama peminjam wajib diisi.');

                return;
            }

        });

});
</script>

@endsection