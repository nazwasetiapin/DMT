@extends('layouts.app')

@section('title', 'History Transaksi')

@section('content')
<div class="section">
    <div class="section-body">

        {{-- Alert --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        <div class="card shadow border-0">

            {{-- Header --}}
            <div
                class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                <h4 class="mb-0 font-weight-bold">
                    <i class="fas fa-history mr-2"></i> History Transaksi
                </h4>

                <span class="badge badge-light shadow-sm px-3 py-2">
                    <i class="fas fa-lock mr-1 text-danger"></i> Data Permanen
                </span>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <p class="small text-muted mb-0">
                    <i class="fas fa-info-circle mr-1"></i>
                    Riwayat ini bersifat <strong>permanen</strong> dan tidak dapat diubah atau dihapus.
                </p>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-borderless align-middle text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Waktu Aksi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $index => $history)
                        <tr>
                            <td>{{ $histories->firstItem() + $index }}</td>

                            {{-- Aksi --}}
                            <td>
                                @if($history->action === 'create')
                                <span class="badge badge-success px-2">
                                    <i class="fas fa-plus-circle mr-1"></i> CREATE
                                </span>
                                @elseif($history->action === 'update')
                                <span class="badge badge-warning px-2">
                                    <i class="fas fa-edit mr-1"></i> UPDATE
                                </span>
                                @elseif($history->action === 'delete')
                                <span class="badge badge-danger px-2">
                                    <i class="fas fa-trash mr-1"></i> DELETE
                                </span>
                                @endif
                            </td>

                            {{-- Tipe transaksi --}}
                            <td>
                                @if($history->type === 'Pemasukan')
                                <span class="badge badge-success">
                                    <i class="fas fa-arrow-down mr-1"></i> Pemasukan
                                </span>
                                @else
                                <span class="badge badge-danger">
                                    <i class="fas fa-arrow-up mr-1"></i> Pengeluaran
                                </span>
                                @endif
                            </td>

                            {{-- Nominal --}}
                            <td
                                class="{{ $history->type === 'Pemasukan' ? 'text-success' : 'text-danger' }} font-weight-bold">
                                Rp {{ number_format($history->amount, 0, ',', '.') }}
                            </td>

                            <td>{{ \Carbon\Carbon::parse($history->tanggal)->format('d M Y') }}</td>
                            <td>{{ $history->user->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y H:i') }}</td>
                            <td>{{ $history->keterangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-4">
                                <i class="fas fa-info-circle mr-1"></i> History belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4 mb-2">
                    {{ $histories->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection