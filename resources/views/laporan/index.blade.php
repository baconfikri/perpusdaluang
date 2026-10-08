@extends('layouts.app')

@section('title', 'Cetak Laporan - Perpustakaan Daluang Manah')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i> Rekapitulasi Sirkulasi
        </h2>
        <p class="text-sm text-gray-500 mt-1">Cetak laporan peminjaman bulanan untuk evaluasi arsip kelurahan.</p>
    </div>

    <form action="{{ route('laporan.cetak') }}" method="POST" target="_blank">
        @csrf
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Bulan</label>
                <select name="bulan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    @for($m=1; $m<=12; ++$m)
                        <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Tahun</label>
                <input type="number" name="tahun" value="{{ date('Y') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
        </div>

        <div class="flex justify-end border-t border-gray-100 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors font-medium text-sm">
                <i data-lucide="printer" class="w-4 h-4"></i> Cetak PDF
            </button>
        </div>
    </form>
</div>
@endsection