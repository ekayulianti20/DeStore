<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DeStore</title>
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Sacramento&family=Work+Sans:wght@100&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="layout-container">
        <div class="sidebar">
            <div class="header">
                <div class="list-item">
                    <a href="#">
                        <img src={{ asset('img/logo2.png') }} alt="" class="logo">
                        <span class="description-header">DeStore</span>
                    </a>
                </div>
            </div>
            <div class="main">
                <div class="list-item">
                    <a href="{{ route('kasir.dashboard-kasir') }}">
                        <img src={{ asset('img/home2.svg') }} alt="" class="icon-default">
                        <img src={{ asset('img/home.svg') }} alt="" class="icon-hover">
                        <span class="description">Dashboard</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="{{ route('kasir.data-produk-kasir') }}">
                        <img src={{ asset('img/data.svg') }} alt="" class="icon-default">
                        <img src={{ asset('img/data2.svg') }} alt="" class="icon-hover">
                        <span class="description">Data Produk</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="{{ route('kasir.transaksi') }}">
                        <img src={{ asset('img/kasir.svg') }} alt="" class="icon-default">
                        <img src={{ asset('img/kasir2.svg') }} alt="" class="icon-hover">
                        <span class="description">Transaksi</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="{{ route('kasir.laporan-kasir') }}">
                        <img src={{ asset('img/lap-kasir.svg') }} alt="" class="icon-default">
                        <img src={{ asset('img/lap-kasir2.svg') }} alt="" class="icon-hover">
                        <span class="description">Laporan Kasir</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="header-main">
                <nav class="navbar bg-body-primary">
                    <div class="container-fluid">
                        <a class="navbar-brand">
                            <img src={{ asset('img/menu.svg') }} alt="" class="icon">
                            <span> Dashboard </span>
                        </a>
                        <div class="dropdown">
                            <a href="#">
                                <img src={{ asset('img/bell.svg') }} alt="" class="icon">
                            </a>
                            <button class="btn my-custom-button dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <a href="#">
                                    <img src={{ asset('img/acc.png') }} alt="" class="icon">
                                    <span class="description">Kasir</span>
                                </a>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            @yield('content')
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
