@extends('layouts.app')

@section('header-title', 'Data Buku')
@section('header-description', 'Kelola seluruh koleksi buku Perpustakaan Desa Rajeg Bersatu.')
@section('header-icon', 'bi bi-book-half')

@section('header-actions')
    <div class="header-book-actions">

        <div class="header-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                id="searchBuku"
                placeholder="Cari Buku..."
                autocomplete="off"
            >
        </div>

        <a href="{{ route('kategori.index') }}" class="header-btn-category">
            <i class="bi bi-funnel-fill"></i>
            Kategori
        </a>

        <a href="{{ route('buku.create') }}" class="header-btn-add">
            <i class="bi bi-plus-lg"></i>
            Tambah Buku
        </a>

    </div>
@endsection

@section('content')

<div class="buku-page">

    {{-- JUDUL DAFTAR BUKU --}}
    <div class="buku-list-title">
        <h2>Daftar Buku</h2>
        <span>Total {{ $totalBuku }} buku</span>
    </div>


    {{-- LIST BUKU --}}
    <div class="buku-list" id="bukuList">

        @forelse ($bukus as $buku)

            <article class="buku-card">

                {{-- SAMPUL --}}
                <div class="buku-cover-box">

                    @if ($buku->gambar_sampul)

                        @php
                            $coverPath = ltrim(
                                (string) $buku->gambar_sampul,
                                '/'
                            );

                            if (!str_starts_with($coverPath, 'uploads/')) {
                                if (str_starts_with($coverPath, 'sampul/')) {
                                    $coverPath = 'uploads/' . $coverPath;
                                } else {
                                    $coverPath = 'uploads/sampul/' . $coverPath;
                                }
                            }
                        @endphp

                        <img
                            src="{{ asset($coverPath) }}"
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


                {{-- STATUS DAN TOMBOL --}}
                <div class="buku-right">

                    @php
                        $statusBuku = $buku->status ?? 'Tersedia';

                        $statusSlug = strtolower(
                            str_replace(' ', '-', trim((string) $statusBuku))
                        );

                        $statusClass = in_array(
                            $statusSlug,
                            ['tidak-tersedia', 'dipinjam', 'habis']
                        ) ? 'tidak-tersedia' : 'tersedia';
                    @endphp

                    <span class="status {{ $statusClass }}">
                        {{ $statusBuku }}
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

    @if (auth()->check() && auth()->user()->role === 'admin')
        <button
            type="button"
            class="btn-hapus-data"
            onclick="bukaPopupHapusData({{ $buku->id }}, {{ Js::from($buku->judul_buku) }})"
        >
            <i class="bi bi-trash"></i>
            Hapus
        </button>
    @endif

</div>
</div>
            </article>

        @empty

            <div class="buku-empty">
                <i class="bi bi-book"></i>
                <p>Belum ada data buku.</p>
            </div>

        @endforelse

        <div class="buku-empty buku-search-empty" id="bukuSearchEmpty" hidden>
            <i class="bi bi-search"></i>
            <p>Buku yang dicari tidak ditemukan.</p>
        </div>

    </div>


    {{-- MODAL HAPUS --}}
    <div class="delete-modal-overlay" id="deleteModal">

        <div
            class="delete-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="deleteModalTitle"
        >

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

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            bookCards.forEach(function (card) {
                const matched = card.textContent
                    .toLowerCase()
                    .includes(keyword);

                card.style.display = matched ? 'flex' : 'none';

                if (matched) {
                    visibleCount++;
                }
            });

            if (searchEmpty) {
                searchEmpty.hidden = !(
                    keyword && visibleCount === 0
                );
            }
        });
    }
    // MODAL HAPUS
    const deleteModal = document.getElementById('deleteModal');
    const deleteBookTitle = document.getElementById('deleteBookTitle');
    const deleteBookForm = document.getElementById('deleteBookForm');
    const cancelButton = document.getElementById('btnCancelDelete');
    const deleteButtons = document.querySelectorAll('.btn-action-delete');

    function openDeleteModal(button) {
        deleteBookTitle.textContent = '"' + button.dataset.title + '"';
        deleteBookForm.action = button.dataset.deleteUrl;

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
            openDeleteModal(this);
        });
    });

    cancelButton.addEventListener('click', closeDeleteModal);

    deleteModal.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            deleteModal.classList.contains('show')
        ) {
            closeDeleteModal();
        }
    });

});
</script>



{{-- POPUP HAPUS BUKU --}}
@if (auth()->check() && auth()->user()->role === 'admin')
    <div class="popup-overlay" id="popupHapusData" aria-hidden="true">
        <div class="popup-hapus" role="dialog" aria-modal="true">
            <div class="popup-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <h3>Hapus Buku?</h3>

            <p>
                Kamu yakin ingin menghapus buku
                <strong id="judulBukuHapus"></strong>?
                Data yang dihapus tidak dapat dikembalikan.
            </p>

            <div class="popup-actions">
                <button
                    type="button"
                    class="popup-btn-batal"
                    onclick="tutupPopupHapusData()"
                >
                    Batal
                </button>

                <form id="formHapusData" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="popup-btn-hapus">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function bukaPopupHapusData(id, judul) {
            document.getElementById('judulBukuHapus').textContent = judul;
            document.getElementById('formHapusData').action = `/buku/${id}`;

            const popup = document.getElementById('popupHapusData');
            popup.classList.add('aktif');
            popup.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function tutupPopupHapusData() {
            const popup = document.getElementById('popupHapusData');
            popup.classList.remove('aktif');
            popup.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        document.getElementById('popupHapusData')
            .addEventListener('click', function (event) {
                if (event.target === this) {
                    tutupPopupHapusData();
                }
            });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                tutupPopupHapusData();
            }
        });
    </script>
@endif

<div class="pagination-container">
    {{ $bukus->links('pagination::bootstrap-5') }}
</div>

@endsection