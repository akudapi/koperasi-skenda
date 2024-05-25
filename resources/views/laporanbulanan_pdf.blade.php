<!-- resources/views/laporanbulanan_pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h1, h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Bulanan - {{ $monthName }} {{ $year }}</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jenis Produk</th>
                <th>Stok Produk</th>
                <th>Harga Produk</th>
                <th>Terjual</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
                <tr>
                    <td>{{ $item->namaProduk }}</td>
                    <td>{{ $item->jenisProduk }}</td>
                    <td>{{ $item->stokProduk }}</td>
                    <td>{{ $item->hargaProduk }}</td>
                    <td>{{ $item->terjual }}</td>
                    <td>{{ $item->totalSatuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2>Total Penjualan: {{ $totalPenjualan }}</h2>
</body>
</html>