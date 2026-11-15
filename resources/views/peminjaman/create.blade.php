@extends('layouts.app')

@section('header-title', 'Tambah Peminjaman')
@section('header-description', 'Masukkan data peminjaman buku')
@section('header-icon', 'bi bi-plus-circle-fill')

@section('header-actions')
    <a href="{{ route('peminjaman.index') }}" class="create-back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
@endsection
@section('content')

    <link
        rel="stylesheet"
        href="{{ asset('css/peminjaman-create.css') }}"
    >


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
    src="{{ asset('uploads/sampul/' . $buku->gambar_sampul) }}"
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


{{-- DAFTAR BUKU TERPILIH --}}
<div class="selected-books" id="selectedBooks" style="display: none;">

    <div class="selected-books-header">
        <strong id="selectedCount">0 buku dipilih</strong>
        <small>Maksimal 5 buku</small>
    </div>

    <div id="selectedBookList"></div>

</div>

{{-- INPUT ID BUKU --}}
<div id="selectedBookInputs"></div>

@error('buku_ids')
    <small class="error-message">{{ $message }}</small>
@enderror

@error('buku_ids.*')
    <small class="error-message">{{ $message }}</small>
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
    const bookItems = document.querySelectorAll('.book-item');

    const selectedBooks = document.getElementById('selectedBooks');
    const selectedBookList = document.getElementById('selectedBookList');
    const selectedBookInputs = document.getElementById('selectedBookInputs');
    const selectedCount = document.getElementById('selectedCount');

    const selectedBookIds = new Set(
        (@json(old('buku_ids', []))).map(id => String(id))
    );


// SEARCH BUKU
function normalisasi(teks) {
    return teks
        .toLowerCase()
        .replace(/[^a-z0-9\s]/g, '')
        .trim();
}

searchInput.addEventListener('input', function () {
    const keyword = normalisasi(this.value);

    bookItems.forEach(function (item) {
        const title = normalisasi(item.dataset.title || '');
        const author = normalisasi(item.dataset.author || '');

        const cocok =
            title.includes(keyword) ||
            author.includes(keyword);

        item.style.setProperty(
            'display',
            cocok ? 'flex' : 'none',
            'important'
        );
    });
});

    // UPDATE DAFTAR BUKU TERPILIH
    function updateSelectedBooks() {

        selectedBookList.innerHTML = '';
        selectedBookInputs.innerHTML = '';

        selectedCount.textContent =
            selectedBookIds.size + ' buku dipilih';

        selectedBooks.style.display =
            selectedBookIds.size > 0 ? 'block' : 'none';

        selectedBookIds.forEach(function (id) {

            const bookItem = Array.from(bookItems).find(
                item => item.dataset.id === id
            );

            if (!bookItem) return;

            const title = bookItem.querySelector(
                '.book-information h3'
            ).textContent.trim();

            const author = bookItem.querySelector(
                '.book-information p'
            ).textContent.trim();

            // Input tersembunyi untuk dikirim ke controller
            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = 'buku_ids[]';
            input.value = id;

            selectedBookInputs.appendChild(input);

            // Tampilan buku terpilih
            const row = document.createElement('div');
            row.className = 'selected-book-row';

            const info = document.createElement('div');
            info.className = 'selected-book-info';

            const icon = document.createElement('i');
            icon.className = 'bi bi-check-circle-fill';

            const textWrapper = document.createElement('div');

            const titleElement = document.createElement('strong');
            titleElement.textContent = title;

            const authorElement = document.createElement('small');
            authorElement.textContent = author;

            textWrapper.appendChild(titleElement);
            textWrapper.appendChild(authorElement);

            info.appendChild(icon);
            info.appendChild(textWrapper);

            // Tombol hapus pilihan
            const removeButton = document.createElement('button');

            removeButton.type = 'button';
            removeButton.className = 'btn-remove-book';
            removeButton.innerHTML = '<i class="bi bi-x-lg"></i>';

            removeButton.addEventListener('click', function () {
                selectedBookIds.delete(id);
                updateSelectedBooks();
            });

            row.appendChild(info);
            row.appendChild(removeButton);

            selectedBookList.appendChild(row);

        });

        // Perbarui tombol Pilih
        bookItems.forEach(function (item) {

            const button = item.querySelector('.btn-pilih-buku');
            const isSelected = selectedBookIds.has(item.dataset.id);

            button.textContent = isSelected ? 'Dipilih' : 'Pilih';

            button.classList.toggle('is-selected', isSelected);

        });

    }

    // PILIH / BATALKAN BUKU
    document.querySelectorAll('.btn-pilih-buku').forEach(function (button) {

        button.addEventListener('click', function () {

            const id = String(this.dataset.id);

            if (selectedBookIds.has(id)) {

                selectedBookIds.delete(id);

            } else {

                if (selectedBookIds.size >= 5) {

                    alert('Maksimal peminjaman adalah 5 buku.');

                    return;
                }

                selectedBookIds.add(id);

            }

            updateSelectedBooks();

        });

    });

    // SET TANGGAL KEMBALI OTOMATIS 7 HARI
    const tanggalPinjam = document.getElementById('tanggal_pinjam');
    const tanggalKembali = document.getElementById('tanggal_kembali');

    function setTanggalKembali() {

        if (!tanggalPinjam.value) return;

        const tanggal = new Date(
            tanggalPinjam.value + 'T00:00:00'
        );

        tanggal.setDate(tanggal.getDate() + 7);

        const year = tanggal.getFullYear();
        const month = String(tanggal.getMonth() + 1).padStart(2, '0');
        const day = String(tanggal.getDate()).padStart(2, '0');

        tanggalKembali.value = `${year}-${month}-${day}`;

    }

    tanggalPinjam.addEventListener('change', setTanggalKembali);

    // VALIDASI FORM
    document.getElementById('formPeminjaman')
        .addEventListener('submit', function (event) {

            if (selectedBookIds.size === 0) {

                event.preventDefault();

                alert('Silakan pilih minimal satu buku.');

                return;
            }

            if (!document.getElementById('nama_peminjam').value.trim()) {

                event.preventDefault();

                alert('Nama peminjam wajib diisi.');

                return;
            }

        });

    // TAMPILKAN KEMBALI PILIHAN JIKA VALIDASI GAGAL
    updateSelectedBooks();

});
</script>

@endsection