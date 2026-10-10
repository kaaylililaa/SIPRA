<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $totalPeminjaman = Peminjaman::count();

        $totalDipinjam = Peminjaman::where('status', 'Dipinjam')->count();

        $totalDikembalikan = Peminjaman::where('status', 'Dikembalikan')->count();

        $totalTerlambat = Peminjaman::where('status', 'Dipinjam')
            ->whereNotNull('tanggal_kembali')
            ->whereDate('tanggal_kembali', '<', Carbon::today())
            ->count();

        $query = Peminjaman::query();
    
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
            ->paginate(10);

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
        'buku_id' => 'required|exists:buku,id',
        'nama_peminjam' => 'required|string|max:255',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ], [
        'buku_id.required' => 'Silakan pilih buku terlebih dahulu.',
        'buku_id.exists' => 'Buku yang dipilih tidak ditemukan.',
        'nama_peminjam.required' => 'Nama peminjam wajib diisi.',
        'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
        'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
        'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
    ]);

    Peminjaman::create([
        'buku_id' => $request->buku_id,
        'nama_peminjam' => $request->nama_peminjam,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'Dipinjam',
    ]);

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Data peminjaman berhasil ditambahkan.');
}
    public function show(Peminjaman $peminjaman)
{
    $peminjaman->load('buku');

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