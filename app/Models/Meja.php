<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';

    protected $fillable = [
        'kode_meja',
        'nomor_meja',
        'lantai',
        'kapasitas',
        'pemandangan',
        'fasilitas',
        'gambar',
        'deskripsi',
        'status',
    ];

    public static function opsiPemandangan(int $lantai): array
    {
        return match ($lantai) {
            2 => ['indoor'],
            1, 3 => ['indoor', 'outdoor'],
            default => [],
        };
    }

    public static function opsiFasilitas(int $lantai): array
    {
        return match ($lantai) {
            1 => ['parkiran', 'kasir'],
            2 => ['no_smoking'],
            3 => ['kamar_mandi', 'mushola'],
            default => [],
        };
    }

    public function labelFasilitas(): string
    {
        return match ($this->fasilitas) {
            'parkiran' => 'Dekat parkiran',
            'kasir' => 'Dekat kasir',
            'no_smoking' => 'Area no smoking',
            'kamar_mandi' => 'Dekat kamar mandi',
            'mushola' => 'Dekat mushola',
            default => (string) $this->fasilitas,
        };
    }

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}