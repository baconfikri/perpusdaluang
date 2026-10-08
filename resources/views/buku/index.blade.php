@extends('layouts.app')

@section('title', 'Data Buku - Perpustakaan Daluang Manah')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Katalog Buku</h2>
            <p class="text-sm text-gray-500">Kelola semua data inventaris buku perpustakaan di sini.</p>
        </div>

        <div class="flex w-full md:w-auto gap-3 items-center">
            <!-- Form Pencarian Buku -->
            <form action="{{ route('buku.index') }}" method="GET" class="relative w-full md:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, pengarang..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none text-sm transition-all">
                <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-2.5"></i>
            </form>

            <a href="{{ route('buku.create') }}" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors text-sm font-medium">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Buku
            </a>
        </div>
    </div>

    <!-- Menampilkan Pesan Sukses -->
    @if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 border border-green-200 flex items-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Tabel Data -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="p-4 font-semibold">Judul Buku</th>
                    <th class="p-4 font-semibold">Pengarang & Penerbit</th>
                    <th class="p-4 font-semibold">Kategori</th>
                    <th class="p-4 font-semibold text-center">Stok</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @forelse($buku as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-medium text-gray-900">{{ $item->judul_buku }}</td>
                    <td class="p-4">
                        <div>{{ $item->pengarang }}</div>
                        <div class="text-xs text-gray-400">{{ $item->penerbit }}</div>
                    </td>
                    <td class="p-4">{{ $item->kategori_buku }}</td>
                    <td class="p-4 text-center font-medium">{{ $item->stok }}</td>
                    <td class="p-4 text-center">
                        @if($item->status == 'Tersedia')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Tersedia</span>
                        @elseif($item->status == 'Dipinjam')
                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-medium">Dipinjam</span>
                        @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Hilang</span>
                        @endif
                    </td>
                    <td class="p-4 flex justify-center gap-2">
                        <a href="{{ route('buku.edit', $item->id_buku) }}" class="text-blue-600 hover:bg-blue-50 p-2 rounded-md transition-colors" title="Edit">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <form action="{{ route('buku.destroy', $item->id_buku) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
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
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                        Belum ada data buku di perpustakaan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!-- Navigasi Paginasi -->
<div class="mt-4">
    {{ $buku->links() }} <!-- Ubah menjadi $anggota->links() untuk file anggota -->
</div>
@endsection