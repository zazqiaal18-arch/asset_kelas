<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password')->nullable(); // Set nullable karena login via Google tidak pakai password
    $table->string('google_id')->nullable(); // Kolom simpan ID Google
    $table->string('role')->default('admin');
    $table->rememberToken();
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
