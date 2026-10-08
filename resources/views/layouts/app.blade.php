<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Perpustakaan Daluang Manah')</title>

    <!-- 1. Tailwind CSS via CDN (Untuk Development Cepat) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 2. Lucide Icons via CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- 3. Font Setup (Opsional: Plus Jakarta Sans untuk kesan modern) -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- NAVBAR DASHBOARD -->
    <nav class="bg-green-700 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Kiri: Logo & Nama Perpustakaan -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:text-green-200 transition-colors whitespace-nowrap">
                    <i data-lucide="book-open" class="w-6 h-6"></i>
                    <span class="font-bold text-lg tracking-wide shrink-0">Perpustakaan Daluang Manah</span>
                </a>

                <!-- Kanan: Menu Navigasi -->
                <div class="hidden md:flex space-x-2 lg:space-x-4 items-center">
    
    <a href="{{ route('dashboard') }}" class="hover:bg-green-600 px-2 lg:px-3 py-2 rounded-md transition duration-200 flex items-center gap-1.5 whitespace-nowrap">
        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
    </a>

    <a href="{{ route('buku.index') }}" class="hover:bg-green-600 px-2 lg:px-3 py-2 rounded-md transition duration-200 flex items-center gap-1.5 whitespace-nowrap">
        <i data-lucide="library" class="w-4 h-4"></i> Data Buku
    </a>
    
    <a href="{{ route('anggota.index') }}" class="hover:bg-green-600 px-2 lg:px-3 py-2 rounded-md transition duration-200 flex items-center gap-1.5 whitespace-nowrap">
        <i data-lucide="users" class="w-4 h-4"></i> Data Anggota
    </a>
    
    <a href="{{ route('peminjaman.index') }}" class="hover:bg-green-600 px-2 lg:px-3 py-2 rounded-md transition duration-200 flex items-center gap-1.5 whitespace-nowrap">
        <i data-lucide="arrow-right-left" class="w-4 h-4"></i> Peminjaman
    </a>

    <a href="{{ route('laporan.index') }}" class="hover:bg-green-600 px-2 lg:px-3 py-2 rounded-md transition duration-200 flex items-center gap-1.5 whitespace-nowrap">
        <i data-lucide="file-text" class="w-4 h-4"></i> Laporan
    </a>

                    <!-- Menu Profil Admin -->
                    <div class="border-l border-green-500 h-6 mx-2"></div>
                    <!-- Menu Profil Admin -->
                    <div class="border-l border-green-500 h-6 mx-2"></div>

                    <div class="relative group">
                        <button class="hover:bg-green-600 px-3 py-2 rounded-md transition duration-200 flex items-center gap-2 text-white cursor-pointer focus:outline-none">
                            <i data-lucide="circle-user-round" class="w-5 h-5"></i>
                            <!-- Menampilkan nama user yang sedang login dari database -->
                            <span>{{ auth()->user()->nama }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </button>

                        <!-- Dropdown (Akan muncul saat di hover) -->
                        <div class="absolute right-0 w-48 mt-1 bg-white rounded-md shadow-lg py-1 hidden group-hover:block border border-gray-100">
                            <!-- Rute Profil -->
                            <a href="{{ route('profil.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat Profil</a>

                            <!-- Tombol Logout (Wajib pakai form POST di Laravel) -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN UTAMA (YIELD) -->
    <!-- Di sinilah konten halaman yang berbeda-beda akan di-inject (seperti tabel CRUD Buku, dll) -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
        <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Kelurahan Cipanengah. Aplikasi Perpustakaan Daluang Manah.
        </div>
    </footer>

    <!-- Inisialisasi Script Lucide Icons agar SVG terender -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>