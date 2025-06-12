    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>QR Code Absensi - @yield('title', 'Beranda')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        @yield('styles')
        <style>
            body {
                background-color: #f5f5f5;
            }
        </style>
    </head>

    <body>

        <!-- Navbar -->
        @yield('navbar')

        <!-- Main Content -->
        <main class="py-4">
            @yield('main-content')
        </main>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            const scanner = new Html5Qrcode("reader");

            const config = {
                fps: 10,
                qrbox: 250
            };

            const beepSound = document.getElementById('beep-sound');

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    scanner.start(devices[0].id, config, onScanSuccess);
                }
            }).catch(err => {
                console.error("Gagal mengakses kamera:", err);
            });

            function onScanSuccess(decodedText, decodedResult) {
                beepSound.play();
                scanner.stop().then(() => {
                    let id = decodedText;

                    $.ajax({
                        url: "{{route('validasiqr')}}",
                        type: 'POST',
                        data: {
                            '_method': 'POST',
                            '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'qr_code': id
                        },
                        success: function(response) {
                            const now = new Date();

                            // Format waktu
                            const time = now.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });

                            // Format tanggal
                            const date = now.toLocaleDateString('id-ID', {
                                weekday: 'long', // contoh: Senin
                                year: 'numeric',
                                month: 'long', // contoh: Juni
                                day: 'numeric'
                            });

                            Swal.fire({
                                icon: 'success',
                                title: `Selamat Datang ${response.member.name}`,
                                html: `${date}, ${time}`,
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                // Setelah tombol diklik, hidupkan kembali kamera
                                Html5Qrcode.getCameras().then(devices => {
                                    if (devices && devices.length) {
                                        scanner.start(devices[0].id, config, onScanSuccess);
                                    }
                                });
                            });
                        },


                        error: function(xhr) {
                            let icon = 'error';
                            let title = 'Gagal!';
                            let message = xhr.responseJSON?.message;

                            if (xhr.status === 403) {
                                icon = 'warning';
                                title = 'Sudah Absen!';
                            }

                            Swal.fire({
                                icon: icon,
                                title: title,
                                html: message,
                                confirmButtonColor: '#d33'
                            }).then(() => {
                                Html5Qrcode.getCameras().then(devices => {
                                    if (devices && devices.length) {
                                        scanner.start(devices[0].id, config, onScanSuccess);
                                    }
                                });
                            });
                        }
                    });
                });

            }
        </script>
    </body>

    </html>