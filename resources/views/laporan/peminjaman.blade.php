
@extends('layouts.app')

@section('title', 'Laporan Peminjaman - SIPRA')
@section('header-title', 'LAPORAN PEMINJAMAN')
@section('header-description', 'Laporan transaksi peminjaman buku.')

@section('content')

<div class="laporan-container">

    <div class="laporan-toolbar no-print">
        <a href="{{ route('laporan.index') }}" class="btn-kembali">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="laporan-card-content">

        <div class="laporan-judul">
            <h2>LAPORAN DATA PEMINJAMAN</h2>
            <p>PERPUSTAKAAN DESA RAJEG BERSATU</p>
            <span>Periode: {{ $namaBulan }} {{ $tahun }}</span>
        </div>

        <form method="GET" class="filter-laporan no-print">
            <select name="bulan">
                @foreach(range(1, 12) as $i)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="tahun" value="{{ $tahun }}">

            <button type="submit">
                <i class="bi bi-search"></i> Tampilkan
            </button>

            <button type="button" onclick="window.print()" class="btn-cetak">
                <i class="bi bi-printer"></i> Cetak
            </button>
        </form>

        <div class="table-responsive">
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_peminjam }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="data-kosong">
                                Tidak ada data peminjaman pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="jumlah-data">
            Total transaksi peminjaman: <strong>{{ $data->count() }}</strong>
        </p>

        <div class="ttd-laporan">
            <p>Rajeg, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Petugas Perpustakaan,</p>
            <br><br><br>
            <strong>(................................)</strong>
        </div>

    </div>
</div>

@endsection
