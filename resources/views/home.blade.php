@extends('layouts.app')

@section('title', 'Café Kopi Naki - Cepogo Boyolali')

@section('content')


<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-cup-hot-fill"></i>
            Kopi Naki
        </a>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

            <li class="nav-item">
    <a class="nav-link px-3" href="#beranda">
        Beranda
    </a>
</li>

<li class="nav-item">
    <a class="nav-link px-3" href="#fitur">
        Fitur
    </a>
</li>

<li class="nav-item">
    <a class="nav-link px-3" href="#cara-reservasi">
        Cara Reservasi
    </a>
</li>


<li class="nav-item">
    <a class="nav-link px-3" href="#pembatalan">
        Cek Reservasi
    </a>
</li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light">
                        Login Admin
                    </a>
                </li>


            </ul>

        </div>
    </div>
</nav>


<!-- ================= HERO ================= -->
<section class="hero" id="beranda">

    <div class="container">

        <div class="hero-content">

            <p class="mb-2">
                Selamat Datang di
            </p>

            <h1>
                Kopi Naki
            </h1>

            <h3 class="mb-3">
                Café & Coffee Space
            </h3>

            <p class="mb-4">
                Nikmati suasana nyaman bersama teman dan keluarga.
                Pesan tempat duduk favoritmu dengan mudah melalui
                sistem reservasi online.
            </p>

            <a href="{{ route('reservasi.create') }}" class="btn btn-coffee btn-lg px-4">
                <i class="bi bi-calendar-check"></i>
                Reservasi Sekarang
            </a>

            <a href="#pembatalan" class="btn btn-outline-light btn-lg px-4 ms-2 mt-2 mt-md-0">
                <i class="bi bi-search"></i>
                Cek Reservasi
            </a>

        </div>

    </div>

</section>


<!-- ================= FITUR ================= -->
<section class="py-5" id="fitur">

    <div class="container py-4">

        <div class="text-center mb-5">

            <p class="text-muted mb-1">
                Fasilitas Sistem
            </p>

            <h2 class="section-title">
                Reservasi Lebih Mudah
            </h2>

            <p class="text-muted">
                Nikmati kemudahan melakukan reservasi tanpa harus
                datang langsung ke café.
            </p>

        </div>


        <div class="row g-4">

            <!-- Fitur 1 -->
            <div class="col-md-6 col-lg-3">

                <div class="card feature-card shadow-sm p-4 text-center">

                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <h5>
                        Reservasi Online
                    </h5>

                    <p class="text-muted">
                        Lakukan reservasi tempat kapan saja
                        melalui website.
                    </p>

                </div>

            </div>


            <!-- Fitur 2 -->
            <div class="col-md-6 col-lg-3">

                <div class="card feature-card shadow-sm p-4 text-center">

                    <div class="feature-icon">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </div>

                    <h5>
                        Pilih Tempat Duduk
                    </h5>

                    <p class="text-muted">
                        Lihat dan pilih tempat duduk yang
                        masih tersedia.
                    </p>

                </div>

            </div>


            <!-- Fitur 3 -->
            <div class="col-md-6 col-lg-3">

                <div class="card feature-card shadow-sm p-4 text-center">

                    <div class="feature-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <h5>
                        Rekomendasi Meja
                    </h5>

                    <p class="text-muted">
                        Dapatkan rekomendasi meja berdasarkan
                        preferensi menggunakan metode SAW.
                    </p>

                </div>

            </div>


            <!-- Fitur 4 -->
            <div class="col-md-6 col-lg-3">

                <div class="card feature-card shadow-sm p-4 text-center">

                    <div class="feature-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>

                    <h5>
                        Pembayaran DP
                    </h5>

                    <p class="text-muted">
                        Lakukan pembayaran uang muka untuk
                        mengamankan reservasi.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= CARA RESERVASI ================= -->
<section class="py-5 bg-light" id="cara-reservasi">

    <div class="container py-4">

        <div class="text-center mb-5">

            <p class="text-muted mb-1">
                Proses Reservasi
            </p>

            <h2 class="section-title">
                Cara Melakukan Reservasi
            </h2>

        </div>


        <div class="row g-4">

            <!-- Step 1 -->
            <div class="col-md-3 text-center">

                <div class="step-number">
                    1
                </div>

                <h5>
                    Login
                </h5>

                <p class="text-muted">
                    Masuk atau buat akun terlebih dahulu.
                </p>

            </div>


            <!-- Step 2 -->
            <div class="col-md-3 text-center">

                <div class="step-number">
                    2
                </div>

                <h5>
                    Pilih Tanggal
                </h5>

                <p class="text-muted">
                    Tentukan tanggal dan waktu reservasi.
                </p>

            </div>


            <!-- Step 3 -->
            <div class="col-md-3 text-center">

                <div class="step-number">
                    3
                </div>

                <h5>
                    Pilih Kursi
                </h5>

                <p class="text-muted">
                    Pilih kursi atau gunakan rekomendasi SAW.
                </p>

            </div>


            <!-- Step 4 -->
            <div class="col-md-3 text-center">

                <div class="step-number">
                    4
                </div>

                <h5>
                    Bayar DP
                </h5>

                <p class="text-muted">
                    Lakukan pembayaran uang muka dan tunggu
                    konfirmasi admin.
                </p>

            </div>

        </div>

    </div>

