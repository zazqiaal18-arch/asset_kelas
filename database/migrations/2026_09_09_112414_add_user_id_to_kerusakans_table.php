<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kerusakans', function (Blueprint $table) {

            $table->string('status_penanganan')
                  ->default('Menunggu')
                  ->after('deskripsi_kerusakan');

            $table->dateTime('tanggal_lapor')
                  ->nullable()
                  ->after('status_penanganan');

            $table->dateTime('tanggal_selesai')
                  ->nullable()
                  ->after('tanggal_lapor');

            $table->text('keterangan')
                  ->nullable()
                  ->after('tanggal_selesai');
        });
    }

    public function down()
    {
        Schema::table('kerusakans', function (Blueprint $table) {

            $table->dropColumn([
                'status_penanganan',
                'tanggal_lapor',
                'tanggal_selesai',
                'keterangan',
            ]);

        });
    }
};