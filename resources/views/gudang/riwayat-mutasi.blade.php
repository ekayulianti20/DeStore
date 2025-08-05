@extends ('gudang.layout-gudang')

@section('title', 'Riwayat Mutasi')

@section('content')

    <div class="pencarian-tanggal mb-3">
        <form method="GET" action="{{ route('mutasi.index') }}">
            <input type="date" name="tanggal" class="form-control w-25" id="tanggalMutasi" onchange="this.form.submit()">
        </form>
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
                @forelse($mutasi as $i => $m)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>13{{ $m->id_produk }}</td>
                        <td>{{ $m->id_produk }}</td>
                        <td>{{ \Carbon\Carbon::parse($m->tanggal_mutasi)->format('d-m-Y H:i') }}</td>
                        <td>{{ ucfirst($m->tipe_mutasi) }}</td>
                        <td>{{ $m->jumlah }}</td>
                        <td>{{ $m->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger">Data tidak ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        
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

        document.addEventListener("click", function (e) {
            const input = document.getElementById("tanggalMutasi");
            if (!input.contains(e.target)) {
                input.value = "";
                window.location.href = "{{ route('mutasi.index') }}"; // Reset filter
            }
        });
    </script>

@endsection