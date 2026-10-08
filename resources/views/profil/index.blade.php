@extends('layouts.app')

@section('title', 'Profil Admin - Perpustakaan Daluang Manah')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Validasi -->
    @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-4 rounded-lg border border-red-200">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- BAGIAN 1: KARTU INFORMASI PROFIL -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i data-lucide="contact" class="w-5 h-5 text-green-600"></i> Informasi Admin Saat Ini
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
            <div class="p-3 bg-gray-50 rounded-lg">
                <span class="block text-gray-400 text-xs mb-1">Nama Pengelola</span>
                <span class="font-medium text-gray-900 text-base">{{ $user->nama }}</span>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <span class="block text-gray-400 text-xs mb-1">Jabatan</span>
                <span class="font-medium text-gray-900 text-base">{{ $user->jabatan }}</span>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <span class="block text-gray-400 text-xs mb-1">Email / Kontak</span>
                <span class="font-medium text-gray-900">{{ $user->email_admin }}</span>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <span class="block text-gray-400 text-xs mb-1">Nomor Telepon</span>
                <span class="font-medium text-gray-900">{{ $user->no_telp }}</span>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg md:col-span-2">
                <span class="block text-gray-400 text-xs mb-1">Alamat Lengkap</span>
                <span class="font-medium text-gray-900">{{ $user->alamat ?? 'Belum ada data alamat.' }}</span>
            </div>
        </div>
    </div>

    <!-- BAGIAN 2: FORM EDIT / PERGANTIAN ADMIN -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-2 flex items-center gap-2">
            <i data-lucide="user-cog" class="w-5 h-5 text-blue-600"></i> Edit Data / Pergantian Admin
        </h2>
        <p class="text-sm text-gray-500 mb-6">Ubah data di bawah ini jika terjadi pergantian kepengurusan perpustakaan.</p>

        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email_admin" value="{{ old('email_admin', $user->email_admin) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-red-500">*</span></label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Tempat Tinggal</label>
                    <textarea name="alamat" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                <div class="md:col-span-2 mt-2 pt-4 border-t border-gray-100">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Password (Opsional)</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                    Simpan Perubahan Akun
                </button>
            </div>
        </form>
    </div>

</div>
@endsection