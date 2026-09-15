@extends('layouts.app')

@section('title', 'Rekomendasi Meja - Kopi Naki')

@section('content')

<section class="reservation-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="reservation-card">

                    {{-- ===================================================== --}}
                    {{-- HEADER --}}
                    {{-- ===================================================== --}}

                    <div class="text-center mb-5">

                        <div class="preference-icon mb-3">
                            <i class="bi bi-stars"></i>
                        </div>

                        <h2 class="reservation-title">
                            Rekomendasi Meja
                        </h2>

                        <p class="reservation-subtitle">
                            Berikut rekomendasi meja yang sesuai
                            dengan data dan preferensi reservasi Anda.
                        </p>

                    </div>

                    {{-- ===================================================== --}}
                    {{-- HASIL REKOMENDASI --}}
                    {{-- ===================================================== --}}

                    @if(count($hasilRekomendasi) > 0)

                        <div class="mb-4">

                            <h5 class="fw-bold">

                                <i class="bi bi-trophy me-2"></i>

                                Rekomendasi Tempat Duduk

                            </h5>

                            <p class="text-muted">

                                Sistem memberikan tiga rekomendasi meja
                                yang paling sesuai dengan data dan
                                preferensi Anda.

                            </p>

                        </div>


                        <div class="row g-4">

                            @foreach($hasilRekomendasi as $index => $hasil)

                                <div class="col-md-4">

                                    <div class="card feature-card h-100">

                                        {{-- ================================================= --}}
                                        {{-- GAMBAR MEJA --}}
                                        {{-- ================================================= --}}

                                        @if($hasil['meja']->gambar)

                                            <img
                                                src="{{ asset('images/tables/' . $hasil['meja']->gambar) }}"
                                                class="card-img-top"
                                                style="height: 220px; object-fit: cover;"
                                                alt="Meja {{ $hasil['meja']->kode_meja }}"
                                            >

                                        @endif


                                        <div class="card-body d-flex flex-column">

                                            {{-- ================================================= --}}
                                            {{-- LABEL REKOMENDASI --}}
                                            {{-- ================================================= --}}

                                            <div class="mb-3">

                                                @if($index === 0)

                                                    <span class="badge bg-warning text-dark">

                                                        <i class="bi bi-trophy-fill me-1"></i>

                                                        Rekomendasi Utama

                                                    </span>

                                                @elseif($index === 1)

                                                    <span class="badge bg-secondary">

                                                        <i class="bi bi-2-circle me-1"></i>

                                                        Rekomendasi Kedua

                                                    </span>

                                                @elseif($index === 2)

                                                    <span class="badge bg-secondary">

                                                        <i class="bi bi-3-circle me-1"></i>

                                                        Rekomendasi Ketiga

                                                    </span>

                                                @endif

                                            </div>


                                            {{-- ================================================= --}}
                                            {{-- KODE MEJA --}}
                                            {{-- ================================================= --}}

                                            <h4 class="fw-bold">

                                                Meja {{ $hasil['meja']->kode_meja }}

                                            </h4>


                                            {{-- ================================================= --}}
                                            {{-- INFORMASI MEJA --}}
                                            {{-- ================================================= --}}

                                            <div class="row g-3 mt-2">

                                                {{-- KAPASITAS --}}
                                                <div class="col-12">

                                                    <small class="text-muted">
                                                        Kapasitas
                                                    </small>

                                                    <div>

                                                        <i class="bi bi-people me-1"></i>

                                                        {{ $hasil['meja']->kapasitas }}
                                                        orang

                                                    </div>

                                                </div>


                                                {{-- LANTAI --}}
                                                <div class="col-12">

                                                    <small class="text-muted">
                                                        Lokasi
                                                    </small>

                                                    <div>

                                                        <i class="bi bi-building me-1"></i>

                                                        Lantai
                                                        {{ $hasil['meja']->lantai }}

                                                    </div>

                                                </div>


                                                {{-- PEMANDANGAN --}}
                                                <div class="col-12">

                                                    <small class="text-muted">
                                                        Pemandangan
                                                    </small>

                                                    <div>

                                                        <i class="bi bi-image me-1"></i>

                                                        {{ ucfirst($hasil['meja']->pemandangan) }}

                                                    </div>

                                                </div>


                                                {{-- FASILITAS --}}
                                                <div class="col-12">

                                                    <small class="text-muted">
                                                        Fasilitas
                                                    </small>

                                                    <div>

                                                        <i class="bi bi-geo-alt me-1"></i>

                                                        @switch($hasil['meja']->fasilitas)

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


                                            {{-- ================================================= --}}
                                            {{-- TOMBOL PILIH MEJA --}}
                                            {{-- ================================================= --}}

                                            <div class="mt-auto pt-4">

<form
    action="{{ route('reservasi.konfirmasi') }}"
    method="POST"
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
    <input type="hidden" name="meja_id" value="{{ $hasil['meja']->id }}">

    <button
        type="submit"
        class="btn btn-recommend w-100"
    >
        <i class="bi bi-calendar-check me-2"></i>
        Pilih Meja Ini
    </button>

</form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        {{-- ================================================= --}}
                        {{-- PILIH MEJA LAIN --}}
                        {{-- ================================================= --}}

                        <div class="text-center mt-5">

                            <p class="text-muted mb-3">

                                Tidak menemukan meja yang sesuai dengan
                                keinginan Anda?

                            </p>

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
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-grid-3x3-gap me-2"></i>
        Pilih Meja Lain
    </button>
</form>

                        </div>


                        {{-- ================================================= --}}
                        {{-- KEMBALI KE FORM --}}
                        {{-- ================================================= --}}

                        <div class="text-center mt-3">

                            <a
                                href="{{ route('reservasi.create') }}"
                                class="btn btn-link text-muted"
                            >

                                <i class="bi bi-arrow-left me-2"></i>

                                Ubah Data Reservasi

                            </a>

                        </div>


                    @else

                        {{-- ================================================= --}}
                        {{-- TIDAK ADA REKOMENDASI --}}
                        {{-- ================================================= --}}

                        <div class="text-center py-5">

                            <i class="bi bi-exclamation-circle fs-1"></i>

                            <h4 class="fw-bold mt-3">

                                Tidak Ada Meja yang Sesuai

                            </h4>

                            <p class="text-muted">

                                Tidak ditemukan meja yang dapat
                                menampung jumlah peserta Anda.

                            </p>

                            <a
                                href="{{ route('reservasi.create') }}"
                                class="btn btn-recommend"
                            >

                                <i class="bi bi-arrow-left me-2"></i>

                                Kembali ke Form

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

@endsection