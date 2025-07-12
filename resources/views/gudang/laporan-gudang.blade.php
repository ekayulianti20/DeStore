@extends ('gudang.layout-gudang')

@section('title','Laporan Gudang')

@section('content')

<!-- Pencarian Tanggal -->
<div class=" pencarian-tanggal mb-3 row align-items-center">
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
        <input type="date" class="form-control" id="tanggalAkhir">
    </div>
</div>

<!-- Cetak -->
</button>
<button class="btn btn-cetak text-white mb-3 float-end" onclick="cetakPDF()">
    Cetak
</button>


<!-- Tabel Laporan Gudang-->
<div class="table-container">
    <div id="LapGudang">
        <table class="table table-bordered text-center" id="tabelLapGudang">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>ID Laporan</th>
                    <th>Tanggal Mutasi</th>
                    <th>Nama Produk</th>
                    <th>Tipe Mutasi</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Inputan -->
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<div class=" info row mt-3">
    <div class="col-md-3">
        <label for="produkMasuk" class="form-label fw-semibold">Produk Masuk :</label>
        <input type="text" class="form-control border-teal" id="produkMasuk" readonly>
    </div>
    <div class="col-md-3">
        <label for="produkKeluar" class="form-label fw-semibold">Produk Keluar :</label>
        <input type="text" class="form-control border-teal" id="produkKeluar" readonly>
    </div>
    <div class="col-md-3">
        <label for="totalProduk" class="form-label fw-semibold">Total Produk :</label>
        <input type="text" class="form-control border-teal" id="totalProduk" readonly>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function formatDate(date) {
        // Mengubah objek Date menjadi format yyyy-mm-dd
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

        // Reset input bulan agar tidak bentrok
        document.getElementById("pilihBulanLain").value = "";
    }

    function setBulanManual(monthValue) {
        if (!monthValue) return;

        const [year, month] = monthValue.split('-');
        const tanggalAwal = document.getElementById("tanggalAwal");
        const tanggalAkhir = document.getElementById("tanggalAkhir");

        const firstDay = new Date(year, month - 1, 1);
        const lastDay = new Date(year, month, 0);

        tanggalAwal.value = formatDate(firstDay);
        tanggalAkhir.value = formatDate(lastDay);

        // Reset dropdown agar tidak bentrok
        document.getElementById("filterTanggal").value = "";
    }

    function cetakPDF() {
        const element = document.getElementById('LapGudang');
        const opt = {
            margin: 0.5,
            filename: 'laporan-gudang.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'F4',
                orientation: 'lanscape'
            }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>


@endsection