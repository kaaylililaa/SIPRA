<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login SIPRA</title>

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

<div class="login-page">

    <div class="overlay"></div>

    <!-- VERSION -->
    <div class="version">
        Version 1.0
    </div>

    <!-- COPYRIGHT -->
    <div class="copyright">
        © 2026 Perpustakaan Desa Rajeg Bersatu
    </div>


    <div class="login-container">

        <!-- LOGO -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Rajeg Bersatu">
        </div>


        <!-- TITLE -->
        <div class="welcome">

            <h1>SELAMAT DATANG DI SIPRA</h1>

            <p>
                Kelola peminjaman buku Perpustakaan Desa Rajeg Bersatu
            </p>

        </div>


        <!-- TAB -->
        <div class="tab-menu">

            <button class="tab active">
                Login
            </button>

            <a href="{{ route('register') }}" class="tab">
                Daftar
            </a>

        </div>


        <!-- LOGIN CARD -->
        <div class="login-card">

            <form method="POST" action="{{ route('login.process') }}">

                @csrf

                <!-- EMAIL -->
                <div class="input-group">

                    <div class="input-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        autofocus
                    >

                </div>


                <!-- PASSWORD -->
                <div class="input-group">

                    <div class="input-icon">
                        <i class="bi bi-key"></i>
                    </div>

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                    >

                </div>


                <!-- LOGIN -->
                <button type="submit" class="btn-login">

                    LOGIN

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>