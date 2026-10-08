<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    // 1. Tampilkan Daftar Peminjaman
    public function index()
    {
        // Panggil data peminjaman beserta relasi anggota dan buku
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    // 2. Form Tambah Peminjaman
    public function create()
    {
        // Hanya panggil buku yang statusnya 'Tersedia' dan stok > 0
        $buku = Buku::where('status', 'Tersedia')->where('stok', '>', 0)->get();
        $anggota = Anggota::all();
        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    // 3. Simpan Transaksi Peminjaman & Kurangi Stok Buku
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id_anggota',
            'buku_id' => 'required|exists:buku,id_buku',
            'tanggal_pinjam' => 'required|date',
            'tenggat_waktu' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // Simpan Transaksi
        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_waktu' => $request->tenggat_waktu,
            'status_transaksi' => 'Berjalan',
        ]);

        // Logika Pengurangan Stok Buku
        $buku = Buku::findOrFail($request->buku_id);
        $buku->decrement('stok'); 
        
        // Jika stok habis setelah dipinjam, ubah status jadi Dipinjam
        if ($buku->stok == 0) {
            $buku->update(['status' => 'Dipinjam']);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman berhasil dicatat!');
    }

    // 4. Proses Pengembalian Buku
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Kembalikan stok buku
        $buku = Buku::findOrFail($peminjaman->buku_id);
        $buku->increment('stok');
        
        // Pastikan status buku menjadi Tersedia kembali
        if ($buku->status == 'Dipinjam') {
            $buku->update(['status' => 'Tersedia']);
        }

        // Update status transaksi
        $peminjaman->update([
            'tanggal_kembali' => now(), // Catat tanggal hari ini
            'status_transaksi' => 'Selesai'
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan!');
    }

    // 5. Fitur Cetak PDF
    public function cetakPdf($id)
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->findOrFail($id);
        
        // Render tampilan blade ke PDF
        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjaman'));
        
        // stream() = buka di browser. download() = langsung unduh
        return $pdf->stream('Kartu_Peminjaman_'.$peminjaman->anggota->nomor_anggota.'.pdf');
    }
}