<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyusutanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cari data barang
        $laptop = DB::table('barangs')->where('nama_barang', 'like', '%Laptop%')->first();
        $proyektor = DB::table('barangs')->where('nama_barang', 'like', '%Proyektor%')->first();

        // Ambil ID barang (jika tidak ada, otomatis pakai ID 1 dan 2)
        $laptopId = $laptop ? $laptop->id_barang : 1;
        $proyektorId = $proyektor ? $proyektor->id_barang : 2;

        DB::table('penyusutans')->insert([
            [
                'barang_id'     => $laptopId,
                'masa_ekonomis' => 5,
                'nilai_residu'  => 500000,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'barang_id'     => $proyektorId,
                'masa_ekonomis' => 3,
                'nilai_residu'  => 300000,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
