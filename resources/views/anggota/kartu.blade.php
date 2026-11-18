
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota - SIPRA</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* HILANGKAN PINGGIRAN KARTU DEPAN */
.kartu-depan {
    border: none !important;
    border-radius: 0 !important;
    outline: none !important;
    box-shadow: none !important;
    background: #176b3b !important;
}

.depan-wave {
    left: 0 !important;
    right: 0 !important;
    width: 100% !important;
}

.depan-wave svg {
    width: 100.5% !important;
    height: 100% !important;
}

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f0f4f0;
        }

        .kartu-page {
            min-height: 100vh;
            padding: 45px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* TOOLBAR */

        .kartu-toolbar {
            width: 100%;
            max-width: 1320px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .btn-kembali,
        .btn-cetak {
            height: 42px;
            padding: 0 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .btn-download {
    height: 42px;
    padding: 0 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border-radius: 9px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 600;
    color: #287c48;
    background: white;
    border: 1px solid #b8d9bd;
    cursor: pointer;
    transition: .2s;
}

.btn-download:hover {
    background: #eaf5eb;
    transform: translateY(-2px);
}

        .btn-kembali {
            color: #526452;
            background: white;
            border: 1px solid #e0e9e0;
        }

        .btn-cetak {
            color: white;
            background: #287c48;
            border: none;
        }

        .btn-kembali:hover {
            background: #e8f3e9;
        }

        .btn-cetak:hover {
            background: #176538;
            transform: translateY(-2px);
        }

        /* PREVIEW */

        .kartu-preview {
            width: 100%;
            max-width: 1320px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 35px;
        }

        .kartu-wrapper {
            flex: 1;
            min-width: 0;
        }

        .kartu-heading {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kartu-heading strong {
            color: #315a3b;
            font-size: 12px;
            font-weight: 700;
        }

        .kartu-heading span {
            color: #8a9a8c;
            font-size: 10px;
        }

        /* UKURAN KARTU */

        .kartu-sisi {
            width: 100%;
            aspect-ratio: 85.6 / 54;
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(36, 86, 53, .13);
        }

        /* ==================================
           SISI DEPAN
        ================================== */
.kartu-depan {
    background: #176b3b;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    border-radius: 0 !important;
}

        .depan-content {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-bottom: 35px;
        }

        .depan-logo {
    width: 125px;
    height: 125px;
    padding: 15px;
    border-radius: 50%;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    position: relative;
    z-index: 5;
    box-shadow: 0 5px 18px rgba(0, 0, 0, .12);
}

.depan-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

        .depan-judul {
            text-align: center;
            padding: 0 20px;
        }

        .depan-judul h2 {
            margin: 0;
            color: white;
            font-size: clamp(12px, 2vw, 21px);
            line-height: 1.6;
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* GELOMBANG PUTIH */

        .depan-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 22%;
    z-index: 1;
    overflow: hidden;
}

.depan-wave svg {
    display: block;
    width: 100%;
    height: 100%;
}
        /* ==================================
           SISI BELAKANG
        ================================== */

        .kartu-belakang {
            background: #ffffff;
            border: 1px solid #e1eae1;
            display: flex;
            flex-direction: column;
        }

          /* DEKORASI BULATAN SISI BELAKANG */

.belakang-dots {
    position: absolute;
    top: 0;
    right: 0;
    width: 39%;
    height: 42%;
    overflow: hidden;
    pointer-events: none;
}

.belakang-dots span {
    position: absolute;
    display: block;
    aspect-ratio: 1 / 1;
    border-radius: 50%;
    background: #81C784;
    opacity: .22;
}

.belakang-dots span:nth-child(1) {
    width: 52%;
    top: -35%;
    right: 4%;
}

.belakang-dots span:nth-child(2) {
    width: 34%;
    top: 29%;
    right: 52%;
}

.belakang-dots span:nth-child(3) {
    width: 20%;
    top: 14%;
    right: 28%;
}

.belakang-dots span:nth-child(4) {
    width: 12%;
    top: 68%;
    right: 22%;
}

.belakang-dots span:nth-child(5) {
    width: 8%;
    top: 50%;
    right: 84%;
}

        .belakang-content {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 7% 6%;
            gap: 5%;
            position: relative;
            z-index: 2;
        }

        /* FOTO ANGGOTA */

        .belakang-foto {
            width: 29%;
            height: 76%;
            flex-shrink: 0;
            border-radius: 13px;
            overflow: hidden;
            background: linear-gradient(145deg, #e5f3e6, #d1ead4);
            border: 2px solid #b8ddbd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #66ad73;
        }

        .belakang-foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .belakang-foto i {
            font-size: 55px;
        }

        /* DATA ANGGOTA */

        .belakang-data {
            flex: 1;
            min-width: 0;
        }

        .belakang-label {
            display: inline-block;
            margin-bottom: 12px;
            padding: 5px 11px;
            border-radius: 5px;
            background: #eaf5eb;
            color: #287c48;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .belakang-data h2 {
            margin: 0 0 13px;
            color: #287c48;
            font-size: clamp(13px, 2vw, 21px);
            font-weight: 800;
            text-transform: uppercase;
            overflow-wrap: anywhere;
        }

        .identitas-item {
            display: grid;
            grid-template-columns: 105px 10px minmax(0, 1fr);
            gap: 5px;
            margin-bottom: 11px;
            align-items: start;
        }

        .identitas-item span,
        .identitas-item strong {
            font-size: 10px;
            line-height: 1.6;
        }

        .identitas-item span {
            color: #63806a;
            font-weight: 500;
        }

        .identitas-item .titik-dua {
            color: #287c48;
            font-weight: 700;
        }

        .identitas-item strong {
            color: #273a2c;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        /* FOOTER BELAKANG */
.belakang-footer {
    width: 100%;
    min-height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 3px; /* Jarak logo dan tulisan diperkecil */
    padding: 8px 24px;
    border-top: 1px solid #edf2ed;
    text-align: left;
}

.belakang-footer img {
    width: auto;
    height: auto;
    max-width: 38px;
    max-height: 38px;
    object-fit: contain;
    flex-shrink: 0;
}

.belakang-footer div {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.belakang-footer strong {
    font-size: 10px;
    font-weight: 700;
    color: #287c48;
}

.belakang-footer span {
    font-size: 8px;
    color: #809181;
}

        /* KETERANGAN */

        .kartu-note {
            margin-top: 25px;
            color: #899489;
            font-size: 10px;
            text-align: center;
        }

        .kartu-note i {
            color: #70b77a;
            margin-right: 5px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .kartu-preview {
                flex-direction: column;
                align-items: center;
            }

            .kartu-wrapper {
                width: 100%;
                max-width: 650px;
            }
        }

        @media (max-width: 500px) {
            .kartu-page {
                padding: 25px 12px;
            }

            .identitas-item {
                grid-template-columns: 75px 7px minmax(0, 1fr);
                gap: 2px;
                margin-bottom: 5px;
            }

            .identitas-item span,
            .identitas-item strong {
                font-size: 7px;
            }

            .belakang-label {
                margin-bottom: 5px;
                font-size: 6px;
            }

            .belakang-data h2 {
                margin-bottom: 6px;
            }

            .belakang-footer strong {
                font-size: 8px;
            }

            .belakang-footer span {
                font-size: 6px;
            }
        }

        /* ==================================
           CETAK DUA SISI
        ================================== */

        @media print {

            @page {
                size: 85.6mm 54mm;
                margin: 0;
            }

            html,
            body {
                width: 85.6mm !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
            }

            .kartu-page {
                display: block !important;
                width: 85.6mm !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .kartu-toolbar,
            .kartu-note,
            .kartu-heading {
                display: none !important;
            }

            .kartu-preview {
                display: block !important;
                width: 85.6mm !important;
                margin: 0 !important;
            }

            .kartu-wrapper {
                display: block !important;
                width: 85.6mm !important;
                height: 54mm !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .kartu-sisi {
                width: 85.6mm !important;
                height: 54mm !important;
                aspect-ratio: auto !important;
                border: none !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                overflow: hidden !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .kartu-wrapper:first-child {
                break-after: page !important;
                page-break-after: always !important;
            }

            .kartu-wrapper:last-child {
                break-after: auto !important;
                page-break-after: auto !important;
            }

            .depan-content {
                padding-bottom: 7mm !important;
            }

            .depan-logo {
                width: 23mm !important;
                height: 21mm !important;
                margin-bottom: 2mm !important;
            }

            .depan-judul h2 {
                font-size: 10pt !important;
                letter-spacing: .5px !important;
            }

            .belakang-content {
                padding: 4mm 4mm !important;
                gap: 3mm !important;
            }

            .belakang-foto {
                border-radius: 2mm !important;
                border-width: .4mm !important;
            }

            .belakang-foto i {
                font-size: 25pt !important;
            }

            .belakang-label {
                font-size: 5pt !important;
                margin-bottom: 1.5mm !important;
                padding: 1mm 1.5mm !important;
            }

            .belakang-data h2 {
                font-size: 9pt !important;
                margin-bottom: 2mm !important;
            }

            .identitas-item {
                grid-template-columns: 23mm 2mm minmax(0, 1fr) !important;
                gap: 1mm !important;
                margin-bottom: 1.8mm !important;
            }

            .identitas-item span,
            .identitas-item strong {
                font-size: 5.5pt !important;
                line-height: 1.4 !important;
            }

            .belakang-footer {
                min-height: 8mm !important;
                padding: 1mm 4mm !important;
                gap: 2mm !important;
                border-top: .3mm solid #edf2ed !important;
            }

            .belakang-footer img {
                width: 8mm !important;
                height: 6mm !important;
            }

            .belakang-footer strong {
                font-size: 8pt !important;
            }

            .belakang-footer span {
                font-size: 5pt !important;
            }
        }
    </style>
</head>

<body>

<div class="kartu-page">

    {{-- TOOLBAR --}}
    <div class="kartu-toolbar">

        <a href="{{ route('anggota.index') }}" class="btn-kembali">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

        <div style="display: flex; gap: 10px;">

            <button onclick="downloadKartuPDF()" class="btn-download">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                Download PDF
            </button>

            <button onclick="window.print()" class="btn-cetak">
                <i class="bi bi-printer-fill"></i>
                Cetak Kedua Sisi
            </button>

        </div>

    </div>

    {{-- PREVIEW KARTU --}}
    <div class="kartu-preview">

        {{-- ==========================
             SISI DEPAN
        =========================== --}}
        <div class="kartu-wrapper">

            <div class="kartu-heading">
                <strong>SISI DEPAN</strong>
                <span>Identitas Perpustakaan</span>
            </div>

            <div class="kartu-sisi kartu-depan">

                <div class="depan-content">

                    <div class="depan-logo">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo Perpustakaan Rajeg Bersatu">
                    </div>

                    <div class="depan-judul">
                        <h2>
                            ANGGOTA PERPUSTAKAAN
                            <br>
                            DESA RAJEG BERSATU
                        </h2>
                    </div>

                </div>

                {{-- GELOMBANG PUTIH --}}
                <div class="depan-wave">
                    <svg viewBox="0 0 650 110"
                         preserveAspectRatio="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <path
    d="M0 45 C130 5 210 85 340 65 C470 45 520 5 650 30 L650 110 L0 110 Z"
    fill="#ffffff"
/>

                    </svg>
                </div>

            </div>

        </div>

        {{-- ==========================
             SISI BELAKANG
        =========================== --}}
        <div class="kartu-wrapper">

            <div class="kartu-heading">
                <strong>SISI BELAKANG</strong>
                <span>Identitas Anggota</span>
            </div>

            <div class="kartu-sisi kartu-belakang">
                {{-- DEKORASI LIST --}}

                <div class="belakang-dots">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<div class="belakang-list">
    <span></span>
    <span></span>
    <span></span>
</div>

                <div class="belakang-content">

                    {{-- FOTO ANGGOTA --}}
                    <div class="belakang-foto">

                        @if(!empty($anggota->foto))

    <img
        src="{{ asset('images/anggota/' . $anggota->foto) }}"
        alt="Foto {{ $anggota->nama }}"
    >

@else

    <i class="bi bi-person-fill"></i>

    @endif

                    </div>

                    {{-- DATA ANGGOTA --}}
                    <div class="belakang-data">

                        <div class="belakang-label">
                            IDENTITAS ANGGOTA
                        </div>

                        <h2>{{ strtoupper($anggota->nama) }}</h2>

                        <div class="identitas-item">
                            <span>NIK</span>
                            <span class="titik-dua">:</span>
                            <strong>{{ $anggota->nik }}</strong>
                        </div>

                        <div class="identitas-item">
                            <span>Tempat, Tgl. Lahir</span>
                            <span class="titik-dua">:</span>
                            <strong>
                                {{ $anggota->tempat_lahir }},
                                {{ $anggota->tanggal_lahir
                                    ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
                                    : '-' }}
                            </strong>
                        </div>

                        <div class="identitas-item">
                            <span>Alamat</span>
                            <span class="titik-dua">:</span>
                            <strong>{{ $anggota->alamat }}</strong>
                        </div>

                    </div>

                </div>

               {{-- FOOTER --}}
        <div class="belakang-footer">

            <img src="{{ asset('images/logo1.png') }}"
                alt="Logo Perpustakaan">

            <div>
                <strong>Perpustakaan Desa Rajeg Bersatu</strong>
            </div>

        </div>

            </div>

        </div>

    </div>

    <p class="kartu-note">
        <i class="bi bi-info-circle"></i>
        Pastikan data anggota sudah benar sebelum mencetak kartu.
    </p>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.2/dist/jspdf.umd.min.js"></script>

<script>
async function downloadKartuPDF() {
    const tombol = document.querySelector('.btn-download');

    try {
        // Periksa library
        if (typeof html2canvas === 'undefined') {
            throw new Error('Library html2canvas belum berhasil dimuat.');
        }

        if (!window.jspdf) {
            throw new Error('Library jsPDF belum berhasil dimuat.');
        }

        tombol.disabled = true;
        tombol.innerHTML = '<i class="bi bi-hourglass-split"></i> Membuat PDF...';

        // Tunggu font dan gambar siap
        await document.fonts.ready;

        const gambar = document.querySelectorAll('.kartu-sisi');

        const { jsPDF } = window.jspdf;

        const pdf = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: [85.6, 54],
            compress: true
        });

        for (let i = 0; i < gambar.length; i++) {
        const canvas = await html2canvas(gambar[i], {
            scale: 3,
            useCORS: true,
            allowTaint: false,
            backgroundColor: null,
            logging: false,

            onclone: function (documentClone) {
                const kartu = documentClone.querySelectorAll('.kartu-sisi');

                kartu.forEach(function (item) {
                    item.style.border = 'none';
                    item.style.borderRadius = '0';
                    item.style.outline = 'none';
                    item.style.boxShadow = 'none';
                });

                const depan = documentClone.querySelector('.kartu-depan');

                if (depan) {
                    depan.style.background = '#176b3b';
                    depan.style.border = 'none';
                    depan.style.borderRadius = '0';
                    depan.style.overflow = 'hidden';
                }

                const wave = documentClone.querySelector('.depan-wave');

                if (wave) {
                    wave.style.width = '100%';
                    wave.style.left = '0';
                    wave.style.right = '0';
                }
            }
        });

            const hasilGambar = canvas.toDataURL('image/jpeg', 0.95);

            if (i > 0) {
                pdf.addPage([85.6, 54], 'landscape');
            }

            const lebarPDF = 85.6;
const tinggiPDF = 54;

const rasioGambar = canvas.width / canvas.height;
const rasioKartu = lebarPDF / tinggiPDF;

let lebarGambar, tinggiGambar, posisiX, posisiY;

if (rasioGambar > rasioKartu) {
    lebarGambar = lebarPDF;
    tinggiGambar = lebarPDF / rasioGambar;
    posisiX = 0;
    posisiY = (tinggiPDF - tinggiGambar) / 2;
} else {
    tinggiGambar = tinggiPDF;
    lebarGambar = tinggiPDF * rasioGambar;
    posisiX = (lebarPDF - lebarGambar) / 2;
    posisiY = 0;
}

pdf.addImage(
    hasilGambar,
    'JPEG',
    posisiX,
    posisiY,
    lebarGambar,
    tinggiGambar
);
        }

        pdf.save('Kartu-Anggota-SIPRA.pdf');

    } catch (error) {

        console.error('Kesalahan PDF:', error);

        alert('PDF gagal dibuat: ' + error.message);

    } finally {

        tombol.disabled = false;
        tombol.innerHTML = '<i class="bi bi-file-earmark-pdf-fill"></i> Download PDF';
    }
    }
</script>
</body>
</html>