@extends('layouts.camera')

@section('title', 'Scan QR GYM')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-qr-code-scan"></i> QR Absensi
            </a>

            <!-- Tombol Dashboard lebih stylish -->
            <a href="{{ route('admin.home') }}" class="btn btn-light text-danger fw-semibold shadow-sm rounded px-4 py-1 d-flex align-items-center">
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
                    <video id="preview" width="100%" height="auto" autoplay></video>
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
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    // Contoh penggunaan kamera dan scan QR (simulasi)
    const video = document.getElementById('preview');
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                video.srcObject = stream;
            })
            .catch(function(error) {
                console.error("Kamera tidak tersedia:", error);
            });
    }
</script>
@endsection