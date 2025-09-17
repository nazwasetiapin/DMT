@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Data Transaksi</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Tipe</th>
              <th>Category</th>
              <th>Sub Category</th>
              <th>Nominal</th>
              <th>Tanggal</th>
              <th>Deskripsi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $index => $trx)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $trx->type->name ?? '-' }}</td>
                <td>{{ $trx->category->name ?? '-' }}</td>
                <td>{{ $trx->subCategory->name ?? '-' }}</td>
                <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                <td>{{ $trx->tanggal->format('d-m-Y') }}</td>
                <td>{{ $trx->deskripsi }}</td>
                <td>
                  <a href="{{ route('transactions.edit', $trx->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
