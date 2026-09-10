<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('kerusakans', 'user_id')) {
            Schema::table('kerusakans', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id_kerusakan')
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('kerusakans', 'user_id')) {
            Schema::table('kerusakans', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};