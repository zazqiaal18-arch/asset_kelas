<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Menentukan nama Primary Key 
    protected $primaryKey = 'id_kategori';

    // Kolom yang diizinkan untuk mengisi data (Mass Assignment)
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

}