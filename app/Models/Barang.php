<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah',
        'tanggal_beli',
        'harga_beli',
    ];

    public function stoks()
    {
        return $this->hasMany(Stok::class, 'barang_id', 'id_barang');
    }
    
}