</section>
<!-- ================= KETENTUAN PEMBAYARAN ================= -->
<section class="py-5" id="ketentuan-pembayaran">

    <div class="container py-4">

        <div class="text-center mb-5">

            <p class="text-muted mb-1">
                Informasi Pembayaran
            </p>

            <h2 class="section-title">
                Ketentuan Pembayaran
            </h2>

            <p class="text-muted">
                Perhatikan ketentuan pembayaran sebelum melakukan reservasi.
            </p>

        </div>


        <div class="row g-4 justify-content-center">

            <!-- Ketentuan 1 -->
            <div class="col-md-4">

                <div class="card feature-card shadow-sm h-100 p-4 text-center">

                    <div class="feature-icon mb-3">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                    <h5 class="fw-bold">
                        Pembayaran Rp15.000 / Orang
                    </h5>

                    <p class="text-muted mb-0">
                        Setiap orang yang melakukan reservasi dikenakan
                        uang muka sebesar <strong>Rp15.000 per orang</strong>.
                    </p>

                </div>

            </div>


            <!-- Ketentuan 2 -->
            <div class="col-md-4">

                <div class="card feature-card shadow-sm h-100 p-4 text-center">

                    <div class="feature-icon mb-3">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <h5 class="fw-bold">
                        Batas Pembayaran 20 Menit
                    </h5>

                    <p class="text-muted mb-0">
                        Setelah reservasi dibuat, pelanggan memiliki waktu
                        <strong>20 menit</strong> untuk melakukan pembayaran.
                        Jika melewati batas waktu, reservasi dapat dibatalkan
                        secara otomatis.
                    </p>

                </div>

            </div>


            <!-- Ketentuan 3 -->
            <div class="col-md-4">

                <div class="card feature-card shadow-sm h-100 p-4 text-center">

                    <div class="feature-icon mb-3">
                        <i class="bi bi-cart-check"></i>
                    </div>

                    <h5 class="fw-bold">
                        Dapat Digunakan untuk Pembelian
                    </h5>

                    <p class="text-muted mb-0">
                        Uang muka yang telah dibayarkan dapat digunakan
                        untuk melakukan pembelian makanan dan minuman
                        di Café Kopi Naki.
                    </p>

                </div>

            </div>

        </div>


        <!-- Catatan -->
        <div class="row justify-content-center mt-4">

            <div class="col-lg-10">

                <div class="alert alert-warning d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill me-3 mt-1"></i>

                    <div>
                        <strong>Catatan Penting</strong>

                        <p class="mb-0 mt-1">
                            Uang muka sebesar Rp15.000 per orang
                            <strong>tidak dapat dikembalikan (refund)</strong>.
                            Uang muka tersebut tetap dapat digunakan untuk
                            melakukan pembelian makanan dan minuman di
                            Café Kopi Naki.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= CEK RESERVASI ================= -->
<section class="py-5" id="pembatalan">

    <div class="container py-4">

        <div class="text-center mb-5">

            <p class="text-muted mb-1">
                Cek Status
            </p>

            <h2 class="section-title">
                Cek Kode Reservasi
            </h2>

            <p class="text-muted">
                Masukkan kode reservasi untuk melihat data, status saat ini,
                dan mengajukan pembatalan jika diperlukan.
            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="reservation-card">

                    @if ($errors->has('kode'))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first('kode') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('reservasi.cek') }}">

                        <label class="form-label">Kode Reservasi</label>

                        <div class="input-group input-group-lg">
                            <input
                                type="text"
                                name="kode"
                                class="form-control"
                                value="{{ old('kode') }}"
                                placeholder="Contoh: KNK-ABC123"
                                required
                            >
                            <button type="submit" class="btn btn-coffee">
                                <i class="bi bi-search me-1"></i>
                                Cek
                            </button>
                        </div>

                    </form>

                    <p class="small text-muted mt-3 mb-0">
                        Jika reservasi sudah dibayar, pembatalan meminta nomor rekening
                        untuk pengembalian uang muka. Admin akan memverifikasi pembatalan
                        dan mengembalikan DP.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= DENAH MEJA ================= -->

