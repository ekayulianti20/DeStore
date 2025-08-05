@extends('kasir.layout-kasir')

@section('title', 'Transaksi')

@section('content')

    <div class="container-input-grup">
        <div class="container-input-transaksi">
            <div class="row text-start">
                <div class="col-md-6">
                    <label class="fw-bold">Pilih Tanggal :</label>
                    <input id="datePicker" class="form-control border border-success me-2" type="date" />
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="w-100">
                        <label class="fw-bold">Pilih Produk :</label>
                        <div class="input-group">
                            <select id="produkSelect" class="form-select border border-success">
                                <option selected disabled>Pilih Produk</option>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->id_produk }}" data-nama="{{ $p->nama_produk }}"
                                        data-harga="{{ $p->harga_satuan }}">
                                        {{ $p->id_produk }} - {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button onclick="tambahProduk()" class="btn ms-2"
                        style="background-color: #2A9D8F; color: white; height: 38px;">
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
            <tbody id="tabelTransaksiBody">
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
                <input type="text" id="jumlahTransaksi" class="form-control border border-success mt-1" placeholder="0" />
            </div>

            <!-- Kolom 2: Pendapatan -->
            <div class="col-md-4">
                <label class="fw-bold">Nominal Uang :</label>
                <input type="text" id="totalPendapatan" class="form-control border border-success mt-1" placeholder="Rp." />
            </div>

            <!-- Kolom 3: Keuntungan -->
            <div class="col-md-4">
                <label class="fw-bold">Kembalian :</label>
                <input type="text" id="keuntungan" class="form-control border border-success mt-1" placeholder="Rp." />
            </div>
        </div>
    </div>

    <!-- Tombol Cetak -->
    <div class="d-flex justify-content-end">
        <form id="formStruk" action="{{ route('kasir.struk') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="id_transaksi" id="id_transaksi_hidden">
            <button type="button" class="btn btn-warning-struk fw-bold" onclick="printStruk()">Cetak Struk</button>
        </form>
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
        let cartItems = [];
        let currentPage = 1;
        const itemsPerPage = 2;

        function renderTable() {
            const tbody = document.getElementById('tabelTransaksiBody');
            tbody.innerHTML = '';

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentItems = cartItems.slice(startIndex, endIndex);

            currentItems.forEach((item, index) => {
                tbody.innerHTML += `
                        <tr>
                            <td>${item.id_produk}</td>
                            <td>${item.nama_produk}</td>
                            <td>Rp ${item.harga_satuan.toLocaleString()}</td>
                            <td>${item.jumlah_beli}</td>
                            <td>Rp ${item.sub_total.toLocaleString()}</td>
                            <td>
                                <button class='btn btn-danger btn-sm' onclick='hapusItem(${startIndex + index})'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </td>
                        </tr>
                    `;
            });

            renderPagination();
            updateTotal();
            hitungKembalian();
        }

        function renderPagination() {
            const totalPages = Math.ceil(cartItems.length / itemsPerPage);
            const paginationContainer = document.querySelector('.pagination');
            paginationContainer.innerHTML = '';

            // Previous
            paginationContainer.innerHTML += `
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Previous</a>
                    </li>`;

            for (let i = 1; i <= totalPages; i++) {
                paginationContainer.innerHTML += `
                        <li class="page-item ${currentPage === i ? 'active' : ''}">
                            <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                        </li>`;
            }

            // Next
            paginationContainer.innerHTML += `
                    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>
                    </li>`;
        }

        function changePage(page) {
            const totalPages = Math.ceil(cartItems.length / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderTable();
        }

        function tambahProduk() {
            const select = document.getElementById('produkSelect');
            const id_produk = select.value;
            const nama_produk = select.options[select.selectedIndex].dataset.nama;
            const harga_satuan = parseFloat(select.options[select.selectedIndex].dataset.harga);

            if (!id_produk) return alert('Pilih produk terlebih dahulu!');
            if (isNaN(harga_satuan)) return alert('Harga produk tidak valid!');

            const jumlah_beli = parseInt(prompt(`Masukkan jumlah beli untuk ${nama_produk}`));
            if (!jumlah_beli || isNaN(jumlah_beli)) return alert('Jumlah beli tidak valid!');

            const existingIndex = cartItems.findIndex(item => item.id_produk === id_produk);

            if (existingIndex !== -1) {
                // Produk sudah ada → tambahkan jumlah dan subtotal
                cartItems[existingIndex].jumlah_beli += jumlah_beli;
                cartItems[existingIndex].sub_total = cartItems[existingIndex].harga_satuan * cartItems[existingIndex].jumlah_beli;
            } else {
                // Produk baru
                const sub_total = harga_satuan * jumlah_beli;
                cartItems.push({ id_produk, nama_produk, harga_satuan, jumlah_beli, sub_total });
            }

            renderTable();
        }

        function updateTotal() {
            let total = cartItems.reduce((sum, item) => sum + item.sub_total, 0);
            document.getElementById('jumlahTransaksi').value = `Rp ${total.toLocaleString()}`;
        }

        function hitungKembalian() {
            const totalStr = document.getElementById('jumlahTransaksi').value.replace(/[^0-9]/g, '');
            const total = parseFloat(totalStr) || 0;
            const nominal = parseFloat(document.getElementById('totalPendapatan').value) || 0;
            const kembalian = nominal - total;
            document.getElementById('keuntungan').value = `Rp ${kembalian >= 0 ? kembalian.toLocaleString() : 0}`;
        }

        const totalInput = document.getElementById('totalPendapatan');
        if (totalInput) {
            totalInput.addEventListener('input', hitungKembalian);
        }

        function hapusItem(index) {
            cartItems.splice(index, 1);
            renderTable();
        }

        function printStruk() {
            const totalStr = document.getElementById('jumlahTransaksi').value.replace(/[^0-9]/g, '');
            const totalBelanja = parseFloat(totalStr);
            const nominalUang = parseFloat(document.getElementById('totalPendapatan').value);
            const kembalianStr = document.getElementById('keuntungan').value.replace(/[^0-9]/g, '');
            const kembalian = parseFloat(kembalianStr);

            if (cartItems.length === 0) {
                alert('Belum ada produk yang ditambahkan!');
                return;
            }

            fetch("{{ route('kasir.transaksi.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    total_harga: totalBelanja,
                    nominal_uang: nominalUang,
                    kembalian: kembalian,
                    produk: cartItems
                })
            })
                .then(res => res.json())
                .then(data => {
                    console.log('RESPON TRANSAKSI:', data); // <-- Debug penting
                    if (data.success && data.id_transaksi) {
                        document.getElementById('id_transaksi_hidden').value = data.id_transaksi;

                        setTimeout(() => {
                            document.getElementById('formStruk').submit();
                            setTimeout(() => location.reload(), 1500);
                        }, 300); // pastikan nilai masuk dulu sebelum submit
                    } else {
                        alert("Gagal menyimpan transaksi: " + (data.error ?? 'ID transaksi tidak dikembalikan.'));
                    }
                })
                .catch(err => {
                    console.error('ERROR FETCH:', err);
                    alert('Terjadi kesalahan saat menyimpan transaksi!');
                });
        }

        // Optional untuk input tanggal
        const searchBox = document.getElementById('searchBox');
        const datePicker = document.getElementById('datePicker');

        if (searchBox) {
            searchBox.addEventListener('focus', function () {
                datePicker.style.display = 'block';
            });

            searchBox.addEventListener('blur', function () {
                setTimeout(() => {
                    if (document.activeElement !== datePicker) {
                        datePicker.style.display = 'none';
                    }
                }, 200);
            });
        }
    </script>

@endsection