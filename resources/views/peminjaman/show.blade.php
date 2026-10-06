@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
{{-- MODAL KONFIRMASI PENGEMBALIAN --}}
@if (strtolower($peminjaman->status) !== 'dikembalikan')

    <div class="return-modal">

        <label for="returnModalToggle"
               class="return-modal-overlay"></label>

        <div class="return-modal-box">

            <h3>Konfirmasi Pengembalian</h3>

            <div class="return-modal-divider"></div>

            <p class="return-modal-question">
                Apakah buku ini sudah dikembalikan?
            </p>

            <p class="return-modal-status">
                Status : {{ $peminjaman->status }}
            </p>

            <div class="return-modal-actions">

                {{-- BATAL --}}
                <label for="returnModalToggle"
                       class="btn-return-no">
                    Batal
                </label>

                {{-- KONFIRMASI --}}
                <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                      method="POST">

                    @csrf
                    @method('PATCH')

                    <button type="submit"
                            class="btn-return-yes">
                        Konfirmasi
                    </button>

                </form>

            </div>

        </div>

    </div>

@endif
<link rel="stylesheet" href="{{ asset('css/peminjaman-detail.css') }}">

<div class="detail-peminjaman-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="detail-header">

        <div class="detail-title-wrapper">

            <div class="detail-title-icon">
                <i class="bi bi-journal-text"></i>
            </div>

            <div class="detail-title-text">

                <h1>Detail Peminjaman</h1>

                <p>
                    Informasi lengkap peminjam buku Perpustakaan Desa Rajeg Bersatu
                </p>

            </div>

        </div>


    <a href="{{ route('peminjaman.konfirmasi', $peminjaman->id) }}" class="btn-kembalikan">
    <i class="bi bi-check-lg"></i>
    Kembalikan Buku
</a>

</div>

    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <div class="loan-summary">

        {{-- ID PEMINJAMAN --}}
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

                    <i class="bi bi-calendar3"></i>

                    {{ $peminjaman->tanggal_pinjam
                        ? $peminjaman->tanggal_pinjam->format('d M Y')
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

                    <i class="bi bi-calendar3"></i>

                    {{ $peminjaman->tanggal_kembali
                        ? $peminjaman->tanggal_kembali->format('d M Y')
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

                @if ($peminjaman->status === 'Dipinjam')

                    <span class="status-badge status-dipinjam">
                        <i class="bi bi-clock"></i>
                        Dipinjam
                    </span>

                @elseif ($peminjaman->status === 'Dikembalikan')

                    <span class="status-badge status-dikembalikan">
                        <i class="bi bi-check-circle"></i>
                        Dikembalikan
                    </span>

                @else

                    <span class="status-badge status-lainnya">
                        {{ $peminjaman->status ?? '-' }}
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
             INFORMASI PEMINJAM
        ================================================== --}}

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
             BUKU YANG DIPINJAM
        ================================================== --}}

        <div class="detail-card books-card">

            <div class="card-heading">

                <i class="bi bi-book-half"></i>

                <span>Buku yang Dipinjam</span>

            </div>


            <div class="card-line"></div>


            @if ($peminjaman->buku)

                <div class="borrowed-book">

                    {{-- COVER --}}
                    <div class="borrowed-book-cover">

                        @if ($peminjaman->buku->gambar_sampul)

                            <img
                                src="{{ asset('uploads/' . $peminjaman->buku->gambar_sampul) }}"
                                alt="{{ $peminjaman->buku->judul_buku }}"
                            >

                        @else

                            <div class="no-book-cover">
                                <i class="bi bi-book"></i>
                            </div>

                        @endif

                    </div>


                    {{-- DATA BUKU --}}
                    <div class="borrowed-book-info">

                        <h3>
                            {{ $peminjaman->buku->judul_buku }}
                        </h3>

                        <strong>
                            {{ $peminjaman->buku->nama_pengarang ?? 'Tidak diketahui' }}
                        </strong>

                        <p>
                            {{ $peminjaman->buku->nama_penerbit ?? 'Tidak diketahui' }}
                            <span>•</span>
                            {{ $peminjaman->buku->tahun_terbit ?? '-' }}
                        </p>

                    </div>


                    <div class="book-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </div>

                </div>

            @else

                <div class="no-book-data">

                    <i class="bi bi-book"></i>

                    <p>
                        Data buku tidak ditemukan.
                    </p>

                </div>

            @endif

        </div>

    </div>


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
                                ? $peminjaman->tanggal_pinjam->format('d M Y')
                                : '-' }}
                        </td>

                        <td>

                            @if ($peminjaman->status === 'Dipinjam')

                                <span class="table-status table-dipinjam">
                                    Dipinjam
                                </span>

                            @elseif ($peminjaman->status === 'Dikembalikan')

                                <span class="table-status table-dikembalikan">
                                    Dikembalikan
                                </span>

                            @else

                                <span class="table-status">
                                    {{ $peminjaman->status ?? '-' }}
                                </span>

                            @endif

                        </td>

                        <td>

                            @if ($peminjaman->status === 'Dikembalikan')

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

</div>
</div>