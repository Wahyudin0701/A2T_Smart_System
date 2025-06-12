<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- Bootstrap Icons (optional but recommended for better UI) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @yield('scripts')
</body>

</html>