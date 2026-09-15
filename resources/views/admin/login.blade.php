@extends('layouts.app')

@section('title', 'Login Admin - Kopi Naki')

@section('content')

<section class="reservation-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="reservation-card">
                    <div class="text-center mb-4">
                        <div class="preference-icon mx-auto mb-3">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h2 class="reservation-title">Login Admin</h2>
                        <p class="reservation-subtitle mb-0">
                            Masuk untuk memverifikasi pembayaran reservasi.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.proses') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kata Sandi</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-recommend w-100">
                            Masuk
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="text-muted">Kembali ke beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
