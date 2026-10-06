<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kategori', KategoriController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/loading', function () {
    return view('loading');
})->middleware('auth')->name('loading');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::get('/register', [LoginController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [LoginController::class, 'register'])
    ->name('register.process');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::get('/register', [LoginController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [LoginController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::resource('buku', BukuController::class);

Route::resource('peminjaman', PeminjamanController::class);

Route::resource('profile', ProfileController::class);

Route::get('/peminjaman/{peminjaman}/konfirmasi', [PeminjamanController::class, 'konfirmasi'])
    ->name('peminjaman.konfirmasi');

Route::put('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
    ->name('peminjaman.kembalikan');