<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi'     => 'Peralatan dan perangkat elektronik seperti komputer, laptop, dan proyektor.',
            ],
            [
                'nama_kategori' => 'Mebel',
                'deskripsi'     => 'Perabotan kantor dan kelas seperti meja, kursi, dan lemari.',
            ],
            [
                'nama_kategori' => 'Alat Tulis Kantor',
                'deskripsi'     => 'Perlengkapan operasional harian seperti papan tulis dan spidol.',
            ],
        ];

        foreach ($kategoris as $data) {
            DB::table('kategoris')->updateOrInsert(
                ['nama_kategori' => $data['nama_kategori']],
                array_merge($data, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
