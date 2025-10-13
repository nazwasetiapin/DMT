<!DOCTYPE html>
<html lang="id">

<head>
    <script>
    document.documentElement.style.display = 'none'; // Sembunyikan seluruh halaman

    const correctPassword = "undangan2025"; // Ganti sesuai keinginan kamu
    const userPassword = prompt("Masukkan password untuk membuka halaman:");

    if (userPassword === correctPassword) {
        document.documentElement.style.display = ''; // Tampilkan halaman
    } else {
        alert("Password salah. Akses ditolak.");
        document.write("<h2 style='color:red;text-align:center;margin-top:20%'>Akses Ditolak 🚫</h2>");
        throw new Error("Unauthorized access");
    }
</script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu Undangan Wedding</title>
    <style>
        body {
            background: linear-gradient(135deg, #fffaf0, #f5deb3, #e6d0a1, #8b6b3f);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            color: #4b3832;
        }

        h1 {
            text-align: center;
            color: #8b4513;
            margin-bottom: 25px;
            font-size: 2rem;
            text-shadow: 1px 1px 3px rgba(139, 69, 19, 0.2);
        }

        /* Search & Export */
        .search-export {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            flex-wrap: wrap;
            gap: 10px;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .search-form input[type="text"] {
            padding: 8px 14px;
            border: 2px solid #d2b48c;
            border-radius: 12px;
            background: #fffaf0;
            flex: 1;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-form input[type="text"]:focus {
            border-color: #a0522d;
            box-shadow: 0 0 8px rgba(160, 82, 45, 0.4);
            outline: none;
        }

        .search-form button {
            background: #a0522d;
            color: white;
            padding: 8px 25px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .search-form button:hover {
            background: #d2691e;
            transform: scale(1.05);
        }

        /* Dropdown Export */
        .dropdown {
            position: relative;
        }

        .dropdown button {
            background: #a0522d;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: background 0.3s, transform 0.2s;
        }

        .dropdown button:hover {
            background: #d2691e;
            transform: scale(1.05);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: #fffaf0;
            min-width: 187px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 1000;
            margin-top: 6px;
            transition: all 0.3s ease;
        }

        .dropdown-content a {
            color: #8b4513;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            transition: background 0.2s;
        }

        .dropdown-content a:hover {
            background: #f3e0c6;
        }

        /* Rekap Amplop */
        .rekap-container {
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
            margin: 22px 0;
        }

        .rekap-card {
            background: linear-gradient(135deg, #fffaf0, #f5e1c4);
            border: 1px solid #d2b48c;
            border-radius: 14px;
            padding: 16px 24px;
            text-align: center;
            min-width: 10px;
            box-shadow: 0 4px 10px rgba(139, 69, 19, 0.15);
            transition: transform 0.3s;
        }

        .rekap-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(139, 69, 19, 0.2);
        }

        .rekap-card h3 {
            font-size: 13px;
            color: #8b4513;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .rekap-card p {
            font-size: 16px;
            font-weight: bold;
            color: #4b3832;
            margin: 0;
        }

        .rekap-card.highlight {
            background: linear-gradient(135deg, #f5deb3, #e0c9a6);
            border: 1px solid #a0522d;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
            font-size: 14px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: middle;
            text-align: center;
        }

        th {
            background-color: #d2b48c;
            color: white;
            font-size: 13px;
        }

        tr:hover {
            background-color: #fdf6ee;
        }

        img {
            border-radius: 6px;
            max-height: 60px;
        }

        /* Button Hapus */
        .delete-btn {
            background: #b22222;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.2s, transform 0.15s;
        }

        .delete-btn:hover {
            background: #d62828;
            transform: scale(1.05);
        }

      .pagination {
    display: flex;
    justify-content: center;
    margin-top: 25px;
    gap: 12px;
}

.pagination a,
.pagination span {
    padding: 8px 18px;
    background: #fffaf0;
    border: 2px solid #d2b48c;
    border-radius: 10px;
    font-size: 14px;
    font-weight: bold;
    color: #8b4513;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}

.pagination a:hover {
    background: #f3e0c6;
    transform: scale(1.05);
}

.pagination .disabled {
    opacity: 0.6;
    cursor: not-allowed;
    background: #fdf6ee;
}

/* === RESPONSIVE UNTUK HP === */
@media (max-width: 768px) {
    body {
        margin: 10px;
    }

    h1 {
        font-size: 1.5rem;
    }

    /* Search & Export biar stack ke bawah */
    .search-export {
        flex-direction: column;
        align-items: center;
    }

    .search-form {
        width: 100%;
    }

    .search-form input[type="text"] {
        width: 100%;
    }

    .dropdown {
        width: 100%;
        text-align: center;
    }

    .dropdown button {
        width: 100%;
    }

    /* Rekap Amplop biar ke tengah & 1 kolom */
    .rekap-container {
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .rekap-card {
        width: 100%;
        max-width: 320px;
    }

    /* Tabel biar bisa scroll horizontal */
    table {
        display: block;
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
    }

    th, td {
        font-size: 12px;
        padding: 6px;
    }

    img {
        max-height: 40px;
    }

    /* Pagination ke tengah */
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination a, .pagination span {
        padding: 6px 12px;
        font-size: 13px;
    }
}


    </style>
</head>

<body>




    <h1>Data Tamu Undangan Wedding</h1>

    <!-- Search & Export -->
    <div class="search-export">
        <form method="GET" action="{{ route('guests.data') }}" class="search-form">
            <input type="text" name="search" placeholder="🔍 Cari nama tamu..." value="{{ request('search') }}">
            <button type="submit">Cari</button>
        </form>

        <div class="dropdown">
            <button onclick="toggleDropdown()">⬇️ Export</button>
            <div id="exportDropdown" class="dropdown-content">
                <a href="{{ route('guests.export.pdf.album') }}">🖼️ Export PDF Album</a>
                <a href="{{ route('guests.export.pdf.data') }}">📑 Export PDF Data</a>
                <a href="{{ route('guests.export.excel') }}">📊 Export Excel</a>
            </div>
        </div>
    </div>

    <!-- Rekap Amplop -->
    <div class="rekap-container">
        <div class="rekap-card">
            <h3>Total Cash</h3>
            <p>Rp {{ number_format($totalCash, 0, ',', '.') }}</p>
        </div>
        <div class="rekap-card">
            <h3>Total Transfer</h3>
            <p>Rp {{ number_format($totalTransfer, 0, ',', '.') }}</p>
        </div>
        <div class="rekap-card highlight">
            <h3>Total Uang</h3>
            <p>Rp {{ number_format($totalUang, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Table Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>WhatsApp</th>
                <th>Pesan</th>
                <th>Jenis Hadiah</th>
                <th>Nominal Transfer</th>
                <th>Metode Transfer</th>
                <th>Bukti Transfer</th>
                <th>Nominal Cash</th>
                <th>Barang</th>
                <th>Foto Tamu</th>
                <th>Tanggal Dibuat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guests as $guest)
            <tr>
                <td>{{ $loop->iteration + ($guests->firstItem() - 1) }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->address }}</td>
                <td>{{ $guest->whatsapp }}</td>
                <td>{{ $guest->message }}</td>
                <td>{{ ucfirst($guest->gift_type) }}</td>
                <td>@if($guest->transfer_amount) Rp {{ number_format($guest->transfer_amount,0,',','.') }} @else - @endif</td>
                <td>{{ $guest->transfer_method ?? '-' }}</td>
                <td>@if($guest->proof)<a href="{{ asset('storage/'.$guest->proof) }}" target="_blank">Lihat</a>@else - @endif</td>
                <td>@if($guest->cash_amount) Rp {{ number_format($guest->cash_amount,0,',','.') }} @else - @endif</td>
                <td>{{ $guest->barang_name ?? '-' }}</td>
                <td>@if($guest->photo)<img src="{{ asset('storage/'.$guest->photo) }}" alt="Foto {{ $guest->name }}">@else - @endif</td>
                <td>{{ $guest->created_at }}</td>
                <td>
                    <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="delete-form" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-btn">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="14" style="text-align:center;">Belum ada tamu yang mendaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
    @if ($guests->onFirstPage())
        <span class="disabled">⟨ Previous</span>
    @else
        <a href="{{ $guests->previousPageUrl() }}">⟨ Previous</a>
    @endif

    @if ($guests->hasMorePages())
        <a href="{{ $guests->nextPageUrl() }}">Next ⟩</a>
    @else
        <span class="disabled">Next ⟩</span>
    @endif
</div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data tamu akan terhapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#b22222',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#f6e8ceff',
                    color: '#5a4634'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        function toggleDropdown() {
            let dropdown = document.getElementById("exportDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.closest('.dropdown')) {
                document.getElementById("exportDropdown").style.display = "none";
            }
        }
    </script>
</body>

</html>
