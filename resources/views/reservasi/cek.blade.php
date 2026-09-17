@extends('layouts.app')

@section('title', 'Cek Reservasi - Kopi Naki')

@section('content')

<section class="reservation-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="reservation-card">

                    <div class="text-center mb-4">
                        <div class="preference-icon mx-auto mb-3">
                            <i class="bi bi-search"></i>
                        </div>
                        <h2 class="reservation-title">Detail Reservasi</h2>
                        <p class="reservation-subtitle mb-0">
                            Status dan data reservasi berdasarkan kode yang Anda masukkan.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="info-box text-center mb-4">
                        <small class="text-muted">Kode Reservasi</small>
                        <h2 class="fw-bold mt-2 mb-2">{{ $reservasi->kode_reservasi }}</h2>
                        <span class="badge rounded-pill text-bg-dark px-3 py-2">
                            {{ $reservasi->labelStatus() }}
                        </span>
                    </div>

                    <div class="form-section-title mb-3">
                        <i class="bi bi-calendar-check me-2"></i>
                        Data Reservasi
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
                                <div class="fw-bold">{{ $reservasi->meja->kode_meja ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Uang muka (DP)</small>
                                <div class="fw-bold">Rp {{ number_format($reservasi->jumlah_dp, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Status pembayaran</small>
                                <div class="fw-bold">{{ str_replace('_', ' ', $reservasi->status_pembayaran) }}</div>
                            </div>
                        </div>
                    </div>

                    @if ($reservasi->menungguVerifikasiPembatalan())
                        <div class="alert alert-warning">
                            <i class="bi bi-hourglass-split me-2"></i>
                            Pengajuan pembatalan sedang menunggu verifikasi admin.
                            Pengembalian DP akan dikirim ke rekening
                            <strong>{{ $reservasi->nomor_rekening }}</strong>
                            ({{ $reservasi->nama_bank }} a.n. {{ $reservasi->nama_pemilik_rekening }}).
                        </div>
                    @elseif ($reservasi->status_pembayaran === 'dikembalikan')
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>
                            Pembatalan telah diverifikasi. Uang muka dikembalikan
                            @if ($reservasi->pengembalian_at)
                                pada {{ $reservasi->pengembalian_at->format('d-m-Y H:i') }}
                            @endif
                            ke rekening {{ $reservasi->nomor_rekening }}.
                        </div>
                    @elseif ($reservasi->bisaDibatalkan())
                        <div class="payment-box text-start mt-2">
                            <div class="form-section-title mb-3">
                                <i class="bi bi-x-circle me-2"></i>
                                Batalkan Reservasi
                            </div>

                            @if ($reservasi->perluDataRekening())
                                <p class="text-muted">
                                    Isi nomor rekening untuk pengembalian uang muka.
                                    Admin akan memverifikasi pembatalan lalu mengembalikan DP.
                                </p>

                                <form
                                    method="POST"
                                    action="{{ route('reservasi.batalkan', $reservasi->kode_reservasi) }}"
                                >
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Nama Bank</label>
                                        <input
                                            type="text"
                                            name="nama_bank"
                                            class="form-control"
                                            value="{{ old('nama_bank') }}"
                                            placeholder="Contoh: BCA"
                                            required
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nomor Rekening</label>
                                        <input
                                            type="number"
                                            name="nomor_rekening"
                                            class="form-control"
                                            value="{{ old('nomor_rekening') }}"
                                            placeholder="Masukkan nomor rekening"
                                            required
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Pemilik Rekening</label>
                                        <input
                                            type="text"
                                            name="nama_pemilik_rekening"
                                            class="form-control"
                                            value="{{ old('nama_pemilik_rekening') }}"
                                            placeholder="Nama sesuai rekening"
                                            required
                                        >
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Alasan Pembatalan</label>
                                        <textarea
                                            name="alasan_pembatalan"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Tuliskan alasan pembatalan reservasi Anda..."
                                            required
                                        >{{ old('alasan_pembatalan') }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-outline-danger">
                                        Ajukan Pembatalan
                                    </button>
                                </form>
                            @else
                                <p class="text-muted">
                                    Pembayaran belum lunas, sehingga pembatalan tidak memerlukan pengembalian DP.
                                </p>
                                <form
                                    method="POST"
                                    action="{{ route('reservasi.batalkan', $reservasi->kode_reservasi) }}"
                                >
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Alasan Pembatalan</label>
                                        <textarea
                                            name="alasan_pembatalan"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Tuliskan alasan pembatalan reservasi Anda..."
                                            required
                                        >{{ old('alasan_pembatalan') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-outline-danger">
                                        Batalkan Reservasi
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif

                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}" class="btn btn-recommend ms-2">
                            Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
