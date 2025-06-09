@extends('kasir.layout-kasir')

@section('title', 'Data Produk Kasir')

@section('content')

    <div class="container-search-data">
        <nav class="navbar">
            <div class="container-fluid">
                <form class="d-flex w-50" role="search">
                    <input class="form-control border-success me-2" type="search" placeholder="Cari Nama/Kategori Produk"
                        aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <div class="container-table-data">
        <table class="table">
            <thead class="thead-custom">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Harga Satuan Produk</th>
                    <th scope="col">Stok Produk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>001</td>
                    <td>Kaos Ukuran XL</td>
                    <td>Pakaian</td>
                    <td>500000</td>
                    <td>100</td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="idProduk" class="form-label">ID Produk</label>
                            <input type="text" class="form-control" id="idProduk" value="001">
                        </div>
                        <div class="mb-3">
                            <label for="namaProduk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="namaProduk" value="Kaos Ukuran XL">
                        </div>
                        <div class="mb-3">
                            <label for="kategoriProduk" class="form-label">Kategori Produk</label>
                            <input type="text" class="form-control" id="kategoriProduk" value="Pakaian">
                        </div>
                        <div class="mb-3">
                            <label for="hargaProduk" class="form-label">Harga Satuan Produk</label>
                            <input type="number" class="form-control" id="hargaProduk" value="500000">
                        </div>
                        <div class="mb-3">
                            <label for="stokProduk" class="form-label">Stok Produk</label>
                            <input type="number" class="form-control" id="stokProduk" value="100">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
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
@endsection
