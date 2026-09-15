@extends('layouts.admin')

@section('title', 'Histori Reservasi - Kopi Naki')

@section('admin')

<div class="reservation-card">
    <div class="mb-4">
        <h2 class="reservation-title mb-1">Histori Reservasi</h2>
        <p class="reservation-subtitle mb-0">
            Daftar reservasi yang sudah dibatalkan atau selesai. Filter berdasarkan bulan, cari jadwal, lalu cetak PDF harian atau bulanan.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="GET" action="{{ route('admin.reservasi.histori') }}" class="mb-4">
        <div class="row g-2 align-items-end mb-2">
            <div class="col-lg-5">
                <label class="form-label small mb-1">Pencarian</label>
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    value="{{ $kata }}"
                    placeholder="Cari kode, nama, WhatsApp, meja, atau jadwal (contoh: 15-09-2026 atau 19:00)"
                >
            </div>
            <div class="col-md-6 col-lg-3">
                <label class="form-label small mb-1">Filter / cetak bulan</label>
                <input
                    type="month"
                    name="bulan"
                    class="form-control"
                    value="{{ $bulan }}"
                >
            <!-- </div>
            <div class="col-md-6 col-lg-4">
                <label class="form-label small mb-1">Tanggal cetak harian</label>
                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ $tanggal }}"
                >
            </div> -->
        </div>

<div class="d-flex flex-wrap gap-2">

    <button
        class="btn btn-recommend"
        type="submit"
    >
        <i class="bi bi-search me-1"></i>
        Cari
    </button>

    <button
        class="btn btn-outline-dark"
        type="submit"
        formaction="{{ route('admin.reservasi.histori.pdf') }}"
        name="periode"
        value="bulan"
    >
        <i class="bi bi-file-earmark-pdf me-1"></i>
        Cetak PDF Bulanan
    </button>

    <a
        href="{{ route('admin.reservasi.histori') }}"
        class="btn btn-outline-secondary"
    >
        Reset
    </a>

</div>
    </form>

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
                        <td>Rp {{ number_format($reservasi->jumlah_dp, 0, ',', '.') }}</td>
                        <td>
                            @include('admin.partials.status-badge')
                            <div class="small text-muted mt-1">{{ $reservasi->labelStatus() }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada histori reservasi{{ ($kata !== '' || $bulan !== '') ? ' untuk filter tersebut' : '' }}.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $reservasis->links() }}
</div>

@endsection
