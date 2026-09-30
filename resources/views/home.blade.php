<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SIPRA</title>

    {{-- Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >

    {{-- Dashboard CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

<div class="dashboard-wrapper">

    {{-- =====================================
         SIDEBAR
    ====================================== --}}
    <aside class="sidebar">

        {{-- Logo --}}
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Rajeg Bersatu">
        </div>

        {{-- Menu --}}
        <div class="menu-title">
            MENU
        </div>

        <nav class="sidebar-menu">

            {{-- Dashboard --}}
            <a href="{{ route('home') }}" class="menu-item active">
                <span class="menu-icon">
                    <i class="bi bi-grid-fill"></i>
                </span>

                <span>Dashboard</span>
            </a>

            {{-- Buku --}}
            <a href="{{ route('buku.index') }}" class="menu-item">
                <span class="menu-icon">
                    <i class="bi bi-book-fill"></i>
                </span>

                <span>Buku</span>
            </a>

            {{-- Peminjaman --}}
            <a href="{{ route('peminjaman.index') }}" class="menu-item">
                <span class="menu-icon">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </span>

                <span>Peminjaman</span>
            </a>

            {{-- Profil --}}
            <a href="{{ route('profile.index') }}" class="menu-item">
                <span class="menu-icon">
                    <i class="bi bi-person-fill"></i>
                </span>

                <span>Profil</span>
            </a>

        </nav>


        {{-- Logout --}}
        <div class="sidebar-bottom">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- =====================================
         MAIN CONTENT
    ====================================== --}}
    <main class="main-content">

        {{-- HEADER --}}
        <header class="top-header">

            <div class="header-title">

                <h1>DASHBOARD</h1>

                <p>
                    Perpustakaan Desa Rajeg Bersatu
                </p>

            </div>


            <div class="header-user">

                <strong>
                    {{ auth()->user()->name ?? 'Kay' }}
                </strong>

                <span>
                    Administrator
                </span>

            </div>

        </header>


        {{-- =====================================
             CONTENT
        ====================================== --}}
        <section class="dashboard-content">


            {{-- =================================
                 WELCOME CARD
            ================================== --}}
            <div class="welcome-card">

                <div class="welcome-content">

                    <div class="sipra-badge">
                        <i class="bi bi-book-fill"></i>
                        SIPRA
                    </div>

                    <h2>
                        Halo, {{ auth()->user()->name ?? 'Kay' }}!
                    </h2>

                    <p>
                        Selamat datang kembali di Sistem Informasi Perpustakaan Desa Rajeg.
                    </p>

                    <p>
                        Kelola peminjaman buku di Perpustakaan Desa Rajeg dengan lebih mudah.
                    </p>

                </div>


                {{-- Ilustrasi --}}
                <div class="welcome-image">
                    <img
                        src="{{ asset('images/library-illustration.png') }}"
                        alt="Ilustrasi Perpustakaan"
                    >
                </div>

            </div>


            {{-- =================================
                 JUDUL RINGKASAN
            ================================== --}}
            <h2 class="section-title">
                Ringkasan Hari Ini
            </h2>


            {{-- =================================
                 SUMMARY CARDS
            ================================== --}}
            <div class="summary-grid">


                {{-- Total Buku --}}
                <div class="summary-card">

                    <div class="summary-icon buku-icon">
                        <i class="bi bi-book-fill"></i>
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $jumlahBuku ?? 1 }}
                        </strong>

                        <span>
                            Total Buku
                        </span>

                    </div>

                </div>


                {{-- Dipinjam --}}
                <div class="summary-card">

                    <div class="summary-icon pinjam-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $jumlahDipinjam ?? 59 }}
                        </strong>

                        <span>
                            Dipinjam
                        </span>

                    </div>

                </div>


                {{-- Anggota --}}
                <div class="summary-card">

                    <div class="summary-icon anggota-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $jumlahAnggota ?? 1 }}
                        </strong>

                        <span>
                            Anggota
                        </span>

                    </div>

                </div>


                {{-- Kategori --}}
                <div class="summary-card">

                    <div class="summary-icon kategori-icon">
                        <i class="bi bi-bookmark-fill"></i>
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $jumlahKategori ?? 5 }}
                        </strong>

                        <span>
                            Kategori
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================
                 BOTTOM SECTION
            ================================== --}}
            <div class="bottom-grid">


                {{-- ==============================
                     BUKU TERBARU
                =============================== --}}
                <div class="dashboard-box buku-terbaru">

                    <div class="box-title">
                        Buku Terbaru
                    </div>

                    @if(isset($bukuTerbaru) && $bukuTerbaru)

                        <div class="book-item">

                            <div class="book-cover">

                                @if($bukuTerbaru->gambar_sampul)
                                    <img
                                        src="{{ asset('storage/' . $bukuTerbaru->gambar_sampul) }}"
                                        alt="{{ $bukuTerbaru->judul_buku }}"
                                    >
                                @else
                                    <i class="bi bi-book"></i>
                                @endif

                            </div>

                            <div class="book-name">
                                {{ $bukuTerbaru->judul_buku }}
                            </div>

                        </div>

                    @else

                        <div class="book-item">

                            <div class="book-cover">
                                <i class="bi bi-book"></i>
                            </div>

                            <div class="book-name">
                                Waktu Aku Sama Mika
                            </div>

                        </div>

                    @endif

                </div>


                {{-- ==============================
                     AKTIVITAS
                =============================== --}}
                <div class="dashboard-box aktivitas-box">

                    <div class="box-title">
                        Aktivitas
                    </div>

                    <div class="activity-list">

                        <div class="activity-item">

                            <i class="bi bi-check-circle-fill"></i>

                            <span>
                                Data buku berhasil ditambahkan
                            </span>

                        </div>


                        <div class="activity-item">

                            <i class="bi bi-check-circle-fill"></i>

                            <span>
                                Peminjaman buku berlangsung
                            </span>

                        </div>


                        <div class="activity-item">

                            <i class="bi bi-check-circle-fill"></i>

                            <span>
                                Buku berhasil dikembalikan
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>