<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIPRA')</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- CSS HALAMAN --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buku-create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buku.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buku-edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    {{-- SIDEBAR BERSAMA, DIMUAT TERAKHIR --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body>

    <div class="sipra-layout">

        {{-- SATU SIDEBAR UNTUK SEMUA HALAMAN --}}
        @include('layouts.partials.sidebar')

        {{-- KONTEN HALAMAN --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

</body>
</html>