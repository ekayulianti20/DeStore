<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DeStore</title>

  <!-- Fonts Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <!-- My Style -->
  <link rel="stylesheet" href="{{  asset('css/dashboard-gudang.css') }}">

  <!-- Feather Icon -->
  <script src="https://unpkg.com/feather-icons"></script>

</head>

<body>

  <!-- Sidebar -->
  <div class="container">

    <div class="sidebar">
      <div class="header-sidebar">
        <div class="list-item">
          <a href="a">
            <img src="" alt="" class="logo">
            <span class="brand">DeStore</span>
          </a>
        </div>
      </div>
      <div class="main-sidebar">
        <div class="list-item">
          <a href="#">
            <img src="" alt="" class="dashboard-gudang">
            <span class="dashboard-g">Dashboard</span>
          </a>
          <a href="#">
            <img src="" alt="" class="dataproduk-gudang">
            <span class="dataproduk-g">Data Produk</span>
          </a>
          <a href="#">
            <img src="" alt="" class="riwayatmutasi-gudang">
            <span class="riwayatmutasi-g">Riwayat Mutasi</span>
          </a>
          <a href="#">
            <img src="" alt="" class="laporan-gudang">
            <span class="laporan-g">Laporan Gudang</span>
          </a>
        </div>
      </div>
    </div>

    <div class="navbar">
      <div class="main-navbar">
        <div class="list-navbar">
          <div class="menu">
            <i data-feather="menu"></i>
            <span class="judul-menu">Dashboard</span>
          </div>
        </div>
      <div class="notifikasi">
        <div class="notif">
          <i data-feather="bell"></i>
        </div>
        <div class="akun">
          <div class="list-akun">
            <img src="" alt="" class="pp">
            <span class="nama-akun">Gudang</span>
            <div class="dropdown-akun">
              <i data-feather="chevron-down"></i>
            </div>
          </div>
        </div>
      </div>
      </div>

    </div>
  </div>

  <script>
    feather.replace();
  </script>
</body>

</html>