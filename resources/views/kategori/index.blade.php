@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="kategori-card">

        {{-- HEADER --}}
        <div class="kategori-header">

            <div class="header-title">

                <div class="header-icon">
                    <i class="bi bi-card-list"></i>
                </div>

                <div>
                    <h4>Kategori Buku</h4>
                    <p>Kelola kategori buku dengan mudah dan rapi</p>
                </div>

            </div>

            <a href="#" class="back-link">
                ← Kembali
            </a>

        </div>


        {{-- CONTENT --}}
        <div class="kategori-content">

            {{-- SEARCH + TAMBAH --}}
            <div class="kategori-toolbar">

                <div class="search-box">

                   <i class="bi bi-search-heart"></i>

                    <input
                        type="text"
                        id="searchKategori"
                        placeholder="Cari kategori..."
                    >

                </div>


                <a
                    href="{{ route('kategori.create') }}"
                    class="btn-tambah"
                >
                     <i class="bi bi-plus-lg"></i>
                    Tambah Kategori
                </a>

            </div>

            {{-- TABLE --}}
           <div class="table-wrapper">

    <table class="kategori-table">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($kategoris as $kategori)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td class="nama-kategori">
                        {{ $kategori->nama_kategori }}
                    </td>

                    <td class="jumlah-buku">
                        {{ $kategori->bukus_count ?? 0 }} Buku
                    </td>

                    <td>

                        <form
                            action="{{ route('kategori.destroy', $kategori->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn-hapus"
                            >
                                <i class="bi bi-trash3"></i>
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>
                
                @empty

                <tr>
                    <td colspan="4" class="data-kosong">
                        Belum ada data kategori
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

    </form>

</td>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="4"
                                class="data-kosong"
                            >

                                <i class="bi bi-folder2-open"></i>

                                <p>
                                    Belum ada data kategori
                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<script>

const search =
    document.getElementById('searchKategori');

search.addEventListener('keyup', function () {

    const keyword =
        this.value.toLowerCase();

    const rows =
        document.querySelectorAll(
            '#kategoriTable tbody tr'
        );

    rows.forEach(function (row) {

        const text =
            row.innerText.toLowerCase();

        row.style.display =
            text.includes(keyword) ? '' : 'none';

    });

});

</script>

@endsection