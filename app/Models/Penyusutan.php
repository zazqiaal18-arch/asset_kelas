<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyusutan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penyusutan';

    protected $fillable = [
        'barang_id',
        'masa_ekonomis',
        'nilai_residu',
        'penyusutan_per_tahun',
    ];

    /**
     * Relasi ke Model Barang
     * Menghubungkan kolom 'barang_id' di tabel penyusutans ke 'id_barang' di tabel barangs
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id_barang');
    }
}