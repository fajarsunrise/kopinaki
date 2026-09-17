@extends('layouts.app')

@section('title', 'Reservasi - Kopi Naki')

@section('content')

<section class="reservation-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="reservation-card">

                    {{-- HEADER --}}
                    <div class="text-center mb-4">

                        <h2 class="reservation-title">
                            Form Reservasi
                        </h2>

                        <p class="reservation-subtitle">
                            Isi data reservasi dan preferensi tempat duduk
                            untuk mendapatkan rekomendasi meja terbaik.
                        </p>

                    </div>


                    {{-- INFORMASI --}}
                    <div class="info-box">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-info-circle-fill me-3 mt-1"></i>

                            <div>

                                <strong>
                                    Informasi Reservasi
                                </strong>

                                <p class="mb-0 mt-1 small text-muted">

                                    Pastikan data yang Anda masukkan sudah benar.
                                    Sistem akan menggunakan preferensi tempat duduk
                                    untuk memberikan rekomendasi meja.

                                </p>

                            </div>

                        </div>

                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif


                    {{-- FORM --}}
                    <form action="{{ route('reservasi.rekomendasi') }}" method="POST">
                    @csrf


                        {{-- DATA PELANGGAN --}}
                        <div class="form-section-title">

                            <i class="bi bi-person me-2"></i>

                            Data Pelanggan

                        </div>


                        <div class="row g-4">

                            {{-- NAMA --}}
                            <div class="col-md-6">

                                <label for="nama" class="form-label">

                                    Nama Lengkap
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama"
                                    name="nama"
                                    placeholder="Masukkan nama lengkap"
                                    required>

                            </div>


                            {{-- WHATSAPP --}}
                            <div class="col-md-6">

                                <label for="whatsapp" class="form-label">

                                    Nomor WhatsApp
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    inputmode="numeric"
                                    pattern="[0-9]{4,14}"
                                    class="form-control"
                                    id="whatsapp"
                                    name="whatsapp"
                                    minlength="4"
                                    maxlength="14"
                                    placeholder="Contoh: 081234567890"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 14);"
                                    required>

                                <small class="text-muted">
                                    Nomor digunakan untuk informasi reservasi.
                                </small>

                            </div>


                            {{-- ALAMAT --}}
                            <div class="col-12">

                                <label for="alamat" class="form-label">

                                    Alamat
                                    <span class="required">*</span>

                                </label>

                                <textarea
                                    class="form-control"
                                    id="alamat"
                                    name="alamat"
                                    rows="3"
                                    placeholder="Masukkan alamat Anda"
                                    required></textarea>

                            </div>

                        </div>


                        <hr class="my-5">


                        {{-- DETAIL RESERVASI --}}
                        <div class="form-section-title">

                            <i class="bi bi-calendar-check me-2"></i>

                            Detail Reservasi

                        </div>


                        <div class="row g-4">

                            {{-- TANGGAL --}}
                            <div class="col-md-6">

                                <label for="tanggal" class="form-label">

                                    Tanggal Reservasi
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="date"
                                    class="form-control"
                                    id="tanggal"
                                    name="tanggal"
                                    min="{{ now()->addDay()->toDateString() }}"
                                    value="{{ old('tanggal') }}"
                                    required>

                                <small class="text-muted">
                                    Tanggal hari ini tidak dapat dipilih.
                                </small>

                            </div>


                            {{-- JAM --}}
                            <div class="col-md-6">

                                <label for="jam" class="form-label">

                                    Jam Reservasi
                                    <span class="required">*</span>

                                </label>

                                <select
                                    class="form-select"
                                    id="jam"
                                    name="jam"
                                    required>

                                    <option value="" selected disabled>
                                        Pilih jam
                                    </option>

                                    @for ($menit = 10 * 60; $menit <= (20 * 60 + 30); $menit += 30)
                                        @php
                                            $jamOpsi = sprintf('%02d:%02d', intdiv($menit, 60), $menit % 60);
                                        @endphp
                                        <option value="{{ $jamOpsi }}" @selected(old('jam') === $jamOpsi)>
                                            {{ $jamOpsi }}
                                        </option>
                                    @endfor

                                </select>

                                <small class="text-muted">
                                    Tersedia pukul 10.00 hingga 20.30.
                                </small>

                            </div>


                            {{-- JUMLAH PESERTA --}}
                            <div class="col-md-6">

                                <label for="jumlah_peserta" class="form-label">

                                    Jumlah Peserta
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    id="jumlah_peserta"
                                    name="jumlah_peserta"
                                    min="1"
                                    placeholder="Contoh: 4"
                                    oninput="if(this.value < 1) this.value = '';"
                                    required>

                                <small class="text-muted">
                                    Masukkan jumlah orang yang akan datang.
                                </small>

                            </div>

                        </div>


                        <hr class="my-5">


                        {{-- PREFERENSI --}}
                        <div class="form-section-title">

                            <i class="bi bi-grid-3x3-gap me-2"></i>

                            Preferensi Tempat Duduk

                        </div>


                        <p class="text-muted small mb-4">

                            Pilih preferensi tempat duduk yang Anda inginkan.
                            Data ini akan digunakan sebagai kriteria rekomendasi
                            menggunakan metode SAW.

                        </p>


                        <div class="row g-4">

                            {{-- LANTAI --}}
                            <div class="col-md-4">

                                <div class="preference-card">

                                    <div class="preference-icon">

                                        <i class="bi bi-building"></i>

                                    </div>

                                    <label for="lantai" class="form-label">
                                        Lantai
                                    </label>
                                    <select
                                        class="form-select"
                                        id="lantai"
                                        name="lantai"
                                        required>

                                        <option value="" @selected(old('lantai') === null || old('lantai') === '')>
                                            Pilih lantai
                                        </option>
                                        <option value="1" @selected(old('lantai') == '1')>Lantai 1</option>
                                        <option value="2" @selected(old('lantai') == '2')>Lantai 2</option>
                                        <option value="3" @selected(old('lantai') == '3')>Lantai 3</option>

                                    </select>

                                </div>

                            </div>


                            {{-- PEMANDANGAN --}}
                            <div class="col-md-4">

                                <div class="preference-card">

                                    <div class="preference-icon">

                                        <i class="bi bi-image"></i>

                                    </div>

                                    <label for="pemandangan" class="form-label">
                                        Pemandangan
                                    </label>

                                    <select
                                        class="form-select"
                                        id="pemandangan"
                                        name="pemandangan"
                                        required>

                                        <option value="">
                                            Pilih pemandangan
                                        </option>
                                        <option value="indoor" @selected(old('pemandangan') === 'indoor')>
                                            Indoor
                                        </option>
                                        <option value="outdoor" @selected(old('pemandangan') === 'outdoor')>
                                            Outdoor
                                        </option>

                                    </select>

                                </div>

                            </div>


                            {{-- FASILITAS --}}
