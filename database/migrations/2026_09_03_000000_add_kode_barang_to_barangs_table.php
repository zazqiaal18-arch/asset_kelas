<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('barangs', 'kode_barang')) {
            Schema::table('barangs', function (Blueprint $table) {
                $table->string('kode_barang', 30)->nullable()->unique()->after('id_barang');
            });
        }

        DB::table('barangs')->whereNull('kode_barang')->orderBy('id_barang')->cursor()->each(function ($barang) {
            DB::table('barangs')
                ->where('id_barang', $barang->id_barang)
                ->update(['kode_barang' => 'BRG-' . str_pad($barang->id_barang, 4, '0', STR_PAD_LEFT)]);
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropUnique(['kode_barang']);
            $table->dropColumn('kode_barang');
        });
    }
};
