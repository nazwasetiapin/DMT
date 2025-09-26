@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Data Transaksi</h1>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>

      <div class="d-flex align-items-center">
        {{-- Filter month & year --}}
        <form method="GET" action="{{ route('transactions.index') }}" class="form-inline mr-2">
          <div class="form-group mr-2">
            <select name="month" class="form-control form-control-sm">
              <option value="">Semua Bulan</option>
              @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                  {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group mr-2">
            <select name="year" class="form-control form-control-sm">
              <option value="">Semua Tahun</option>
              @foreach($years as $y)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
              @endforeach
            </select>
          </div>

          <button class="btn btn-primary btn-sm mr-2">Filter</button>
          <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">Reset</a>
        </form>


      </div>
    </div>

    <div class="card-body">
      {{-- Info total filter --}}
      @if(request()->filled('month') || request()->filled('year'))
        <p class="small">
          Total transaksi : <strong>Rp {{ number_format($transactions->sum('amount'), 0, ',', '.') }}</strong>
        </p>
      @endif

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
              @if($role === 'admin')
                <th>Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($transactions as $index => $trx)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $trx->type->name ?? '-' }}</td>
                <td>{{ $trx->category->name ?? '-' }}</td>
                <td>{{ $trx->subCategory->name ?? '-' }}</td>
                <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $trx->deskripsi }}</td>

                @if($role === 'admin')
                  <td>
                    <a href="{{ route('transactions.edit', $trx->id) }}" class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>

                    <form id="delete-form-{{ $trx->id }}" action="{{ route('transactions.destroy', $trx->id) }}" method="POST"
                      class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="confirmDelete({{ $trx->id }})" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>

                @endif
              </tr>
            @empty
              <tr>
                <td colspan="{{ $role === 'admin' ? 8 : 7 }}" class="text-center">
                  Data tidak ada
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection