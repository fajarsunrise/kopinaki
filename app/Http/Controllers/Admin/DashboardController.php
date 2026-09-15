<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        Reservasi::batalkanYangKadaluarsa();

        $kata = trim((string) $request->query('q', ''));

        $statistik = [
            'reservasi_hari_ini' => Reservasi::query()->whereDate('tanggal', today())->count(),
            'menunggu_verifikasi' => Reservasi::query()
                ->where('status', 'menunggu_pembayaran')
                ->where('status_pembayaran', 'menunggu_verifikasi')
                ->count(),
            'menunggu_pembatalan' => Reservasi::query()
                ->where('status', 'menunggu_pembatalan')
                ->count(),
            'dikonfirmasi' => Reservasi::query()->where('status', 'dikonfirmasi')->count(),
            'total_meja' => Meja::query()->count(),
            'meja_nonaktif' => Meja::query()->where('status', 'nonaktif')->count(),
            'pendapatan_dp' => Reservasi::query()
                ->where('status_pembayaran', 'lunas')
                ->sum('jumlah_dp'),
        ];

        $hasilPencarian = null;

        if ($kata !== '') {
            $hasilPencarian = Reservasi::with('meja')
                ->cari($kata)
                ->latest()
                ->limit(10)
                ->get();
        }

        $terbaru = Reservasi::with('meja')
            ->latest()
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact('statistik', 'kata', 'hasilPencarian', 'terbaru'));
    }
}
