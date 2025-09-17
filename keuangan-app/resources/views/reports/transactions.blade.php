<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Jumlah</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
                <tr>
                    <td>{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $trx->type->name ?? '-' }}</td>
                    <td>{{ $trx->category->name ?? '-' }}</td>
                    <td>{{ $trx->subCategory->name ?? '-' }}</td>
                    <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                    <td>{{ $trx->deskripsi ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
