<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stoks = [
            [
                'nama_barang' => 'Laptop Asus Vivobook',
                'stok_masuk'  => 10,
                'stok_keluar' => 2,
                'total_stok'  => 8,
                'keterangan'  => 'Stok awal pembelian dan penggunaan ruang lab',
            ],
            [
                'nama_barang' => 'Proyektor Epson',
                'stok_masuk'  => 5,
                'stok_keluar' => 1,
                'total_stok'  => 4,
                'keterangan'  => 'Stok proyektor ruang rapat',
            ],
        ];

        foreach ($stoks as $data) {
            DB::table('stoks')->updateOrInsert(
                ['nama_barang' => $data['nama_barang']],
                array_merge($data, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
