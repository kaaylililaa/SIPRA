@extends('layouts.app')

@section('header-title', 'Detail Peminjam')
@section('header-description', 'Informasi lengkap peminjam buku Perpustakaan Desa Rajeg Bersatu.')
@section('header-icon', 'bi bi-journal-bookmark-fill')

@section('header-actions')
<a href="{{ route('peminjaman.index') }}"
       class="btn-kembali-data">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

       @if ($statusTampilan !== 'Dikembalikan')
    <button
        type="button"
        class="btn-kembalikan"
        onclick="bukaKonfirmasi()"
    >
        <i class="bi bi-check-lg"></i>
        Kembalikan Buku
    </button>
@endif    
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('css/peminjaman-detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/peminjaman-konfirmasi.css') }}">


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <div class="loan-summary">

        {{-- ID --}}
        <div class="summary-item summary-id">

            <div class="summary-icon">
                <i class="bi bi-archive"></i>
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    ID Peminjaman
                </span>

                <strong>
                    PMJ-{{ $peminjaman->tanggal_pinjam
                        ? $peminjaman->tanggal_pinjam->format('Ymd')
                        : '00000000' }}-{{ str_pad($peminjaman->id, 6, '0', STR_PAD_LEFT) }}
                </strong>

            </div>

        </div>


        {{-- TANGGAL PINJAM --}}
        <div class="summary-item">

            <div class="summary-content">

                <span class="summary-label">
                    Tanggal Pinjam
                </span>

                <strong class="summary-date">

                    <i class="bi bi-calendar2-heart"></i>

                    {{ $peminjaman->tanggal_pinjam
                        ? $peminjaman->tanggal_pinjam->locale('id')->translatedFormat('d F Y')
                        : '-' }}

                </strong>

            </div>

        </div>


        {{-- TANGGAL KEMBALI --}}
        <div class="summary-item">

            <div class="summary-content">

                <span class="summary-label">
                    Tanggal Kembali
                </span>

                <strong class="summary-date">

                    <i class="bi bi-calendar2-heart"></i>

                    {{ $peminjaman->tanggal_kembali
                        ? $peminjaman->tanggal_kembali->locale('id')->translatedFormat('d F Y')
                        : '-' }}

                </strong>

                @if ($peminjaman->tanggal_pinjam && $peminjaman->tanggal_kembali)

                    <small>
                        ({{ $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_kembali) }} hari)
                    </small>

                @endif

            </div>

        </div>


        {{-- STATUS --}}
        <div class="summary-item summary-status">

            <div class="summary-content">

                <span class="summary-label">
                    Status
                </span>


                @if ($statusTampilan === 'Terlambat')

                    <span class="status-badge status-terlambat">
                        <i class="bi bi-exclamation-circle"></i>
                        Terlambat
                    </span>

                @elseif ($statusTampilan === 'Dikembalikan')

                    <span class="status-badge status-dikembalikan">
                        <i class="bi bi-check-circle"></i>
                        Dikembalikan
                    </span>

                @else

                    <span class="status-badge status-dipinjam">
                        <i class="bi bi-clock"></i>
                        Dipinjam
                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <div class="detail-main-grid">

        {{-- =================================================
             KOLOM KIRI
        ================================================== --}}

        <div class="detail-left-column">

            {{-- DATA PEMINJAM --}}
            <div class="detail-card borrower-card">

                <div class="card-heading">

                    <i class="bi bi-person-fill"></i>

                    <span>Data Peminjam</span>

                </div>

                <div class="card-line"></div>

                <div class="borrower-row">

                    <div class="borrower-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="borrower-info">

                        <span>
                            Nama peminjam
                        </span>

                        <strong>
                            {{ $peminjaman->nama_peminjam }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 CARD TERLAMBAT
            ================================================== --}}

            @if ($isTerlambat)

                <div class="late-card">

                    <div class="late-title">

                        <i class="bi bi-exclamation-circle"></i>

                        <span>
                            Peminjaman Terlambat
                        </span>

                    </div>


                    <div class="late-info-grid">

                        {{-- TERLAMBAT --}}
                        <div class="late-info-box">

                            <span>
                                Terlambat
                            </span>

                            <strong>
                                {{ $hariTerlambat }} Hari
                            </strong>

                            @if ($mulaiTerlambat)
                                <small>
                                    Sejak {{ $mulaiTerlambat->locale('id')->translatedFormat('d F Y') }}
                                </small>
                            @endif

                        </div>


                        {{-- DENDA --}}
                        <div class="late-info-box">

                            <span>
                                Denda
                            </span>

                            <strong>
                                Rp {{ number_format($denda, 0, ',', '.') }}
                            </strong>

                            <small>
                                Rp 10.000 / hari
                            </small>

                        </div>

                    </div>


                    <div class="late-warning">

                        <i class="bi bi-info-circle"></i>

                        <span>
                            Denda dihitung berdasarkan Rp 10.000 per hari keterlambatan.
                        </span>

                    </div>

                </div>

            @endif

        </div>


        {{-- =================================================
             BUKU YANG DIPINJAM
        ================================================== --}}

        <div class="detail-card books-card">

            <div class="card-heading">

                <i class="bi bi-book-half"></i>

                <span>Buku yang Dipinjam</span>

            </div>

            <div class="card-line">
            @if ($peminjaman->buku)

                <div class="borrowed-book">

                    <div class="borrowed-book-cover">

                       @if ($peminjaman->buku && $peminjaman->buku->gambar_sampul)
    <img
        src="{{ asset('uploads/sampul/' . $peminjaman->buku->gambar_sampul) }}"
        alt="{{ $peminjaman->buku->judul_buku }}"
        class="buku-cover"
    >
