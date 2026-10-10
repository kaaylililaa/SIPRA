<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Konfirmasi Pengembalian</title>


    {{-- FONT POPPINS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    {{-- CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/peminjaman-konfirmasi.css') }}"
    >

</head>


<body>

    <div
        class="konfirmasi-page
        {{ $isTerlambat ? 'konfirmasi-terlambat' : 'konfirmasi-normal' }}"
    >

        <div class="konfirmasi-card">

            {{-- TOMBOL X --}}
            <a
                href="{{ route('peminjaman.show', $peminjaman->id) }}"
                class="btn-close-konfirmasi"
                aria-label="Tutup"
            >
                ×
            </a>


            {{-- JUDUL --}}
            <h1 class="konfirmasi-title">
                Konfirmasi Pengembalian
            </h1>


            {{-- GARIS --}}
            <div class="konfirmasi-divider"></div>


            {{-- PERTANYAAN --}}
            <p class="konfirmasi-question">
                Apakah buku ini sudah dikembalikan?
            </p>


            {{-- ================================
                 STATUS NORMAL
            ================================= --}}
            @if (!$isTerlambat)

                <p class="konfirmasi-status">
                    Status : {{ $peminjaman->status }}
                </p>


                <div class="konfirmasi-actions">

                    <a
                        href="{{ route('peminjaman.show', $peminjaman->id) }}"
                        class="btn-batal"
                    >
                        Batal
                    </a>


                    <form
                        action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')

                        <button
                            type="submit"
                            class="btn-konfirmasi"
                        >
                            Konfirmasi
                        </button>

                    </form>

                </div>


            {{-- ================================
                 STATUS TERLAMBAT
            ================================= --}}
            @else

                <div class="late-confirmation">

                    <p class="late-status">
                        Status : Terlambat
                    </p>

                    <p class="late-duration">
                        Keterlambatan : {{ $hariTerlambat }} Hari
                    </p>

                    <p class="late-fine">
                        Denda : Rp {{ number_format($denda, 0, ',', '.') }}
                    </p>

                </div>


                <div class="late-confirmation-action">

                    <form
                        action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')

                        <button
                            type="submit"
                            class="btn-konfirmasi btn-konfirmasi-late"
                        >
                            Konfirmasi
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</body>

</html>