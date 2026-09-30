<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Buku | SIPRA</title>

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Poppins -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/buku-detail.css') }}">
</head>

<body>

<!-- ================= DELETE MODAL ================= -->
<div class="delete-modal-overlay" id="deleteModal">

    <div class="delete-modal">

        <div class="delete-icon">
            <i class="bi bi-trash3"></i>
        </div>

        <h3>Hapus Buku?</h3>

        <p>
            Apakah kamu yakin ingin menghapus buku
            <strong>"{{ $buku->judul_buku }}"</strong>?
        </p>

        <div class="delete-modal-buttons">

            <button
                type="button"
                class="btn-cancel-delete"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>

            <form
                action="{{ route('buku.destroy', $buku->id) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn-confirm-delete"
                >
                    <i class="bi bi-trash3"></i>
                    Hapus
                </button>
            </form>

        </div>

    </div>

</div>
<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>

<div class="sipra-wrapper">

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar">

        <div class="sidebar-top">

            <!-- Logo -->
            <div class="logo-wrapper">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logo Perpustakaan Desa Rajeg Bersatu"
                    class="logo"
                >
            </div>

            <!-- SIPRA -->
            <div class="sipra-title">
                SIPRA
            </div>

            <div class="sipra-description">
                Sistem Informasi<br>
                Perpustakaan Desa<br>
                Rajeg Bersatu
            </div>

            <!-- Menu -->
            <div class="menu-title">
                MENU
            </div>

            <nav class="sidebar-menu">

                <a href="{{ url('/home') }}" class="menu-item">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('buku.index') }}" class="menu-item active">
                    <i class="bi bi-book-fill"></i>
                    <span>Buku</span>
                </a>

                <a href="{{ route('peminjaman.index') }}" class="menu-item">
                    <i class="bi bi-journal-text"></i>
                    <span>Peminjaman</span>
                </a>

                <a href="{{ url('/profil') }}" class="menu-item">
                    <i class="bi bi-person-fill"></i>
                    <span>Profil</span>
                </a>

            </nav>

        </div>

        <!-- Logout -->
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


    <!-- ================= MAIN CONTENT ================= -->
    <main class="main-content">

        <!-- Header -->
        <header class="page-header">

            <div class="header-left">

                <div class="header-icon">
                    <i class="bi bi-book-half"></i>
                </div>

                <div class="header-text">
                    <h1>Detail Buku</h1>

                    <p>
                        Informasi lengkap koleksi buku perpustakaan.
                    </p>
                </div>

            </div>

            <a href="{{ route('buku.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </header>


        <!-- ================= CONTENT ================= -->
        <section class="content-area">

            <!-- Action Buttons -->
            <div class="action-buttons">

                <a
                    href="{{ route('buku.edit', $buku->id) }}"
                    class="btn-edit"
                >
                    <i class="bi bi-pencil"></i>
                    Edit
                </a>

       <button
    type="button"
    class="btn-delete"
    onclick="openDeleteModal()"
>
    <i class="bi bi-trash3"></i>
    Hapus
</button>

            </div>


            <!-- ================= BOOK CARD ================= -->
            <div class="book-card">

                <!-- Cover -->
                <div class="book-cover-wrapper">

                    @if(!empty($buku->gambar_sampul))

                        <img
                            src="{{ asset('storage/' . $buku->gambar_sampul) }}"
                            alt="Sampul {{ $buku->judul_buku }}"
                            class="book-cover"
                        >

                    @else

                        <div class="book-cover-empty">
                            <i class="bi bi-book"></i>
                            <span>Tidak ada sampul</span>
                        </div>

                    @endif

                </div>


                <!-- Book Information -->
                <div class="book-information">

                    <h2>
                        {{ $buku->judul_buku }}
                    </h2>

                    <p class="author">
                        {{ $buku->nama_pengarang }}
                    </p>

                    <p class="publisher">
                        {{ $buku->nama_penerbit }}
                        @if(!empty($buku->tahun_terbit))
                            {{ $buku->tahun_terbit }}
                        @endif
                    </p>


                    <!-- Badges -->
                    <div class="book-badges">

                        <span class="badge-category">
    {{ $buku->kategori->nama_kategori ?? 'Novel' }}
</span>
                        <span class="badge-status">
                            Tersedia
                        </span>

                    </div>

                </div>

            </div>


            <!-- ================= INFORMATION CARDS ================= -->
            <div class="information-grid">

                <!-- ISBN -->
                <div class="information-card">

                    <div class="information-label">
                        ISBN
                    </div>

                    <div class="information-value">
                        {{ data_get($buku, 'isbn') ?: '978-602-5421-124' }}
                    </div>

                </div>


                <!-- Kode Perpustakaan -->
                <div class="information-card">

                    <div class="information-label">
                        Kode Perpustakaan
                    </div>

                    <div class="information-value">
                        {{ data_get($buku, 'kode_perpustakaan') ?: '808.1 IND w' }}
                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>