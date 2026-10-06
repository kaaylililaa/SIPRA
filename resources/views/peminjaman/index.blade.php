@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')

<link rel="stylesheet" href="{{ asset('css/peminjaman.css') }}">

<div class="peminjaman-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="page-title-wrapper">

            <div class="page-icon">
                <i class="bi bi-journal-arrow-up"></i>
            </div>

            <div>
                <h1>Data Peminjaman</h1>
                <p>Kelola transaksi peminjaman buku perpustakaan.</p>
            </div>

        </div>

        <a href="{{ route('peminjaman.create') }}" class="btn-add-peminjaman">
            <i class="bi bi-plus"></i>
            Tambah Peminjaman
        </a>

    </div>


    {{-- STATISTIC CARDS --}}
    <div class="statistik-container">

        {{-- TOTAL --}}
        <div class="statistik-card">

            <div class="statistik-icon total-icon">
                <i class="bi bi-journal-text"></i>
            </div>

            <div class="statistik-info">
                <span>Total Peminjam</span>
                <strong>{{ $totalPeminjaman }}</strong>
            </div>

        </div>


        {{-- DIPINJAM --}}
        <div class="statistik-card">

            <div class="statistik-icon pinjam-icon">
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div class="statistik-info">
                <span>Dipinjam</span>
                <strong>{{ $totalDipinjam }}</strong>
            </div>

        </div>


        {{-- DIKEMBALIKAN --}}
        <div class="statistik-card">

            <div class="statistik-icon kembali-icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <div class="statistik-info">
                <span>Dikembalikan</span>
                <strong>{{ $totalDikembalikan }}</strong>
            </div>

        </div>


        {{-- TERLAMBAT --}}
        <div class="statistik-card">

            <div class="statistik-icon terlambat-icon">
                <i class="bi bi-exclamation-circle"></i>
            </div>

            <div class="statistik-info">
                <span>Terlambat</span>
                <strong>{{ $totalTerlambat }}</strong>
            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <form action="{{ route('peminjaman.index') }}" method="GET" class="filter-form">

            {{-- SEARCH --}}
            <div class="search-wrapper">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="search-input"
                    placeholder="Cari nama peminjam / kode pinjam ..."
                >

                <button type="submit" class="search-button">
                    <i class="bi bi-search"></i>
                </button>

            </div>


            {{-- STATUS --}}
            <div class="filter-select-wrapper">

                <select name="status" class="filter-select">

                    <option value="">Semua Status</option>

                    <option value="Dipinjam"
                        {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>

                    <option value="Dikembalikan"
                        {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan
                    </option>

                    <option value="Terlambat"
                        {{ request('status') == 'Terlambat' ? 'selected' : '' }}>
                        Terlambat
                    </option>

                </select>

            </div>


            {{-- DATE --}}
            <div class="filter-date-wrapper">

                <i class="bi bi-calendar3"></i>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    class="filter-date"
                >

            </div>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-responsive">

            <table class="table-peminjaman">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Peminjaman</th>
                        <th>Peminjam</th>
                        <th>Batas Kembali</th>
                        <th>Jumlah Buku</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($peminjamans as $index => $peminjaman)

                        <tr>

                            {{-- NOMOR --}}
                            <td class="nomor">
                               {{ $index + 1 }}
                            </td>


                            {{-- ID --}}
                            <td>

                                <span class="kode-peminjaman">
                                    PMJ-{{ date('Y', strtotime($peminjaman->created_at)) }}-{{ str_pad($peminjaman->id, 5, '0', STR_PAD_LEFT) }}
                                </span>

                            </td>


                            {{-- PEMINJAM --}}
                            <td>
                                <span class="nama-peminjam">
                                    {{ $peminjaman->nama_peminjam }}
                                </span>
                            </td>


                            {{-- BATAS KEMBALI --}}
                            <td>

                                @if ($peminjaman->tanggal_kembali)
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') }}
                                @else
                                    -
                                @endif

                            </td>


                            {{-- JUMLAH BUKU --}}
                            <td class="jumlah-buku">

                                @if (isset($peminjaman->jumlah_buku))
                                    {{ $peminjaman->jumlah_buku }}
                                @else
                                    1
                                @endif

                            </td>

{{-- STATUS --}}
<td>

    @php
        $status = strtolower($peminjaman->status ?? 'Dipinjam');
    @endphp

    @if ($status === 'dikembalikan')

        <a href="{{ route('peminjaman.show', $peminjaman->id) }}"
           class="status-badge status-dikembalikan">
            Dikembalikan
        </a>

    @elseif ($status === 'terlambat')

        <a href="{{ route('peminjaman.show', $peminjaman->id) }}"
           class="status-badge status-terlambat">
            Terlambat
        </a>

    @else

        <a href="{{ route('peminjaman.show', $peminjaman->id) }}"
           class="status-badge status-dipinjam">
            Dipinjam
        </a>

    @endif

</td>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-data">

                                <div class="empty-icon">
                                    <i class="bi bi-journal-x"></i>
                                </div>

                                <p>Belum ada data peminjaman.</p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($peminjamans->hasPages())

            <div class="pagination-wrapper">

                {{ $peminjaman->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection