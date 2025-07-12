<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeStore</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="{{ asset('css/gudang.css') }}">
</head>

<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="header-sidebar">
                <div>
                    <img src="{{ asset('img/logo2.png') }}" alt="logo" class="logo">
                </div>
                <div class="nama">DeStore</div>
            </div>
            <div>
                <ul class="list-sidebar">
                    <li class="sidebar-dashboard">
                        <a href="{{ url('/dashboard-gudang') }}"
                            class="link-sidebar {{ request()->is('dashboard-gudang') ? 'active' : '' }}">
                            <img src="{{ asset('img/home-putih.png') }}" class="logo-sidebar">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-dataproduk">
                        <a href="{{ url('/data-produk') }}"
                            class="link-sidebar {{ request()->is('data-produk') ? 'active' : '' }}">
                            <img src="{{ asset('img/data.svg') }}" class="logo-sidebar">
                            <span>Data Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-riwayatmutasi">
                        <a href="{{ url('/riwayat-mutasi') }}"
                            class="link-sidebar {{ request()->is('riwayat-mutasi') ? 'active' : '' }}">
                            <img src="{{ asset('img/riwayat-mutasi.png') }}" class="logo-sidebar">
                            <span>Riwayat Mutasi</span>
                        </a>
                    </li>
                    <li class="sidebar-laporan">
                        <a href="{{ url('/laporan-gudang') }}"
                            class="link-sidebar {{ request()->is('laporan-gudang') ? 'active' : '' }}">
                            <img src="{{ asset('img/lap-kasir.svg') }}" class="logo-sidebar">
                            <span>Laporan Gudang</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Navbar -->
            <div class="navbar">
                <div class="menu">
                    <i data-feather="menu"></i>
                    <span>@yield('title', 'Dashboard')</span>
                </div>
                <div class="navbar-kanan d-flex align-items-center gap-3">
                    <img src="{{ asset('img/bell.svg') }}" alt="notif" class="notif">
                    <div class="akun">
                        <div class="container-akun d-flex align-items-center gap-2">
                            <img src="{{ asset('img/acc.png') }}" alt="pp" class="pp">
                            <span class="role">Gudang</span>
                            <div class="dropdown">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="content-atas d-flex justify-content-between align-items-center mb-3">
                    <div class="content-kiri d-flex align-items-center">
                        <div class="apk"><span>DeStore</span></div>
                        <div class="next mx-2"><i data-feather="chevron-right"></i></div>
                        <div class="menu-content"><span>@yield('title', 'Dashboard')</span></div>
                    </div>
                    <div class="content-kanan d-flex align-items-center gap-2">
                        <div class="ikon-calendar"><i data-feather="calendar"></i></div>
                        <div class="kalender" id="tanggal"></div>
                    </div>
                </div>

                {{-- Konten --}}
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Feather Icons Replace -->
    <script>
        feather.replace();

        // Tanggal Hari Ini
        const tanggal = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById("tanggal").textContent = tanggal.toLocaleDateString("id-ID", options);
    </script>
</body>

</html>