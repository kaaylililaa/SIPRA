<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // Menampilkan daftar anggota
    public function index(Request $request)
    {
        $anggota = Anggota::when($request->search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:anggota,nik',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        Anggota::create($request->all());

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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:anggota,nik,' . $anggota->id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    // Menghapus anggota
    public function destroy(Anggota $anggota)
    {
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