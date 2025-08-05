<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        @page { margin: 0 }
        body { margin: 0; font-size:10px;font-family: monospace;}
        td { font-size:10px; }
        .sheet {
            margin: 0;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            page-break-after: always;
        }

        body.struk        .sheet { width: 58mm; padding: 2mm; }

        .txt-left { text-align: left;}
        .txt-center { text-align: center;}
        .txt-right { text-align: right;}

        @media screen {
            body { background: #e0e0e0; }
            .sheet {
                background: white;
                box-shadow: 0 .5cm 2cm rgba(0,0,0,.3);
                margin: 5cm;
            }
        }

        @media print {
            body { font-family: monospace; }
        }
    </style>
</head>
<body class="struk" onload="printOut()">
    <section class="sheet">
        <div class="txt-center">
            <strong>Destore Mart</strong><br>
            Jl. Kasir Laravel No.1<br>
            =======================
        </div>

        <table width="100%">
            <tr>
                <td>Tanggal</td>
                <td class="txt-right">{{ $transaksi->tanggal_transaksi }}</td>
            </tr>
            <tr>
                <td>ID Transaksi</td>
                <td class="txt-right">{{ $transaksi->id_transaksi }}</td>
            </tr>
        </table>

        =======================

        <table width="100%">
            @foreach ($transaksi->details as $detail)
                <tr>
                    <td colspan="2">{{ $detail->id_produk }} - 
                        {{ DB::connection('gudang')->table('produk')->where('id_produk', $detail->id_produk)->value('nama_produk') }}
                    </td>
                </tr>
                <tr>
                    <td>{{ $detail->jumlah_beli }} x {{ number_format($detail->sub_total / $detail->jumlah_beli) }}</td>
                    <td class="txt-right">{{ number_format($detail->sub_total) }}</td>
                </tr>
            @endforeach
        </table>

        =======================
        <table width="100%">
            <tr>
                <td><strong>Total</strong></td>
                <td class="txt-right"><strong>Rp {{ number_format($transaksi->total_harga) }}</strong></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td class="txt-right">Rp {{ number_format($transaksi->nominal_uang) }}</td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="txt-right">Rp {{ number_format($transaksi->kembalian) }}</td>
            </tr>
        </table>

        =======================
        <div class="txt-center">
            TERIMA KASIH<br>
            TELAH BERBELANJA
        </div>
    </section>

    <script>
        let lama = 1000;
        function printOut() {
            window.print();
            setTimeout(() => window.close(), lama);
        }
    </script>
</body>
</html>
