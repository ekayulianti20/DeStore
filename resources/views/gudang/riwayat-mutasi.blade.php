@extends ('gudang.layout-gudang')

@section('title','Riwayat Mutasi')

@section('content')

<div class="pencarian-tanggal">
<input type="date" class="form-control" id="tanggalMutasi">
</div>

<!-- Tabel Riwayat Mutasi -->
<div class="table-container">
    <table class="table table-bordered text-center" id="tabelMutasi">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>ID Mutasi</th>
                <th>ID Produk</th>
                <th>Tanggal Mutasi</th>
                <th>Tipe Mutasi</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data Inputan -->
        </tbody>
    </table>
</div>

@endsection