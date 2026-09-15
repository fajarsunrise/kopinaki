<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mejas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_meja')->unique();
            $table->integer('nomor_meja');
            $table->integer('lantai');
            $table->integer('kapasitas');
            $table->string('pemandangan');
            $table->string('fasilitas');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['tersedia', 'nonaktif'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};