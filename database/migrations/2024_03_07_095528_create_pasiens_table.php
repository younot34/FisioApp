<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pasien')->nullable();
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('sex',1);
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('phone')->nullable();
            $table->string('gol_darah',2);
            $table->string('pekerjaan')->nullable();
            $table->string('alamat')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
