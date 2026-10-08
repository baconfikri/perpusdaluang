<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLoginForm()
    {
        // Jika admin sudah login, cegah akses form login dan lempar ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // 2. Memproses data dari form login
    public function login(Request $request)
    {
        // Validasi input form
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Proses percobaan autentikasi
        if (Auth::attempt($credentials)) {
            // Jika berhasil: generate ulang session untuk keamanan
            $request->session()->regenerate();
            
            // Arahkan ke halaman dasbor
            return redirect()->intended('dashboard');
        }

        // Jika gagal: kembalikan ke form login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // 3. Memproses proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}