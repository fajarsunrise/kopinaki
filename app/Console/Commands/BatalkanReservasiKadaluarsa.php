<?php

namespace App\Console\Commands;

use App\Models\Reservasi;
use Illuminate\Console\Command;

class BatalkanReservasiKadaluarsa extends Command
{
    protected $signature = 'reservasi:expire';

    protected $description = 'Batalkan reservasi yang melewati batas waktu pembayaran 20 menit';

    public function handle(): int
    {
        $jumlah = Reservasi::batalkanYangKadaluarsa();

        $this->info("Reservasi kadaluarsa dibatalkan: {$jumlah}");

        return self::SUCCESS;
    }
}
