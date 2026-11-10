
@extends('layouts.app')

@section('title', 'Laporan Perpustakaan - SIPRA')
@section('header-title', 'LAPORAN PERPUSTAKAAN')
@section('header-description', 'Kelola dan cetak laporan perpustakaan.')

@section('content')

<div class="laporan-container">

    <div class="laporan-heading">
        <div>
            <h2>Laporan Perpustakaan</h2>
            <p>Pilih jenis laporan yang ingin ditampilkan atau dicetak.</p>
        </div>
    </div>

    <div class="laporan-grid">

        <a href="{{ route('laporan.buku') }}" class="laporan-card">
            <div class="laporan-icon">
                <i class="bi bi-book"></i>
            </div>
            <div>
                <h3>Laporan Buku Terbaru</h3>
                <p>Data buku yang ditambahkan setiap bulan.</p>
            </div>
            <i class="bi bi-arrow-right laporan-arrow"></i>
        </a>

        <a href="{{ route('laporan.peminjaman') }}" class="laporan-card">
            <div class="laporan-icon">
                <i class="bi bi-journal-arrow-up"></i>
            </div>
            <div>
                <h3>Laporan Peminjaman</h3>
                <p>Data transaksi peminjaman buku setiap bulan.</p>
            </div>
            <i class="bi bi-arrow-right laporan-arrow"></i>
        </a>

        <a href="{{ route('laporan.pengembalian') }}" class="laporan-card">
            <div class="laporan-icon">
                <i class="bi bi-journal-check"></i>
            </div>
            <div>
                <h3>Laporan Pengembalian</h3>
                <p>Data transaksi pengembalian setiap bulan.</p>
            </div>
            <i class="bi bi-arrow-right laporan-arrow"></i>
        </a>

        <a href="{{ route('laporan.denda') }}" class="laporan-card">
            <div class="laporan-icon">
                <i class="bi bi-wallet2"></i>
            </div>
            <div>
                <h3>Laporan Pembayaran Denda</h3>
                <p>Data nominal denda dan total denda tercatat.</p>
            </div>
            <i class="bi bi-arrow-right laporan-arrow"></i>
        </a>

    </div>

</div>

@endsection
