<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    // Mass assignment
    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tenggat_waktu',
        'tanggal_kembali',
        'status_transaksi',
    ];

    // Relasi ke tabel Anggota (Foreign Key: anggota_id)
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id_anggota');
    }

    // Relasi ke tabel Buku (Foreign Key: buku_id)
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id_buku');
    }
}