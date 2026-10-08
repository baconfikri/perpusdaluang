<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku'); 
            $table->string('judul_buku');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('kategori_buku'); 
            $table->integer('stok')->default(1); 
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Hilang'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};