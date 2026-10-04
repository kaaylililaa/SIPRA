<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::count();

        $jumlahDipinjam = Peminjaman::where('status', 'Dipinjam')->count();

        $jumlahAnggota = User::count();

        $jumlahKategori = Kategori::count();

        $bukuTerbaru = Buku::latest()
        ->take(5)
        ->get();

        return view('home', compact(
            'jumlahBuku',
            'jumlahDipinjam',
            'jumlahAnggota',
            'jumlahKategori',
            'bukuTerbaru'
        ));
    }
}