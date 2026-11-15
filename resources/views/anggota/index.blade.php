 @extends('layouts.app')

@section('title', 'Data Anggota - SIPRA')
@section('header-title', 'DATA ANGGOTA')
@section('header-description', 'Kelola data anggota Perpustakaan Desa Rajeg Bersatu.')

@section('header-actions')
    <form action="{{ route('anggota.index') }}" method="GET" class="header-search">
        <input
            type="text"
            name="search"
            placeholder="Cari nama atau NIK..."
            value="{{ request('search') }}"
        >
        <button type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <a href="{{ route('anggota.create') }}" class="header-btn-add">
        <i class="bi bi-plus-lg"></i>
        Tambah Anggota
    </a>
@endsection

@section('content')

<div class="anggota-container">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER TABEL --}}
    <div class="anggota-card">

        <div class="anggota-card-header">
            <div>
                <h3>Daftar Anggota Perpustakaan</h3>
                <p>Seluruh data anggota yang telah terdaftar.</p>
            </div>

            <span class="anggota-total">
                {{ $anggota->total() }} Anggota
            </span>
        </div>

        {{-- TABEL --}}
        <div class="table-responsive">
            <table class="anggota-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Anggota</th>
                        <th>NIK</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($anggota as $item)
                        <tr>
                            <td>
                                {{ $anggota->firstItem() + $loop->index }}
                            </td>

                            <td class="nama-anggota">
                                {{ $item->nama }}
                            </td>

                            <td>{{ $item->nik }}</td>

                            <td>
                                {{ $item->tempat_lahir }},
                                {{ $item->tanggal_lahir->translatedFormat('d F Y') }}
                            </td>

                            <td class="alamat-anggota">
                                {{ $item->alamat }}
                            </td>

                            <td>
                                <div class="anggota-actions">

                                    <a
                                        href="{{ route('anggota.show', $item->id) }}"
                                        class="btn-detail"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('anggota.edit', $item->id) }}"
                                        class="btn-edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a
                                        href="{{ route('anggota.kartu.cetak', $item->id) }}"
                                        class="btn-cetak"
                                        title="Cetak Kartu Anggota"
                                    >
                                        <i class="bi bi-printer"></i>
                                    </a>

                                    
<button
    type="button"
    class="btn-delete"
    title="Hapus"
    onclick="bukaModalHapus('{{ $item->id }}')"
>
    <i class="bi bi-trash"></i>
</button>

{{-- POPUP HAPUS --}}
<div class="modal-anggota" id="modalHapus{{ $item->id }}">

    <div class="modal-anggota-content">

        <div class="icon-hapus">
            <i class="bi bi-trash3-fill"></i>
        </div>

        <h3>Hapus Data Anggota?</h3>

        <p>
            Apakah kamu yakin ingin menghapus data anggota
            <strong>{{ $item->nama }}</strong>?
        </p>

        <span class="modal-warning">
            Data anggota yang sudah dihapus tidak dapat dikembalikan.
        </span>

        <div class="modal-footer-kategori">

            <button
                type="button"
                class="btn-batal"
                onclick="tutupModalHapus('{{ $item->id }}')"
            >
                Batal
            </button>

            <form
                action="{{ route('anggota.destroy', $item->id) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-konfirmasi-hapus">
                    Ya, Hapus
                </button>
            </form>

        </div>

    </div>

</div>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="anggota-empty">
                                <i class="bi bi-people"></i>
                                <p>Belum ada data anggota.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="anggota-pagination">
            {{ $anggota->links() }}
        </div>

    </div>

</div>

@endsection


<script>
    function bukaModalHapus(id) {
        const modal = document.getElementById('modalHapus' + id);

        if (modal) {
            modal.classList.add('active');
            document.body.classList.add('modal-anggota-open');
        }
    }

    function tutupModalHapus(id) {
        const modal = document.getElementById('modalHapus' + id);

        if (modal) {
            modal.classList.remove('active');
            document.body.classList.remove('modal-anggota-open');
        }
    }

    // Tutup popup ketika area luar modal diklik
    document.querySelectorAll('.modal-anggota').forEach(function(modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('active');
                document.body.classList.remove('modal-anggota-open');
            }
        });
    });

    // Tutup popup menggunakan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('.modal-anggota.active').forEach(function(modal) {
                modal.classList.remove('active');
            });

            document.body.classList.remove('modal-anggota-open');
        }
    });
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/anggota.css') }}">
@endpush