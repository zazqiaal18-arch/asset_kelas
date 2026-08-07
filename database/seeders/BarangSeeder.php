<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan import DB facade

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert([ // Tambahkan DB::table('nama_tabel')
            [
                'nama_barang'  => 'Laptop Asus Vivobook',
                'jumlah'       => 5,
                'tanggal_beli' => '2026-01-15',
                'harga_beli'   => 8500000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_barang'  => 'Proyektor Epson',
                'jumlah'       => 2,
                'tanggal_beli' => '2026-02-10',
                'harga_beli'   => 4500000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_barang'  => 'Mouse Wireless Logitech',
                'jumlah'       => 10,
                'tanggal_beli' => '2026-03-01',
                'harga_beli'   => 150000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}