@else
    <div class="buku-cover-placeholder">
        <i class="bi bi-book"></i>
        <span>Sampul tidak tersedia</span>
    </div>
@endif
@endif

    {{-- =====================================================
         RIWAYAT PEMINJAMAN
    ====================================================== --}}

    <div class="history-card">

        <div class="history-heading">

            <i class="bi bi-clock-history"></i>

            <span>Riwayat Peminjaman</span>

        </div>


        <div class="history-table-wrapper">

            <table class="history-table">

                <thead>

                    <tr>

                        <th>No.</th>

                        <th>Tanggal</th>

                        <th>Status</th>

                        <th>Keterangan</th>

                        <th>Petugas</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>

                        <td>
                            {{ $peminjaman->tanggal_pinjam
                                ? $peminjaman->tanggal_pinjam->locale('id')->translatedFormat('d F Y')
                                : '-' }}
                        </td>

                        <td>

                            @if ($statusTampilan === 'Terlambat')

                                <span class="table-status table-terlambat">
                                    Terlambat
                                </span>

                            @elseif ($statusTampilan === 'Dikembalikan')

                                <span class="table-status table-dikembalikan">
                                    Dikembalikan
                                </span>

                            @else

                                <span class="table-status table-dipinjam">
                                    Dipinjam
                                </span>

                            @endif

                        </td>

                        <td>

                            @if ($statusTampilan === 'Terlambat')

                                Terlambat

                            @elseif ($statusTampilan === 'Dikembalikan')

                                Sudah Dikembalikan

                            @else

                                Peminjaman Berlangsung

                            @endif

                        </td>

                        <td>
                            Kay
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- POP-UP KONFIRMASI PENGEMBALIAN --}}
@if ($statusTampilan !== 'Dikembalikan')
<div
    class="modal-konfirmasi {{ $isTerlambat ? 'konfirmasi-terlambat' : 'konfirmasi-normal' }}"
    id="modalKonfirmasi"
    aria-hidden="true"
>
    <div class="konfirmasi-card">

        <button
            type="button"
            class="btn-close-konfirmasi"
            onclick="tutupKonfirmasi()"
            aria-label="Tutup"
        >
            &times;
        </button>

        <h1 class="konfirmasi-title">
            Konfirmasi Pengembalian
        </h1>

        <div class="konfirmasi-divider"></div>

        <p class="konfirmasi-question">
            Apakah buku ini sudah dikembalikan?
        </p>

        @if (!$isTerlambat)

            <p class="konfirmasi-status">
                Status : {{ $peminjaman->status }}
            </p>

            <div class="konfirmasi-actions">
                <button
                    type="button"
                    class="btn-batal"
                    onclick="tutupKonfirmasi()"
                >
                    Batal
                </button>

                <form
                    action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn-konfirmasi">
                        Konfirmasi
                    </button>
                </form>
            </div>

        @else

            <div class="late-confirmation">
                <p class="late-status">Status : Terlambat</p>

                <p class="late-duration">
                    Keterlambatan : {{ $hariTerlambat }} Hari
                </p>

                <p class="late-fine">
                    Denda : Rp {{ number_format($denda, 0, ',', '.') }}
                </p>
            </div>

            <div class="late-confirmation-action">
                <form
                    action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <button
                        type="submit"
                        class="btn-konfirmasi btn-konfirmasi-late"
                    >
                        Konfirmasi
                    </button>
                </form>
            </div>

        @endif
    </div>
</div>
@endif

<script>
function bukaKonfirmasi() {
    const modal = document.getElementById('modalKonfirmasi');

    if (modal) {
        modal.classList.add('aktif');
        modal.setAttribute('aria-hidden', 'false');
    }
}

function tutupKonfirmasi() {
    const modal = document.getElementById('modalKonfirmasi');

    if (modal) {
        modal.classList.remove('aktif');
        modal.setAttribute('aria-hidden', 'true');
    }
}

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        tutupKonfirmasi();
    }
});

document.getElementById('modalKonfirmasi')?.addEventListener(
    'click',
    function (event) {
        if (event.target === this) {
            tutupKonfirmasi();
        }
    }
);
</script>

@endsection