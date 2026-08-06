<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'nama_barang',
        'stok_masuk',
        'stok_keluar',
        'total_stok',
        'keterangan',
    ];
}