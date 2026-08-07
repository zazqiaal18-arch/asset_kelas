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
        DB::table('kerusakans')->insert([
            [
                'barang_id'           => 1, // Sesuaikan dengan ID barang yang ada di tabel barangs
                'jumlah_rusak'        => 1,
                'tingkat_kerusakan'   => 'Berat',
                'deskripsi_kerusakan' => 'Layar laptop retak dan tidak dapat menampilkan gambar dengan jelas.',
                'status'              => 'Dilaporkan',
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'barang_id'           => 1,
                'jumlah_rusak'        => 1,
                'tingkat_kerusakan'   => 'Sedang',
                'deskripsi_kerusakan' => 'Baterai laptop tidak dapat mengisi daya meskipun kabel charger terhubung.',
                'status'              => 'Dalam Perbaikan',
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'barang_id'           => 2,
                'jumlah_rusak'        => 2,
                'tingkat_kerusakan'   => 'Ringan',
                'deskripsi_kerusakan' => 'Beberapa tombol pada keyboard tidak berfungsi atau macet.',
                'status'              => 'Selesai',
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);
    }
}