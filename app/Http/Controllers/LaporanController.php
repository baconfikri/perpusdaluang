<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // 1. Menampilkan halaman form pilih bulan & tahun
    public function index()
    {
        return view('laporan.index');
    }

    // 2. Memproses cetak PDF berdasarkan bulan & tahun
    public function cetak(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
        ]);

        // Cast ke (int) agar Carbon tidak protes saat menerima string dari form
        $bulan = (int) $request->bulan;
        $tahun = (int) $request->tahun;

        // Ambil data sirkulasi sesuai bulan & tahun yang dipilih
        $laporan = Peminjaman::with(['anggota', 'buku'])
                    ->whereMonth('tanggal_pinjam', $bulan)
                    ->whereYear('tanggal_pinjam', $tahun)
                    ->orderBy('tanggal_pinjam', 'asc')
                    ->get();

        // Nama bulan untuk dicetak
        $nama_bulan = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'nama_bulan', 'tahun'))->setPaper('A4', 'landscape');
        return $pdf->stream('Laporan_Sirkulasi_'.$nama_bulan.'_'.$tahun.'.pdf');
    }
}