<section id="denah" class="py-5">

    ```
    <div class="container">

        <!-- ================= JUDUL DENAH ================= -->
        <div class="text-center mb-5">

            <h2 class="section-title">
                Detail Tempat Duduk
            </h2>

            <p class="text-muted">
                Lihat posisi meja yang tersedia dan klik meja
                untuk melihat informasi lebih lengkap.
            </p>

        </div>


        <!-- ================= DENAH PER LANTAI ================= -->

        @for ($lantai = 1; $lantai <= 3; $lantai++) <div class="mb-5">

            <!-- Judul Lantai -->
            <h3 class="area-title mb-4">
                <i class="bi bi-building"></i>
                Lantai {{ $lantai }}
            </h3>


            <!-- Daftar Meja -->
            <div class="row g-4">

                @foreach ($mejas->where('lantai', $lantai) as $meja)

                <div class="col-6 col-md-4 col-lg-3">

                    <div class="card feature-card table-card h-100" data-bs-toggle="modal"
                        data-bs-target="#modal{{ $meja->kode_meja }}" style="cursor: pointer;">

                        <div class="card-body text-center">

                            <!-- Icon Meja -->
                            <div class="feature-icon mb-3">
                                <i class="bi bi-table"></i>
                            </div>


                            <!-- Kode Meja -->
                            <h5 class="fw-bold">
                                {{ $meja->kode_meja }}
                            </h5>


                            <!-- Kapasitas -->
                            <p class="mb-1">
                                <i class="bi bi-people"></i>
                                {{ $meja->kapasitas }} Orang
                            </p>


                            <!-- Pemandangan -->
                            <small class="text-muted">
                                {{ ucfirst($meja->pemandangan) }}
                            </small>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

    </div>

    @endfor


    <!-- ================= MODAL INFORMASI MEJA ================= -->

    @foreach ($mejas as $meja)

    <div class="modal fade" id="modal{{ $meja->kode_meja }}" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <!-- Header Modal -->
                <div class="modal-header">

                    <h5 class="modal-title">
                        Meja {{ $meja->kode_meja }}
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>


                <!-- Isi Modal -->
                <div class="modal-body">


                    <!-- Foto Meja -->
                    @if ($meja->gambar)

                    <img src="{{ asset('images/tables/' . $meja->gambar) }}" class="img-fluid rounded mb-3 w-100"
                        alt="Meja {{ $meja->kode_meja }}">

                    @endif


                    <!-- Nama Meja -->
                    <h5 class="fw-bold">
                        Meja {{ $meja->kode_meja }}
                    </h5>


                    <!-- Deskripsi -->
                    @if ($meja->deskripsi)

                    <p class="text-muted">
                        {{ $meja->deskripsi }}
                    </p>

                    @endif


                    <hr>


                    <!-- Informasi Meja -->
                    <div class="row">


                        <!-- Lantai -->
                        <div class="col-6 mb-3">

                            <strong>
                                <i class="bi bi-building"></i>
                                Lantai
                            </strong>

                            <br>

                            {{ $meja->lantai }}

                        </div>


                        <!-- Kapasitas -->
                        <div class="col-6 mb-3">

                            <strong>
                                <i class="bi bi-people"></i>
                                Kapasitas
                            </strong>

                            <br>

                            {{ $meja->kapasitas }} orang

                        </div>


                        <!-- Pemandangan -->
                        <div class="col-6">

                            <strong>
                                <i class="bi bi-eye"></i>
                                Pemandangan
                            </strong>

                            <br>

                            {{ ucfirst($meja->pemandangan) }}

                        </div>


                        <!-- Fasilitas -->
                        <div class="col-6">

                            <strong>
                                <i class="bi bi-geo-alt"></i>
                                Fasilitas
                            </strong>

                            <br>

                            {{ ucfirst($meja->fasilitas) }}

                        </div>

                    </div>

                </div>


                <!-- Footer Modal -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>


                    <a href="{{ route('reservasi.create') }}" class="btn btn-coffee">

                        <i class="bi bi-calendar-check"></i>

                        Reservasi Meja

                    </a>

                </div>


            </div>

        </div>

    </div>

    @endforeach

    </div>
    ```

</section>


<!-- ================= CTA ================= -->
<section class="cta py-5">

    <div class="container text-center py-4">

        <h2 class="fw-bold mb-3">
            Siap Melakukan Reservasi?
        </h2>

        <p class="mb-4">
            Pesan tempat duduk favoritmu sekarang
            dan nikmati waktu bersama orang-orang terdekat.
        </p>

        <a href="{{ route('reservasi.create') }}" class="btn btn-light btn-lg px-4">
            <i class="bi bi-calendar-plus"></i>
            Mulai Reservasi

        </a>

    </div>

</section>


<!-- ================= FOOTER ================= -->
<footer class="py-4">

    <div class="container">

        <div class="row">

            <div class="col-md-6">

                <h5>
                    <i class="bi bi-cup-hot-fill"></i>
                    Kopi Naki
                </h5>

                <p class="small mb-0">
                    Sistem Reservasi Café Berbasis Web
                </p>

            </div>


            <div class="col-md-6 text-md-end">

                <p class="small mb-1">
                    Café Kopi Naki Cepogo, Boyolali
                </p>

                <p class="small mb-0">
                    &copy; {{ date('Y') }} Kopi Naki.
                    All Rights Reserved.
                </p>

            </div>

        </div>

    </div>

</footer>

@endsection