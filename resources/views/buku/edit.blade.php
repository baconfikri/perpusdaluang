@extends('layouts.app')

@section('title', 'Edit Data Buku')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('buku.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Edit Data Buku</h2>
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

    <!-- Form update membutuhkan method PUT -->
    <form action="{{ route('buku.update', $buku->id_buku) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku <span class="text-red-500">*</span></label>
                <input type="text" name="judul_buku" value="{{ old('judul_buku', $buku->judul_buku) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pengarang <span class="text-red-500">*</span></label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit <span class="text-red-500">*</span></label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Buku <span class="text-red-500">*</span></label>
                <input type="text" name="kategori_buku" value="{{ old('kategori_buku', $buku->kategori_buku) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                        <option value="Tersedia" {{ old('status', $buku->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dipinjam" {{ old('status', $buku->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Hilang" {{ old('status', $buku->status) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <a href="{{ route('buku.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection