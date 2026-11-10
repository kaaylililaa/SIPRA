
@extends('layouts.app')

@section('title', 'Laporan Denda - SIPRA')
@section('header-title', 'LAPORAN DENDA')
@section('header-description', 'Laporan nominal denda keterlambatan.')

@section('content')

<div class="laporan-container">

    <div class="laporan-toolbar no-print">
        <a href="{{ route('laporan.index') }}" class="btn-kembali">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="laporan-card-content">

        <div class="laporan-judul">
            <h2>LAPORAN DENDA KETERLAMBATAN</h2>
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
                        <th>ID Pengembalian</th>
                        <th>ID Buku</th>
                        <th>Tanggal Pencatatan</th>
                        <th>Nominal Denda</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pengembalian_id }}</td>
                            <td>{{ $item->buku_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>Rp{{ number_format($item->denda, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="data-kosong">
                                Tidak ada data denda pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-denda">
            <span>Total Denda Tercatat</span>
            <strong>Rp{{ number_format($totalDenda, 0, ',', '.') }}</strong>
        </div>

        <div class="ttd-laporan">
            <p>Rajeg, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Petugas Perpustakaan,</p>
            <br><br><br>
            <strong>(................................)</strong>
        </div>

    </div>
</div>

@endsection
