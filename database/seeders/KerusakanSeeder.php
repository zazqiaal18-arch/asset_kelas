<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kerusakans = [
            [
                'barang_nama'         => 'Laptop Asus Vivobook',
                'jumlah_rusak'        => 1,
                'tingkat_kerusakan'   => 'Berat',
                'deskripsi_kerusakan' => 'Layar laptop retak dan tidak dapat menampilkan gambar dengan jelas.',
            ],
            [
                'barang_nama'         => 'Laptop Asus Vivobook',
                'jumlah_rusak'        => 1,
                'tingkat_kerusakan'   => 'Sedang',
                'deskripsi_kerusakan' => 'Baterai laptop tidak dapat mengisi daya meskipun kabel charger terhubung.',
            ],
            [
                'barang_nama'         => 'Proyektor Epson',
                'jumlah_rusak'        => 2,
                'tingkat_kerusakan'   => 'Ringan',
                'deskripsi_kerusakan' => 'Beberapa tombol pada keyboard tidak berfungsi atau macet.',
            ],
        ];

        foreach ($kerusakans as $data) {
            $barang = DB::table('barangs')->where('nama_barang', $data['barang_nama'])->first();

            if (!$barang) {
                continue;
            }

            unset($data['barang_nama']);
            DB::table('kerusakans')->updateOrInsert(
                [
                    'barang_id' => $barang->id_barang,
                    'deskripsi_kerusakan' => $data['deskripsi_kerusakan'],
                ],
                array_merge($data, [
                    'barang_id' => $barang->id_barang,
                    'updated_at' => now(),
                ])
            );
        }
    }
}