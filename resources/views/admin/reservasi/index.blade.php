@extends('layouts.admin')

@section('title', 'Kelola Reservasi - Kopi Naki')

@section('admin')

<div class="reservation-card">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="reservation-title mb-1">Kelola Reservasi</h2>
            <p class="reservation-subtitle mb-0">
                Verifikasi pembayaran dan pembatalan reservasi yang masih aktif.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <div class="info-box mb-0">
                Verifikasi bayar:
                <strong>{{ $menungguVerifikasi }}</strong>
            </div>
            <div class="info-box mb-0">
                Verifikasi batal:
                <strong>{{ $menungguPembatalan }}</strong>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.reservasi.index') }}" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="q"
                class="form-control"
                value="{{ $kata }}"
                placeholder="Cari kode, nama, WhatsApp, meja, atau jadwal (tanggal/jam)"
            >
            <button class="btn btn-recommend" type="submit">
                <i class="bi bi-search me-1"></i>
                Cari
            </button>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Meja</th>
                    <th>Jadwal</th>
                    <th>DP</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservasis as $reservasi)
                    <tr>
                        <td class="fw-bold">{{ $reservasi->kode_reservasi }}</td>
                        <td>
                            {{ $reservasi->nama }}<br>
                            <small class="text-muted">{{ $reservasi->whatsapp }}</small>
                        </td>
                        <td>{{ $reservasi->meja->kode_meja ?? '-' }}</td>
                        <td>
                            {{ $reservasi->tanggal->format('d-m-Y') }}<br>
                            <small class="text-muted">{{ $reservasi->jam->format('H:i') }}</small>
                        </td>
                        <td>
                            Rp {{ number_format($reservasi->jumlah_dp, 0, ',', '.') }}
                            @if ($reservasi->nomor_rekening)
                                <br>
                                <small class="text-muted">
                                    {{ $reservasi->nama_bank }} {{ $reservasi->nomor_rekening }}
                                    <br>a.n. {{ $reservasi->nama_pemilik_rekening }}
                                </small>
                            @endif
                        </td>
                        <td>@include('admin.partials.status-badge')</td>
                        <td class="text-end">
                            @if ($reservasi->status === 'menunggu_pembayaran' && $reservasi->status_pembayaran === 'menunggu_verifikasi')
                                <form method="POST" action="{{ route('admin.reservasi.verifikasi', $reservasi) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-recommend btn-sm">
                                        Verifikasi Bayar
                                    </button>
                                </form>
                            @elseif ($reservasi->status === 'menunggu_pembatalan' && $reservasi->status_pembatalan === 'menunggu_verifikasi')
                                <form method="POST" action="{{ route('admin.reservasi.verifikasi-pembatalan', $reservasi) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Verifikasi Batal &amp; Refund
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Tidak ada reservasi aktif{{ $kata !== '' ? ' untuk pencarian tersebut' : '' }}.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $reservasis->links() }}
</div>

@endsection
