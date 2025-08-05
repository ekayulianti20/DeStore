@extends ('gudang.layout-gudang')

@section('title', 'Data Produk')

@section('content')

    <!-- Pencarian -->
    <div class="input-group mb-3 w-50 gap-3">
        <input type="text" class="form-control" id="inputPencarian" placeholder="Cari Nama / Kategori Produk">
        <button class="btn btn-sm btn-edit me-1" type="button" id="btnCari">
            <i data-feather="search"></i>
        </button>
    </div>

    <!-- Tambah Produk -->
    <button class="btn btn-tambah text-white mb-3 float-end" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
        <i data-feather="plus"></i> Tambah Produk
    </button>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="tambahProdukModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('produk.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>ID Produk</label>
                        <input type="text" name="id_produk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Satuan</label>
                        <input type="number" name="harga_satuan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Modal</label>
                        <input type="number" name="harga_modal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tipe Mutasi</label>
                        <select name="tipe_mutasi" class="form-control" required>
                            <option value="in">Masuk</option>
                            <option value="out">Keluar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div>
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->id_produk }}</td>
                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ $p->kategori }}</td>
                    <td>Rp {{ number_format($p->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>
                        <!-- Button Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editProdukModal{{ $p->id_produk }}">
                            <i data-feather="edit"></i>
                        </button>
                        <!-- Button Hapus -->
                        <form action="{{ route('produk.destroy', $p->id_produk) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>

                        <!-- Modal Edit Produk -->
                        <div class="modal fade" id="editProdukModal{{ $p->id_produk }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('produk.update', $p->id_produk) }}" method="POST"
                                    class="modal-content">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title">Edit Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama Produk</label>
                                            <input type="text" name="nama_produk" class="form-control"
                                                value="{{ $p->nama_produk }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Kategori</label>
                                            <input type="text" name="kategori" class="form-control"
                                                value="{{ $p->kategori }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Harga Satuan</label>
                                            <input type="number" name="harga_satuan" class="form-control"
                                                value="{{ $p->harga_satuan }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Harga Modal</label>
                                            <input type="number" name="harga_modal" class="form-control"
                                                value="{{ $p->harga_modal }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Stok</label>
                                            <input type="number" name="stok" class="form-control"
                                                value="{{ $p->stok }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tipe Mutasi</label>
                                            <select name="tipe_mutasi" class="form-control" required>
                                                <option value="in">Masuk</option>
                                                <option value="out">Keluar</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="2"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-warning" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </td>
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
        document.getElementById("btnCari").addEventListener("click", function() {
            const keyword = document.getElementById("inputPencarian").value.toLowerCase();
            const rows = document.querySelectorAll("#tabelProduk tbody tr");
            let ditemukan = false;

            rows.forEach(row => {
                const namaProduk = row.cells[2].textContent.toLowerCase();
                const kategoriProduk = row.cells[3].textContent.toLowerCase();

                const cocok = namaProduk.includes(keyword) || kategoriProduk.includes(keyword);
                row.style.display = cocok ? "" : "none";
                if (cocok) ditemukan = true;
            });

            document.getElementById("pesanTidakDitemukan").style.display = ditemukan ? "none" : "block";
        });

        // Reset input pencarian saat klik di luar
        document.addEventListener("click", function(e) {
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
