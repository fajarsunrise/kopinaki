<?php

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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
        
            // Data pelanggan
            $table->string('kode_reservasi')->unique();
            $table->string('nama');
            $table->string('whatsapp', 20);
            $table->text('alamat');
        
            // Data reservasi
            $table->date('tanggal');
            $table->time('jam');
            $table->integer('jumlah_peserta');
        
            // Preferensi pelanggan
            $table->integer('lantai');
            $table->string('pemandangan');
            $table->string('fasilitas');
        
            // Meja yang dipilih
            $table->foreignId('meja_id')
                ->constrained('mejas')
                ->cascadeOnDelete();
        
            // Status reservasi
            $table->enum('status', [
                'menunggu_pembayaran',
                'dikonfirmasi',
                'dibatalkan',
                'selesai'
            ])->default('menunggu_pembayaran');
        
            // Pembayaran
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->decimal('jumlah_dp', 12, 2)->default(0);
            $table->string('status_pembayaran')->default('belum_bayar');
        
            $table->timestamps();
        });
    }
};
