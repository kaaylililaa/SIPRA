<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - SIPRA</title>

    {{-- Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- CSS Register --}}
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>

    {{-- Overlay background --}}
    <div class="overlay"></div>

    {{-- Logo kiri atas --}}
    <div class="logo-area">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Rajeg Bersatu">
    </div>


    {{-- Tab Login & Daftar --}}
    <div class="auth-tabs">

        <a href="{{ route('login') }}" class="tab login-tab">
            Login
        </a>

        <a href="{{ route('register') }}" class="tab register-tab active">
            Daftar
        </a>

    </div>


    {{-- Card Register --}}
    <div class="register-card">

        {{-- Header card --}}
        <div class="register-header">

            <div class="register-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

            <div class="register-title">
                <h2>Daftar Akun</h2>
                <p>Buat akun baru untuk mengakses SIPRA</p>
            </div>

        </div>

        <div class="divider"></div>


        {{-- Form --}}
       <form action="{{ route('register.process') }}" method="POST">

            @csrf

            {{-- Nama --}}
            <div class="form-group">

                <label for="name">
                    Nama
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                >

            </div>


            {{-- Email --}}
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                >

            </div>

             {{-- Password --}}
    <div class="form-group">
        <label for="password">Password</label>

        <input
            type="password"
            id="password"
            name="password"
            autocomplete="new-password"
            required
        >

        @error('password')
            <small class="error-message">
                {{ $message }}
            </small>
        @enderror
    </div>

            {{-- Tombol daftar --}}
            <button type="submit" class="btn-daftar">
                Daftar
            </button>

        </form>

    </div>


    {{-- Footer --}}
    <div class="version">
        Version 1.0
    </div>
    <div class="copyright">
        © 2026 Perpustakaan Desa Rajeg Bersatu
    </div>

</body>
</html>