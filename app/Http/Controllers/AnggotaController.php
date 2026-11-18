<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    // Menampilkan daftar anggota
    public function index(Request $request)
    {
        $anggota = Anggota::when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        return view('anggota.create');
    }

    // Menyimpan anggota baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:anggota,nik',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mencatat akun admin/petugas yang menambahkan anggota
        $data['user_id'] = auth()->id();

        // Upload foto anggota
        if ($request->hasFile('foto')) {
            $folder = public_path('images/anggota');

            File::ensureDirectoryExists($folder);

            $foto = $request->file('foto');
            $namaFoto = Str::uuid() . '.' . $foto->extension();

            $foto->move($folder, $namaFoto);

            $data['foto'] = $namaFoto;
        }

        Anggota::create($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan!');
    }

    // Menampilkan detail anggota
    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    // Menampilkan form edit
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    // Memperbarui data anggota
    public function update(Request $request, Anggota $anggota)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:anggota,nik,' . $anggota->id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            $folder = public_path('images/anggota');

            File::ensureDirectoryExists($folder);

            $foto = $request->file('foto');
            $namaFoto = Str::uuid() . '.' . $foto->extension();

            $foto->move($folder, $namaFoto);

            // Hapus foto lama
            if ($anggota->foto) {
                $fotoLama = $folder . '/' . $anggota->foto;

                if (File::exists($fotoLama)) {
                    File::delete($fotoLama);
                }
            }

            $data['foto'] = $namaFoto;
        }

        $anggota->update($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    // Menghapus anggota
    public function destroy(Anggota $anggota)
    {
        // Hapus foto anggota
        if ($anggota->foto) {
            $foto = public_path('images/anggota/' . $anggota->foto);

            if (File::exists($foto)) {
                File::delete($foto);
            }
        }

        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus!');
    }

    // Menampilkan kartu anggota untuk dicetak
    public function cetakKartu(Anggota $anggota)
    {
        return view('anggota.kartu', compact('anggota'));
    }
}
