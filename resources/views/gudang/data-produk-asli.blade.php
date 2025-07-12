@extends ('gudang.layout-gudang')

@section('title','Data Produk')

@section('content')

<!-- Cari Produk -->
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

<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="tambahProdukLabel">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahProduk">
                    <div class="mb-3">
                        <label for="idProduk" class="form-label">ID Produk</label>
                        <input type="text" class="form-control" id="idProduk" required>
                    </div>
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriProduk" class="form-label">Kategori Produk</label>
                        <input type="text" class="form-control" id="kategoriProduk" required>
                    </div>
                    <div class="mb-3">
                        <label for="hargaSatuan" class="form-label">Harga Satuan Produk</label>
                        <input type="number" class="form-control" id="hargaSatuan" required>
                    </div>
                    <div class="mb-3">
                        <label for="stokProduk" class="form-label">Stok Produk</label>
                        <input type="number" class="form-control" id="stokProduk" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Produk -->
<div class="table-container">
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
            <!-- Data Inputan -->
        </tbody>
    </table>
</div>
    <p id="pesanTidakDitemukan" class="text-center text-danger mt-3" style="display: none;">
        Data tidak ditemukan.
    </p>


    
<script>
    let rowToEdit = null; // baris yang sedang diedit

    // Saat form disubmit (tambah / edit)
    document.getElementById("formTambahProduk").addEventListener("submit", function(event) {
        event.preventDefault();
        const konfirmasi = confirm("Apakah Anda yakin ingin menyimpan data ini?");
        if (!konfirmasi) return;

        const id = document.getElementById("idProduk").value;
        const nama = document.getElementById("namaProduk").value;
        const kategori = document.getElementById("kategoriProduk").value;
        const harga = document.getElementById("hargaSatuan").value;
        const stok = document.getElementById("stokProduk").value;
        const formattedHarga = `Rp ${parseInt(harga).toLocaleString("id-ID")}`;

        if (rowToEdit) {
            // MODE EDIT – Update data
            const cells = rowToEdit.querySelectorAll("td");
            cells[1].textContent = id;
            cells[2].textContent = nama;
            cells[3].textContent = kategori;
            cells[4].textContent = formattedHarga;
            cells[5].textContent = stok;
        } else {
            // MODE TAMBAH – Tambahkan baris baru
            const tabel = document.getElementById("tabelProduk").querySelector("tbody");
            const baris = tabel.insertRow();

            baris.innerHTML = `
                <td></td>
                <td>${id}</td>
                <td>${nama}</td>
                <td>${kategori}</td>
                <td>${formattedHarga}</td>
                <td>${stok}</td>
                <td>
                    <button class="btn btn-sm btn-edit me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                        <i data-feather="edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-hapus" title="Hapus">
                        <i data-feather="trash-2"></i>
                    </button>
                </td>
            `;
        }

        // Reset dan tutup modal
        document.getElementById("formTambahProduk").reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById("tambahProdukModal"));
        modal.hide();

        rowToEdit = null;
        document.getElementById("tambahProdukLabel").textContent = "Tambah Produk Baru";

        // Update icon + urutan
        feather.replace();
        reindexTable();
    });

    // Reset form saat klik tombol "Tambah Produk"
    document.querySelector('[data-bs-target="#tambahProdukModal"]').addEventListener("click", function() {
        document.getElementById("formTambahProduk").reset();
        document.getElementById("tambahProdukLabel").textContent = "Tambah Produk Baru";
        rowToEdit = null;
    });

    // Fungsi untuk perbarui nomor urut
    function reindexTable() {
        const rows = document.querySelectorAll("#tabelProduk tbody tr");
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    // Edit & Hapus
    document.querySelector("#tabelProduk tbody").addEventListener("click", function(e) {
        const editBtn = e.target.closest(".btn-edit");
        const hapusBtn = e.target.closest(".btn-hapus");

        // HAPUS DATA
        if (hapusBtn) {
            if (confirm("Apakah yakin ingin menghapus produk ini?")) {
                hapusBtn.closest("tr").remove();
                reindexTable();
            }
        }

        // EDIT DATA
        if (editBtn) {
            const row = editBtn.closest("tr");
            rowToEdit = row;

            const cells = row.querySelectorAll("td");
            const id = cells[1].textContent;
            const nama = cells[2].textContent;
            const kategori = cells[3].textContent;
            const harga = cells[4].textContent.replace(/[^\d]/g, '');
            const stok = cells[5].textContent;

            document.getElementById("idProduk").value = id;
            document.getElementById("namaProduk").value = nama;
            document.getElementById("kategoriProduk").value = kategori;
            document.getElementById("hargaSatuan").value = harga;
            document.getElementById("stokProduk").value = stok;

            document.getElementById("tambahProdukLabel").textContent = "Edit Data Produk";
        }
    });

    // Pencarian Produk
    const inputPencarian = document.getElementById("inputPencarian");
    const btnCari = document.getElementById("btnCari");

    btnCari.addEventListener("click", function() {
        const keyword = inputPencarian.value.toLowerCase();
        const rows = document.querySelectorAll("#tabelProduk tbody tr");
        let ditemukan = false;

        rows.forEach(row => {
            const namaProduk = row.cells[2].textContent.toLowerCase();
            const kategoriProduk = row.cells[3].textContent.toLowerCase();

            const cocok = namaProduk.includes(keyword) || kategoriProduk.includes(keyword);
            row.style.display = cocok ? "" : "none";

            if (cocok) ditemukan = true;
        });

        const pesan = document.getElementById("pesanTidakDitemukan");
        pesan.style.display = ditemukan ? "none" : "block";
    });


    // Reset input pencarian dan tampilkan semua data saat klik di luar input dan tombol
    document.addEventListener("click", function(e) {
        if (!inputPencarian.contains(e.target) && !btnCari.contains(e.target)) {
            inputPencarian.value = "";

            // Tampilkan semua data
            const rows = document.querySelectorAll("#tabelProduk tbody tr");
            rows.forEach(row => {
                row.style.display = "";
            });

            // Sembunyikan pesan error
            document.getElementById("pesanTidakDitemukan").style.display = "none";
        }
    });
</script>

@endsection