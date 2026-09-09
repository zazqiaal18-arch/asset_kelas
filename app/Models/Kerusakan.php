<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;

    protected $table = 'kerusakans';

    protected $primaryKey = 'id_kerusakan';

    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah_rusak',
        'tingkat_kerusakan',
        'deskripsi_kerusakan',
        'status_penanganan',
        'tanggal_lapor',
        'tanggal_selesai',
        'foto_kerusakan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_lapor' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];


    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'barang_id',
            'id_barang'
        );
    }


    // Relasi ke user/pelapor
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }


    // Scope laporan yang belum selesai
    public function scopeBelumSelesai($query)
    {
        return $query->where('status_penanganan', '!=', 'Selesai');
    }


    // Filter berdasarkan tingkat kerusakan
    public function scopeTingkat($query, $tingkat)
    {
        return $query->where(
            'tingkat_kerusakan',
            $tingkat
        );
    }
}