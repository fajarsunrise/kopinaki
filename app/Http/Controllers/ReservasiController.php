<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReservasiController extends Controller
{
    /**
     * Menampilkan rekomendasi meja berdasarkan
     * preferensi pelanggan menggunakan metode SAW.
     */
    public function rekomendasi(Request $request)
    {
        // =====================================================
        // VALIDASI DATA FORM
        // =====================================================

        $validated = $request->validate($this->aturanFormReservasi(), $this->pesanFormReservasi());

        $request->session()->put('reservasi_form', $validated);


// =====================================================
// CARI MEJA YANG SUDAH DIPESAN
// PADA TANGGAL DAN JAM YANG DIPILIH
// =====================================================

$mejaSudahDipesan = $this->mejaTerisiIds($request->tanggal, $request->jam);


// =====================================================
// AMBIL MEJA YANG TERSEDIA
// =====================================================

$mejas = Meja::where('status', 'tersedia')
    ->whereNotIn('id', $mejaSudahDipesan)
    ->orderBy('lantai')
    ->orderBy('nomor_meja')
    ->get();


if ($mejas->isEmpty()) {
    return redirect()
        ->route('reservasi.pilih-meja')
        ->withErrors([
            'tanggal' =>
                'Semua meja pada tanggal dan jam tersebut sedang terisi atau tidak aktif. Anda tetap dapat melihat status meja di denah.'
        ]);
}


        // =====================================================
        // BOBOT KRITERIA SAW
        // =====================================================

        $bobotKapasitas = 0.40;
        $bobotLokasi = 0.30;
        $bobotPemandangan = 0.10;
        $bobotFasilitas = 0.20;


        // =====================================================
        // PROSES PERHITUNGAN SAW
        // =====================================================

        $hasilRekomendasi = [];

        foreach ($mejas as $meja) {

            // =================================================
            // C1 - KAPASITAS
            // =================================================

            $jumlahPeserta = $request->jumlah_peserta;

            if ($meja->kapasitas < $jumlahPeserta) {

                // Meja tidak mampu menampung jumlah peserta
                $nilaiKapasitas = 0;

            } else {

                // Semakin dekat kapasitas meja dengan
                // jumlah peserta, semakin tinggi nilainya
                $nilaiKapasitas =
                    $jumlahPeserta / $meja->kapasitas;
            }


            // =================================================
            // C2 - LOKASI / LANTAI
            // =================================================

            if ((int) $request->lantai === $meja->lantai) {

                $nilaiLokasi = 1;

            } else {

                $nilaiLokasi = 0;
            }


            // =================================================
            // C3 - PEMANDANGAN
            // =================================================

            if ($request->pemandangan === $meja->pemandangan) {

                $nilaiPemandangan = 1;

            } else {

                $nilaiPemandangan = 0;
            }


            // =================================================
            // C4 - KEDEKATAN DENGAN FASILITAS
            // =================================================

            if ($request->fasilitas === $meja->fasilitas) {

                $nilaiFasilitas = 1;

            } else {

                $nilaiFasilitas = 0;
            }


            // =================================================
            // NILAI AKHIR SAW
            // =================================================

            $nilaiAkhir =
                ($bobotKapasitas * $nilaiKapasitas) +
                ($bobotLokasi * $nilaiLokasi) +
                ($bobotPemandangan * $nilaiPemandangan) +
                ($bobotFasilitas * $nilaiFasilitas);


            // =================================================
            // SIMPAN HASIL
            // =================================================

            $hasilRekomendasi[] = [

                'meja' => $meja,

                'nilai_kapasitas' => $nilaiKapasitas,

                'nilai_lokasi' => $nilaiLokasi,

                'nilai_pemandangan' => $nilaiPemandangan,

                'nilai_fasilitas' => $nilaiFasilitas,

                'nilai_akhir' => $nilaiAkhir,
            ];
        }


        // =====================================================
        // URUTKAN DARI NILAI TERTINGGI
        // =====================================================

        usort($hasilRekomendasi, function ($a, $b) {

            return $b['nilai_akhir']
                <=> $a['nilai_akhir'];

        });


        // =====================================================
        // AMBIL 3 REKOMENDASI TERBAIK
        // =====================================================

        $hasilRekomendasi = array_slice(
            $hasilRekomendasi,
            0,
            3
        );


        // =====================================================
        // TAMPILKAN HALAMAN REKOMENDASI
        // =====================================================

        return view(
            'reservasi.rekomendasi',
            compact(
                'hasilRekomendasi',
                'request'
            )
        );
    }


    /**
     * Menampilkan halaman pemilihan meja secara manual.
     */
    public function pilihMeja(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate($this->aturanFormReservasi(), $this->pesanFormReservasi());
            $request->session()->put('reservasi_form', $validated);

            return redirect()->route('reservasi.pilih-meja');
        }

        $form = $this->ambilFormReservasi($request);

        if ($form === null) {
            return redirect()
                ->route('reservasi.create')
                ->withErrors([
                    'form' => 'Silakan isi form reservasi terlebih dahulu.',
                ]);
        }

        $mejas = $this->mejaDenganStatus($form->tanggal, $form->jam);

        return view('reservasi.pilih-meja', [
            'mejas' => $mejas,
            'request' => $form,
        ]);
    }

    /**
     * Status meja untuk tanggal dan jam tertentu (pembaruan denah).
     */
    public function statusMeja(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);

        $mejas = $this->mejaDenganStatus($request->tanggal, $request->jam);

        return response()->json([
            'mejas' => $mejas->map(function ($meja) {
                return [
                    'id' => $meja->id,
                    'kode_meja' => $meja->kode_meja,
                    'status_reservasi' => $meja->status_reservasi,
                ];
            })->values(),
        ]);
    }

    public function konfirmasi(Request $request)
    {
        if ($request->isMethod('get')) {
            $data = $request->session()->get('reservasi_konfirmasi');

            if (!$data) {
                return redirect()
                    ->route('reservasi.create')
                    ->withErrors([
                        'form' => 'Silakan isi form reservasi dan pilih meja terlebih dahulu.',
                    ]);
            }

            $meja = Meja::findOrFail($data['meja_id']);

            return view('reservasi.konfirmasi', [
                'request' => (object) $data,
                'meja' => $meja,
            ]);
        }

        $validated = $request->validate(
            $this->aturanFormReservasi() + [
                'meja_id' => 'required|exists:mejas,id',
            ],
            $this->pesanFormReservasi()
        );

        $meja = Meja::findOrFail($validated['meja_id']);
        $statusMeja = $this->statusReservasiMeja(
            $meja,
            $validated['tanggal'],
            $validated['jam']
        );

        $formTanpaMeja = collect($validated)->except('meja_id')->all();
        $request->session()->put('reservasi_form', $formTanpaMeja);

        if ($statusMeja !== 'tersedia') {
            return redirect()
                ->route('reservasi.pilih-meja')
                ->withErrors([
                    'meja_id' => 'Meja tersebut sudah tidak tersedia untuk tanggal dan jam yang dipilih. Silakan pilih meja lain.',
                ]);
        }

        $request->session()->put('reservasi_konfirmasi', $validated);

        return redirect()->route('reservasi.konfirmasi');
    }

