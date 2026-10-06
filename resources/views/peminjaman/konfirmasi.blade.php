<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Konfirmasi Pengembalian</title>

    <link rel="stylesheet" href="{{ asset('css/peminjaman.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
    font-family: 'Poppins', sans-serif;
}
        .konfirmasi-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            padding: 30px;
        }

        .konfirmasi-card {
            width: 100%;
            max-width: 460px;
            background: #80c77f;
            border-radius: 16px;
            padding: 25px 28px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .konfirmasi-title {
            margin: 0;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }

        .konfirmasi-line {
            height: 1px;
            background: rgba(255, 255, 255, 0.35);
            margin: 10px 40px 28px;
        }

        .konfirmasi-text {
            font-size: 18px;
            margin-bottom: 28px;
        }

        .konfirmasi-status {
            font-size: 18px;
            margin-bottom: 70px;
        }

        .konfirmasi-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-batal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 65px;
            height: 38px;
            padding: 0 16px;
            border: none;
            border-radius: 6px;
            background: #f45b61;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-konfirmasi {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 95px;
            height: 38px;
            padding: 0 16px;
            border: none;
            border-radius: 6px;
            background: #286c50;
            color: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-batal:hover,
        .btn-konfirmasi:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

<div class="konfirmasi-page">

    <div class="konfirmasi-card">

        <h2 class="konfirmasi-title">
            Konfirmasi Pengembalian
        </h2>

        <div class="konfirmasi-line"></div>

        <div class="konfirmasi-text">
            Apakah buku ini sudah dikembalikan?
        </div>

        <div class="konfirmasi-status">
            Status : {{ $peminjaman->status }}
        </div>

        <div class="konfirmasi-actions">

            <a href="{{ route('peminjaman.show', $peminjaman->id) }}"
               class="btn-batal">
                Batal
            </a>

            <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                  method="POST"
                  style="margin: 0;">
                @csrf
                @method('PUT')

                <button type="submit" class="btn-konfirmasi">
                    Konfirmasi
                </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>