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

    {{-- CSS SIDEBAR DAN HEADER BERSAMA --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    @stack('styles')
</head>

<body>

    <div class="sipra-layout">

        {{-- SIDEBAR BERSAMA --}}
        @include('layouts.partials.sidebar')

        {{-- AREA UTAMA --}}
        <main class="main-content">

            {{-- HEADER BERSAMA --}}

<header class="sipra-header">

    @hasSection('header-icon')
        <div class="header-icon">
            <i class="@yield('header-icon')"></i>
        </div>
    @endif

    <div class="sipra-header-text">
        <h1>@yield('header-title', 'SIPRA')</h1>
        <p>@yield('header-description', 'Perpustakaan Desa Rajeg Bersatu')</p>
    </div>

    @yield('header-actions')
</header>

            {{-- KONTEN HALAMAN --}}
            <div class="sipra-page-content">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>