<div class="col-md-4">

    <div class="preference-card">

        <div class="preference-icon">

            <i class="bi bi-geo-alt"></i>

        </div>

        <label for="fasilitas" class="form-label">
            Kedekatan dengan Fasilitas
        </label>

        <select
            class="form-select"
            id="fasilitas"
            name="fasilitas"
            required>

            <option value="">
                Pilih fasilitas
            </option>
            <option value="parkiran" data-lantai="1" @selected(old('fasilitas') === 'parkiran')>
                Dekat dengan Parkiran
            </option>
            <option value="kasir" data-lantai="1" @selected(old('fasilitas') === 'kasir')>
                Dekat dengan Kasir
            </option>
            <option value="no_smoking" data-lantai="2" @selected(old('fasilitas') === 'no_smoking')>
                Area No Smoking
            </option>
            <option value="kamar_mandi" data-lantai="3" @selected(old('fasilitas') === 'kamar_mandi')>
                Dekat dengan Kamar Mandi
            </option>
            <option value="mushola" data-lantai="3" @selected(old('fasilitas') === 'mushola')>
                Dekat dengan Mushola
            </option>

        </select>

    </div>

</div>

                        </div>


                        {{-- TOMBOL --}}
                        <div class="text-center mt-5 d-flex justify-content-center gap-2 flex-wrap">

                        </button>
{{-- KEMBALI KE MENU UTAMA --}}
<a
    href="{{ route('home') }}"
    class="btn btn-outline-secondary">

    <i class="bi bi-arrow-left me-2"></i>

    Kembali ke Menu Utama

</a>
{{-- CARI REKOMENDASI --}}

<button
    type="submit"
    class="btn btn-recommend">

    <i class="bi bi-stars me-2"></i>

    Cari Rekomendasi Meja



</div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection

@section('js')
<script>
    (function () {
        const aturan = {
            1: {
                pemandangan: ['indoor', 'outdoor'],
                fasilitas: ['parkiran', 'kasir']
            },
            2: {
                pemandangan: ['indoor'],
                fasilitas: ['no_smoking']
            },
            3: {
                pemandangan: ['indoor', 'outdoor'],
                fasilitas: ['kamar_mandi', 'mushola']
            }
        };

        const lantaiSelect = document.getElementById('lantai');
        const pemandanganSelect = document.getElementById('pemandangan');
        const fasilitasSelect = document.getElementById('fasilitas');
        const tanggalInput = document.getElementById('tanggal');

        function aturOpsi(select, allowed) {
            const current = select.value;
            Array.from(select.options).forEach(function (option) {
                if (!option.value) {
                    option.disabled = false;
                    option.hidden = false;
                    return;
                }
                const boleh = allowed.indexOf(option.value) !== -1;
                option.disabled = !boleh;
                option.hidden = !boleh;
            });

            if (current && allowed.indexOf(current) === -1) {
                select.value = '';
            }
        }

        function terapkanLantai() {
            const lantai = lantaiSelect.value;
            const aturanLantai = aturan[lantai];

            if (!aturanLantai) {
                aturOpsi(pemandanganSelect, []);
                aturOpsi(fasilitasSelect, []);
                pemandanganSelect.value = '';
                fasilitasSelect.value = '';
                return;
            }

            aturOpsi(pemandanganSelect, aturanLantai.pemandangan);
            aturOpsi(fasilitasSelect, aturanLantai.fasilitas);
        }

        lantaiSelect.addEventListener('change', terapkanLantai);
        terapkanLantai();

        if (tanggalInput) {
            tanggalInput.addEventListener('change', function () {
                if (tanggalInput.min && tanggalInput.value && tanggalInput.value < tanggalInput.min) {
                    tanggalInput.value = '';
                    alert('Tanggal hari ini tidak dapat dipilih. Silakan pilih tanggal berikutnya.');
                }
            });
        }
    })();
</script>
@endsection