@extends('layouts.app')

@section('title', 'Konfirmasi Reservasi - Kopi Naki')

@section('content')

<section class="reservation-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="reservation-card">

                    {{-- ================================================= --}}
                    {{-- HEADER --}}
                    {{-- ================================================= --}}

                    <div class="text-center mb-5">

                        <div class="preference-icon mb-3">
                            <i class="bi bi-check2-circle"></i>
                        </div>

                        <h2 class="reservation-title">
                            Konfirmasi Reservasi
                        </h2>

                        <p class="reservation-subtitle">
                            Periksa kembali data reservasi dan meja
                            yang Anda pilih sebelum melanjutkan.
                        </p>

                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif


                    {{-- ================================================= --}}
                    {{-- DATA PELANGGAN --}}
                    {{-- ================================================= --}}

                    <div class="form-section-title">

                        <i class="bi bi-person me-2"></i>

                        Data Pelanggan

                    </div>

                    <div class="info-box mb-4">

                        <div class="row g-4">

                            <div class="col-md-6">

                                <small class="text-muted">
                                    Nama Lengkap
                                </small>

                                <div class="fw-bold">
                                    {{ $request->nama }}
                                </div>

                            </div>


                            <div class="col-md-6">

                                <small class="text-muted">
                                    Nomor WhatsApp
                                </small>

                                <div class="fw-bold">
                                    {{ $request->whatsapp }}
                                </div>

                            </div>


                            <div class="col-12">

                                <small class="text-muted">
                                    Alamat
                                </small>

                                <div class="fw-bold">
                                    {{ $request->alamat }}
                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="my-5">


                    {{-- ================================================= --}}
                    {{-- DETAIL RESERVASI --}}
                    {{-- ================================================= --}}

                    <div class="form-section-title">

                        <i class="bi bi-calendar-check me-2"></i>

                        Detail Reservasi

                    </div>

                    <div class="info-box mb-4">

                        <div class="row g-4">

                            <div class="col-md-4">

                                <small class="text-muted">
                                    Tanggal Reservasi
                                </small>

                                <div class="fw-bold">
                                    {{ $request->tanggal }}
                                </div>

                            </div>


                            <div class="col-md-4">

                                <small class="text-muted">
                                    Jam Reservasi
                                </small>

                                <div class="fw-bold">
                                    {{ $request->jam }}
                                </div>

                            </div>


                            <div class="col-md-4">

                                <small class="text-muted">
                                    Jumlah Peserta
                                </small>

                                <div class="fw-bold">
                                    {{ $request->jumlah_peserta }}
                                    orang
                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="my-5">


                    {{-- ================================================= --}}
                    {{-- MEJA YANG DIPILIH --}}
                    {{-- ================================================= --}}

                    <div class="form-section-title">

                        <i class="bi bi-grid-3x3-gap me-2"></i>

                        Meja yang Dipilih

                    </div>

                    <div class="row justify-content-center">

                        <div class="col-md-8">

                            <div class="card feature-card">

                                @if ($meja->gambar)

                                    <img
                                        src="{{ asset('images/tables/' . $meja->gambar) }}"
                                        class="card-img-top"
                                        style="height: 280px; object-fit: cover;"
                                        alt="Meja {{ $meja->kode_meja }}"
                                    >

                                @endif


                                <div class="card-body">

                                    <div class="text-center mb-4">

                                        <span class="badge bg-success mb-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Meja Dipilih
                                        </span>

                                        <h3 class="fw-bold">
                                            Meja {{ $meja->kode_meja }}
                                        </h3>

                                    </div>


                                    <div class="row g-4">

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

                                    </div>


                                    @if ($meja->deskripsi)

                                        <div class="mt-4">

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

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TOMBOL --}}
                    {{-- ================================================= --}}

                    <div class="text-center mt-5">

                    <form
    action="{{ route('reservasi.pilih-meja') }}"
    method="POST"
    class="d-inline"
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

    <button
        type="submit"
        class="btn btn-outline-secondary me-2"
    >
        <i class="bi bi-arrow-left me-2"></i>
        Ubah Meja
    </button>

</form>


<form
    action="{{ route('reservasi.simpan') }}"
    method="POST"
    class="d-inline"
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
        class="btn btn-recommend"
    >
        <i class="bi bi-check-circle me-2"></i>
        Konfirmasi Reservasi
    </button>

</form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection