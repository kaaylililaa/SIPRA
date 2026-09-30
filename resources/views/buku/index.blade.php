@extends('layouts.app')

@section('content')

<div class="buku-page">

    {{-- HEADER --}}
    <div class="buku-top">

        <div class="buku-title">

            <div class="buku-title-icon">
                <i class="bi bi-book"></i>
            </div>

            <div>
                <h1>Data Buku</h1>
                <p>Kelola seluruh koleksi buku Perpustakaan Desa Rajeg Bersatu.</p>
            </div>

        </div>


        <div class="buku-top-actions">

            {{-- SEARCH --}}
            <div class="buku-search">
                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchBuku"
                    placeholder="Cari Buku..."
                    autocomplete="off"
                >
            </div>


            {{-- KATEGORI --}}
            <a href="{{ route('kategori.index') }}" class="btn-kategori">
                <i class="bi bi-tag-fill"></i>
                Kategori
            </a>


            {{-- TAMBAH BUKU --}}
            <a href="{{ route('buku.create') }}" class="btn-tambah-buku">
                <i class="bi bi-plus-lg"></i>
                Tambah Buku
            </a>

        </div>

    </div>


    {{-- JUDUL LIST --}}
    <div class="buku-list-title">

        <h2>Daftar Buku</h2>

        <span>
            Total {{ $totalBuku }} buku
        </span>

    </div>


    {{-- LIST BUKU --}}
    <div class="buku-list" id="bukuList">

        @forelse ($bukus as $buku)

            <div class="buku-card">

                {{-- SAMPUL --}}
                <div class="buku-cover-box">

                    @if ($buku->gambar_sampul)

                        <img
                            src="{{ asset('uploads/sampul/' . $buku->gambar_sampul) }}"
                            alt="{{ $buku->judul_buku }}"
                            class="buku-cover"
                        >

                    @else

                        <div class="buku-no-cover">
                            <i class="bi bi-book"></i>
                        </div>

                    @endif

                </div>


                {{-- INFORMASI --}}
                <div class="buku-info">

                    <h3>
                        {{ $buku->judul_buku }}
                    </h3>

                    <div class="buku-pengarang">
                        {{ $buku->nama_pengarang }}
                    </div>

                    <div class="buku-penerbit">
                        {{ $buku->nama_penerbit }} • {{ $buku->tahun_terbit }}
                    </div>

                    <div class="buku-detail">

                        <span>
                            <i class="bi bi-upc-scan"></i>
                            ISBN: {{ $buku->isbn ?? '-' }}
                        </span>

                        <span class="detail-separator">•</span>

                        <span>
                            Kode: {{ $buku->kode_perpus ?? 'Belum ada' }}
                        </span>

                    </div>

                </div>


                {{-- BAGIAN KANAN --}}
                <div class="buku-right">

                    {{-- STATUS --}}
                    <span class="status tersedia">
                        Tersedia
                    </span>


                    {{-- BUTTON --}}
                    <div class="buku-buttons">

                        <a
                            href="{{ route('buku.show', $buku->id) }}"
                            class="buku-btn"
                            title="Lihat"
                        >
                            <i class="bi bi-eye"></i>
                        </a>

                        <a
                            href="{{ route('buku.edit', $buku->id) }}"
                            class="buku-btn"
                            title="Edit"
                        >
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form
                            action="{{ route('buku.destroy', $buku->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="buku-btn"
                                title="Hapus"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="buku-empty">
                <i class="bi bi-book"></i>
                <p>Belum ada data buku.</p>
            </div>

        @endforelse

    </div>

</div>


{{-- SEARCH --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchBuku');
    const cards = document.querySelectorAll('.buku-card');

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        cards.forEach(function (card) {

            const text = card.innerText.toLowerCase();

            if (text.includes(keyword)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }

        });

    });

});

</script>

@endsection