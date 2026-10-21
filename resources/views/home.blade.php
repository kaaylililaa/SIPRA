@extends('layouts.app')

@section('title', 'Dashboard - SIPRA')
@section('header-title', 'DASHBOARD')
@section('header-description', 'Perpustakaan Desa Rajeg Bersatu')

@section('header-actions')
    <div class="header-user">
        <strong>{{ Auth::user()->name ?? 'Kay' }}</strong>
        <span>Administrator</span>
    </div>
@endsection

@section('content')

<section class="content">

      {{-- WELCOME CARD --}}
            <div class="welcome-card">

                <div class="welcome-text">

                    <div class="sipra-label">
                        <i class="bi bi-book-fill"></i>
                        SIPRA
                    </div>

                    <h2>
                        Halo, {{ Auth::user()->name ?? 'Kay' }}!
                    </h2>

                    <p>
                        Selamat datang kembali di Sistem Informasi Perpustakaan Desa Rajeg.
                        <br>
                        Kelola peminjaman buku di Perpustakaan Desa Rajeg dengan lebih mudah.
                    </p>

                </div>

                <div class="welcome-illustration">
    <img
        src="{{ asset('images/library-illustration.png') }}"
        alt="Ilustrasi perpustakaan SIPRA"
    >
</div>
</div>

            {{-- TITLE --}}
            <h3 class="section-title">
                Ringkasan Hari Ini
            </h3>

{{-- STATISTICS --}}
<div class="statistics">

    {{-- TOTAL BUKU --}}
    <a href="{{ route('buku.index') }}" class="stat-card stat-card-link">
        <div class="stat-icon green">
            <i class="bi bi-book-fill"></i>
        </div>

        <div class="stat-info">
            <strong>{{ $jumlahBuku ?? 0 }}</strong>
            <span>Total Buku</span>
        </div>
    </a>

    {{-- DIPINJAM --}}
    <a href="{{ route('peminjaman.index') }}" class="stat-card stat-card-link">
        <div class="stat-icon blue">
            <i class="bi bi-journal-bookmark-fill"></i>
        </div>

        <div class="stat-info">
            <strong>{{ $jumlahDipinjam ?? 0 }}</strong>
            <span>Dipinjam</span>
        </div>
    </a>

    {{-- ANGGOTA --}}
    <div class="stat-card">
        @if (auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}"
   class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
   @endif
        <div class="stat-icon purple">
            <i class="bi bi-person-fill"></i>
        </div>
</a>

        <div class="stat-info">
            <strong>{{ $jumlahAnggota ?? 0 }}</strong>
            <span>Anggota</span>
        </div>
    </div>

    {{-- KATEGORI --}}
    <a href="{{ route('kategori.index') }}" class="stat-card stat-card-link">
        <div class="stat-icon orange">
            <i class="bi bi-bookmark-heart-fill"></i>
        </div>

        <div class="stat-info">
            <strong>{{ $jumlahKategori ?? 0 }}</strong>
            <span>Kategori</span>
        </div>
    </a>

</div>

            {{-- LOWER CONTENT --}}
            <div class="dashboard-bottom">

                {{-- BUKU TERBARU --}}
            <div class="dashboard-card buku-terbaru-card">

    <div class="buku-terbaru-header">
        <h3>Buku Terbaru</h3>

        <a href="{{ route('buku.index') }}" class="lihat-semua-buku">
            Lihat semua
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="buku-terbaru-list">

        @forelse ($bukuTerbaru->take(3) as $buku)

            <a href="{{ route('buku.index') }}" class="buku-terbaru-item">

                <div class="buku-terbaru-sampul">

                    @if ($buku->gambar_sampul)
                        <img
                            src="{{ asset('uploads/sampul/' . basename($buku->gambar_sampul)) }}"
                            alt="Sampul {{ $buku->judul_buku }}"
                            loading="lazy"
                        >
                    @else
                        <div class="sampul-kosong">
                            <i class="bi bi-book"></i>
                        </div>
                    @endif

                </div>

                <div class="buku-terbaru-info">
                    <span>{{ $buku->judul_buku }}</span>
                    <small>{{ $buku->nama_pengarang ?? 'Pengarang tidak diketahui' }}</small>
                </div>

                <i class="bi bi-chevron-right buku-terbaru-arrow"></i>

            </a>

        @empty

            <div class="buku-kosong">
                <i class="bi bi-book"></i>
                <p>Belum ada buku.</p>
            </div>

        @endforelse

    </div>
</div>

                {{-- AKTIVITAS --}}
                <div class="activity-card card-box peminjam-terbaru-card">

    <div class="card-header">
        <h3>Data Terbaru Peminjam</h3>
        <a href="{{ route('peminjaman.index') }}" class="lihat-semua-peminjam">
            Lihat semua
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="peminjam-terbaru-list">

        @forelse ($peminjamTerbaru as $peminjam)

            <div class="peminjam-terbaru-item">

                <div class="peminjam-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="peminjam-info">
                    <strong>
                        {{ $peminjam->nama_peminjam }}
                    </strong>

                    <span>
                        <i class="bi bi-calendar3"></i>
                        {{ $peminjam->tanggal_pinjam
                            ? \Carbon\Carbon::parse($peminjam->tanggal_pinjam)->format('d M Y')
                            : '-' }}
                    </span>
                </div>

                @php
                    $statusPeminjam = strtolower($peminjam->status ?? 'dipinjam');

                    if ($statusPeminjam === 'dikembalikan') {
                        $statusClass = 'peminjam-status-kembali';
                        $statusLabel = 'Dikembalikan';
                    } elseif ($statusPeminjam === 'terlambat') {
                        $statusClass = 'peminjam-status-terlambat';
                        $statusLabel = 'Terlambat';
                    } else {
                        $statusClass = 'peminjam-status-dipinjam';
                        $statusLabel = 'Dipinjam';
                    }
                @endphp

                <span class="peminjam-status {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>

            </div>

        @empty

            <div class="peminjam-kosong">
                <i class="bi bi-inbox"></i>
                <p>Belum ada data peminjaman.</p>
            </div>

        @endforelse

    </div>
</div>
</section>

@endsection