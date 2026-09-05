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

        foreach ([
            [$laptop, 5, 500000],
            [$proyektor, 3, 300000],
        ] as [$barang, $masaEkonomis, $nilaiResidu]) {
            if (!$barang) {
                continue;
            }

            $penyusutanPerTahun = max(0, ($barang->harga_beli - $nilaiResidu) / $masaEkonomis);

            DB::table('penyusutans')->updateOrInsert(
                ['barang_id' => $barang->id_barang],
                [
                    'masa_ekonomis' => $masaEkonomis,
                    'nilai_residu' => $nilaiResidu,
                    'penyusutan_per_tahun' => $penyusutanPerTahun,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
