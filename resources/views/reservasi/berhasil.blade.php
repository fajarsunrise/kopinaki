@extends('layouts.app')

@section('title', 'Pembayaran Reservasi - Kopi Naki')

@php
    $barcodePng = public_path('images/pembayaran/barcode.png');
    $barcodeSrc = file_exists($barcodePng)
        ? asset('images/pembayaran/barcode.png')
        : asset('images/pembayaran/barcode.svg');

    $menungguBayar = $reservasi->status === 'menunggu_pembayaran'
        && $reservasi->status_pembayaran === 'belum_bayar';
    $menungguVerifikasi = $reservasi->status === 'menunggu_pembayaran'
        && $reservasi->status_pembayaran === 'menunggu_verifikasi';
    $lunas = $reservasi->status === 'dikonfirmasi';
    $gagal = $reservasi->status_pembayaran === 'kadaluarsa';
    $dibatalkan = $reservasi->status === 'dibatalkan' && !$gagal;
    $menungguPembatalan = $reservasi->status === 'menunggu_pembatalan';
    $sisaDetik = $reservasi->sisaDetikPembayaran();
@endphp

@section('content')

<section class="reservation-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="reservation-card text-center">

                    @if ($gagal)
                        <div class="preference-icon mb-4">
                            <i class="bi bi-x-circle"></i>
                        </div>

                        <h2 class="reservation-title">
                            Pembayaran Gagal
                        </h2>

                        <p class="reservation-subtitle mb-4">
                            Waktu pembayaran 20 menit telah habis.
                            Reservasi dibatalkan dan meja kembali tersedia.
                            Silakan mendaftar reservasi ulang.
                        </p>
                    @elseif ($dibatalkan)
                        <div class="preference-icon mb-4">
                            <i class="bi bi-x-circle"></i>
                        </div>

                        <h2 class="reservation-title">
                            Reservasi Dibatalkan
                        </h2>

                        <p class="reservation-subtitle mb-4">
                            Reservasi ini sudah dibatalkan.
                            @if ($reservasi->status_pembayaran === 'dikembalikan')
                                Uang muka telah dikembalikan ke rekening yang didaftarkan.
                            @endif
                        </p>
                    @elseif ($menungguPembatalan)
                        <div class="preference-icon mb-4">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                        <h2 class="reservation-title">
                            Menunggu Verifikasi Pembatalan
                        </h2>

                        <p class="reservation-subtitle mb-4">
                            Pengajuan pembatalan sedang diproses admin.
                            Pengembalian DP akan dikirim ke rekening yang Anda isi.
                        </p>
                    @elseif ($lunas)
                        <div class="preference-icon mb-4">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <h2 class="reservation-title">
                            Pembayaran Terverifikasi
                        </h2>

                        <p class="reservation-subtitle mb-4">
                            Admin telah mengonfirmasi pembayaran Anda.
                            Meja sudah dipesan dan berstatus hijau pada denah.
                        </p>
                    @elseif ($menungguVerifikasi)
                        <div class="preference-icon mb-4">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                        <h2 class="reservation-title">
                            Menunggu Verifikasi Admin
                        </h2>

                        <p class="reservation-subtitle mb-4">
                            Konfirmasi pembayaran Anda sudah diterima.
                            Meja akan berubah menjadi hijau setelah admin
                            memverifikasi pembayaran.
                        </p>
                    @else
                        <div class="preference-icon mb-4">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <h2 class="reservation-title">
                            Reservasi Berhasil!
                        </h2>

                        <p class="reservation-subtitle mb-4">
                            Lakukan pembayaran dalam waktu 20 menit
                            agar meja tetap dipesan untuk Anda.
                        </p>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger text-start">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success text-start">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="info-box mb-4">

                        <small class="text-muted">
                            Kode Reservasi
                        </small>

                        <h2 class="fw-bold mt-2">
                            {{ $reservasi->kode_reservasi }}
                        </h2>

                        <p class="text-muted mb-0">
                            Simpan kode reservasi ini untuk
                            keperluan pengecekan reservasi.
                        </p>

                    </div>

                    <div class="text-start">

                        <div class="form-section-title mb-3">
                            <i class="bi bi-calendar-check me-2"></i>
                            Detail Reservasi
                        </div>

                        <div class="info-box">

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <small class="text-muted">Nama</small>
                                    <div class="fw-bold">{{ $reservasi->nama }}</div>
                                </div>

                                <div class="col-md-6">
                                    <small class="text-muted">WhatsApp</small>
                                    <div class="fw-bold">{{ $reservasi->whatsapp }}</div>
                                </div>

                                <div class="col-md-6">
                                    <small class="text-muted">Tanggal</small>
                                    <div class="fw-bold">{{ $reservasi->tanggal->format('d-m-Y') }}</div>
                                </div>

                                <div class="col-md-6">
                                    <small class="text-muted">Jam</small>
                                    <div class="fw-bold">{{ $reservasi->jam->format('H:i') }}</div>
                                </div>

                                <div class="col-md-6">
                                    <small class="text-muted">Jumlah Peserta</small>
                                    <div class="fw-bold">{{ $reservasi->jumlah_peserta }} orang</div>
                                </div>

                                <div class="col-md-6">
                                    <small class="text-muted">Meja</small>
                                    <div class="fw-bold">{{ $reservasi->meja->kode_meja }}</div>
                                </div>

                            </div>

                        </div>

                    </div>

                    @if ($menungguBayar)
                        <div class="payment-box mt-4">

                            <div class="form-section-title mb-3">
                                <i class="bi bi-qr-code me-2"></i>
                                Instruksi Pembayaran
                            </div>

                            <p class="text-muted mb-3">
                                Pindai barcode di bawah ini, lalu bayar sesuai total
                                yang tertera sebelum waktu habis.
                            </p>

                            <div class="barcode-frame mb-4">
                                <img
                                    src="{{ $barcodeSrc }}"
                                    alt="Barcode pembayaran"
                                    class="barcode-image"
                                >
                            </div>

                            <div class="payment-total mb-3">
                                <small class="text-muted d-block">Total yang harus dibayar</small>
                                <div class="fw-bold fs-4">
                                    Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                </div>
                                <div class="text-muted">
                                    {{ $reservasi->jumlah_peserta }} peserta × Rp 15.000
                                </div>
                            </div>

                            <div class="payment-timer mb-4" data-sisa="{{ $sisaDetik }}">
                                <small class="text-muted d-block">Sisa waktu pembayaran</small>
                                <div class="fw-bold fs-3" id="payment-countdown">20:00</div>
                            </div>

                        </div>

                        {{-- ============================== --}}
                        {{-- FORM BUKTI PEMBAYARAN --}}
                        {{-- ============================== --}}
                        <div class="payment-box mt-4 text-start">

                            <div class="form-section-title mb-3">
                                <i class="bi bi-upload me-2"></i>
                                Upload Bukti Pembayaran
                            </div>

                            <p class="text-muted mb-4">
                                Setelah melakukan transfer, upload foto / screenshot bukti pembayaran
                                di bawah ini agar admin dapat memverifikasi pembayaran Anda.
                            </p>

                            <form
                                method="POST"
                                action="{{ route('reservasi.sudah-bayar', $reservasi->kode_reservasi) }}"
                                enctype="multipart/form-data"
                                id="form-bukti-pembayaran"
                            >
                                @csrf

                                {{-- Preview Gambar --}}
                                <div id="preview-wrapper" class="mb-3" style="display:none;">
                                    <small class="text-muted d-block mb-2">Preview bukti:</small>
                                    <img
                                        id="preview-bukti"
                                        src="#"
                                        alt="Preview bukti pembayaran"
                                        class="img-fluid rounded border"
                                        style="max-height: 260px; object-fit: contain; width: 100%;"
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label fw-semibold">
                                        <i class="bi bi-image me-1"></i>
                                        Foto / Screenshot Bukti Transfer
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="file"
                                        name="bukti_pembayaran"
                                        id="bukti_pembayaran"
                                        class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                        accept="image/jpeg,image/png,image/jpg,image/webp"
                                        required
                                    >
                                    @error('bukti_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        Format yang diterima: JPG, PNG, WEBP. Ukuran maks. 2 MB.
                                    </small>
                                </div>

                                <div class="mb-4">
                                    <label for="catatan_pembayaran" class="form-label fw-semibold">
                                        <i class="bi bi-chat-text me-1"></i>
                                        Catatan (Opsional)
                                    </label>
                                    <textarea
                                        name="catatan_pembayaran"
                                        id="catatan_pembayaran"
                                        class="form-control"
                                        rows="2"
                                        placeholder="Contoh: Transfer via BCA mobile, pukul 14.30..."
                                    >{{ old('catatan_pembayaran') }}</textarea>
                                </div>

                                <div class="alert alert-info d-flex align-items-start mb-4" style="font-size:0.875rem;">
                                    <i class="bi bi-info-circle-fill me-2 mt-1 flex-shrink-0"></i>
                                    <div>
                                        Setelah mengklik <strong>Konfirmasi Sudah Bayar</strong>,
                                        admin akan memverifikasi bukti pembayaran Anda.
                                        Status reservasi akan berubah menjadi <strong>Dikonfirmasi</strong>
                                        setelah verifikasi berhasil.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-recommend w-100" id="btn-konfirmasi-bayar">
                                    <i class="bi bi-wallet2 me-2"></i>
                                    Konfirmasi Sudah Bayar
                                </button>

                            </form>

                        </div>
                    @elseif ($menungguVerifikasi)
                        <div class="payment-box mt-4">

                            <div class="form-section-title mb-3">
                                <i class="bi bi-hourglass-split me-2"></i>
                                Bukti Pembayaran Terkirim
                            </div>

                            @if ($reservasi->bukti_pembayaran)
                                <div class="mb-3 text-start">
                                    <small class="text-muted d-block mb-2">Bukti yang diunggah:</small>
                                    <img
                                        src="{{ asset('images/bukti-pembayaran/' . $reservasi->bukti_pembayaran) }}"
                                        alt="Bukti pembayaran"
                                        class="img-fluid rounded border"
                                        style="max-height: 200px; object-fit: contain; width: 100%;"
                                    >
                                </div>
                            @endif

                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-info-circle me-2"></i>
                                Bukti pembayaran Anda sedang ditinjau oleh admin.
                                Status meja akan berubah setelah verifikasi selesai.
                            </div>
                        </div>
                    @elseif ($lunas)
                        <div class="alert alert-success mt-4 mb-0">
                            <i class="bi bi-check-circle me-2"></i>
                            Reservasi dikonfirmasi. Status meja pada denah berwarna hijau.
                        </div>
                    @endif

                    <div class="mt-5">

                        @if ($gagal)
                            <a href="{{ route('reservasi.create') }}" class="btn btn-recommend">
                                <i class="bi bi-arrow-repeat me-2"></i>
                                Daftar Reservasi Ulang
                            </a>
                        @endif

                        <a href="{{ route('home') }}" class="btn btn-outline-secondary {{ $gagal ? 'ms-2' : '' }}">
                            <i class="bi bi-house me-2"></i>
                            Kembali ke Menu Utama
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection

@section('js')
@if ($menungguBayar)
<script>
    (function () {
        const timerEl = document.querySelector('.payment-timer');
        const countdownEl = document.getElementById('payment-countdown');
        const statusUrl = @json(route('reservasi.status-pembayaran', $reservasi->kode_reservasi));
        let sisa = timerEl ? parseInt(timerEl.dataset.sisa, 10) : 0;

        function formatWaktu(detik) {
            const menit = Math.floor(detik / 60);
            const sisaDetik = detik % 60;
            return String(menit).padStart(2, '0') + ':' + String(sisaDetik).padStart(2, '0');
        }

        function tampilkan() {
            if (!countdownEl) {
                return;
            }
            countdownEl.textContent = formatWaktu(Math.max(0, sisa));
        }

        function habisWaktu() {
            window.location.reload();
        }

        tampilkan();

        const intervalHitung = setInterval(function () {
            sisa -= 1;
            if (sisa <= 0) {
                clearInterval(intervalHitung);
                tampilkan();
                habisWaktu();
                return;
            }
            tampilkan();
        }, 1000);

        setInterval(async function () {
            try {
                const response = await fetch(statusUrl, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    return;
                }
                const data = await response.json();
                if (typeof data.sisa_detik === 'number') {
                    sisa = data.sisa_detik;
                    tampilkan();
                }
                if (data.kadaluarsa || data.status_pembayaran !== 'belum_bayar') {
                    window.location.reload();
                }
            } catch (error) {
                // abaikan gangguan jaringan singkat
            }
        }, 5000);
        // =====================================================
        // PREVIEW GAMBAR BUKTI PEMBAYARAN
        // =====================================================
        const inputBukti = document.getElementById('bukti_pembayaran');
        const previewWrapper = document.getElementById('preview-wrapper');
        const previewBukti = document.getElementById('preview-bukti');

        if (inputBukti) {
            inputBukti.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewBukti.src = e.target.result;
                        previewWrapper.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewWrapper.style.display = 'none';
                    previewBukti.src = '#';
                }
            });
        }

        // Tombol konfirmasi - disable setelah klik untuk cegah double submit
        const formBukti = document.getElementById('form-bukti-pembayaran');
        const btnKonfirmasi = document.getElementById('btn-konfirmasi-bayar');
        if (formBukti && btnKonfirmasi) {
            formBukti.addEventListener('submit', function () {
                btnKonfirmasi.disabled = true;
                btnKonfirmasi.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';
            });
        }
    })();
</script>
@elseif ($menungguVerifikasi)
<script>
    (function () {
        const statusUrl = @json(route('reservasi.status-pembayaran', $reservasi->kode_reservasi));
        setInterval(async function () {
            try {
                const response = await fetch(statusUrl, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    return;
                }
                const data = await response.json();
                if (data.status === 'dikonfirmasi' || data.status === 'dibatalkan') {
                    window.location.reload();
                }
            } catch (error) {
                // abaikan gangguan jaringan singkat
            }
        }, 5000);
    })();
</script>
@endif
@endsection
