<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPRA - Memuat</title>

    {{-- Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- CSS Loading --}}
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
</head>

<body>

    <div class="loading-page">

        <div class="loading-content">

            {{-- LOGO --}}
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Rajeg Bersatu"
                class="loading-logo"
            >

            {{-- NAMA APLIKASI --}}
            <h1>SIPRA</h1>

            {{-- TEKS PROSES --}}
            <p class="loading-text">
                Menyiapkan Dashboard<span class="dots"></span>
            </p>

            {{-- SPINNER --}}
            <div class="spinner"></div>

        </div>

    </div>


    <script>

        setTimeout(function () {

            window.location.href = "{{ route('home') }}";

        }, 1800);

    </script>

</body>

</html>