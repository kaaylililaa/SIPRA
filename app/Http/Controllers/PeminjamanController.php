<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
 
public function status($status)
{
    $judul = [
        'semua' => 'Total Peminjaman',
        'dipinjam' => 'Data Buku Dipinjam',
        'dikembalikan' => 'Data Buku Dikembalikan',
        'terlambat' => 'Data Peminjaman Terlambat',
    ];

    abort_unless(isset($judul[$status]), 404);

    $query = \App\Models\Peminjaman::query();

    if ($status === 'dipinjam') {
    $query->whereRaw('LOWER(TRIM(status)) = ?', ['dipinjam'])
          ->whereDate('tanggal_kembali', '>=', now()->toDateString());
} elseif ($status === 'terlambat') {
    $query->where(function ($q) {
        $q->whereRaw('LOWER(TRIM(status)) = ?', ['terlambat'])
          ->orWhere(function ($sub) {
              $sub->whereRaw('LOWER(TRIM(status)) = ?', ['dipinjam'])
                  ->whereDate('tanggal_kembali', '<', now()->toDateString());
          });
    });
} elseif ($status === 'dikembalikan') {
    $query->whereRaw('LOWER(TRIM(status)) = ?', ['dikembalikan']);
}

    $peminjaman = $query->orderByDesc('id')->paginate(5);

    return view('peminjaman.status', [
        'peminjaman' => $peminjaman,
        'statusAktif' => $status,
        'judulHalaman' => $judul[$status],
    ]);
}

    public function index(Request $request)
    {
        $totalPeminjaman = Peminjaman::count();

        $totalDipinjam = Peminjaman::where('status', 'Dipinjam')->count();

        $totalDikembalikan = Peminjaman::where('status', 'Dikembalikan')->count();

        $totalTerlambat = Peminjaman::where('status', 'Dipinjam')
            ->whereNotNull('tanggal_kembali')
            ->whereDate('tanggal_kembali', '<', Carbon::today())
            ->count();

        $query = Peminjaman::withCount('bukus');
    
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_peminjam', 'like', '%' . $search . '%')
                  ->orWhere('id', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {

            if ($request->status === 'Terlambat') {

                $query->where('status', 'Dipinjam')
                    ->whereNotNull('tanggal_kembali')
                    ->whereDate(
                        'tanggal_kembali',
                        '<',
                        Carbon::today()
                    );

            } else {

                $query->where('status', $request->status);

            }
        }

        if ($request->filled('tanggal')) {
            $query->whereDate(
                'tanggal_kembali',
                $request->tanggal
            );
        }

        $peminjamans = $query
            ->latest()
            ->paginate(5);

        return view('peminjaman.index', compact(
            'peminjamans',
            'totalPeminjaman',
            'totalDipinjam',
            'totalDikembalikan',
            'totalTerlambat'
        ));
    }

    public function create()
    {
         $bukus = Buku::orderBy('judul_buku', 'asc')->get();

    return view('peminjaman.create', compact('bukus'));
    }

    
public function store(Request $request)
{
    $request->validate([
        'buku_ids' => 'required|array|min:1|max:5',
        'buku_ids.*' => 'required|exists:buku,id|distinct',
        'nama_peminjam' => 'required|string|max:255',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ], [
        'buku_ids.required' => 'Silakan pilih buku terlebih dahulu.',
        'buku_ids.min' => 'Pilih minimal satu buku.',
        'buku_ids.max' => 'Maksimal peminjaman adalah 5 buku.',
        'buku_ids.*.exists' => 'Buku yang dipilih tidak ditemukan.',
        'buku_ids.*.distinct' => 'Buku tidak boleh dipilih lebih dari satu kali.',
        'nama_peminjam.required' => 'Nama peminjam wajib diisi.',
        'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
        'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
        'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
    ]);

    DB::transaction(function () use ($request) {

        // Simpan transaksi peminjaman
        $peminjaman = Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);

        // Simpan semua buku ke detail_pinjam
        foreach ($request->buku_ids as $bukuId) {
            DB::table('detail_pinjam')->insert([
                'peminjaman_id' => $peminjaman->id,
                'buku_id' => $bukuId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    });

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Data peminjaman berhasil ditambahkan.');
}

    public function show(Peminjaman $peminjaman)
{
    $peminjaman->load('bukus');

    /*
    |--------------------------------------------------------------------------
    | CEK KETERLAMBATAN
    |--------------------------------------------------------------------------
    */

    $isTerlambat = false;
    $hariTerlambat = 0;
    $denda = 0;
    $mulaiTerlambat = null;

    if (
        $peminjaman->status !== 'Dikembalikan' &&
        $peminjaman->tanggal_kembali
    ) {
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);

        if ($tanggalKembali->isBefore(Carbon::today())) {
            $isTerlambat = true;

            $hariTerlambat = $tanggalKembali->diffInDays(
                Carbon::today()
            );

            $denda = $hariTerlambat * 10000;

            $mulaiTerlambat = $tanggalKembali->copy()->addDay();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS YANG DITAMPILKAN
    |--------------------------------------------------------------------------
    */

    $statusTampilan = $isTerlambat
        ? 'Terlambat'
        : ($peminjaman->status ?? 'Dipinjam');


    return view('peminjaman.show', compact(
        'peminjaman',
        'isTerlambat',
        'hariTerlambat',
        'denda',
        'mulaiTerlambat',
        'statusTampilan'
    ));

    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'buku_id' => 'required|integer',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
        ]);

        $peminjaman->update([
            'nama_peminjam' => $request->nama_peminjam,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
{
    // Hanya admin yang boleh menghapus
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Anda tidak memiliki izin untuk menghapus data peminjaman.');
    }

    $peminjaman->delete();

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Data peminjaman berhasil dihapus.');
}

public function konfirmasi(Peminjaman $peminjaman)
{
    $isTerlambat = false;
    $hariTerlambat = 0;
    $denda = 0;

    if (
        $peminjaman->status !== 'Dikembalikan' &&
        $peminjaman->tanggal_kembali
    ) {
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);

        if ($tanggalKembali->isBefore(Carbon::today())) {
            $isTerlambat = true;

            $hariTerlambat = $tanggalKembali->diffInDays(
                Carbon::today()
            );

            $denda = $hariTerlambat * 10000;
        }
    }

    return view('peminjaman.konfirmasi', compact(
        'peminjaman',
        'isTerlambat',
        'hariTerlambat',
        'denda'
    ));
}
/**
 * Memproses konfirmasi pengembalian buku.
 */
public function kembalikan(Peminjaman $peminjaman)
{
    // Ubah status peminjaman menjadi Dikembalikan.
    $peminjaman->update([
        'status' => 'Dikembalikan',
    ]);

    // Kembali ke halaman detail dengan status terbaru.
    return redirect()
        ->route('peminjaman.show', $peminjaman->id)
        ->with('success', 'Buku berhasil dikembalikan.');

        }
}
