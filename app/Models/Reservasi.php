<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    public const HARGA_PER_ORANG = 15000;

    public const BATAS_MENIT = 20;

    protected $table = 'reservasis';

    protected $fillable = [
        'kode_reservasi',
        'nama',
        'whatsapp',
        'alamat',
        'tanggal',
        'jam',
        'jumlah_peserta',
        'lantai',
        'pemandangan',
        'fasilitas',
        'meja_id',
        'status',
        'total_harga',
        'jumlah_dp',
        'status_pembayaran',
        'batas_pembayaran',
        'bukti_pembayaran',
        'nama_bank',
        'nomor_rekening',
        'nama_pemilik_rekening',
        'status_pembatalan',
        'pengembalian_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam' => 'datetime:H:i',
        'batas_pembayaran' => 'datetime',
        'total_harga' => 'integer',
        'jumlah_dp' => 'integer',
        'pengembalian_at' => 'datetime',
    ];

    public static function hitungTotal(int $jumlahPeserta): int
    {
        return $jumlahPeserta * self::HARGA_PER_ORANG;
    }

    public function masihMenungguBayar(): bool
    {
        return $this->status === 'menunggu_pembayaran'
            && $this->status_pembayaran === 'belum_bayar';
    }

    /**
     * Cek apakah waktu pembayaran telah kadaluarsa (lebih dari 20 menit).
     * Setelah pelanggan menandai sudah bayar, timer berhenti menunggu verifikasi admin.
     */
    public function isKadaluarsa(): bool
    {
        if (!$this->masihMenungguBayar()) {
            return false;
        }

        $deadline = $this->deadlinePembayaran();

        return $deadline ? now()->greaterThan($deadline) : false;
    }

    public function deadlinePembayaran()
    {
        if ($this->batas_pembayaran) {
            return $this->batas_pembayaran;
        }

        return $this->created_at
            ? $this->created_at->copy()->addMinutes(self::BATAS_MENIT)
            : null;
    }

    /**
     * Hitung sisa waktu pembayaran dalam detik.
     */
    public function sisaDetikPembayaran(): int
    {
        if (!$this->masihMenungguBayar() || $this->isKadaluarsa()) {
            return 0;
        }

        $deadline = $this->deadlinePembayaran();

        if (!$deadline) {
            return 0;
        }

        return max(0, (int) now()->diffInSeconds($deadline, false));
    }

    public function batalkanJikaKadaluarsa(): bool
    {
        if (!$this->isKadaluarsa()) {
            return false;
        }

        $this->forceFill([
            'status' => 'dibatalkan',
            'status_pembayaran' => 'kadaluarsa',
        ])->save();

        return true;
    }

    public static function batalkanYangKadaluarsa(): int
    {
        $batasWaktu = now()->subMinutes(self::BATAS_MENIT);

        return static::query()
            ->where('status', 'menunggu_pembayaran')
            ->where('status_pembayaran', 'belum_bayar')
            ->where(function ($query) use ($batasWaktu) {
                $query->where('batas_pembayaran', '<', now())
                    ->orWhere(function ($query) use ($batasWaktu) {
                        $query->whereNull('batas_pembayaran')
                            ->where('created_at', '<', $batasWaktu);
                    });
            })
            ->update([
                'status' => 'dibatalkan',
                'status_pembayaran' => 'kadaluarsa',
            ]);
    }

    public function sudahMembayarDp(): bool
    {
        return in_array($this->status_pembayaran, [
            'menunggu_verifikasi',
            'lunas',
            'dikembalikan',
        ], true);
    }

    public function bisaDibatalkan(): bool
    {
        return in_array($this->status, ['menunggu_pembayaran', 'dikonfirmasi'], true);
    }

    public function perluDataRekening(): bool
    {
        return $this->bisaDibatalkan() && $this->sudahMembayarDp();
    }

    public function menungguVerifikasiPembatalan(): bool
    {
        return $this->status === 'menunggu_pembatalan'
            && $this->status_pembatalan === 'menunggu_verifikasi';
    }

    public function labelStatus(): string
    {
        if ($this->status === 'menunggu_pembatalan') {
            return 'Menunggu verifikasi pembatalan';
        }

        if ($this->status === 'dibatalkan') {
            if ($this->status_pembayaran === 'kadaluarsa') {
                return 'Dibatalkan (waktu pembayaran habis)';
            }

            if ($this->status_pembayaran === 'dikembalikan') {
                return 'Dibatalkan (DP dikembalikan)';
            }

            return 'Dibatalkan';
        }

        if ($this->status === 'dikonfirmasi') {
            return 'Dikonfirmasi';
        }

        if ($this->status === 'selesai') {
            return 'Selesai';
        }

        if ($this->status_pembayaran === 'menunggu_verifikasi') {
            return 'Menunggu verifikasi pembayaran';
        }

        return 'Menunggu pembayaran';
    }

    public function scopeCari($query, ?string $kata)
    {
        $kata = trim((string) $kata);

        if ($kata === '') {
            return $query;
        }

        $tanggalDicari = self::parseTanggalPencarian($kata);
        $jamDicari = null;

        if (preg_match('/\b([01]?\d|2[0-3])[:\.]([0-5]\d)\b/', $kata, $cocokanJam)) {
            $jamDicari = sprintf('%02d:%02d', $cocokanJam[1], $cocokanJam[2]);
        }

        return $query->where(function ($query) use ($kata, $tanggalDicari, $jamDicari) {
            $query->where('kode_reservasi', 'like', '%'.$kata.'%')
                ->orWhere('nama', 'like', '%'.$kata.'%')
                ->orWhere('whatsapp', 'like', '%'.$kata.'%')
                ->orWhereHas('meja', function ($meja) use ($kata) {
                    $meja->where('kode_meja', 'like', '%'.$kata.'%');
                })
                ->orWhereRaw("DATE_FORMAT(tanggal, '%d-%m-%Y') like ?", ['%'.$kata.'%'])
                ->orWhereRaw("DATE_FORMAT(tanggal, '%d/%m/%Y') like ?", ['%'.$kata.'%'])
                ->orWhereRaw("DATE_FORMAT(tanggal, '%Y-%m-%d') like ?", ['%'.$kata.'%'])
                ->orWhereRaw("DATE_FORMAT(jam, '%H:%i') like ?", ['%'.$kata.'%'])
                ->orWhereRaw(
                    "CONCAT(DATE_FORMAT(tanggal, '%d-%m-%Y'), ' ', DATE_FORMAT(jam, '%H:%i')) like ?",
                    ['%'.$kata.'%']
                );

            if ($tanggalDicari) {
                $query->orWhereDate('tanggal', $tanggalDicari);
            }

            if ($jamDicari) {
                $query->orWhereRaw("DATE_FORMAT(jam, '%H:%i') = ?", [$jamDicari]);
            }

            if (preg_match('/^(\d{4})-(\d{2})$/', $kata, $cocokanBulan)) {
                $query->orWhere(function ($bulanQuery) use ($cocokanBulan) {
                    $bulanQuery->whereYear('tanggal', $cocokanBulan[1])
                        ->whereMonth('tanggal', $cocokanBulan[2]);
                });
            }

            if (preg_match('/^(\d{2})-(\d{4})$/', $kata, $cocokanBulan)) {
                $query->orWhere(function ($bulanQuery) use ($cocokanBulan) {
                    $bulanQuery->whereMonth('tanggal', $cocokanBulan[1])
                        ->whereYear('tanggal', $cocokanBulan[2]);
                });
            }
        });
    }

    private static function parseTanggalPencarian(string $kata): ?string
    {
        $bagian = preg_split('/\s+/', trim($kata))[0] ?? '';

        if ($bagian === '') {
            return null;
        }

        foreach (['d-m-Y', 'd/m/Y', 'Y-m-d', 'd-m-y', 'd/m/y'] as $format) {
            try {
                $tanggal = \Carbon\Carbon::createFromFormat('!'.$format, $bagian);

                if ($tanggal && $tanggal->format($format) === $bagian) {
                    return $tanggal->toDateString();
                }
            } catch (\Throwable $e) {
                continue;
            }
        }

        return null;
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}
