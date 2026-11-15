<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota - SIPRA</title>

    {{-- FONT POPPINS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f0f4f0;
        }

        /* HALAMAN */

        .kartu-page {
            min-height: 100vh;
            padding: 45px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* TOOLBAR */

        .kartu-toolbar {
            width: 650px;
            max-width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .btn-kembali,
        .btn-cetak {
            height: 40px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .btn-kembali {
            background: white;
            color: #526452;
            border: 1px solid #e0e9e0;
        }

        .btn-cetak {
            background: #328b48;
            color: white;
            border: none;
        }

        .btn-kembali:hover {
            background: #e8f3e9;
        }

        .btn-cetak:hover {
            background: #246d38;
            transform: translateY(-2px);
        }

        /* KARTU UTAMA */

        .kartu-anggota {
            width: 650px;
            height: 410px;
            position: relative;
            overflow: hidden;
            background: #fff;
            border: 1px solid #dceadd;
            border-radius: 17px;
            box-shadow: 0 15px 40px rgba(36, 86, 53, .12);
        }

        /* DEKORASI HIJAU */

        .kartu-anggota::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            right: -105px;
            top: -115px;
            border-radius: 50%;
            background: #e5f3e6;
        }

        .kartu-anggota::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            right: -95px;
            bottom: 15px;
            border-radius: 50%;
            background: rgba(129, 199, 132, .12);
        }

        /* HEADER */

        .kartu-header {
            height: 90px;
            padding: 15px 28px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
        }

        .kartu-logo {
            width: 65px;
            height: 60px;
            flex-shrink: 0;
        }

        .kartu-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .kartu-identitas {
            flex: 1;
        }

        .kartu-identitas span {
            color: #718272;
            font-size: 10px;
            letter-spacing: 2px;
            font-weight: 500;
        }

        .kartu-identitas h2 {
            margin: 1px 0;
            color: #28754d;
            font-size: 22px;
            font-weight: 800;
        }

        .kartu-identitas p {
            margin: 0;
            color: #849184;
            font-size: 8px;
            letter-spacing: 1.2px;
        }

        .kartu-header-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf7ee;
            color: #62b66c;
            font-size: 23px;
        }

        /* AKSEN */

        .kartu-accent {
            height: 7px;
            background: linear-gradient(90deg, #287c4b, #78c77d, #b9e4b9);
        }

        /* BODY */

        .kartu-body {
            height: 265px;
            padding: 24px 35px;
            display: flex;
            align-items: center;
            gap: 28px;
            position: relative;
            z-index: 2;
        }

        /* FOTO */

        .kartu-foto {
            width: 125px;
            flex-shrink: 0;
            text-align: center;
        }

        .foto-frame {
            width: 115px;
            height: 145px;
            margin: 0 auto 10px;
            border: 2px solid #8dce91;
            border-radius: 12px;
            background: linear-gradient(145deg, #eaf6eb, #d8efda);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #68b976;
        }

        .foto-frame i {
            font-size: 57px;
        }

        .kartu-foto span {
            color: #438052;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* DATA ANGGOTA */

        .kartu-data {
            flex: 1;
            min-width: 0;
        }

        .kartu-label {
            display: inline-block;
            margin-bottom: 7px;
            padding: 5px 10px;
            border-radius: 5px;
            background: #edf7ee;
            color: #428452;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .kartu-data h3 {
            margin: 0 0 13px;
            color: #28754d;
            font-size: 19px;
            font-weight: 800;
            text-transform: uppercase;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .data-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
            margin-bottom: 10px;
        }

        .data-item span {
            color: #879187;
            font-size: 9px;
        }

        .data-item strong {
            color: #354438;
            font-size: 11px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        /* FOOTER */

        .kartu-footer {
            height: 48px;
            padding: 0 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 3;
            background: #328b48;
            color: white;
        }

        .kartu-footer div {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: .8px;
        }

        .kartu-footer div i {
            font-size: 15px;
        }

        .kartu-footer > span {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .kartu-watermark {
            position: absolute;
            right: 20px;
            bottom: 65px;
            font-size: 145px;
            color: rgba(87, 165, 99, .045);
            transform: rotate(-15deg);
            pointer-events: none;
        }

        .kartu-note {
            margin-top: 20px;
            color: #899489;
            font-size: 10px;
            text-align: center;
        }

        .kartu-note i {
            color: #70b77a;
            margin-right: 4px;
        }

        /* RESPONSIVE */

        @media (max-width: 700px) {
            .kartu-page {
                padding: 25px 12px;
            }

            .kartu-anggota {
                width: 100%;
                height: auto;
                aspect-ratio: 650 / 410;
            }

            .kartu-header {
                height: 22%;
                padding: 2%;
                gap: 2%;
            }

            .kartu-logo {
                width: 11%;
                height: 80%;
            }

            .kartu-identitas h2 {
                font-size: clamp(12px, 3.3vw, 22px);
            }

            .kartu-identitas span {
                font-size: clamp(6px, 1.5vw, 10px);
            }

            .kartu-identitas p {
                font-size: clamp(5px, 1.2vw, 8px);
            }

            .kartu-header-icon {
                display: none;
            }

            .kartu-accent {
                height: 1.7%;
            }

            .kartu-body {
                height: 64.6%;
                padding: 3%;
                gap: 3%;
            }

            .kartu-foto {
                width: 22%;
            }

            .foto-frame {
                width: 90%;
                height: auto;
                aspect-ratio: 115 / 145;
            }

            .foto-frame i {
                font-size: 35px;
            }

            .kartu-data h3 {
                font-size: clamp(10px, 2.8vw, 19px);
            }

            .data-item {
                margin-bottom: 2%;
            }

            .data-item span {
                font-size: clamp(6px, 1.3vw, 9px);
            }

            .data-item strong {
                font-size: clamp(7px, 1.7vw, 11px);
            }

            .kartu-footer {
                height: 11.7%;
                padding: 0 3%;
            }

            .kartu-footer div {
                font-size: clamp(6px, 1.4vw, 9px);
            }
        }

        /* CETAK KARTU */

        @media print {

            @page {
                size: 85.6mm 54mm;
                margin: 0;
            }

            html,
            body {
                width: 85.6mm !important;
                height: 54mm !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                overflow: hidden !important;
            }

            .kartu-page {
                display: block !important;
                width: 85.6mm !important;
                height: 54mm !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
            }

            .kartu-toolbar,
            .kartu-note {
                display: none !important;
            }

            .kartu-anggota {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 85.6mm !important;
                height: 54mm !important;
                min-height: 0 !important;
                margin: 0 !important;
                border: none !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                overflow: hidden !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .kartu-header {
                height: 12mm !important;
                padding: 2mm 4mm !important;
                gap: 2mm !important;
            }

            .kartu-logo {
                width: 11mm !important;
                height: 9mm !important;
            }

            .kartu-identitas span {
                font-size: 4.5pt !important;
            }

            .kartu-identitas h2 {
                font-size: 10pt !important;
            }

            .kartu-identitas p {
                font-size: 3.5pt !important;
            }

            .kartu-header-icon {
                width: 8mm !important;
                height: 8mm !important;
                font-size: 13pt !important;
            }

            .kartu-accent {
                height: 1mm !important;
            }

            .kartu-body {
                height: 34mm !important;
                padding: 3mm 4mm !important;
                gap: 3mm !important;
            }

            .kartu-foto {
                width: 19mm !important;
            }

            .foto-frame {
                width: 17mm !important;
                height: 22mm !important;
                margin-bottom: 1mm !important;
                border-radius: 1.5mm !important;
            }

            .foto-frame i {
                font-size: 22pt !important;
            }

            .kartu-foto span {
                font-size: 4pt !important;
            }

            .kartu-label {
                margin-bottom: 1mm !important;
                padding: 1mm 1.5mm !important;
                font-size: 4pt !important;
            }

            .kartu-data h3 {
                margin-bottom: 2mm !important;
                font-size: 8pt !important;
            }

            .data-item {
                gap: .5mm !important;
                margin-bottom: 1.5mm !important;
            }

            .data-item span {
                font-size: 4pt !important;
            }

            .data-item strong {
                font-size: 5pt !important;
                line-height: 1.2 !important;
            }

            .kartu-footer {
                height: 7mm !important;
                padding: 0 4mm !important;
            }

            .kartu-footer div {
                gap: 1mm !important;
                font-size: 4pt !important;
            }

            .kartu-footer div i {
                font-size: 7pt !important;
            }

            .kartu-footer > span {
                font-size: 7pt !important;
            }

            .kartu-watermark {
                font-size: 80pt !important;
            }
        }
    </style>
</head>

<body>

<div class="kartu-page">

    {{-- TOMBOL NAVIGASI --}}
    <div class="kartu-toolbar">
        <a href="{{ route('anggota.index') }}" class="btn-kembali">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

        <button onclick="window.print()" class="btn-cetak">
            <i class="bi bi-printer-fill"></i>
            Cetak Kartu
        </button>
    </div>

    {{-- KARTU ANGGOTA --}}
    <div class="kartu-anggota">

        <div class="kartu-header">

            <div class="kartu-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Perpustakaan">
            </div>

            <div class="kartu-identitas">
                <span>PERPUSTAKAAN DESA</span>
                <h2>RAJEG BERSATU</h2>
                <p>KARTU TANDA ANGGOTA PERPUSTAKAAN</p>
            </div>

            <div class="kartu-header-icon">
                <i class="bi bi-book-half"></i>
            </div>

        </div>

        <div class="kartu-accent"></div>

        <div class="kartu-body">

            <div class="kartu-foto">
                <div class="foto-frame">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>

            <div class="kartu-data">

                <div class="kartu-label">IDENTITAS ANGGOTA</div>

                <h3>{{ strtoupper($anggota->nama) }}</h3>

                <div class="data-item">
                    <span>Nomor Induk Kependudukan</span>
                    <strong>{{ $anggota->nik }}</strong>
                </div>

                <div class="data-item">
                    <span>Tempat, Tanggal Lahir</span>
                    <strong>
                        {{ $anggota->tempat }},
                        {{ $anggota->tanggal_lahir
                            ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
                            : '-' }}
                    </strong>
                </div>

                <div class="data-item">
                    <span>Alamat</span>
                    <strong>{{ $anggota->alamat }}</strong>
                </div>

            </div>

        </div>

        <div class="kartu-footer">
            <div>
                <i class="bi bi-patch-check-fill"></i>
                ANGGOTA RESMI PERPUSTAKAAN
            </div>

            <span>SIPRA</span>
        </div>

        <div class="kartu-watermark">
            <i class="bi bi-book-half"></i>
        </div>

    </div>

    <p class="kartu-note">
        <i class="bi bi-info-circle"></i>
        Pastikan data anggota sudah benar sebelum mencetak kartu.
    </p>

</div>

</body>
</html>
