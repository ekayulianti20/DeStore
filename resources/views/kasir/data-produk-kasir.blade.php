@extends('kasir.layout-kasir')

@section('title', 'Data Produk Kasir')

@section('content')

    <div class="container-search-data">
        <nav class="navbar">
            <div class="container-fluid">
                <form class="d-flex w-50" role="search" id="formPencarian">
                    <input class="form-control border-success me-2" type="search" placeholder="Cari Nama/Kategori Produk"
                        aria-label="Search" id="inputPencarian" />
                    <button class="btn btn-outline-success" type="button" id="btnCari">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Tabel Produk -->
    <table class="table table-bordered text-center" id="tabelProduk">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->id_produk }}</td>
                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ ucwords(trim($p->kategori)) }}</td>
                    <td>Rp {{ number_format($p->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $p->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-danger">Data produk tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p id="pesanTidakDitemukan" class="text-center text-danger mt-3" style="display: none;">
        Data tidak ditemukan.
    </p>

        <!-- Script Pencarian -->
    <script>
        document.getElementById("btnCari").addEventListener("click", function () {
            const keyword = document.getElementById("inputPencarian").value.toLowerCase().trim();
            const rows = document.querySelectorAll("#tabelProduk tbody tr");
            let ditemukan = false;

            rows.forEach(row => {
                const namaProduk = row.cells[2].textContent.toLowerCase().trim();
                const kategoriProduk = row.cells[3].textContent.toLowerCase().trim();

                console.log("Kategori:", kategoriProduk); // debug
                console.log("Keyword:", keyword);         // debug

                const cocok = namaProduk.includes(keyword) || kategoriProduk.includes(keyword);
                row.style.display = cocok ? "table-row" : "none";
                if (cocok) ditemukan = true;
            });

            document.getElementById("pesanTidakDitemukan").style.display = ditemukan ? "none" : "block";
        });

        // Reset input pencarian saat klik di luar
        document.addEventListener("click", function (e) {
            const input = document.getElementById("inputPencarian");
            const button = document.getElementById("btnCari");

            if (!input.contains(e.target) && !button.contains(e.target)) {
                input.value = "";
                document.querySelectorAll("#tabelProduk tbody tr").forEach(row => {
                    row.style.display = "";
                });
                document.getElementById("pesanTidakDitemukan").style.display = "none";
            }
        });
    </script>
@endsection