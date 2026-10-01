<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Buku - SIPRA</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link rel="stylesheet" href="{{ asset('css/buku-edit.css') }}">
</head>

<body>

<div class="app-wrapper">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="logo-area">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Rajeg Bersatu"
                class="logo"
            >

            <h2>SIPRA</h2>

            <p>
                Sistem Informasi<br>
                Perpustakaan Desa<br>
                Rajeg Bersatu
            </p>

        </div>


        <div class="menu-title">
            MENU
        </div>


        <nav class="sidebar-menu">

            <a href="{{ route('home') }}" class="menu-item">
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

          <a href="/profil" class="menu-item">
    <i class="bi bi-person-fill"></i>
    <span>Profil</span>
</a>

        </nav>


        <div class="logout-area">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- ================= MAIN CONTENT ================= -->

    <main class="main-content">

        <!-- HEADER -->

        <div class="page-header">

            <div class="header-left">

                <div class="header-icon">
                    <i class="bi bi-pencil"></i>
                </div>

                <div>

                    <h1>Edit Buku</h1>

                    <p>
                        Edit Data Buku Perpustakaan Desa Rajeg Bersatu
                    </p>

                </div>

            </div>


            <a href="{{ route('buku.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>


        <!-- ================= FORM CARD ================= -->

        <div class="edit-card">

            <form
                action="{{ route('buku.update', $buku->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <!-- ================= SAMPUL ================= -->

                <div class="cover-section">

                    <h3>Sampul Buku</h3>


                    <div class="cover-preview">

                        @if($buku->gambar_sampul)

                         <img
    src="{{ asset('uploads/sampul/' . $buku->gambar_sampul) }}"
    alt="Sampul {{ $buku->judul_buku }}"
    id="coverPreview"
>

                        @else

                            <div class="empty-cover" id="emptyCover">
                                <i class="bi bi-book"></i>
                                <span>Tidak ada sampul</span>
                            </div>

                            <img
                                src=""
                                alt=""
                                id="coverPreview"
                                style="display: none;"
                            >

                        @endif

                    </div>


                    <label for="gambar_sampul" class="change-cover-button">

                        <i class="bi bi-cloud-arrow-up"></i>
                        Ubah Sampul

                    </label>

                    <input
                        type="file"
                        name="gambar_sampul"
                        id="gambar_sampul"
                        accept=".jpg,.jpeg,.png,.webp"
                        hidden
                    >


                    <button
                        type="button"
                        class="remove-cover-button"
                        onclick="removeCover()"
                    >
                        <i class="bi bi-trash3"></i>
                        Hapus Sampul
                    </button>


                    <div class="format-info">

                        Format yang didukung:<br>
                        JPG, PNG, JPEG<br>
                        Maks. ukuran 2MB

                    </div>

                </div>


                <!-- ================= FORM INPUT ================= -->

                <div class="form-section">

                    <div class="form-grid">

                        <!-- Judul -->

                        <div class="form-group">

                            <label for="judul_buku">
                                Judul Buku
                            </label>

                            <input
                                type="text"
                                name="judul_buku"
                                id="judul_buku"
                                value="{{ old('judul_buku', $buku->judul_buku) }}"
                                required
                            >

                            @error('judul_buku')
                                <small class="error-message">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <!-- Pengarang -->

                        <div class="form-group">

                            <label for="nama_pengarang">
                                Nama Pengarang
                            </label>

                            <input
                                type="text"
                                name="nama_pengarang"
                                id="nama_pengarang"
                                value="{{ old('nama_pengarang', $buku->nama_pengarang) }}"
                                required
                            >

                            @error('nama_pengarang')
                                <small class="error-message">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <!-- Penerbit -->

                        <div class="form-group">

                            <label for="nama_penerbit">
                                Nama Penerbit
                            </label>

                            <input
                                type="text"
                                name="nama_penerbit"
                                id="nama_penerbit"
                                value="{{ old('nama_penerbit', $buku->nama_penerbit) }}"
                                required
                            >

                            @error('nama_penerbit')
                                <small class="error-message">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <!-- Tahun -->

                        <div class="form-group">

                            <label for="tahun_terbit">
                                Tahun Terbit
                            </label>

                            <input
                                type="number"
                                name="tahun_terbit"
                                id="tahun_terbit"
                                value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                min="1000"
                                max="{{ date('Y') }}"
                                required
                            >

                            @error('tahun_terbit')
                                <small class="error-message">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <!-- Kode Perpus -->

                        <div class="form-group">

                            <label for="kode_perpus">
                                Kode Perpus
                            </label>

                            <input
    type="text"
    name="kode_perpus"
    id="kode_perpus"
    value="{{ old('kode_perpus', $buku->kode_perpus) }}"
    placeholder="Masukkan kode perpus"
>

                        </div>


                        <!-- ISBN -->

                        <div class="form-group">

                            <label for="isbn">
                                ISBN
                            </label>

                            <input
                                type="text"
                                name="isbn"
                                id="isbn"
                                value="{{ old('isbn', $buku->isbn) }}"
                            >

                            @error('isbn')
                                <small class="error-message">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <!-- Kategori -->

                        <div class="form-group full-width">

                            <label for="kategori_id">
                                Kategori Buku
                            </label>

                            <select
                                name="kategori_id"
                                id="kategori_id"
                                required
                            >

                                <option value="" disabled>
                                    Pilih kategori
                                </option>

                                @foreach($kategoris as $kategori)

                                    <option
                                        value="{{ $kategori->id }}"
                                        {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}
                                    >
                                        {{ $kategori->nama_kategori }}
                                    </option>

                                @endforeach

                            </select>

                            @error('kategori_id')
                                <small class="error-message">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>


                    <!-- BUTTON -->

                    <div class="form-buttons">

                        <a
                            href="{{ route('buku.index') }}"
                            class="btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-update"
                        >
                            <i class="bi bi-check-lg"></i>
                            Perbarui Buku
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </main>

</div>


<!-- ================= JAVASCRIPT ================= -->

<script>

    const imageInput = document.getElementById('gambar_sampul');
    const coverPreview = document.getElementById('coverPreview');

    imageInput.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function (event) {

                coverPreview.src = event.target.result;
                coverPreview.style.display = 'block';

                const emptyCover = document.getElementById('emptyCover');

                if (emptyCover) {
                    emptyCover.style.display = 'none';
                }

            };

            reader.readAsDataURL(file);
        }

    });


    function removeCover() {

        imageInput.value = '';

        coverPreview.src = '';
        coverPreview.style.display = 'none';

        const emptyCover = document.getElementById('emptyCover');

        if (emptyCover) {
            emptyCover.style.display = 'flex';
        }

    }

</script>

</body>
</html>