@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-cup-hot-fill"></i>
            Admin Kopi Naki
        </a>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#adminMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('admin.reservasi.index') ? 'active' : '' }}" href="{{ route('admin.reservasi.index') }}">
                        Kelola Reservasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('admin.meja.*') ? 'active' : '' }}" href="{{ route('admin.meja.index') }}">
                        Data Meja
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('admin.reservasi.histori*') ? 'active' : '' }}" href="{{ route('admin.reservasi.histori') }}">
                        Histori
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="reservation-section">
    <div class="container">
        @yield('admin')
    </div>
</section>

@endsection
