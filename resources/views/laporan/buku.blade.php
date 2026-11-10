
@extends('layouts.app')

@section('title', 'Laporan Buku - SIPRA')
@section('header-title', 'LAPORAN BUKU TERBARU')
@section('header-description', 'Laporan penambahan data buku perpustakaan.')

@section('content')

<div class="laporan-container">

    <div class="laporan-toolbar">
        <a href="{{ route('laporan.index') }}" class="btn-kembali">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="laporan-card-content">

        <div class="laporan-judul">
            <h2>LAPORAN DATA BUKU TERBARU</h2>
            <p>PERPUSTAKAAN DESA RAJEG BERSATU</p>
            <span>Periode: {{ $namaBulan }} {{ $tahun }}</span>
        </div>

        <form method="GET" class="filter-laporan no-print">

            <select name="bulan">
                @foreach(range(1, 12) as $i)
                    <option value="{{ $i }}"
                        {{ $bulan == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="tahun"
                value="{{ $tahun }}" min="2000" max="2100">

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
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Tanggal Ditambahkan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->judul_buku }}</td>
                            <td>{{ $buku->nama_pengarang }}</td>
                            <td>{{ $buku->nama_penerbit }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ \Carbon\Carbon::parse($buku->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="data-kosong">
                                Tidak ada data buku pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="jumlah-data">
            Total buku ditambahkan: <strong>{{ $data->count() }}</strong>
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
