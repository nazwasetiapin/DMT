@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Transaksi</h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ url('/transactions/1') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi" value="Pemasukan Gaji" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" value="5000000" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="2025-09-01" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ url('/transactions') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
