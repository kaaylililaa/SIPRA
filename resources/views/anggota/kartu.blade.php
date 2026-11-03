 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kartu Anggota - SIPRA</title>

    <link rel="stylesheet" href="{{ asset('css/kartu-anggota.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="kartu-page">

        <div class="kartu-toolbar">
            <a href="{{ route('anggota.index') }}" class="btn-kembali-kartu">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <button onclick="window.print()" class="btn-print-kartu">
                <i class="bi bi-printer-fill"></i>
                Cetak Kartu
            </button>
        </div>

        <div class="kartu-anggota">

            <div class="kartu-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Perpustakaan">

                <div class="kartu-identitas">
                    <h2>PERPUSTAKAAN DESA</h2>
                    <h1>RAJEG BERSATU</h1>
                    <p>KARTU TANDA ANGGOTA PERPUSTAKAAN</p>
                </div>
            </div>

            <div class="kartu-garis"></div>

            <div class="kartu-body">

                <div class="kartu-foto">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="kartu-data">

                    <h3>{{ $anggota->nama }}</h3>

                    <div class="kartu-detail">
                        <span>NIK</span>
                        <strong>{{ $anggota->nik }}</strong>
                    </div>

                    <div class="kartu-detail">
                        <span>Tempat, Tanggal Lahir</span>
                        <strong>
                            {{ $anggota->tempat_lahir }},
                            {{ $anggota->tanggal_lahir->translatedFormat('d F Y') }}
                        </strong>
                    </div>

                    <div class="kartu-detail">
                        <span>Alamat</span>
                        <strong>{{ $anggota->alamat }}</strong>
                    </div>

                </div>

            </div>

            <div class="kartu-footer">
                <span>ANGGOTA PERPUSTAKAAN DESA RAJEG BERSATU</span>
                <i class="bi bi-book-half"></i>
            </div>

        </div>

        <p class="kartu-caption">
            Pastikan data anggota sudah benar sebelum mencetak kartu.
        </p>

    </div>

</body>
</html>