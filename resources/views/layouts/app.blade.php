<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'SIPRA')
    </title>

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="sipra-layout">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="sidebar">

        {{-- LOGO --}}
        <div class="sidebar-logo">

            <div class="logo-image">
                <img
                    src="{{ asset('images/logo.png') }}"
                >
            </div>

            <div class="logo-text">
                <h2>SIPRA</h2>

                <p>
                    Sistem Informasi<br>
                    Perpustakaan Desa<br>
                    Rajeg Bersatu
                </p>
            </div>

        </div>


        {{-- MENU --}}
        <div class="sidebar-menu">

            <span class="menu-title">
                MENU
            </span>


            {{-- DASHBOARD --}}
            <a
                href="{{ url('/home') }}"
                class="sidebar-item {{ request()->is('home') || request()->is('dashboard') ? 'active' : '' }}"
            >
                <i class="bi bi-grid-fill"></i>

                <span>
                    Dashboard
                </span>
            </a>


            {{-- BUKU --}}
            <a
                href="{{ route('buku.index') }}"
                class="sidebar-item {{ request()->is('buku*') ? 'active' : '' }}"
            >
                <i class="bi bi-book-fill"></i>

                <span>
                    Buku
                </span>
            </a>


            {{-- PEMINJAMAN --}}
            <a
                href="{{ route('peminjaman.index') }}"
                class="sidebar-item {{ request()->is('peminjaman*') ? 'active' : '' }}"
            >
                <i class="bi bi-journal-text"></i>

                <span>
                    Peminjaman
                </span>
            </a>


            {{-- PROFIL --}}
            <a
                href="{{ url('/profil') }}"
                class="sidebar-item {{ request()->is('profil*') ? 'active' : '' }}"
            >
                <i class="bi bi-person-fill"></i>

                <span>
                    Profil
                </span>
            </a>

        </div>


        {{-- LOGOUT --}}
        <div class="sidebar-bottom">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>

            </form>

        </div>

    </aside>


    {{-- ================= MAIN ================= --}}
    <main class="main-content">

        @yield('content')

    </main>

</div>

</body>
</html>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buku-create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buku.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buku-edit.css') }}">