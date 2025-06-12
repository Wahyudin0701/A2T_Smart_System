@extends('layouts.camera')

@section('title', 'Scan QR GYM')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="bi bi-qr-code-scan"></i> QR Absensi
        </a>

        <!-- Tombol Dashboard lebih stylish -->
        <a href="{{ route('dashboard') }}" class="btn btn-light text-danger fw-semibold shadow-sm rounded px-4 py-1 d-flex align-items-center">
            Dashboard
        </a>
    </div>
</nav>
@endsection

@section('main-content')
<div class="container">
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h3>Absensi Anggota GYM</h3>
    </div>

    <div class="row">
        <!-- Tips -->
        <div class="col-md-3 mb-3">
            <div class="card card-custom p-3">
                <h5>Tips</h5>
                <ul class="mb-0">
                    <li>Tunjukkan QR Code sampai terlihat jelas di kamera</li>
                    <li>Posisikan QR Code tidak terlalu jauh atau dekat</li>
                </ul>
            </div>
        </div>

        <!-- Scanner -->
        <div class="col-md-6 mb-3">
            <div class="card card-custom p-3 text-center">
                <h5 class="mb-3">Silakan Tunjukkan QR Code Anda</h5>

                <div class="camera-box mb-3">
                    <!-- Simulasi kamera -->
                    <div id="reader" style="width: 100%;"></div>
                    <div id="result" class="mt-3 fw-semibold"></div>
                </div>
            </div>
        </div>

        <!-- Penggunaan -->
        <div class="col-md-3 mb-3">
            <div class="card card-custom p-3">
                <h5>Petunjuk</h5>
                <ul>
                    <li>Jika berhasil scan, data akan muncul di bawah kamera</li>
                    <li>Untuk melihat data, klik tombol <span class="text-primary">Dashboard</span></li>
                    <li>Login diperlukan untuk mengakses halaman Admin</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<audio id="beep-sound" src="{{ asset('sounds/beep.mp3') }}"></audio>
@endsection
