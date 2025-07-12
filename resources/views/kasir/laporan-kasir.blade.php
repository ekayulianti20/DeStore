@extends('kasir.layout-kasir')

@section('title', 'Laporan Kasir')

@section('content')
    <div class="container-search-tanggal">
        <nav class="navbar">
            <div class="container-fluid">
                <form class="d-flex" role="search">
                    <div class="input-group">
                        <!-- Tanggal input (disembunyikan dulu) -->
                        <input id="datePicker" class="form-control me-2" type="date" />

                        <!-- Tombol cari -->
                        <button class="btn btn-outline-success" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </nav>
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-warning fw-bold">Cetak</button>
    </div>

    <div class="container-table-laporan">
        <table class="table">
            <thead class="thead-custom">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Detail</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">ID Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>001</td>
                    <td>06/05/2025</td>
                    <td>001</td>
                    <td>Kaos Ukuran XL</td>
                    <td>10</td>
                    <td class="subTotal">500000</td>
                </tr>
            </tbody>
        </table>
        <!-- Bootstrap Pagination -->
        <nav>
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container-recap">
        <div class="row text-start">
            <!-- Kolom 1: Jumlah Transaksi -->
            <div class="col-md-4">
                <label class="fw-bold">Jumlah Transaksi :</label>
                <input type="text" id="jumlahTransaksi" class="form-control border border-success mt-1" />
            </div>

            <!-- Kolom 2: Pendapatan -->
            <div class="col-md-4">
                <label class="fw-bold">Pendapatan :</label>
                <input type="text" id="totalPendapatan" class="form-control border border-success mt-1" />
            </div>

            <!-- Kolom 3: Keuntungan -->
            <div class="col-md-4">
                <label class="fw-bold">Keuntungan :</label>
                <input type="text" id="keuntungan" class="form-control border border-success mt-1" />
            </div>
        </div>
    </div>




    <!-- Script untuk memunculkan date input saat kotak search diklik -->
    <script>
        const searchBox = document.getElementById('searchBox');
        const datePicker = document.getElementById('datePicker');

        searchBox.addEventListener('focus', function() {
            datePicker.style.display = 'block'; // tampilkan input tanggal saat fokus
        });

        // Opsional: sembunyikan kembali jika ingin saat kehilangan fokus
        searchBox.addEventListener('blur', function() {
            // Tunggu sebentar agar user bisa klik datePicker
            setTimeout(() => {
                if (document.activeElement !== datePicker) {
                    datePicker.style.display = 'none';
                }
            }, 200);
        });

        datePicker.addEventListener('blur', function() {
            datePicker.style.display = 'none'; // sembunyikan saat datePicker kehilangan fokus
        });
    </script>

    <!-- Script untuk memunculkan data -->
    <script>
        function hitungLaporan() {
            const tabel = document.querySelector('table');
            const rows = tabel.querySelectorAll('tbody tr');

            let jumlahTransaksi = 0;
            let totalPendapatan = 0;

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length > 0) {
                    jumlahTransaksi++;
                    const subTotal = parseFloat(cells[6].textContent) || 0;
                    totalPendapatan += subTotal;
                }
            });

            const keuntungan = totalPendapatan * 0.6;

            // ISI KE INPUT
            document.getElementById('jumlahTransaksi').value = jumlahTransaksi;
            document.getElementById('totalPendapatan').value = `Rp ${formatRupiah(totalPendapatan)}`;
            document.getElementById('keuntungan').value = `Rp ${formatRupiah(keuntungan)}`;
        }

        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID');
        }

        window.onload = hitungLaporan;
    </script>



@endsection
