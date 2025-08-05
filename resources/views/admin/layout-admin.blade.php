<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DeStore | Admin</title>
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Sacramento&family=Work+Sans:wght@100&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        </div>
        <div class="main-content">
            <div class="header-main">
                <nav class="navbar bg-body-primary">
                    <div class="container-fluid">
                        <a class="navbar-brand">
                            <img src={{ asset('img/menu.svg') }} alt="" class="icon">
                            <span>@yield('title', 'Dashboard')</span>
                        </a>
                        <div class="dropdown">
                            <a href="#">
                                <img src={{ asset('img/bell.svg') }} alt="" class="icon">
                            </a>
                            <button class="btn my-custom-button dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <a href="#">
                                    <img src={{ asset('img/acc.png') }} alt="" class="icon">
                                    <span class="description">Admin</span>
                                </a>
                            </button>
                            <ul class="dropdown-menu">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Keluar Sebagai Admin</button>
                                </form>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="dash-container">
                <nav class="d-flex align-items-center"
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">

                    <ol class="breadcrumb mb-0 me-auto">
                        <li class="breadcrumb-item"><a href="/dashboard-admin">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>@yield('title', 'Dashboard')</span>
                        </li>
                    </ol>

                    <ol class="breadcrumb breadcrumb-date mb-0">
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bi bi-calendar-date me-1"></i>
                            <span id="tanggal-hari-ini"></span>
                        </li>
                    </ol>
                </nav>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>

    <script>
        const today = new Date();
        const tanggal = today.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('tanggal-hari-ini').textContent = tanggal;
    </script>

</body>

</html>