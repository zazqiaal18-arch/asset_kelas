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
        $items = [
            [
                'nama' => 'Laptop Asus Vivobook',
                'masa_ekonomis' => 5,
                'nilai_residu' => 500000,
            ],
            [
                'nama' => 'Proyektor Epson',
                'masa_ekonomis' => 3,
                'nilai_residu' => 300000,
            ],
        ];

        foreach ($items as $item) {
            $barang = DB::table('barangs')->where('nama_barang', $item['nama'])->first();

            if (!$barang) {
                continue;
            }

            // Hitung penyusutan per tahun
            $hargaBeli = $barang->harga_beli ?? 0;
            $penyusutanPerTahun = max(0, ($hargaBeli - $item['nilai_residu']) / $item['masa_ekonomis']);

            DB::table('penyusutans')->updateOrInsert(
                ['barang_id' => $barang->id_barang],
                [
                    'masa_ekonomis'        => $item['masa_ekonomis'],
                    'nilai_residu'         => $item['nilai_residu'],
                    'penyusutan_per_tahun' => $penyusutanPerTahun,
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ]
            );
        }
    }
}
