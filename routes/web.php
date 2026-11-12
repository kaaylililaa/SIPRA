<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

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

Route::get('/peminjaman/{peminjaman}/konfirmasi', [PeminjamanController::class, 'konfirmasi'])
    ->name('peminjaman.konfirmasi');

Route::put('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
    ->name('peminjaman.kembalikan');

Route::get('/peminjaman/status/{status}', [
    App\Http\Controllers\PeminjamanController::class,
    'status'
])->name('peminjaman.status');

Route::resource('anggota', AnggotaController::class)
    ->parameters(['anggota' => 'anggota']);

Route::get(
    '/kartu-anggota/{anggota}/cetak',
    [AnggotaController::class, 'cetakKartu']
)->name('anggota.kartu.cetak');


// LAPORAN PERPUSTAKAAN
Route::prefix('laporan')->name('laporan.')->group(function () {

    Route::get('/', [LaporanController::class, 'index'])
        ->name('index');

    Route::get('/buku', [LaporanController::class, 'buku'])
        ->name('buku');

    Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])
        ->name('peminjaman');

    Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])
        ->name('pengembalian');

    Route::get('/denda', [LaporanController::class, 'denda'])
        ->name('denda');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});