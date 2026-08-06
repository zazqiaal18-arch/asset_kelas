<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasaPenyusutanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('penyusutans', function (Blueprint $table) {
        $table->id('id_penyusutan');
        $table->foreignId('barang_id')->constrained('barangs', 'id_barang')->onDelete('cascade');
        $table->integer('masa_ekonomis'); // Contoh: 5 (tahun)
        $table->decimal('nilai_residu', 15, 2)->default(0); // Nilai sisa barang di akhir masa ekonomis
        $table->decimal('penyusutan_per_tahun', 15, 2)->default(0); // Rumus: (Harga Beli - Nilai Residu) / Masa Ekonomis
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masa_penyusutan');
    }
}
