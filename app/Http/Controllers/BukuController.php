<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // 1. Menampilkan Halaman Tabel Data Buku
    public function index(Request $request)
    {
        // Menangkap kata kunci pencarian dari form
        $search = $request->input('search');

        // Modifikasi query untuk mencari berdasarkan judul, pengarang, penerbit, atau kategori
        $buku = Buku::when($search, function ($query, $search) {
            return $query->where('judul_buku', 'like', "%{$search}%")
                         ->orWhere('pengarang', 'like', "%{$search}%")
                         ->orWhere('penerbit', 'like', "%{$search}%")
                         ->orWhere('kategori_buku', 'like', "%{$search}%");
        })
        ->orderBy('judul_buku', 'asc') // Tetap urut abjad
        ->paginate(10)->withQueryString();

        return view('buku.index', compact('buku'));
    }

    // 2. Menampilkan Form Tambah Buku Baru
    public function create()
    {
        return view('buku.create');
    }

    // 3. Memproses Data dari Form Tambah ke Database
    public function store(Request $request)
    {
        // Validasi agar input tidak boleh kosong dan sesuai tipe data
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_buku' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Dipinjam,Hilang',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Data Buku
    public function edit($id_buku)
    {
        $buku = Buku::findOrFail($id_buku);
        return view('buku.edit', compact('buku'));
    }

    // 5. Memproses Pembaruan Data ke Database
    public function update(Request $request, $id_buku)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_buku' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Dipinjam,Hilang',
        ]);

        $buku = Buku::findOrFail($id_buku);
        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    // 6. Menghapus Data Buku dari Database
    public function destroy($id_buku)
    {
        $buku = Buku::findOrFail($id_buku);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus!');
    }
}