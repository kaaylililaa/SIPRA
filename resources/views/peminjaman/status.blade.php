@extends('layouts.app')

@section('header-title', $judulHalaman . '')
@section('header-icon', 'bi bi-book-half')

@section('header-actions')
    <a href="{{ route('peminjaman.index') }}" class="btn-kembali">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
@endsection


@section('content')

    <div class="status-card">
        <div class="status-info">
            <span>Total Data</span>
            <strong>{{ $peminjaman->total() }}</strong>
        </div>

        <div class="table-responsive">
            <table class="status-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Peminjaman</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($peminjaman as $item)
                        
<tr>
    <td>{{ $peminjaman->firstItem() + $loop->index }}</td>

    <td>
        PMJ-{{ $item->created_at->format('Y') }}-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
    </td>

    <td>{{ $item->nama_peminjam }}</td>

    <td>
        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}
    </td>

    <td>
        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}
    </td>

    <td>
        @php
            $statusTampil = strtolower(trim($item->status ?? 'dipinjam'));

            if (
                $statusTampil === 'dipinjam' &&
                $item->tanggal_kembali &&
                \Carbon\Carbon::parse($item->tanggal_kembali)->startOfDay()->lt(now()->startOfDay())
            ) {
                $statusTampil = 'terlambat';
            }
        @endphp

        <span class="status-label status-{{ $statusTampil }}">
            {{ ucfirst($statusTampil) }}
        </span>
    </td>
</tr>

                    @empty
                        <tr>
                            <td colspan="6" class="data-kosong">
                                Belum ada data peminjaman untuk status ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $peminjaman->links() }}
        </div>
    </div>

</div>

<style>
.status-page {
    padding: 25px;
    color: #333;
}

.status-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 22px;
}

.status-header h2 {
    color: #287658;
    font-size: 25px;
    font-weight: 700;
    margin: 0 0 6px;
}

.status-header p {
    color: #777;
    margin: 0;
}

.btn-kembali {
    background: #78c47c;
    color: white;
    text-decoration: none;
    padding: 10px 16px;
    border-radius: 8px;
    white-space: nowrap;
}

.btn-kembali:hover {
    background: #287658;
    color: white;
}

.status-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 2px 6px #00000012;
}

.status-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f1f8f2;
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    color: #287658;
}

.status-info strong {
    font-size: 22px;
}

.status-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.status-table th {
    background: #eeeeee;
    color: #176b48;
    padding: 13px 12px;
    text-align: left;
}

.status-table th:first-child {
    border-radius: 8px 0 0 8px;
}

.status-table th:last-child {
    border-radius: 0 8px 8px 0;
}

.status-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #ddd;
}

.status-label {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 7px;
    font-size: 11px;
    color: white;
    background: #78c47c;
}

.status-dipinjam {
    background: #4b83ee;
}

.status-dikembalikan {
    background: #ff9f2e;
}

.status-terlambat {
    background: #ff5757;
}

.data-kosong {
    text-align: center;
    color: #888;
    padding: 30px !important;
}

.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    width: 100%;
}

.pagination-container nav {
    display: flex;
    justify-content: center;
}

.pagination-container nav > div:first-child {
    display: none;
}

.pagination-container ul.pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 5px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-container .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    min-height: 38px;
    padding: 8px 12px;
    color: #287658;
    background: #fff;
    border: 1px solid #dce8df;
    border-radius: 8px !important;
    text-decoration: none;
    box-shadow: none;
}

.pagination-container .page-item.active .page-link {
    color: #fff;
    background: #287658;
    border-color: #287658;
}

.pagination-container .page-link:hover {
    color: #287658;
    background: #e8f5eb;
    border-color: #b9d9c1;
}

.pagination-container .page-item.disabled .page-link {
    color: #aaa;
    background: #f5f5f5;
    border-color: #e5e5e5;
}

@media (max-width: 768px) {
    .status-page {
        padding: 15px;
    }

    .status-header {
        align-items: flex-start;
    }

    .status-table {
        min-width: 700px;
    }
}
</style>
@endsection