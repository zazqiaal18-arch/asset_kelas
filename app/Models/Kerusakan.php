<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;

    // Menentukan Primary Key kustom
    protected $primaryKey = 'id_kerusakan';

    // Kolom-kolom yang diizinkan untuk diisi data
    protected $fillable = [
        'barang_id',
        'jumlah_rusak',
        'tingkat_kerusakan',
        'deskripsi_kerusakan',
        'status',
    ];
}
