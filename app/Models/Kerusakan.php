<?php
// app/Models/Kerusakan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kerusakan';
    protected $table = 'kerusakans';

    protected $fillable = [
        'barang_id',
        'jumlah_rusak',
        'tingkat_kerusakan',
        'deskripsi_kerusakan',
        'status_penanganan',
        'tanggal_lapor',
        'tanggal_selesai',
        'foto_kerusakan',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_lapor' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id_barang');
    }

    // Scope untuk filter
    public function scopeBelumSelesai($query)
    {
        return $query->where('status_penanganan', '!=', 'Selesai');
    }

    public function scopeTingkat($query, $tingkat)
    {
        return $query->where('tingkat_kerusakan', $tingkat);
    }
}
