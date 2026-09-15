<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('nama_bank')->nullable()->after('bukti_pembayaran');
            $table->string('nomor_rekening', 50)->nullable()->after('nama_bank');
            $table->string('nama_pemilik_rekening')->nullable()->after('nomor_rekening');
            $table->string('status_pembatalan')->nullable()->after('nama_pemilik_rekening');
            $table->timestamp('pengembalian_at')->nullable()->after('status_pembatalan');
        });

        DB::statement("ALTER TABLE reservasis MODIFY status ENUM('menunggu_pembayaran','dikonfirmasi','menunggu_pembatalan','dibatalkan','selesai') NOT NULL DEFAULT 'menunggu_pembayaran'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE reservasis MODIFY status ENUM('menunggu_pembayaran','dikonfirmasi','dibatalkan','selesai') NOT NULL DEFAULT 'menunggu_pembayaran'");

        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn([
                'nama_bank',
                'nomor_rekening',
                'nama_pemilik_rekening',
                'status_pembatalan',
                'pengembalian_at',
            ]);
        });
    }
};
