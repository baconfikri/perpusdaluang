<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman; // Pastikan ini juga ditambahkan

// 1. Rute Halaman Login (Guest)
Route::middleware('guest')->group(function () {
    // Kita arahkan ROOT URL '/' langsung ke method showLoginForm
    // Rute Landing Page Publik
Route::get('/', function () {
    // 1. Hitung total buku & anggota
    $total_buku = \App\Models\Buku::count();
    $total_anggota = \App\Models\Anggota::count();
    
    // 2. Ambil 4 buku terpopuler untuk dipajang di halaman depan
    $buku_terpopuler = \App\Models\Buku::withCount('peminjaman')
                        ->orderBy('peminjaman_count', 'desc')
                        ->take(4)
                        ->get();

    return view('welcome', compact('total_buku', 'total_anggota', 'buku_terpopuler'));
})->name('beranda');

    Route::get('/', [AuthController::class, 'showLoginForm']);
    
    // Kita buat juga URL '/login' dengan metode GET agar tidak error saat di-redirect
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    
    // Ini adalah URL untuk memproses input form (POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// 2. Rute Terproteksi (Auth)
Route::middleware('auth')->group(function () {
    
    // Rute Dasbor

    Route::get('/dashboard', function () {
        $total_buku = Buku::count(); 
        $total_anggota = Anggota::count();
        $sirkulasi_aktif = Peminjaman::where('status_transaksi', 'Berjalan')->count();

        // 1. Mengambil 5 aktivitas sirkulasi terakhir beserta relasinya
        $aktivitas_terkini = Peminjaman::with(['anggota', 'buku'])->latest()->take(5)->get();

        // 2. Mengambil 5 buku terpopuler berdasarkan frekuensi peminjaman
        $buku_terpopuler = Buku::withCount('peminjaman')
                            ->orderBy('peminjaman_count', 'desc')
                            ->take(5)
                            ->get();

        return view('dashboard', compact('total_buku', 'total_anggota', 'sirkulasi_aktif', 'aktivitas_terkini', 'buku_terpopuler'));
    })->name('dashboard');

    // Rute untuk CRUD Buku
    Route::resource('buku', BukuController::class);

    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute untuk CRUD Buku
    Route::resource('buku', BukuController::class);

    // Rute untuk CRUD Anggota
    Route::resource('anggota', App\Http\Controllers\AnggotaController::class);
    
    // Rute untuk CRUD Buku dan Anggota (yg sudah ada)
    Route::resource('buku', BukuController::class);
    Route::resource('anggota', App\Http\Controllers\AnggotaController::class);

    // Rute untuk Transaksi Peminjaman
    Route::resource('peminjaman', App\Http\Controllers\PeminjamanController::class);
    
    // Rute Khusus Cetak PDF
    Route::get('/peminjaman/{id}/pdf', [App\Http\Controllers\PeminjamanController::class, 'cetakPdf'])->name('peminjaman.pdf');

    // Rute Profil Admin
    Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil/update', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');

    // Rute Laporan
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/cetak', [App\Http\Controllers\LaporanController::class, 'cetak'])->name('laporan.cetak');
});
