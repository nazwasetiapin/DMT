<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Buku Tamu</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 11px; 
            color: #4b3621; 
            background-color: #fffdf8;
        }
        h2 { 
            text-align: center; 
            margin-bottom: 15px; 
            color: #8b5e3c;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        th, td { 
            border: 1px solid #d2b48c; 
            padding: 6px 8px; 
        }
        th { 
            background: #deb887; /* coklat muda */
            color: white; 
            font-weight: bold; 
            text-align: center; 
        }

        tbody tr:nth-child(even) { background: #fff8dc; } /* krem muda */
        tbody tr:nth-child(odd) { background: #fdf5e6; }  /* krem lebih soft */

        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .small { font-size: 10px; color: #6e4b3a; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Data Buku Tamu</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No WA</th>
                <th>Jenis Hadiah</th>
                <th>Nominal Transfer</th>
                <th>Nominal Cash</th>
                <th>Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $index => $guest)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->address }}</td>
                <td>{{ $guest->whatsapp }}</td>
                <td class="text-center">{{ ucfirst($guest->gift_type) }}</td>
                <td class="text-right">
                    {{ $guest->transfer_amount ? 'Rp ' . number_format($guest->transfer_amount, 0, ',', '.') : '-' }}
                </td>
                <td class="text-right">
                    {{ $guest->cash_amount ? 'Rp ' . number_format($guest->cash_amount, 0, ',', '.') : '-' }}
                </td>
                <td>{{ $guest->barang_name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="small text-center">Dicetak pada {{ now()->format('d-m-Y H:i') }}</p>
</body>
</html>
