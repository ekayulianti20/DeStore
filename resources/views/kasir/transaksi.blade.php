@extends('kasir.layout-kasir')

@section('title', 'Transaksi')

@section('content')
    `
    <div class="container-input-grup">
        <div class="container-input-transaksi">
            <div class="row text-start">
                <div class="col-md-6">
                    <label class="fw-bold">Pilih Tanggal :</label>
                    <input id="datePicker" class="form-control border border-success me-2" type="date" />
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="w-100">
                        <label class="fw-bold">ID Produk :</label>
                        <div class="input-group">
                            <input type="text" class="form-control border border-success" />
                            <span class="input-group-text bg-white border-success">
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
                        </div>
                    </div>
                    <button class="btn ms-2" style="background-color: #2A9D8F; color: white; height: 38px;">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-table-transaksi">
        <table class="table">
            <thead class="thead-custom">
                <tr>
                    <th scope="col">ID Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>Kaos Ukuran XL</td>
                    <td>50000</td>
                    <td>10</td>
                    <td>500000</td>
                    <td>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
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

    <div class="container-recap-transaksi">
        <div class="row text-start">
            <!-- Kolom 1: Jumlah Transaksi -->
            <div class="col-md-4">
                <label class="fw-bold">Total Belanja :</label>
                <input type="text" id="jumlahTransaksi" class="form-control border border-success mt-1"
                    placeholder="0" />
            </div>

            <!-- Kolom 2: Pendapatan -->
            <div class="col-md-4">
                <label class="fw-bold">Nominal Uang :</label>
                <input type="text" id="totalPendapatan" class="form-control border border-success mt-1"
                    placeholder="Rp." />
            </div>

            <!-- Kolom 3: Keuntungan -->
            <div class="col-md-4">
                <label class="fw-bold">Kembalian :</label>
                <input type="text" id="keuntungan" class="form-control border border-success mt-1" placeholder="Rp." />
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-warning-struk fw-bold">Cetak Struk</button>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <strong>Kaos Ukuran XL</strong> (ID: 001)?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
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
@endsection
