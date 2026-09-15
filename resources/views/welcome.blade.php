<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kopi Naki - Reservasi Café</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #3e2723;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #d7ccc8 !important;
        }

        .hero {
            min-height: 90vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: white;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero h1 {
            font-size: 55px;
            font-weight: bold;
        }

        .hero p {
            font-size: 19px;
        }

        .btn-coffee {
            background-color: #6d4c41;
            color: white;
            border: none;
        }

        .btn-coffee:hover {
            background-color: #4e342e;
            color: white;
        }

        .section-title {
            color: #3e2723;
            font-weight: bold;
        }

        .feature-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background-color: #efebe9;
            color: #5d4037;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background-color: #6d4c41;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 15px;
        }

        .cta {
            background-color: #3e2723;
            color: white;
        }

        footer {
            background-color: #211512;
            color: #ddd;
        }

        /* ================= DENAH MEJA ================= */

        .table-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .table-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12) !important;
        }


        /* ================= DETAIL MEJA ================= */

        .table-detail-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }


        .table-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: #555;
        }


        .table-info-item i {
            width: 35px;
            height: 35px;

            display: flex;
            align-items: center;
            justify-content: center;

            background-color: #f1e7dc;
            color: #8b5e3c;

            border-radius: 8px;
        }


        .table-info-item strong {
            color: #333;
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-cup-hot-fill"></i>
                Kopi Naki
            </a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
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
                        <a class="nav-link px-3" href="#cara-reservasi">
                            Pembatalan Reservasi
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a href="/login" class="btn btn-outline-light">
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

                <a href="/login" class="btn btn-coffee btn-lg px-4">
                    <i class="bi bi-calendar-check"></i>
                    Reservasi Sekarang
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
                            Rekomendasi Kursi
                        </h5>

                        <p class="text-muted">
                            Dapatkan rekomendasi tempat duduk
                            berdasarkan preferensi menggunakan metode SAW.
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

    <!-- ================= DENAH MEJA ================= -->
    <section class="py-5" id="denah">

        <div class="container py-4">

            <!-- ================= JUDUL DENAH ================= -->
            <div class="text-center mb-5">

                <p class="text-muted mb-1">
                    Area Café
                </p>

                <h2 class="section-title">
                    Denah Tempat Duduk
                </h2>

                <p class="text-muted">
                    Lihat posisi meja yang tersedia dan klik meja
                    untuk melihat informasi lebih lengkap.
                </p>

            </div>


            <!-- =================================================
             LANTAI 1
        ================================================== -->
            <div class="floor-plan mb-5">

                <!-- Judul Lantai -->
                <div class="area-title mb-4">
                    <h2 class="section-title">
                        Lantai 1
                    </h2>
                </div>


                <!-- Daftar Meja -->
                <div class="row g-4">


                    <!-- ================= M101 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM101" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M101
                            </h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M102 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM102" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M102
                            </h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M103 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM103" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M103
                            </h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M104 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM104" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M104
                            </h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M105 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM105" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M105
                            </h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M106 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM106" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M106
                            </h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M107 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM107" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M107
                            </h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>

                    </div>


                    <!-- ================= M108 ================= -->
                    <div class="col-md-3 col-lg-2">

                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM108" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>
                                M108
                            </h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
             LANTAI 2
        ================================================== -->
            <div class="floor-plan mb-5">

                <div class="area-title mb-4">
                    <h2 class="section-title">
                        Lantai 2
                    </h2>
                </div>


                <div class="row g-4">

                    <!-- M201 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM201" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M201</h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M202 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM202" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M202</h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M203 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM203" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M203</h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M204 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM204" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M204</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M205 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM205" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M205</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M206 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM206" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M206</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M207 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM207" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M207</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M208 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM208" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M208</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M209 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM209" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M209</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <!-- M210 -->
                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM210" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M210</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>

                </div>

            </div>


            <!-- =================================================
             LANTAI 3
        ================================================== -->
            <div class="floor-plan mb-5">

                <div class="area-title mb-4">
                    <h2 class="section-title">
                        Lantai 3
                    </h2>
                </div>


                <div class="row g-4">

                    <!-- M301 - M315 -->

                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM301" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M301</h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM302" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M302</h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM303" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M303</h5>

                            <p class="text-muted small mb-0">
                                2 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM304" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M304</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM305" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M305</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM306" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M306</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM307" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M307</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM308" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M308</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM309" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M309</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM310" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M310</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM311" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M311</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM312" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M312</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM313" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M313</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM314" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M314</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>


                    <div class="col-md-3 col-lg-2">
                        <div class="card feature-card shadow-sm p-4 text-center table-card" data-bs-toggle="modal"
                            data-bs-target="#modalM315" style="cursor: pointer;">

                            <div class="feature-icon">
                                <i class="bi bi-table"></i>
                            </div>

                            <h5>M315</h5>

                            <p class="text-muted small mb-0">
                                4 Orang
                            </p>

                        </div>
                    </div>

                </div>

            </div>

        </div>

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

            <a href="reservasi.blade" class="btn btn-light btn-lg px-4">
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


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>