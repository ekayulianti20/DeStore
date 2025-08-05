@extends('gudang.layout-gudang')

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