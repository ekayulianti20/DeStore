@extends('admin.layout-admin')

@section('title', 'Dashboard')

@section('content')


    <div class="container-dashboard">
        <div class="card-dashboard masuk">
            <div class="icon"><i class="fas fa-boxes"></i></div>
            <div class="info">
                <h3 id="produkMasuk"></h3>
                <p>Produk Masuk</p>
            </div>
        </div>

        <div class="card-dashboard keluar">
            <div class="icon"><i class="fas fa-dolly-flatbed"></i></div>
            <div class="info">
                <h3 id="produkKeluar"></h3>
                <p>Produk Keluar</p>
            </div>
        </div>

        <div class="card-dashboard total">
            <div class="icon"><i class="fas fa-database"></i></div>
            <div class="info">
                <h3 id="totalProduk"></h3>
                <p>Total Produk</p>
            </div>
        </div>
    </div>

    <div class="card-wrapper">
        <div class="card card-pengguna" onclick="window.location.href='/admin/pengguna'">
            <div class="card-title">Pengguna</div>
        </div>
        <div class="card card-data-produk" onclick="window.location.href='{{ route('admin.data-produk-admin.index') }}'">
            <div class="card-title">Data Produk</div>
        </div>
        <div class="card card-laporan" onclick="window.location.href='/laporan-admin'">
            <div class="card-title">Laporan</div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        // Simulasi data dari backend
        const totalStok = {{ $stok }};
        const totalTerjual = {{ $jumlah_beli }};
        const totalDataProduk = {{ $id_produk }};

        document.getElementById("produkMasuk").innerText = totalStok;
        document.getElementById("produkKeluar").innerText = totalStok - totalTerjual;
        document.getElementById("totalProduk").innerText = totalDataProduk;
    </script>
@endsection