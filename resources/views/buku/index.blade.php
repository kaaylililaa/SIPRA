@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')

<link rel="stylesheet" href="{{ asset('css/buku.css') }}">

<div class="buku-page">

    {{-- HEADER --}}
    <div class="buku-top">

        <div class="buku-title">
            <div class="buku-title-icon">
                <i class="bi bi-book-half"></i>
            </div>

            <div class="buku-title-text">
                <h1>Data Buku</h1>
                <p>Kelola seluruh koleksi buku Perpustakaan Desa Rajeg Bersatu.</p>
            </div>
        </div>

        <div class="buku-top-actions">

            <div class="buku-search">
                <i class="bi bi-search-heart"></i>
                <input
                    type="text"
                    id="searchBuku"
                    placeholder="Cari Buku..."
                    autocomplete="off"
                >
            </div>

            <a href="{{ route('kategori.index') }}" class="btn-kategori">
                <i class="bi bi-funnel-fill"></i>
                Kategori
            </a>

            <a href="{{ route('buku.create') }}" class="btn-tambah-buku">
                <i class="bi bi-plus-lg"></i>
                Tambah Buku
            </a>

        </div>
    </div>


    {{-- JUDUL DAFTAR --}}
    <div class="buku-list-title">
        <h2>Daftar Buku</h2>
        <span>Total {{ $totalBuku }} buku</span>
    </div>


    {{-- DAFTAR BUKU --}}
    <div class="buku-list" id="bukuList">

        @forelse ($bukus as $buku)

            <article class="buku-card">

                {{-- COVER --}}
                <div class="buku-cover-box">

                    @if ($buku->gambar_sampul)

                        <img
                            src="{{ asset('uploads/sampul/' . $buku->gambar_sampul) }}"
                            alt="Sampul {{ $buku->judul_buku }}"
                            class="buku-cover"
                            loading="lazy"
                        >

                    @else

                        <div class="buku-no-cover">
                            <i class="bi bi-book"></i>
                        </div>

                    @endif

                </div>


                {{-- INFORMASI BUKU --}}
                <div class="buku-info">

                    <h3 title="{{ $buku->judul_buku }}">
                        {{ $buku->judul_buku }}
                    </h3>

                    <div class="buku-pengarang">
                        {{ $buku->nama_pengarang ?? 'Tidak diketahui' }}
                    </div>

                    <div class="buku-penerbit">
                        {{ $buku->nama_penerbit ?? 'Tidak diketahui' }}
                        <span class="detail-separator">•</span>
                        {{ $buku->tahun_terbit ?? '-' }}
                    </div>

                    <div class="buku-detail">

                        <span>
                            <i class="bi bi-upc-scan"></i>
                            ISBN: {{ $buku->isbn ?? '-' }}
                        </span>

                        <span class="detail-separator">•</span>

                        <span>
                            Kode: {{ $buku->kode_perpus ?? 'Belum ada' }}
                        </span>

                    </div>

                </div>


                {{-- AKSI DI SISI KANAN --}}
                <div class="buku-right">

                    {{-- Status mengikuti tampilan yang sudah digunakan --}}
                    <span class="status tersedia">
                        Tersedia
                    </span>

                    <div class="buku-buttons">

                        <a
                            href="{{ route('buku.show', $buku->id) }}"
                            class="buku-btn"
                            title="Lihat detail"
                            aria-label="Lihat detail buku"
                        >
                            <i class="bi bi-eye"></i>
                        </a>

                        <a
                            href="{{ route('buku.edit', $buku->id) }}"
                            class="buku-btn"
                            title="Edit buku"
                            aria-label="Edit buku"
                        >
                            <i class="bi bi-pencil"></i>
                        </a>

                        <button
                            type="button"
                            class="buku-btn btn-action-delete"
                            data-id="{{ $buku->id }}"
                            data-title="{{ $buku->judul_buku }}"
                            title="Hapus buku"
                            aria-label="Hapus buku"
                        >
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>
                </div>

            </article>

        @empty

            <div class="buku-empty" id="bukuEmpty">
                <i class="bi bi-book"></i>
                <p>Belum ada data buku.</p>
            </div>

        @endforelse

        <div class="buku-empty buku-search-empty" id="bukuSearchEmpty" hidden>
            <i class="bi bi-search"></i>
            <p>Buku yang dicari tidak ditemukan.</p>
        </div>

    </div>


    {{-- MODAL HAPUS: SATU SAJA DI LUAR LOOP --}}
    <div class="delete-modal-overlay" id="deleteModal">

        <div class="delete-modal" role="dialog" aria-modal="true"
             aria-labelledby="deleteModalTitle">

            <div class="delete-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <h3 id="deleteModalTitle">Hapus Buku?</h3>

            <p>
                Apakah kamu yakin ingin menghapus buku
                <strong id="deleteBookTitle"></strong>?
            </p>

            <div class="delete-modal-buttons">

                <button
                    type="button"
                    class="btn-cancel-delete"
                    id="btnCancelDelete"
                >
                    Batal
                </button>

                <form id="deleteBookForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-confirm-delete">
                        <i class="bi bi-trash3"></i>
                        Hapus
                    </button>
                </form>

            </div>
        </div>
    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    // PENCARIAN BUKU
    const searchInput = document.getElementById('searchBuku');
    const bookCards = document.querySelectorAll('.buku-card');
    const searchEmpty = document.getElementById('bukuSearchEmpty');

    searchInput.addEventListener('input', function () {
        const keyword = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        bookCards.forEach(function (card) {
            const text = card.textContent.toLowerCase();
            const matched = text.includes(keyword);

            card.style.display = matched ? 'flex' : 'none';

            if (matched) {
                visibleCount++;
            }
        });

        searchEmpty.hidden = visibleCount !== 0 || bookCards.length === 0;
    });


    // MODAL HAPUS BUKU
    const deleteModal = document.getElementById('deleteModal');
    const deleteBookTitle = document.getElementById('deleteBookTitle');
    const deleteBookForm = document.getElementById('deleteBookForm');
    const cancelButton = document.getElementById('btnCancelDelete');
    const deleteButtons = document.querySelectorAll('.btn-action-delete');

    function openDeleteModal(id, title) {
        deleteBookTitle.textContent = '"' + title + '"';
        deleteBookForm.action = "{{ url('/buku') }}/" + id;

        deleteModal.classList.add('show');
        document.body.style.overflow = 'hidden';
        cancelButton.focus();
    }

    function closeDeleteModal() {
        deleteModal.classList.remove('show');
        document.body.style.overflow = '';
    }

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openDeleteModal(
                this.dataset.id,
                this.dataset.title
            );
        });
    });

    cancelButton.addEventListener('click', closeDeleteModal);

    deleteModal.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && deleteModal.classList.contains('show')) {
            closeDeleteModal();
        }
    });

});
</script>

@endsection