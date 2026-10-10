<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SIPRA</title>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- CSS Dashboard --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">   
</head>

<body>

<div class="dashboard-wrapper">

    @include('layouts.partials.sidebar')
    
    {{-- ================= MAIN CONTENT ================= --}}
    <main class="main-content">

        {{-- HEADER --}}
        <header class="top-header">

            <div class="header-title">
                <h1>DASHBOARD</h1>
                <p>Perpustakaan Desa Rajeg Bersatu</p>
            </div>

            <div class="header-user">
                <strong>{{ Auth::user()->name ?? 'Kay' }}</strong>
                <span>Administrator</span>
            </div>

        </header>


        {{-- CONTENT --}}
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
                <div class="latest-books card-box">

                    <div class="card-header">
                        <h3>Buku Terbaru</h3>
                    </div>

                    @if(isset($bukuTerbaru) && $bukuTerbaru->count() > 0)
@foreach ($bukuTerbaru->take(1) as $buku)

    <div class="latest-book-item">

        <div class="book-cover">

            @if ($buku->gambar_sampul)

                @php
                    $gambar = ltrim($buku->gambar_sampul, '/');

                    if (!str_starts_with($gambar, 'uploads/')) {
                        $gambar = 'uploads/' . $gambar;
                    }
                @endphp

                <img
                    src="{{ asset($gambar) }}"
                    alt="{{ $buku->judul_buku }}"
                >

            @else

                <div class="no-cover">
                    <i class="bi bi-book"></i>
                </div>

            @endif

        </div>

        <div class="book-title">
            {{ $buku->judul_buku }}
        </div>

    </div>

@endforeach

                    @else

                        <div class="empty-book">
                            Belum ada buku terbaru.
                        </div>

                    @endif

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

                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>