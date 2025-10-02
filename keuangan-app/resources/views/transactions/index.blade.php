@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
<div class="section">
  
  <div class="section-body">
    {{-- Alert --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="card shadow border-0">
      <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
        <h4 class="mb-0 h4 font-weight-bold">
          <i class="fas fa-list mr-2"></i> Daftar Transaksi
        </h4>

        {{-- Filter --}}
        <form method="GET" action="{{ route('transactions.index') }}" class="form-inline">
          <select name="month" class="form-control form-control-sm mr-2 shadow-sm">
            <option value="">Semua Bulan</option>
            @foreach(range(1,12) as $m)
              <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                {{ \Carbon\Carbon::createFromDate(null, $m, 1)->translatedFormat('F') }}
              </option>
            @endforeach
          </select>

          <select name="year" class="form-control form-control-sm mr-2 shadow-sm">
            <option value="">Semua Tahun</option>
            @foreach($years as $y)
              <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
          </select>

          <button class="btn btn-light btn-sm border mr-2 shadow-sm">
            <i class="fas fa-filter mr-1 text-primary"></i> Filter
          </button>
          <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-undo mr-1"></i> Reset
          </a>
        </form>
      </div>

      <div class="card-body">
        {{-- Info filter --}}
        @if(request()->filled('month') || request()->filled('year'))
          <p class="small text-muted mb-3">
            <i class="fas fa-info-circle mr-1"></i>
            Total transaksi hasil filter :
            <strong class="text-success">Rp {{ number_format($transactions->sum('amount'), 0, ',', '.') }}</strong>
          </p>
        @endif

        <div class="table-responsive">
          <table class="table table-hover table-striped table-borderless align-middle text-center">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Periode</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                @if($role === 'admin')
                  <th>Aksi</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $index => $trx)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>
                    @if($trx->type->name == 'Pemasukan')
                      <span class="badge badge-success px-2 py-1">
                        <i class="fas fa-arrow-down mr-1"></i> {{ $trx->type->name }}
                      </span>
                    @elseif($trx->type->name == 'Pengeluaran')
                      <span class="badge badge-danger px-2 py-1">
                        <i class="fas fa-arrow-up mr-1"></i> {{ $trx->type->name }}
                      </span>
                    @else
                      <span class="badge badge-secondary px-2 py-1">
                        {{ $trx->type->name ?? '-' }}
                      </span>
                    @endif
                  </td>
                  <td>{{ $trx->category->name ?? '-' }}</td>
                  <td>{{ $trx->subCategory->name ?? '-' }}</td>
                  <td class="{{ $trx->type->name == 'Pemasukan' ? 'text-success' : 'text-danger' }} font-weight-bold">
                    Rp {{ number_format($trx->amount, 0, ',', '.') }}
                  </td>
                  <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                  <td>{{ $trx->deskripsi ?? '-' }}</td>

                  @if($role === 'admin')
                    <td>
                      <a href="{{ route('transactions.edit', $trx->id) }}" class="btn btn-sm btn-warning shadow-sm mr-1" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Hapus transaksi ini?')" data-toggle="tooltip" title="Hapus">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  @endif
                </tr>
              @empty
                <tr>
                  <td colspan="{{ $role === 'admin' ? 8 : 7 }}" class="text-center text-muted py-4">
                    <i class="fas fa-info-circle mr-1"></i> Data transaksi belum ada
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
