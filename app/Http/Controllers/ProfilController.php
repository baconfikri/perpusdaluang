<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    // Menampilkan halaman profil dan form edit
    public function index()
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    // Memproses pembaruan data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'email_admin' => 'required|email|unique:users,email_admin,' . $user->id,
            'jabatan' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Password opsional
        ]);

        $user->nama = $request->nama;
        $user->no_telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->email_admin = $request->email_admin;
        $user->jabatan = $request->jabatan;

        // Jika form password diisi, enkripsi dan simpan password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data Profil Admin berhasil diperbarui!');
    }
}