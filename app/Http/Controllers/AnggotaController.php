<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap kata kunci pencarian
        $search = $request->input('search');

        // Mencari berdasarkan nomor anggota, nama, atau alamat
        $anggota = Anggota::when($search, function ($query, $search) {
            return $query->where('nomor_anggota', 'like', "%{$search}%")
                         ->orWhere('nama', 'like', "%{$search}%")
                         ->orWhere('alamat', 'like', "%{$search}%");
        })
        ->orderBy('nomor_anggota', 'asc') // Tetap urut nomor
        ->paginate(10)->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|string|max:255|unique:anggota,nomor_anggota',
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    public function edit($id_anggota)
    {
        $anggota = Anggota::findOrFail($id_anggota);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id_anggota)
    {
        $request->validate([
            'nomor_anggota' => 'required|string|max:255|unique:anggota,nomor_anggota,' . $id_anggota . ',id_anggota',
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $anggota = Anggota::findOrFail($id_anggota);
        $anggota->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id_anggota)
    {
        $anggota = Anggota::findOrFail($id_anggota);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus!');
    }
}