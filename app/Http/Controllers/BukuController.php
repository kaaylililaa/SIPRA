<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    public function index(Request $request)
{
      $bukus = \App\Models\Buku::with('kategori')
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    $totalBuku = \App\Models\Buku::count();

    return view('buku.index', compact('bukus', 'totalBuku'));

}

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'kategori_id' => 'required|exists:kategori,id',
        'judul_buku' => 'required|string|max:255',
        'nama_pengarang' => 'required|string|max:255',
        'nama_penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|integer',
        'kode_perpus' => 'nullable|string|max:50',
        'isbn' => 'nullable|string|max:20',
        'gambar_sampul' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('gambar_sampul')) {
        $file = $request->file('gambar_sampul');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(
            public_path('uploads/sampul'),
            $namaFile
        );

        $validated['gambar_sampul'] = $namaFile;
    }

    Buku::create($validated);

    return redirect()
        ->route('buku.index')
        ->with('success', 'Buku berhasil ditambahkan.');
}

        public function show($id)
{
  $buku = Buku::with('kategori')->findOrFail($id);

    return view('buku.show', compact('buku'));
}

    public function edit($id)
{
    $buku = Buku::findOrFail($id);

    $kategoris = Kategori::orderBy('nama_kategori')->get();

    return view('buku.edit', compact('buku', 'kategoris'));
}

   public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);

    $request->validate([
        'judul_buku' => 'required|string|max:255',
        'nama_pengarang' => 'required|string|max:255',
        'nama_penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|integer',
        'isbn' => 'nullable|string|max:50',
        'kategori_id' => 'required|exists:kategori,id',
        'gambar_sampul' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $buku->judul_buku = $request->judul_buku;
    $buku->nama_pengarang = $request->nama_pengarang;
    $buku->nama_penerbit = $request->nama_penerbit;
    $buku->tahun_terbit = $request->tahun_terbit;
    $buku->isbn = $request->isbn;
    $buku->kategori_id = $request->kategori_id;

    if ($request->hasFile('gambar_sampul')) {

        $file = $request->file('gambar_sampul');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->storeAs(
            'public',
            $filename
        );

        $buku->gambar_sampul = $filename;
    }

    $buku->kode_perpus = $request->kode_perpus;
    $buku->judul_buku = $request->judul_buku;
$buku->nama_pengarang = $request->nama_pengarang;
$buku->nama_penerbit = $request->nama_penerbit;
$buku->tahun_terbit = $request->tahun_terbit;
$buku->isbn = $request->isbn;
$buku->kode_perpus = $request->kode_perpus;
$buku->kategori_id = $request->kategori_id;
    $buku->save();

    return redirect()
        ->route('buku.index')
        ->with('success', 'Data buku berhasil diperbarui.');
}


public function destroy(Buku $buku)
{
    // Hanya admin yang boleh menghapus buku
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Kamu tidak memiliki izin untuk menghapus buku.');
    }

    // Periksa apakah buku masih digunakan dalam data peminjaman
    $masihDipinjam = \Illuminate\Support\Facades\DB::table('peminjaman')
        ->where('buku_id', $buku->id)
        ->exists();

    if ($masihDipinjam) {
        return redirect()
            ->route('buku.show', $buku->id)
            ->with('error', 'Buku tidak dapat dihapus karena masih terhubung dengan data peminjaman.');
    }

    // Hapus file sampul jika tersedia
    if ($buku->gambar_sampul) {
        $path = public_path('uploads/sampul/' . basename($buku->gambar_sampul));

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $buku->delete();

    return redirect()
        ->route('buku.index')
        ->with('success', 'Buku berhasil dihapus.');
}

}
