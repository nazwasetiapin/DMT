<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Album Tamu Undangan Wedding</title>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        margin: 20px;
        color: #333;
        background: #fff;
    }

    h1 {
        text-align: center;
        font-size: 28px;
        color: #b36b00;
        margin-bottom: 30px;
        border-bottom: 2px solid #b36b00;
        padding-bottom: 10px;
    }

    .card {
        border: 1px solid #e0cba8;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background: #fffdf7;
        page-break-inside: avoid;
    }

    .card-table {
        width: 100%;
        border-collapse: collapse;
    }

    .photo-cell {
        width: 130px;
        vertical-align: top;
        padding-right: 15px;
    }

    .photo-frame {
    display: inline-block;
    border: 2px solid #e0cba8;
    border-radius: 8px;
    overflow: hidden;
    background: #f7f3eb;
    max-width: 135px;   /* batas maksimal */
}

.photo-frame img {
    width: 100%;        /* biar tidak melebihi frame */
    height: auto;       /* tinggi menyesuaikan rasio foto */
    display: block;
}




    .info-cell {
        vertical-align: top;
        font-size: 13px;
        width: 100%;
    }

    .info-cell h3 {
        margin: 0 0 10px 0;
        font-size: 18px;
        color: #a35c00;
    }

    /* Detail pakai tabel agar label sejajar */
    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table td {
        padding: 4px 0;
        vertical-align: top;
    }

    .label {
        color: #b36b00;
        font-weight: bold;
        width: 70px;
        white-space: nowrap;
    }

    .value {
        color: #333;
    }
</style>
</head>
<body>

<h1>Album Tamu Undangan Wedding</h1>

@foreach($guests as $guest)
    @php
        $photoPath = public_path('storage/'.$guest->photo);
        if($guest->photo && file_exists($photoPath)){
            $type = pathinfo($photoPath, PATHINFO_EXTENSION);
            $data = file_get_contents($photoPath);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
        } else {
            $base64 = 'https://ui-avatars.com/api/?name='.urlencode($guest->name).'&background=8b4513&color=fff';
        }
    @endphp

    <div class="card">
        <table class="card-table">
            <tr>
                <td class="photo-cell">
                    <div class="photo-frame">
                        <img src="{{ $base64 }}" alt="Foto {{ $guest->name }}">
                    </div>
                </td>
                <td class="info-cell">
                    <h3>{{ $guest->name }}</h3>
                    <table class="detail-table">
                        <tr>
                            <td class="label">Alamat:</td>
                            <td class="value">{{ $guest->address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Ucapan:</td>
                            <td class="value">{{ $guest->message ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
