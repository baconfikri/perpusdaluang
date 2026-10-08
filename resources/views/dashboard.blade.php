@extends('layouts.app')

@section('title', 'Dasbor Utama - Perpustakaan Daluang Manah')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->nama }}!</h1>
        <p class="text-gray-500 mt-1">Pusat kendali dan rekam jejak operasional Perpustakaan Daluang Manah.</p>
    </div>

    <!-- Kartu Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                <i data-lucide="book" class="w-8 h-8"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Judul Buku</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $total_buku }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="bg-orange-100 p-3 rounded-lg text-orange-600">
                <i data-lucide="users" class="w-8 h-8"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Anggota Terdaftar</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $total_anggota }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="bg-green-100 p-3 rounded-lg text-green-600">
                <i data-lucide="arrow-right-left" class="w-8 h-8"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Sirkulasi Aktif (Dipinjam)</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $sirkulasi_aktif }}</h3>
            </div>
        </div>
    </div>

    <!-- Layout Bawah: Aktivitas Terkini & Buku Terpopuler -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri: Aktivitas Terkini (Porsi 2 Grid) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i data-lucide="activity" class="w-5 h-5 text-green-600"></i> Aktivitas Sirkulasi Terkini
                </h2>
                <a href="{{ route('peminjaman.index') }}" class="text-xs text-green-700 hover:underline font-semibold">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b border-gray-100">
                            <th class="p-3 font-semibold">Peminjam</th>
                            <th class="p-3 font-semibold">Buku</th>
                            <th class="p-3 font-semibold">Tanggal</th>
                            <th class="p-3 font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse($aktivitas_terkini as $akt)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $akt->anggota->nama ?? 'Data Dihapus' }}</td>
                            <td class="p-3 text-gray-600">{{ $akt->buku->judul_buku ?? 'Data Dihapus' }}</td>
                            <td class="p-3 text-xs text-gray-500">{{ \Carbon\Carbon::parse($akt->tanggal_pinjam)->format('d/m/Y') }}</td>
                            <td class="p-3 text-center">
                                @if($akt->status_transaksi == 'Berjalan')
                                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs font-medium">Dipinjam</span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-400 text-sm">Belum ada aktivitas sirkulasi tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kolom Kanan: Katalog Buku Terpopuler (Porsi 1 Grid) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="award" class="w-5 h-5 text-orange-500"></i> Buku Terpopuler
            </h2>

            <div class="space-y-4">
                @forelse($buku_terpopuler as $index => $buku)
                <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full {{ $index == 0 ? 'bg-orange-100 text-orange-600' : 'bg-gray-100 text-gray-600' }} text-xs font-bold">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $buku->judul_buku }}</h4>
                            <p class="text-xs text-gray-400">{{ $buku->pengarang }}</p>
                        </div>
                    </div>
                    <span class="bg-gray-50 text-gray-600 px-2 py-1 rounded-md text-xs font-bold border border-gray-100">
                        {{ $buku->peminjaman_count }}x
                    </span>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm py-6">Data peminjaman belum tersedia.</p>
                @endforelse
            </div>
        </div>

    </div>
@endsection