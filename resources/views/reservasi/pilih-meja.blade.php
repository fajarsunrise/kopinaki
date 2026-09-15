@extends('layouts.app')

@section('title', 'Pilih Meja - Kopi Naki')

@php
    $labelStatus = [
        'tersedia' => 'Tersedia',
        'proses_pembayaran' => 'Proses pembayaran',
        'dipesan' => 'Sudah dipesan',
        'tidak_aktif' => 'Maintenance',
    ];
@endphp

@section('content')

<section class="reservation-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-11">

                <div class="reservation-card">

                    <div class="text-center mb-5">

                        <div class="preference-icon mb-3">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>

                        <h2 class="reservation-title">
                            Pilih Meja
                        </h2>

                        <p class="reservation-subtitle">
                            Status tempat duduk diperbarui sesuai kondisi reservasi
                            pada tanggal {{ $request->tanggal }} pukul {{ $request->jam }}.
                        </p>

                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="info-box mb-4">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-info-circle fs-4 me-3"></i>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Informasi Pemilihan Meja
                                </h6>

                                <p class="mb-3 text-muted">
                                    Semua meja tetap ditampilkan. Hanya meja berwarna abu-abu
                                    yang dapat dipilih. Status akan berubah otomatis jika ada
                                    reservasi baru pada tanggal dan jam yang sama.
                                </p>

                                <div class="status-legend">
                                    <div class="status-legend-item">
                                        <span class="status-dot tersedia"></span>
                                        Tersedia
                                    </div>
                                    <div class="status-legend-item">
                                        <span class="status-dot proses_pembayaran"></span>
                                        Proses pembayaran
                                    </div>
                                    <div class="status-legend-item">
                                        <span class="status-dot dipesan"></span>
                                        Sudah dipesan
                                    </div>
                                    <div class="status-legend-item">
                                        <span class="status-dot tidak_aktif"></span>
                                        Maintenance
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    @for ($lantai = 1; $lantai <= 3; $lantai++)

                        <div class="mb-5">

                            <div class="d-flex align-items-center mb-4">

                                <div class="preference-icon me-3"
                                     style="width: 45px; height: 45px; font-size: 20px;">

                                    <i class="bi bi-building"></i>

                                </div>

                                <div>

                                    <h3 class="area-title mb-1">
                                        Lantai {{ $lantai }}
                                    </h3>

                                    <small class="text-muted">
                                        Denah meja lantai {{ $lantai }}
                                    </small>

                                </div>

                            </div>

                            <div class="row g-4">

                                @foreach ($mejas->where('lantai', $lantai) as $meja)

                                    @php
                                        $status = $meja->status_reservasi;
                                        $bisaDipilih = $status === 'tersedia';
                                    @endphp

                                    <div class="col-6 col-md-4 col-lg-3">

                                        <div
                                            class="card feature-card table-card h-100 status-{{ $status }} {{ $bisaDipilih ? '' : 'is-locked' }}"
                                            data-meja-id="{{ $meja->id }}"
                                            data-status="{{ $status }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal{{ $meja->kode_meja }}"
                                        >

                                            @if ($meja->gambar)

                                                <img
                                                    src="{{ asset('images/tables/' . $meja->gambar) }}"
                                                    class="card-img-top"
                                                    style="height: 180px; object-fit: cover;"
                                                    alt="Meja {{ $meja->kode_meja }}"
                                                >

                                            @else

                                                <div
                                                    class="d-flex align-items-center justify-content-center bg-light"
                                                    style="height: 180px;"
                                                >

                                                    <i class="bi bi-table fs-1 text-muted"></i>

                                                </div>

                                            @endif

                                            <div class="card-body text-center">

                                                <h5 class="fw-bold mb-2">
                                                    Meja {{ $meja->kode_meja }}
                                                </h5>

                                                <div class="text-muted">

                                                    <i class="bi bi-people me-1"></i>

                                                    {{ $meja->kapasitas }}
                                                    orang

                                                </div>

                                                <div class="table-status-badge js-status-label">
                                                    {{ $labelStatus[$status] }}
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endfor

                    @foreach ($mejas as $meja)

                        @php
                            $status = $meja->status_reservasi;
                            $bisaDipilih = $status === 'tersedia';
                        @endphp

                        <div
                            class="modal fade"
                            id="modal{{ $meja->kode_meja }}"
                            tabindex="-1"
                            aria-labelledby="modalLabel{{ $meja->kode_meja }}"
                            aria-hidden="true"
                        >

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5
                                            class="modal-title fw-bold"
                                            id="modalLabel{{ $meja->kode_meja }}"
                                        >
                                            Meja {{ $meja->kode_meja }}
                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>

                                    </div>

                                    <div class="modal-body">

                                        @if ($meja->gambar)

                                            <img
                                                src="{{ asset('images/tables/' . $meja->gambar) }}"
                                                class="img-fluid rounded mb-4 w-100"
                                                style="max-height: 300px; object-fit: cover;"
                                                alt="Meja {{ $meja->kode_meja }}"
                                            >

                                        @endif

                                        <h5 class="fw-bold mb-3">
                                            Informasi Meja
                                        </h5>

                                        <div class="row g-3">

                                            <div class="col-6">

                                                <small class="text-muted">
                                                    Kapasitas
                                                </small>

                                                <div class="fw-bold">

                                                    <i class="bi bi-people me-1"></i>

                                                    {{ $meja->kapasitas }}
                                                    orang

                                                </div>

                                            </div>

                                            <div class="col-6">

                                                <small class="text-muted">
                                                    Lokasi
                                                </small>

                                                <div class="fw-bold">

                                                    <i class="bi bi-building me-1"></i>

                                                    Lantai {{ $meja->lantai }}

                                                </div>

                                            </div>

                                            <div class="col-6">

                                                <small class="text-muted">
                                                    Pemandangan
                                                </small>

                                                <div class="fw-bold">

                                                    <i class="bi bi-image me-1"></i>

                                                    {{ ucfirst($meja->pemandangan) }}

                                                </div>

                                            </div>

                                            <div class="col-6">

                                                <small class="text-muted">
                                                    Fasilitas
                                                </small>

                                                <div class="fw-bold">

                                                    <i class="bi bi-geo-alt me-1"></i>

                                                    @switch($meja->fasilitas)

                                                        @case('parkiran')
                                                            Dekat dengan Parkiran
                                                            @break

                                                        @case('kasir')
                                                            Dekat dengan Kasir
                                                            @break

                                                        @case('no_smoking')
                                                            Area No Smoking
                                                            @break

                                                        @case('kamar_mandi')
                                                            Dekat dengan Kamar Mandi
                                                            @break

                                                        @case('mushola')
                                                            Dekat dengan Mushola
                                                            @break

                                                        @default
                                                            -
                                                    @endswitch

                                                </div>

                                            </div>

                                            @if ($meja->deskripsi)

                                                <div class="col-12 mt-3">

                                                    <small class="text-muted">
                                                        Keterangan
                                                    </small>

                                                    <p class="mb-0 mt-1">
                                                        {{ $meja->deskripsi }}
                                                    </p>

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Tutup
                                        </button>

                                        <form
                                            action="{{ route('reservasi.konfirmasi') }}"
                                            method="POST"
                                            class="js-pilih-meja-form"
                                            data-meja-id="{{ $meja->id }}"
                                        >
                                            @csrf

                                            <input type="hidden" name="nama" value="{{ $request->nama }}">
                                            <input type="hidden" name="whatsapp" value="{{ $request->whatsapp }}">
                                            <input type="hidden" name="alamat" value="{{ $request->alamat }}">
                                            <input type="hidden" name="tanggal" value="{{ $request->tanggal }}">
                                            <input type="hidden" name="jam" value="{{ $request->jam }}">
                                            <input type="hidden" name="jumlah_peserta" value="{{ $request->jumlah_peserta }}">
                                            <input type="hidden" name="lantai" value="{{ $request->lantai }}">
                                            <input type="hidden" name="pemandangan" value="{{ $request->pemandangan }}">
                                            <input type="hidden" name="fasilitas" value="{{ $request->fasilitas }}">
                                            <input type="hidden" name="meja_id" value="{{ $meja->id }}">

                                            <button
                                                type="submit"
                                                class="btn btn-recommend w-100 js-pilih-meja-btn"
                                                @disabled(!$bisaDipilih)
                                            >
                                                <i class="bi bi-check-circle me-2"></i>
                                                Pilih Meja Ini
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                    <div class="text-center mt-4">

                        <a
                            href="{{ route('reservasi.create') }}"
                            class="btn btn-outline-secondary"
                        >

                            <i class="bi bi-arrow-left me-2"></i>

                            Kembali ke Form Reservasi

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection

