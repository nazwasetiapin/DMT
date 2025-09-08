@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengeluaran</h1>

    <a href="{{ url('/transactions/pengeluaran/create') }}" class="btn btn-primary mb-3">+ Tambah Pengeluaran</a>

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
                    <tr>
                        <td>1</td>
                        <td>Belanja Bulanan</td>
                        <td>Rp 2.000.000</td>
                        <td>02-09-2025</td>
                        <td>
                            <a href="{{ url('/transactions/pengeluaran/1/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
