@extends('layouts.app')

@section('header-title', 'Kategori Buku')
@section('header-description', 'Kelola seluruh koleksi kategori buku Perpustakaan Desa Rajeg Bersatu.')
@section('header-icon', 'bi bi-pencil-square')

@section('header-actions')

    <a href="{{ route('kategori.create') }}" class="header-btn-add">
            <i class="bi bi-plus-lg"></i>
            Tambah Kategori
        </a>

@endsection

@section('content')

<div class="kategori-page">
    {{-- KONTEN --}}
    <div class="kategori-card">

        <div class="kategori-toolbar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text"
                       id="searchKategori"
                       placeholder="Cari kategori buku...">
            </div>

            <span class="jumlah-kategori">
                Total: {{ $kategori->count() }} kategori
            </span>
        </div>

        @if(session('success'))
            <div class="alert-success-kategori">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error-kategori">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="table-responsive">
            <table class="kategori-table" id="tabelKategori">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Dibuat Pada</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="nama-kategori">
                                <div class="kategori-icon">
                                    <i class="bi bi-book"></i>
                                </div>
                                <span>{{ $item->nama_kategori }}</span>
                            </div>
                        </td>

                        <td>
                            {{ $item->created_at
                                ? $item->created_at->format('d M Y')
                                : '-' }}
                        </td>

                        <td>
                            <div class="aksi-kategori">
                                <a href="{{ route('kategori.edit', $item->id) }}"
                                class="btn-edit"
                                title="Edit kategori">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                
@if (auth()->check() && auth()->user()->role === 'admin')
    <button type="button"
            class="btn-hapus"
            data-bs-toggle="modal"
            data-bs-target="#modalHapus{{ $item->id }}"
            title="Hapus kategori">
        <i class="bi bi-trash3"></i>
    </button>
@endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="kategori-kosong">
                                <i class="bi bi-folder2-open"></i>
                                <h3>Belum Ada Kategori</h3>
                                <p>Tambahkan kategori untuk mengelompokkan buku.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL HAPUS KATEGORI --}}
@if (auth()->check() && auth()->user()->role === 'admin')
@foreach($kategori as $item)
<div class="modal fade"
     id="modalHapus{{ $item->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content modal-kategori">

            <div class="modal-body text-center">
                <div class="icon-hapus">
                    <i class="bi bi-trash3"></i>
                </div>

                <h5>Hapus Kategori?</h5>

                <p>
                    Kategori <strong>{{ $item->nama_kategori }}</strong>
                    akan dihapus. Tindakan ini tidak dapat dibatalkan.
                </p>

                <form action="{{ route('kategori.destroy', $item->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-footer-kategori">
                        <button type="button"
                                class="btn-batal"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                                class="btn-konfirmasi-hapus">
                            Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
    @endforeach
@endif

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('searchKategori');
    const rows = document.querySelectorAll(
        '#tabelKategori tbody tr'
    );

    search.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();

        rows.forEach(function (row) {
            row.style.display =
                row.innerText.toLowerCase().includes(keyword)
                    ? ''
                    : 'none';
        });
    });
});
</script>
@endpush