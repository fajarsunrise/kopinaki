<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // LANTAI 1
        // =========================

        Meja::create([
            'kode_meja' => 'M101',
            'nomor_meja' => 1,
            'lantai' => 1,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'parkiran',
            'gambar' => 'M101.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M102',
            'nomor_meja' => 2,
            'lantai' => 1,
            'kapasitas' => 4,
            'pemandangan' => 'indoor',
            'fasilitas' => 'parkiran',
            'gambar' => 'M102.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M103',
            'nomor_meja' => 3,
            'lantai' => 1,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'parkiran',
            'gambar' => 'M103.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M104',
            'nomor_meja' => 4,
            'lantai' => 1,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'parkiran',
            'gambar' => 'M104.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M105',
            'nomor_meja' => 5,
            'lantai' => 1,
            'kapasitas' => 6,
            'pemandangan' => 'indoor',
            'fasilitas' => ' dekat dengan parkiran',
            'gambar' => 'M105.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M106',
            'nomor_meja' => 6,
            'lantai' => 1,
            'kapasitas' => 4,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'Kasir',
            'gambar' => 'M106.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M107',
            'nomor_meja' => 7,
            'lantai' => 1,
            'kapasitas' => 2,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kasir',
            'gambar' => 'M107.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 1.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M108',
            'nomor_meja' => 8,
            'lantai' => 1,
            'kapasitas' => 6,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kasir',
            'gambar' => 'M108.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 1.',
            'status' => 'tersedia',
        ]);


        // =========================
        // LANTAI 2
        // =========================

        Meja::create([
            'kode_meja' => 'M201',
            'nomor_meja' => 1,
            'lantai' => 2,
            'kapasitas' => 5,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M201.jpeg',
            'deskripsi' => 'Meja untuk 5 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M202',
            'nomor_meja' => 2,
            'lantai' => 2,
            'kapasitas' => 4,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M202.jpeg',
            'deskripsi' => 'Meja untuk 4 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M203',
            'nomor_meja' => 3,
            'lantai' => 2,
            'kapasitas' => 6,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M203.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M204',
            'nomor_meja' => 4,
            'lantai' => 2,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M204.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M205',
            'nomor_meja' => 5,
            'lantai' => 2,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M205.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M206',
            'nomor_meja' => 6,
            'lantai' => 2,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M206.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M207',
            'nomor_meja' => 7,
            'lantai' => 2,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M207.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M208',
            'nomor_meja' => 8,
            'lantai' => 2,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M208.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M209',
            'nomor_meja' => 9,
            'lantai' => 2,
            'kapasitas' => 2,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M209.jpeg',
            'deskripsi' => 'Meja untuk 2 orang di lantai 2.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M210',
            'nomor_meja' => 10,
            'lantai' => 2,
            'kapasitas' => 6,
            'pemandangan' => 'indoor',
            'fasilitas' => 'no_smoking',
            'gambar' => 'M210.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 2.',
            'status' => 'tersedia',
        ]);


        // =========================
        // LANTAI 3
        // =========================

        Meja::create([
            'kode_meja' => 'M301',
            'nomor_meja' => 1,
            'lantai' => 3,
            'kapasitas' => 6,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M301.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M302',
            'nomor_meja' => 2,
            'lantai' => 3,
            'kapasitas' => 4,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M302.jpeg',
            'deskripsi' => 'Meja untuk 4 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M303',
            'nomor_meja' => 3,
            'lantai' => 3,
            'kapasitas' => 6,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M303.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M304',
            'nomor_meja' => 4,
            'lantai' => 3,
            'kapasitas' => 6,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M304.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M305',
            'nomor_meja' => 5,
            'lantai' => 3,
            'kapasitas' => 4,
            'pemandangan' => 'indoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M305.jpeg',
            'deskripsi' => 'Meja untuk 4 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M306',
            'nomor_meja' => 6,
            'lantai' => 3,
            'kapasitas' => 6,
            'pemandangan' => 'indoor',
            'fasilitas' => 'mushola',
            'gambar' => 'M306.jpeg',
            'deskripsi' => 'Meja untuk 6 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M307',
            'nomor_meja' => 7,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'mushola',
            'gambar' => 'M307.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M308',
            'nomor_meja' => 8,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M308.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M309',
            'nomor_meja' => 9,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M309.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M310',
            'nomor_meja' => 10,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M310.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M311',
            'nomor_meja' => 11,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'indoor',
            'fasilitas' => 'kamar_mandi',
            'gambar' => 'M311.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M312',
            'nomor_meja' => 12,
            'lantai' => 3,
            'kapasitas' => 8,
            'pemandangan' => 'indoor',
            'fasilitas' => 'mushola',
            'gambar' => 'M312.jpeg',
            'deskripsi' => 'Meja untuk 8 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M313',
            'nomor_meja' => 13,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'mushola',
            'gambar' => 'M313.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M314',
            'nomor_meja' => 14,
            'lantai' => 3,
            'kapasitas' => 3,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'mushola',
            'gambar' => 'M314.jpeg',
            'deskripsi' => 'Meja untuk 3 orang di lantai 3.',
            'status' => 'tersedia',
        ]);

        Meja::create([
            'kode_meja' => 'M315',
            'nomor_meja' => 15,
            'lantai' => 3,
            'kapasitas' => 10,
            'pemandangan' => 'outdoor',
            'fasilitas' => 'mushola',
            'gambar' => 'M315.jpeg',
            'deskripsi' => 'Meja untuk 10 orang di lantai 3.',
            'status' => 'tersedia',
        ]);
    }
}