@section('js')
<script>
    (function () {
        const statusUrl = @json(route('reservasi.status-meja'));
        const tanggal = @json($request->tanggal);
        const jam = @json($request->jam);
        const labels = {
            tersedia: 'Tersedia',
            proses_pembayaran: 'Proses pembayaran',
            dipesan: 'Sudah dipesan',
            tidak_aktif: 'Maintenance'
        };

        function terapkanStatus(meja) {
            const card = document.querySelector('[data-meja-id="' + meja.id + '"]');
            const form = document.querySelector('.js-pilih-meja-form[data-meja-id="' + meja.id + '"]');
            const tombol = form ? form.querySelector('.js-pilih-meja-btn') : null;
            const label = card ? card.querySelector('.js-status-label') : null;
            const bisaDipilih = meja.status_reservasi === 'tersedia';

            if (card) {
                card.classList.remove(
                    'status-tersedia',
                    'status-proses_pembayaran',
                    'status-dipesan',
                    'status-tidak_aktif',
                    'is-locked'
                );
                card.classList.add('status-' + meja.status_reservasi);
                if (!bisaDipilih) {
                    card.classList.add('is-locked');
                }
                card.dataset.status = meja.status_reservasi;
            }

            if (label) {
                label.textContent = labels[meja.status_reservasi] || meja.status_reservasi;
            }

            if (tombol) {
                tombol.disabled = !bisaDipilih;
            }
        }

        async function perbaruiStatusMeja() {
            const url = statusUrl + '?tanggal=' + encodeURIComponent(tanggal) + '&jam=' + encodeURIComponent(jam);
            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            (data.mejas || []).forEach(terapkanStatus);
        }

        setInterval(perbaruiStatusMeja, 4000);
        document.addEventListener('visibilitychange', function () {
            if (!document.hidden) {
                perbaruiStatusMeja();
            }
        });
    })();
</script>
@endsection
