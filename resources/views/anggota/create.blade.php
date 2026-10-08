@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('anggota.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Tambah Anggota Baru</h2>
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

    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
        <div class="space-y-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Anggota <span class="text-red-500">*</span></label>
                <input type="text" name="nomor_anggota" value="{{ old('nomor_anggota') }}" required placeholder="Contoh: KTA-001" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-red-500">*</span></label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                <textarea name="alamat" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">{{ old('alamat') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition-colors font-medium text-sm">Simpan Data</button>
        </div>
    </form>
</div>
@endsection