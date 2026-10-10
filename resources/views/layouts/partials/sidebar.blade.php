<aside class="sidebar sipra-sidebar">

    {{-- LOGO DAN IDENTITAS --}}
    <div class="sidebar-logo">

        <div class="logo-image">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Perpustakaan Desa Rajeg Bersatu"
            >
        </div>

        <div class="sidebar-brand logo-text">
            <span>SIPRA</span>

            <p class="sidebar-subtitle">
                Sistem Informasi
                <br>
                Perpustakaan Desa
                <br>
                Rajeg Bersatu
            </p>
        </div>

    </div>


    {{-- MENU --}}
    <div class="menu-title">MENU</div>

    <nav class="sidebar-menu">

        <a
            href="{{ url('/home') }}"
            class="menu-item sidebar-item {{ request()->is('home') || request()->is('dashboard') ? 'active' : '' }}"
        >
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>

        <a
            href="{{ route('buku.index') }}"
            class="menu-item sidebar-item {{ request()->is('buku*') || request()->is('kategori*') ? 'active' : '' }}"
        >
            <i class="bi bi-book-fill"></i>
            <span>Buku</span>
        </a>

        <a
            href="{{ route('peminjaman.index') }}"
            class="menu-item sidebar-item {{ request()->is('peminjaman*') ? 'active' : '' }}"
        >
            <i class="bi bi-journal-bookmark-fill"></i>
            <span>Peminjaman</span>
        </a>

        <a
            href="{{ url('/profil') }}"
            class="menu-item sidebar-item {{ request()->is('profil*') ? 'active' : '' }}"
        >
            <i class="bi bi-person-fill"></i>
            <span>Profil</span>
        </a>

    </nav>


    {{-- LOGOUT --}}
    <div class="sidebar-bottom">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-button">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>