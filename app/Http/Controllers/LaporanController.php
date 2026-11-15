<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // HALAMAN UTAMA LAPORAN
    public function index()
    {
        return view('laporan.index');
    }

    // FILTER BULAN DAN TAHUN
    private function periode(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'nullable|integer|between:1,12',
            'tahun' => 'nullable|integer|min:2000|max:2100',
        ]);

        $bulan = (int) ($validated['bulan'] ?? now()->month);
        $tahun = (int) ($validated['tahun'] ?? now()->year);

        return [
            $bulan,
            $tahun,
            Carbon::createFromDate($tahun, $bulan, 1)
                ->locale('id')
                ->translatedFormat('F')
        ];
    }

    // 1. LAPORAN BUKU TERBARU
    public function buku(Request $request)
    {
        [$bulan, $tahun, $namaBulan] = $this->periode($request);

        $data = DB::table('buku')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.buku', compact(
            'data', 'bulan', 'tahun', 'namaBulan'
        ));
    }

    
// 2. LAPORAN PEMINJAMAN
public function peminjaman(Request $request)
{
    [$bulan, $tahun, $namaBulan] = $this->periode($request);

    $data = DB::table('peminjaman')
        ->leftJoin(
            'detail_pinjam',
            'peminjaman.id',
            '=',
            'detail_pinjam.peminjaman_id'
        )
        ->leftJoin(
            'buku',
            'detail_pinjam.buku_id',
            '=',
            'buku.id'
        )
        ->select(
            'peminjaman.*',
            'buku.judul_buku'
        )
        ->whereMonth('peminjaman.tanggal_pinjam', $bulan)
        ->whereYear('peminjaman.tanggal_pinjam', $tahun)
        ->orderBy('peminjaman.tanggal_pinjam', 'desc')
        ->get();

    return view('laporan.peminjaman', compact(
        'data',
        'bulan',
        'tahun',
        'namaBulan'
    ));
}

    // 3. LAPORAN PENGEMBALIAN
    public function pengembalian(Request $request)
    {
        [$bulan, $tahun, $namaBulan] = $this->periode($request);

        $data = DB::table('pengembalian')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.pengembalian', compact(
            'data', 'bulan', 'tahun', 'namaBulan'
        ));
    }

    // 4. LAPORAN PEMBAYARAN DENDA
    public function denda(Request $request)
    {
        [$bulan, $tahun, $namaBulan] = $this->periode($request);

        $data = DB::table('detail_kembali')
    ->join(
        'pengembalian',
        'detail_kembali.pengembalian_id',
        '=',
        'pengembalian.id'
    )
    ->select(
        'detail_kembali.*',
        'pengembalian.created_at'
    )
    ->whereMonth('pengembalian.created_at', $bulan)
    ->whereYear('pengembalian.created_at', $tahun)
    ->where('detail_kembali.denda', '>', 0)
    ->orderBy('pengembalian.created_at', 'desc')
    ->get();

$totalDenda = $data->sum('denda');

        return view('laporan.denda', compact(
            'data',
            'totalDenda',
            'bulan',
            'tahun',
            'namaBulan'
        ));
    }
}
