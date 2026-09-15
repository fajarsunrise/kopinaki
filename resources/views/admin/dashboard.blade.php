@extends('layouts.admin')

@section('title', 'Dashboard Admin - Kopi Naki')

@section('admin')

<div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
    <div>
        <h2 class="reservation-title mb-1">Dashboard</h2>
        <p class="reservation-subtitle mb-0">
            Ringkasan reservasi, meja, dan pencarian data.
        </p>
    </div>
</div>

<form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
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

@if ($kata !== '')
    <div class="reservation-card mb-4">
        <h5 class="mb-3">Hasil pencarian “{{ $kata }}”</h5>
        @if ($hasilPencarian->isEmpty())
            <p class="text-muted mb-0">Tidak ada reservasi yang cocok.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Meja</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasilPencarian as $reservasi)
                            <tr>
                                <td class="fw-bold">{{ $reservasi->kode_reservasi }}</td>
                                <td>{{ $reservasi->nama }}</td>
                                <td>{{ $reservasi->meja->kode_meja ?? '-' }}</td>
                                <td>{{ $reservasi->tanggal->format('d-m-Y') }} {{ $reservasi->jam->format('H:i') }}</td>
                                <td>@include('admin.partials.status-badge')</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Reservasi hari ini</small>
            <div class="admin-stat-value">{{ $statistik['reservasi_hari_ini'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Menunggu verifikasi bayar</small>
            <div class="admin-stat-value">{{ $statistik['menunggu_verifikasi'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Menunggu pembatalan</small>
            <div class="admin-stat-value">{{ $statistik['menunggu_pembatalan'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Reservasi dikonfirmasi</small>
            <div class="admin-stat-value">{{ $statistik['dikonfirmasi'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Total meja</small>
            <div class="admin-stat-value">{{ $statistik['total_meja'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Maintenance</small>
            <div class="admin-stat-value">{{ $statistik['meja_nonaktif'] }}</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card">
            <small>Total DP lunas</small>
            <div class="admin-stat-value">Rp {{ number_format($statistik['pendapatan_dp'], 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="reservation-card">
    <h5 class="mb-3">Reservasi terbaru</h5>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Meja</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($terbaru as $reservasi)
                    <tr>
                        <td class="fw-bold">{{ $reservasi->kode_reservasi }}</td>
                        <td>{{ $reservasi->nama }}</td>
                        <td>{{ $reservasi->meja->kode_meja ?? '-' }}</td>
                        <td>{{ $reservasi->tanggal->format('d-m-Y') }} {{ $reservasi->jam->format('H:i') }}</td>
                        <td>@include('admin.partials.status-badge')</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted text-center py-4">Belum ada reservasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
