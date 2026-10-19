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
                <div class="stat-card">

                    <div class="stat-icon green">
                        <i class="bi bi-book-fill"></i>
                    </div>

                    <div class="stat-info">
                        <strong>{{ $jumlahBuku ?? 0 }}</strong>
                        <span>Total Buku</span>
                    </div>

                </div>


                {{-- DIPINJAM --}}
                <div class="stat-card">

                    <div class="stat-icon blue">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>

                    <div class="stat-info">
                        <strong>{{ $jumlahDipinjam ?? 0 }}</strong>
                        <span>Dipinjam</span>
                    </div>

                </div>


                {{-- ANGGOTA --}}
                <div class="stat-card">

                    <div class="stat-icon purple">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="stat-info">
                        <strong>{{ $jumlahUser ?? 0 }}</strong>
                        <span>Anggota</span>
                    </div>

                </div>


                {{-- KATEGORI --}}
                <div class="stat-card">

                    <div class="stat-icon orange">
                        <i class="bi bi-bookmark-fill"></i>
                    </div>

                    <div class="stat-info">
                        <strong>{{ $jumlahKategori ?? 0 }}</strong>
                        <span>Kategori</span>
                    </div>

                </div>

            </div>


            {{-- LOWER CONTENT --}}
            <div class="dashboard-bottom">

                {{-- BUKU TERBARU --}}
            
<div class="dashboard-card buku-terbaru-card">
    <h3>Buku Terbaru</h3>

    <div class="buku-terbaru-list">
        @forelse ($bukuTerbaru->take(3) as $buku)
            <div class="buku-terbaru-item">
                <div class="buku-terbaru-sampul">
                    @if ($buku->gambar_sampul)
                        <img
                            src="{{ asset('uploads/sampul/' . basename($buku->gambar_sampul)) }}"
                            alt="{{ $buku->judul_buku }}"
                        >
                    @else
                        <div class="sampul-kosong">
                            <i class="bi bi-book"></i>
                        </div>
                    @endif
                </div>

                <div class="buku-terbaru-info">
                    <span>{{ $buku->judul_buku }}</span>
                </div>
            </div>
        @empty
            <p class="buku-kosong">Belum ada buku.</p>
        @endforelse
    </div>
</div>

                {{-- AKTIVITAS --}}
                <div class="activity-card card-box">

                    <div class="card-header">
                        <h3>Aktivitas</h3>
                    </div>

                    <div class="activity-list">

                        <div class="activity-item">
                            <span class="activity-dot green-dot"></span>
                            <p>Data buku berhasil ditambahkan</p>
                        </div>

                        <div class="activity-item">
                            <span class="activity-dot outline-dot"></span>
                            <p>Peminjaman buku berlangsung</p>
                        </div>

                        <div class="activity-item">
                            <span class="activity-dot green-dot"></span>
                            <p>Buku berhasil dikembalikan</p>
                        </div>

</section>

@endsection