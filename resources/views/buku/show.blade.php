@extends('layouts.app')

@section('header-title', 'Detail Buku')
@section('header-description', 'Informasi lengkap koleksi buku perpustakaan.')
@section('header-icon', 'bi bi-book-half')

@section('header-actions')
    <a href="{{ route('buku.index') }}" class="show-back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
@endsection

@section('content')
<div class="buku-detail-page">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="detail-alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- KONTEN --}}
    <section class="detail-content">

        {{-- TOMBOL AKSI --}}
        <div class="detail-actions">
            <a href="{{ route('buku.edit', $buku->id) }}"
               class="detail-btn-edit">
                <i class="bi bi-pencil-square"></i>
                Edit Buku
            </a>

<button type="button"
        class="detail-btn-delete"
        onclick="bukaPopupHapus()">
    <i class="bi bi-trash3"></i>
    Hapus Buku
</button>

        </div>

        {{-- INFORMASI UTAMA --}}
        <div class="detail-book-card">

            <div class="detail-cover-wrapper">
                @if($buku->gambar_sampul)
                    <img
                        src="{{ asset('uploads/sampul/' . $buku->gambar_sampul) }}"
                        alt="Sampul {{ $buku->judul_buku }}"
                        class="detail-book-cover"
                    >
                @else
                    <div class="detail-cover-empty">
                        <i class="bi bi-book"></i>
                        <span>Tidak ada sampul</span>
                    </div>
                @endif
            </div>

            <div class="detail-book-information">
                <span class="detail-section-label">INFORMASI BUKU</span>

                <h2>{{ $buku->judul_buku }}</h2>

                <p class="detail-author">
                    <i class="bi bi-person"></i>
                    {{ $buku->nama_pengarang ?: 'Pengarang belum diisi' }}
                </p>

                <p class="detail-publisher">
                    <i class="bi bi-building"></i>
                    {{ $buku->nama_penerbit ?: 'Penerbit belum diisi' }}
                    @if($buku->tahun_terbit)
                        ({{ $buku->tahun_terbit }})
                    @endif
                </p>

                <div class="detail-badges">
                    <span class="detail-category-badge">
                        <i class="bi bi-bookmark"></i>
                        {{ $buku->kategori->nama_kategori ?? 'Belum berkategori' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- INFORMASI TAMBAHAN --}}
        <div class="detail-information-card">
            <div class="detail-information-heading">
                <i class="bi bi-info-circle"></i>
                <h3>Informasi Tambahan</h3>
            </div>

            <div class="detail-information-grid">
                <div class="detail-information-item">
                    <span>ISBN</span>
                    <strong>{{ $buku->isbn ?: '-' }}</strong>
                </div>

                <div class="detail-information-item">
                    <span>Kode Perpustakaan</span>
                    <strong>{{ $buku->kode_perpus ?: '-' }}</strong>
                </div>

                <div class="detail-information-item">
                    <span>Tahun Terbit</span>
                    <strong>{{ $buku->tahun_terbit ?: '-' }}</strong>
                </div>

                <div class="detail-information-item">
                    <span>Kategori</span>
                    <strong>
                        {{ $buku->kategori->nama_kategori ?? '-' }}
                    </strong>
                </div>

                <div class="detail-information-item">
                    <span>Nama Pengarang</span>
                    <strong>{{ $buku->nama_pengarang ?: '-' }}</strong>
                </div>

                <div class="detail-information-item">
                    <span>Nama Penerbit</span>
                    <strong>{{ $buku->nama_penerbit ?: '-' }}</strong>
                </div>
            </div>
        </div>
    </section>
</div>


{{-- POP-UP KONFIRMASI HAPUS BUKU --}}
<div class="popup-overlay" id="popupHapusBuku">
    <div class="popup-hapus">

        <div class="popup-icon">
            <i class="bi bi-trash3"></i>
        </div>

        <h3>Hapus Buku?</h3>

        <p>
            Apakah kamu yakin ingin menghapus buku
            <strong>{{ $buku->judul_buku }}</strong>?
            Data buku yang dihapus tidak dapat dikembalikan.
        </p>

        <div class="popup-actions">
            <button
                type="button"
                class="popup-btn-batal"
                onclick="tutupPopupHapus()"
            >
                Batal
            </button>

            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="popup-btn-hapus">
                    Hapus Buku
                </button>
            </form>
        </div>

    </div>
</div>


<script>
function bukaPopupHapus() {
    document.getElementById('popupHapusBuku').classList.add('aktif');
}

function tutupPopupHapus() {
    document.getElementById('popupHapusBuku').classList.remove('aktif');
}

document.getElementById('popupHapusBuku').addEventListener('click', function (event) {
    if (event.target === this) {
        tutupPopupHapus();
    }
});

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        tutupPopupHapus();
    }
});
</script>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/buku-detail.css') }}">
@endpush

@push('scripts')
<script>
function openDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    const cancelButton = modal.querySelector('.detail-cancel-delete');
    if (cancelButton) cancelButton.focus();
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('deleteModal');

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('show')) {
            closeDeleteModal();
        }
    });
});
</script>
@endpush
