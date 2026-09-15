<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        Reservasi::batalkanYangKadaluarsa();

        $kata = trim((string) $request->query('q', ''));

        $reservasis = Reservasi::with('meja')
            ->whereIn('status', [
                'menunggu_pembayaran',
                'dikonfirmasi',
                'menunggu_pembatalan',
            ])
            ->cari($kata)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $menungguVerifikasi = Reservasi::query()
            ->where('status', 'menunggu_pembayaran')
            ->where('status_pembayaran', 'menunggu_verifikasi')
            ->count();

        $menungguPembatalan = Reservasi::query()
            ->where('status', 'menunggu_pembatalan')
            ->where('status_pembatalan', 'menunggu_verifikasi')
            ->count();

        return view('admin.reservasi.index', compact(
            'reservasis',
            'menungguVerifikasi',
            'menungguPembatalan',
            'kata'
        ));
    }

    public function histori(Request $request)
    {
        Reservasi::batalkanYangKadaluarsa();

        $kata = trim((string) $request->query('q', ''));
        $bulan = trim((string) $request->query('bulan', ''));
        $tanggal = trim((string) $request->query('tanggal', ''));

        $reservasis = $this->queryHistori($kata, $bulan)
            ->paginate(15)
            ->withQueryString();

        return view('admin.reservasi.histori', compact(
            'reservasis',
            'kata',
            'bulan',
            'tanggal'
        ));
    }

    public function cetakPdf(Request $request)
    {
        Reservasi::batalkanYangKadaluarsa();

        $periode = $request->query('periode', 'bulan');
        $kata = trim((string) $request->query('q', ''));
        $bulan = trim((string) $request->query('bulan', ''));
        $tanggal = trim((string) $request->query('tanggal', ''));

        if ($periode === 'hari') {
            if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
                return redirect()
                    ->route('admin.reservasi.histori', $request->only(['q', 'bulan', 'tanggal']))
                    ->withErrors([
                        'pdf' => 'Pilih tanggal untuk mencetak PDF harian.',
                    ]);
            }

            $reservasis = $this->queryHistori($kata, '', $tanggal)->get();
            $labelPeriode = Carbon::createFromFormat('Y-m-d', $tanggal)
                ->locale('id')
                ->translatedFormat('d F Y');
            $namaFile = 'histori-reservasi-'.$tanggal.'.pdf';
        } else {
            if (! preg_match('/^\d{4}-\d{2}$/', $bulan)) {
                return redirect()
                    ->route('admin.reservasi.histori', $request->only(['q', 'bulan', 'tanggal']))
                    ->withErrors([
                        'pdf' => 'Pilih bulan untuk mencetak PDF bulanan.',
                    ]);
            }

            $reservasis = $this->queryHistori($kata, $bulan)->get();
            $labelPeriode = Carbon::createFromFormat('Y-m-d', $bulan.'-01')
                ->locale('id')
                ->translatedFormat('F Y');
            $namaFile = 'histori-reservasi-'.$bulan.'.pdf';
        }

        $pdf = Pdf::loadView('admin.reservasi.histori-pdf', [
            'reservasis' => $reservasis,
            'labelPeriode' => $labelPeriode,
            'periode' => $periode,
            'kata' => $kata,
            'dicetakPada' => now()->locale('id')->translatedFormat('d F Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream($namaFile);
    }

    private function queryHistori(string $kata, string $bulan, string $tanggal = ''): Builder
    {
        $query = Reservasi::with('meja')
            ->whereIn('status', ['dibatalkan', 'selesai'])
            ->cari($kata);

        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
            $query->whereDate('tanggal', $tanggal);
        } elseif (preg_match('/^\d{4}-\d{2}$/', $bulan)) {
            [$tahun, $nomorBulan] = explode('-', $bulan);
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $nomorBulan);
        }

        return $query->latest();
    }

    public function verifikasi(Request $request, Reservasi $reservasi)
    {
        Reservasi::batalkanYangKadaluarsa();
        $reservasi->refresh();

        if ($reservasi->status !== 'menunggu_pembayaran'
            || $reservasi->status_pembayaran !== 'menunggu_verifikasi') {
            return back()->withErrors([
                'verifikasi' => 'Pembayaran hanya dapat diverifikasi setelah pelanggan menekan tombol Sudah Bayar dan sebelum kadaluarsa.',
            ]);
        }

        $reservasi->update([
            'status' => 'dikonfirmasi',
            'status_pembayaran' => 'lunas',
        ]);

        return back()->with(
            'success',
            'Pembayaran '.$reservasi->kode_reservasi.' telah diverifikasi. Status meja menjadi hijau (sudah dipesan).'
        );
    }

    public function verifikasiPembatalan(Request $request, Reservasi $reservasi)
    {
        Reservasi::batalkanYangKadaluarsa();
        $reservasi->refresh();

        if ($reservasi->status !== 'menunggu_pembatalan'
            || $reservasi->status_pembatalan !== 'menunggu_verifikasi') {
            return back()->withErrors([
                'verifikasi' => 'Pembatalan hanya dapat diverifikasi jika pelanggan sudah mengajukan pembatalan.',
            ]);
        }

        $reservasi->update([
            'status' => 'dibatalkan',
            'status_pembatalan' => 'disetujui',
            'status_pembayaran' => 'dikembalikan',
            'pengembalian_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pembatalan '.$reservasi->kode_reservasi.' diverifikasi. DP dikembalikan ke rekening '.$reservasi->nomor_rekening.' dan meja kembali tersedia.'
        );
    }
}
