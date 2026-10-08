<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('anggota_id');
            $table->foreign('anggota_id')->references('id_anggota')->on('anggota')->onDelete('restrict'); 

            $table->unsignedBigInteger('buku_id');
            $table->foreign('buku_id')->references('id_buku')->on('buku')->onDelete('restrict');

            $table->date('tanggal_pinjam');
            $table->date('tenggat_waktu');
            $table->date('tanggal_kembali')->nullable(); 
            $table->enum('status_transaksi', ['Berjalan', 'Selesai', 'Terlambat'])->default('Berjalan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};