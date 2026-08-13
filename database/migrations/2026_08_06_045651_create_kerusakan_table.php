<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerusakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('kerusakans', function (Blueprint $table) {
            $table->id('id_kerusakan');
            $table->foreignId('barang_id')->constrained('barangs', 'id_barang')->onDelete('cascade');
            $table->integer('jumlah_rusak');
            $table->enum('tingkat_kerusakan', ['Ringan', 'Sedang', 'Berat']);
            $table->text('deskripsi_kerusakan');
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
        Schema::dropIfExists('kerusakan');
    }
}
