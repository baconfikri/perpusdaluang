@extends('layouts.app')

@section('title', 'Data Peminjaman - Perpustakaan Daluang Manah')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Sirkulasi Peminjaman</h2>
            <p class="text-sm text-gray-500">Kelola transaksi peminjaman dan pengembalian buku.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors text-sm font-medium">
            <i data-lucide="plus" class="w-4 h-4"></i> Catat Peminjaman
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 border border-green-200 flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="p-4 font-semibold">Data Peminjam</th>
                    <th class="p-4 font-semibold">Buku yang Dipinjam</th>
                    <th class="p-4 font-semibold">Tgl Pinjam</th>
                    <th class="p-4 font-semibold text-center">Batas Waktu</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @forelse($peminjaman as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4">
                        <div class="font-medium text-gray-900">{{ $item->anggota->nama }}</div>
                        <div class="text-xs text-gray-400">{{ $item->anggota->nomor_anggota }}</div>
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-900">{{ $item->buku->judul_buku }}</div>
                        <div class="text-xs text-gray-400">Stok sisa: {{ $item->buku->stok }}</div>
                    </td>
                    <td class="p-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                    <td class="p-4 text-center text-red-600 font-medium">{{ \Carbon\Carbon::parse($item->tenggat_waktu)->format('d M Y') }}</td>
                    <td class="p-4 text-center">
                        @if($item->status_transaksi == 'Berjalan')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">Berjalan</span>
                        @else
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Selesai</span>
                            <div class="text-xs text-gray-400 mt-1">Tgl Kembali: {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</div>
                        @endif
                    </td>
                    <td class="p-4 flex justify-center gap-2">
                        <!-- Tombol Cetak PDF -->
                        <a href="{{ route('peminjaman.pdf', $item->id) }}" target="_blank" class="bg-orange-100 text-orange-600 hover:bg-orange-200 px-3 py-1.5 rounded-md transition-colors flex items-center gap-1 text-xs font-medium" title="Cetak Kartu">
                            <i data-lucide="printer" class="w-3 h-3"></i> Cetak
                        </a>
                        
                        <!-- Tombol Kembalikan Buku (Hanya muncul jika status Berjalan) -->
                        @if($item->status_transaksi == 'Berjalan')
                            <a href="{{ route('peminjaman.edit', $item->id) }}" onclick="return confirm('Proses pengembalian buku? Stok buku akan bertambah kembali.');" class="bg-green-100 text-green-700 hover:bg-green-200 px-3 py-1.5 rounded-md transition-colors flex items-center gap-1 text-xs font-medium">
                                <i data-lucide="check-square" class="w-3 h-3"></i> Selesai
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        <i data-lucide="file-x-2" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                        Belum ada riwayat transaksi peminjaman.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection