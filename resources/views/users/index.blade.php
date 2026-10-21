@extends('layouts.app')

@section('title', 'Atur User | SIPRA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endpush

@section('content')
<div class="users-page">

    {{-- Header halaman --}}
    <div class="users-header">
        <div>
            <h2>Atur User</h2>
            <p>Kelola akun pengguna SIPRA.</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus"></i>
            Tambah User
        </a>
    </div>

    {{-- Notifikasi berhasil --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi gagal --}}
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Kartu tabel user --}}
    <div class="card">
        <div class="card-body">

            {{-- Pencarian --}}
            <form
                action="{{ route('users.index') }}"
                method="GET"
                class="users-search"
            >
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama atau email user..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i>
                    Cari
                </button>

                <a href="{{ route('users.index') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </form>

            {{-- Tabel data user --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Tanggal Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    {{ $user->created_at
                                        ? $user->created_at->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Edit user"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    @if(auth()->id() !== $user->id)
                                        <form
                                            action="{{ route('users.destroy', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus user"
                                            >
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <i class="bi bi-people"
                                       style="font-size: 28px;"></i>

                                    <p>
                                        @if(request('search'))
                                            User dengan kata kunci
                                            "{{ request('search') }}"
                                            tidak ditemukan.
                                        @else
                                            Belum ada data user.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($users->hasPages())
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