public function simpan(Request $request)
{
    // =====================================================
    // VALIDASI DATA
    // =====================================================

    $request->validate(
        $this->aturanFormReservasi() + [
            'meja_id' => 'required|exists:mejas,id',
        ],
        $this->pesanFormReservasi()
    );


    // =====================================================
    // CEK MEJA
    // =====================================================

    $meja = Meja::findOrFail($request->meja_id);

    if ($this->statusReservasiMeja($meja, $request->tanggal, $request->jam) !== 'tersedia') {
        return redirect()
            ->route('reservasi.pilih-meja')
            ->withErrors([
                'meja_id' =>
                    'Maaf, meja tersebut baru saja dipesan oleh pelanggan lain untuk tanggal dan jam yang sama. Silakan pilih meja lain.'
            ]);
    }


    // =====================================================
    // CEK KAPASITAS
    // =====================================================

    if ($meja->kapasitas < $request->jumlah_peserta) {

        return back()->withErrors([
            'meja_id' => 'Meja yang dipilih tidak memiliki kapasitas yang cukup.'
        ]);
    }


    // =====================================================
    // TRANSAKSI DATABASE
    // =====================================================

    $reservasi = DB::transaction(function () use ($request, $meja) {

        // Mengunci data meja selama proses penyimpanan
        $meja = Meja::where('id', $meja->id)
            ->lockForUpdate()
            ->first();


        // =================================================
        // CEK DOUBLE BOOKING
        // =================================================

        $sudahDipesan = Reservasi::where('meja_id', $meja->id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', [
                'menunggu_pembayaran',
                'dikonfirmasi',
                'menunggu_pembatalan',
            ])
            ->exists();


        // =================================================
        // JIKA SUDAH DIPESAN
        // =================================================

        if ($sudahDipesan) {

            return null;
        }


        // =================================================
        // BUAT KODE RESERVASI
        // =================================================

        do {

            $kodeReservasi =
                'KNK-' .
                strtoupper(
                    substr(
                        md5(uniqid()),
                        0,
                        6
                    )
                );

        } while (
            Reservasi::where(
                'kode_reservasi',
                $kodeReservasi
            )->exists()
        );


        // =================================================
        // SIMPAN RESERVASI
        // =================================================

        return Reservasi::create([

            'kode_reservasi' => $kodeReservasi,

            'nama' => $request->nama,

            'whatsapp' => $request->whatsapp,

            'alamat' => $request->alamat,

            'tanggal' => $request->tanggal,

            'jam' => $request->jam,

            'jumlah_peserta' =>
                $request->jumlah_peserta,

            'lantai' =>
                $request->lantai,

            'pemandangan' =>
                $request->pemandangan,

            'fasilitas' =>
                $request->fasilitas,

            'meja_id' =>
                $meja->id,

            'status' =>
                'menunggu_pembayaran',

            'total_harga' => Reservasi::hitungTotal((int) $request->jumlah_peserta),

            'jumlah_dp' => Reservasi::hitungTotal((int) $request->jumlah_peserta),

            'status_pembayaran' =>
                'belum_bayar',

            'batas_pembayaran' => now()->addMinutes(Reservasi::BATAS_MENIT),
        ]);
    });


    // =====================================================
    // JIKA MEJA SUDAH DIPESAN
    // =====================================================

    if ($reservasi === null) {

        return redirect()
            ->route('reservasi.pilih-meja')
            ->withErrors([
                'meja_id' =>
                    'Maaf, meja tersebut baru saja dipesan oleh pelanggan lain untuk tanggal dan jam yang sama. Silakan pilih meja lain.'
            ]);
    }

    $request->session()->forget([
        'reservasi_form',
        'reservasi_konfirmasi',
    ]);

    return redirect()->route(
        'reservasi.pembayaran',
        $reservasi->kode_reservasi
    );
}

    public function pembayaran(string $kode)
    {
        Reservasi::batalkanYangKadaluarsa();

        $reservasi = Reservasi::with('meja')
            ->where('kode_reservasi', $kode)
            ->firstOrFail();

        $reservasi->batalkanJikaKadaluarsa();
        $reservasi->refresh()->load('meja');

        return view('reservasi.berhasil', compact('reservasi'));
    }

    public function sudahBayar(Request $request, string $kode)
    {
        Reservasi::batalkanYangKadaluarsa();

        $reservasi = Reservasi::where('kode_reservasi', $kode)->firstOrFail();

        if ($reservasi->batalkanJikaKadaluarsa()) {
            return redirect()
                ->route('reservasi.pembayaran', $kode)
                ->withErrors([
                    'pembayaran' => 'Waktu pembayaran telah habis. Silakan mendaftar reservasi ulang.',
                ]);
        }

        if ($reservasi->status === 'dikonfirmasi') {
            return redirect()->route('reservasi.pembayaran', $kode);
        }

        if ($reservasi->status !== 'menunggu_pembayaran') {
            return redirect()
                ->route('reservasi.pembayaran', $kode)
                ->withErrors([
                    'pembayaran' => 'Reservasi ini tidak dapat dikonfirmasi pembayarannya.',
                ]);
        }

        if ($reservasi->status_pembayaran === 'belum_bayar') {

            // =====================================================
            // VALIDASI BUKTI PEMBAYARAN
            // =====================================================

            $request->validate([
                'bukti_pembayaran' => [
                    'required',
                    'file',
                    'image',
                    'mimes:jpeg,png,jpg,webp',
                    'max:2048',
                ],
            ], [
                'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
                'bukti_pembayaran.image'    => 'File harus berupa gambar.',
                'bukti_pembayaran.mimes'    => 'Format gambar yang diizinkan: JPG, PNG, WEBP.',
                'bukti_pembayaran.max'      => 'Ukuran gambar maksimal 2 MB.',
            ]);

            // =====================================================
            // SIMPAN FILE BUKTI PEMBAYARAN
            // =====================================================

            $file = $request->file('bukti_pembayaran');
            $namaFile = time() . '_' . $kode . '.' . $file->getClientOriginalExtension();
            $direktori = public_path('images/bukti-pembayaran');

            if (!file_exists($direktori)) {
                mkdir($direktori, 0755, true);
            }

            $file->move($direktori, $namaFile);

            // =====================================================
            // UPDATE STATUS & SIMPAN BUKTI
            // =====================================================

            $reservasi->update([
                'status_pembayaran' => 'menunggu_verifikasi',
                'bukti_pembayaran'  => $namaFile,
            ]);
        }

        return redirect()
            ->route('reservasi.pembayaran', $kode)
            ->with('success', 'Bukti pembayaran berhasil dikirim. Mohon tunggu verifikasi dari admin.');
    }

    public function statusPembayaran(string $kode)
    {
        Reservasi::batalkanYangKadaluarsa();

        $reservasi = Reservasi::where('kode_reservasi', $kode)->firstOrFail();
        $reservasi->batalkanJikaKadaluarsa();
        $reservasi->refresh();

        return response()->json([
            'status' => $reservasi->status,
            'status_pembayaran' => $reservasi->status_pembayaran,
            'sisa_detik' => $reservasi->sisaDetikPembayaran(),
            'kadaluarsa' => $reservasi->status_pembayaran === 'kadaluarsa',
        ]);
    }

    public function cek(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20',
        ], [
            'kode.required' => 'Masukkan kode reservasi terlebih dahulu.',
        ]);

        Reservasi::batalkanYangKadaluarsa();

        $kode = strtoupper(trim($validated['kode']));

        $reservasi = Reservasi::with('meja')
            ->where('kode_reservasi', $kode)
            ->first();

        if (!$reservasi) {
            return redirect()
                ->route('home')
                ->withFragment('pembatalan')
                ->withInput()
                ->withErrors([
                    'kode' => 'Kode reservasi tidak ditemukan. Periksa kembali kode yang diberikan.',
                ]);
        }

        $reservasi->batalkanJikaKadaluarsa();
        $reservasi->refresh()->load('meja');

        return view('reservasi.cek', compact('reservasi'));
    }

    public function batalkan(Request $request, string $kode)
    {
        Reservasi::batalkanYangKadaluarsa();

        $reservasi = Reservasi::where('kode_reservasi', $kode)->firstOrFail();
        $reservasi->batalkanJikaKadaluarsa();
        $reservasi->refresh();

        if (!$reservasi->bisaDibatalkan()) {
            return redirect()
                ->route('reservasi.cek', ['kode' => $kode])
                ->withErrors([
                    'pembatalan' => 'Reservasi ini tidak dapat dibatalkan.',
                ]);
        }

        if ($reservasi->perluDataRekening()) {
            $validated = $request->validate([
                'nama_bank' => 'required|string|max:80',
                'nomor_rekening' => 'required|string|max:50',
                'nama_pemilik_rekening' => 'required|string|max:100',
            ], [
                'nama_bank.required' => 'Nama bank wajib diisi untuk pengembalian DP.',
                'nomor_rekening.required' => 'Nomor rekening wajib diisi untuk pengembalian DP.',
                'nama_pemilik_rekening.required' => 'Nama pemilik rekening wajib diisi untuk pengembalian DP.',
            ]);

            $reservasi->update([
                'nama_bank' => $validated['nama_bank'],
                'nomor_rekening' => $validated['nomor_rekening'],
                'nama_pemilik_rekening' => $validated['nama_pemilik_rekening'],
                'status' => 'menunggu_pembatalan',
                'status_pembatalan' => 'menunggu_verifikasi',
            ]);

            return redirect()
                ->route('reservasi.cek', ['kode' => $kode])
                ->with('success', 'Pengajuan pembatalan terkirim. Admin akan memverifikasi dan mengembalikan uang muka ke rekening yang Anda isi.');
        }

        $reservasi->update([
            'status' => 'dibatalkan',
            'status_pembatalan' => 'disetujui',
            'status_pembayaran' => $reservasi->status_pembayaran === 'belum_bayar'
                ? 'belum_bayar'
                : $reservasi->status_pembayaran,
        ]);

        return redirect()
            ->route('reservasi.cek', ['kode' => $kode])
            ->with('success', 'Reservasi berhasil dibatalkan. Meja kembali tersedia karena pembayaran belum diverifikasi.');
    }

    private function aturanFormReservasi(): array
    {
        $lantai = (int) request('lantai');

        return [
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal' => 'required|date|after:today',
            'jam' => $this->aturanJamReservasi(),
            'jumlah_peserta' => 'required|integer|min:1',
            'lantai' => 'required|in:1,2,3',
            'pemandangan' => [
                'required',
                Rule::in($this->opsiPemandangan($lantai)),
            ],
            'fasilitas' => [
                'required',
                Rule::in($this->opsiFasilitas($lantai)),
            ],
        ];
    }

    private function pesanFormReservasi(): array
    {
        return [
            'tanggal.after' => 'Tanggal hari ini tidak dapat dipilih. Silakan pilih tanggal berikutnya.',
            'pemandangan.in' => 'Pemandangan tidak sesuai dengan lantai yang dipilih.',
            'fasilitas.in' => 'Fasilitas tidak sesuai dengan lantai yang dipilih.',
        ];
    }

    private function aturanJamReservasi(): array
    {
        return [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) {
                if ($value < '10:00' || $value > '20:30') {
                    $fail('Jam reservasi hanya dapat dipilih pukul 10.00 sampai 20.30.');
                }
            },
        ];
    }

    private function opsiPemandangan(int $lantai): array
    {
        return match ($lantai) {
            2 => ['indoor'],
            1, 3 => ['indoor', 'outdoor'],
            default => [],
        };
    }

    private function opsiFasilitas(int $lantai): array
    {
        return match ($lantai) {
            1 => ['parkiran', 'kasir'],
            2 => ['no_smoking'],
            3 => ['kamar_mandi', 'mushola'],
            default => [],
        };
    }

    private function ambilFormReservasi(Request $request): ?object
    {
        $data = $request->session()->get('reservasi_form');

        return $data ? (object) $data : null;
    }

    private function mejaTerisiIds($tanggal, $jam)
    {
        Reservasi::batalkanYangKadaluarsa();

        return Reservasi::query()
            ->whereDate('tanggal', $tanggal)
            ->whereTime('jam', $jam)
            ->whereIn('status', [
                'menunggu_pembayaran',
                'dikonfirmasi',
                'menunggu_pembatalan',
            ])
            ->pluck('meja_id');
    }

    private function mejaDenganStatus($tanggal, $jam)
    {
        Reservasi::batalkanYangKadaluarsa();

        $reservasiAktif = Reservasi::query()
            ->whereDate('tanggal', $tanggal)
            ->whereTime('jam', $jam)
            ->whereIn('status', [
                'menunggu_pembayaran',
                'dikonfirmasi',
                'menunggu_pembatalan',
            ])
            ->get()
            ->keyBy('meja_id');

        return Meja::query()
            ->orderBy('lantai')
            ->orderBy('nomor_meja')
            ->get()
            ->map(function (Meja $meja) use ($reservasiAktif) {
                $meja->status_reservasi = $this->tentukanStatusMeja(
                    $meja,
                    $reservasiAktif->get($meja->id)
                );

                return $meja;
            });
    }

    private function statusReservasiMeja(Meja $meja, $tanggal, $jam): string
    {
        Reservasi::batalkanYangKadaluarsa();

        $reservasi = Reservasi::query()
            ->where('meja_id', $meja->id)
            ->whereDate('tanggal', $tanggal)
            ->whereTime('jam', $jam)
            ->whereIn('status', [
                'menunggu_pembayaran',
                'dikonfirmasi',
                'menunggu_pembatalan',
            ])
            ->first();

        return $this->tentukanStatusMeja($meja, $reservasi);
    }

    private function tentukanStatusMeja(Meja $meja, ?Reservasi $reservasi): string
    {
        if ($meja->status === 'nonaktif') {
            return 'tidak_aktif';
        }

        if ($reservasi?->status === 'menunggu_pembayaran') {
            return 'proses_pembayaran';
        }

        if ($reservasi?->status === 'dikonfirmasi' || $reservasi?->status === 'menunggu_pembatalan') {
            return 'dipesan';
        }

        return 'tersedia';
    }
}