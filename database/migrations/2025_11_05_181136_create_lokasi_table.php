<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->string('kode_lokasi')->unique();
            $table->string('alamat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('tipe');
            $table->integer('kapasitas')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi');
    }
};
