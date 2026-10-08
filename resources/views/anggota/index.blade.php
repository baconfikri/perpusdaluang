@extends('layouts.app')

@section('title', 'Data Anggota - Perpustakaan Daluang Manah')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Anggota</h2>
            <p class="text-sm text-gray-500">Kelola data anggota yang terdaftar di perpustakaan.</p>
        </div>

        <div class="flex w-full md:w-auto gap-3 items-center">
            <!-- Form Pencarian Anggota -->
            <form action="{{ route('anggota.index') }}" method="GET" class="relative w-full md:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, nomor..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none text-sm transition-all">
                <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-2.5"></i>
            </form>

        <a href="{{ route('anggota.create') }}" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors text-sm font-medium">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah Anggota
        </a>
    </div>
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
                    <th class="p-4 font-semibold">No. Anggota</th>
                    <th class="p-4 font-semibold">Nama Lengkap</th>
                    <th class="p-4 font-semibold">No. Telepon</th>
                    <th class="p-4 font-semibold">Alamat</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @forelse($anggota as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-medium text-gray-900">{{ $item->nomor_anggota }}</td>
                    <td class="p-4 font-medium">{{ $item->nama }}</td>
                    <td class="p-4">{{ $item->no_telp }}</td>
                    <td class="p-4">{{ $item->alamat }}</td>
                    <td class="p-4 flex justify-center gap-2">
                        <a href="{{ route('anggota.edit', $item->id_anggota) }}" class="text-blue-600 hover:bg-blue-50 p-2 rounded-md transition-colors" title="Edit">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <form action="{{ route('anggota.destroy', $item->id_anggota) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-md transition-colors" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        <i data-lucide="users" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                        Belum ada data anggota yang terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection