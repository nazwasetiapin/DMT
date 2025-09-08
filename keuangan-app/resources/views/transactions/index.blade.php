@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Transaksi</h1>

    <a href="{{ url('/transactions/create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- contoh data dummy -->
                    <tr>
                        <td>1</td>
                        <td>Pemasukan Gaji</td>
                        <td>Rp 5.000.000</td>
                        <td>01-09-2025</td>
                        <td>
                            <a href="{{ url('/transactions/1/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
