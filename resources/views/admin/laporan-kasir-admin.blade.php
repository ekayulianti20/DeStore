@extends('admin.layout-admin')

@section('title', 'Laporan Kasir Admin')

@section('content')
    <div class="container-search-tanggal">
        <nav class="navbar">
            <div class="col-md-3">
                <label for="filterTanggal" class="form-label fw-semibold">Rentang Waktu</label>
                <select class="form-select" id="filterTanggal" onchange="aturRentangTanggal()">
                    <option value="">Pilih Rentang Waktu</option>
                    <option value="hari">Hari Ini</option>
                    <option value="minggu">1 Minggu Terakhir</option>
                    <option value="bulan">1 Bulan Terakhir</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="pilihBulanLain" class="form-label fw-semibold">Pilih Bulan</label>
                <input type="month" class="form-control" id="pilihBulanLain" onchange="setBulanManual(this.value)">
            </div>
            <div class="col-md-3">
                <label for="tanggalAwal" class="form-label fw-semibold">Tanggal Awal</label>
                <input type="date" class="form-control" id="tanggalAwal">
            </div>
            <div class="col-md-3">
                <label for="tanggalAkhir" class="form-label fw-semibold">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tanggalAkhir" onchange="ambilDataLaporan()">
            </div>
        </nav>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-warning fw-bold" onclick="cetakPDF()">Cetak</button>
    </div>

    <div id="LapKasir">
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
                <tbody id="isiTabelLaporan">
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
    </div>

    <!-- Library html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        function aturRentangTanggal() {
            const pilihan = document.getElementById("filterTanggal").value;
            const tanggalAwal = document.getElementById("tanggalAwal");
            const tanggalAkhir = document.getElementById("tanggalAkhir");
            const today = new Date();

            if (pilihan === "hari") {
                tanggalAwal.value = formatDate(today);
                tanggalAkhir.value = formatDate(today);
            } else if (pilihan === "minggu") {
                const semingguLalu = new Date(today);
                semingguLalu.setDate(today.getDate() - 6);
                tanggalAwal.value = formatDate(semingguLalu);
                tanggalAkhir.value = formatDate(today);
            } else if (pilihan === "bulan") {
                const sebulanLalu = new Date(today);
                sebulanLalu.setMonth(today.getMonth() - 1);
                tanggalAwal.value = formatDate(sebulanLalu);
                tanggalAkhir.value = formatDate(today);
            } else {
                tanggalAwal.value = "";
                tanggalAkhir.value = "";
            }

            document.getElementById("pilihBulanLain").value = "";
            ambilDataLaporan();
        }

        function setBulanManual(monthValue) {
            if (!monthValue) return;
            const [year, month] = monthValue.split('-');
            const firstDay = new Date(year, month - 1, 1);
            const lastDay = new Date(year, month, 0);
            document.getElementById("tanggalAwal").value = formatDate(firstDay);
            document.getElementById("tanggalAkhir").value = formatDate(lastDay);
            document.getElementById("filterTanggal").value = "";
            ambilDataLaporan();
        }

        function ambilDataLaporan() {
            const awal = document.getElementById('tanggalAwal').value;
            const akhir = document.getElementById('tanggalAkhir').value;

            fetch(`/kasir/api/laporan-kasir?tanggal_awal=${awal}&tanggal_akhir=${akhir}`)
                .then(res => res.json())
                .then(res => {
                    const tbody = document.getElementById('isiTabelLaporan');
                    tbody.innerHTML = '';
                    res.data.forEach((item, index) => {
                        tbody.innerHTML += `
                                                <tr>
                                                    <td>${index + 1}</td>
                                                    <td>${item.id_detail}</td>
                                                    <td>${item.tanggal_transaksi}</td>
                                                    <td>${item.id_produk}</td>
                                                    <td>${item.nama_produk}</td>
                                                    <td>${item.jumlah_beli}</td>
                                                    <td>${item.sub_total}</td>
                                                </tr>
                                            `;
                        });


                    document.getElementById('jumlahTransaksi').value = res.jumlah_transaksi;
                    document.getElementById('totalPendapatan').value = formatRupiah(res.total_pendapatan);
                    document.getElementById('keuntungan').value = formatRupiah(res.keuntungan);
                });
        }
        function cetakPDF() {
            const element = document.getElementById('LapKasir');
            const opt = {
                margin: 0.5,
                filename: 'laporan-kasir.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }
            };
            html2pdf().set(opt).from(element).save();
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }
    </script>

@endsection