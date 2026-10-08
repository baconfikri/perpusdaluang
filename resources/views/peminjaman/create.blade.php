@extends('layouts.app')

@section('title', 'Catat Peminjaman')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('peminjaman.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Catat Peminjaman Baru</h2>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 border border-red-200">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="space-y-4 mb-6">
            <!-- Pilihan Anggota -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Peminjam (Anggota) <span class="text-red-500">*</span></label>
                <select name="anggota_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    <option value="" disabled selected>-- Pilih Anggota Terdaftar --</option>
                    @foreach($anggota as $a)
                        <option value="{{ $a->id_anggota }}" {{ old('anggota_id') == $a->id_anggota ? 'selected' : '' }}>
                            {{ $a->nomor_anggota }} - {{ $a->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilihan Buku -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Buku yang Dipinjam <span class="text-red-500">*</span></label>
                <select name="buku_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    <option value="" disabled selected>-- Pilih Buku (Hanya yang Tersedia) --</option>
                    @foreach($buku as $b)
                        <option value="{{ $b->id_buku }}" {{ old('buku_id') == $b->id_buku ? 'selected' : '' }}>
                            {{ $b->judul_buku }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-400 mt-1">*Buku dengan stok 0 tidak akan muncul di daftar ini.</p>
            </div>

            <!-- Tanggal Pinjam & Kembali -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam <span class="text-red-500">*</span></label>
                    <!-- Default value hari ini -->
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batas Pengembalian <span class="text-red-500">*</span></label>
                    <!-- Default value +7 hari -->
                    <input type="date" name="tenggat_waktu" value="{{ old('tenggat_waktu', date('Y-m-d', strtotime('+7 days'))) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition-colors font-medium text-sm">Proses Peminjaman</button>
        </div>
    </form>
</div>
@endsection