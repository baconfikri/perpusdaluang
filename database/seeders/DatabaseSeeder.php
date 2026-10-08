<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin default
        User::create([
            'username' => 'admin',
            'nama' => 'Rossaeni', // Sesuai data struktur organisasi kelurahan
            'email_admin' => 'admin@daluangmanah.com',
            'no_telp' => '081234567890',
            'jabatan' => 'Relawan',
            'nama_perpustakaan' => 'Perpustakaan Daluang Manah',
            'password' => Hash::make('admin123'), // Password: admin123
        ]);
    }
}