<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'buku'; 
    
    // Mendefinisikan Primary Key karena kita menggunakan 'id_buku'
    protected $primaryKey = 'id_buku';

    // Kolom yang diizinkan untuk diisi (Mass Assignment)
    protected $fillable = [
        'judul_buku',
        'pengarang',
        'penerbit',
        'kategori_buku',
        'stok',
        'status',
    ];

    // Relasi ke tabel Peminjaman untuk menghitung popularitas buku
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id', 'id_buku');
    }
}