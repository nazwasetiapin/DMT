@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h2 fw-bold text-primary">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </h1>
    <a href="{{ route('report.generate') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<style>
    .card:hover {
        transform: translateY(-3px);
        transition: all 0.25s ease-in-out;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
</style>

<style>
    .form-select:focus {
        box-shadow: 0 0 6px rgba(0,0,0,0.25) !important;
        outline: none;
        border-color: #fff;
    }
    .form-select option {
        color: #000;
    }
</style>


<!-- ================== FILTER TAHUN & BULAN ================== -->
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="input-group" style="gap: 4px;"> <!-- jarak minimal antar dropdown -->
                
                <!-- Tahun -->
                <select name="year" class="form-select form-select-sm fw-bold"
                    onchange="this.form.submit()"
                    style="background: linear-gradient(135deg,#4361ee,#6e8bff); color:#fff; border-radius:8px; border:none; height:38px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>

                <!-- Bulan -->
                <select name="month" class="form-select form-select-sm fw-bold"
                    onchange="this.form.submit()"
                    style="background: linear-gradient(135deg,#ff6b6b,#ff8fab); color:#fff; border-radius:8px; border:none; height:38px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>

            </div>
        </form>
    </div>
</div>


<!-- ================== SUMMARY CARDS ================== -->
<div class="row">
    <!-- Pemasukan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="background: linear-gradient(135deg,#ff6b6b,#ff8fab); border-radius:12px;">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase mb-1">Pemasukan</div>
                        <div class="h5 mb-0 fw-bold">Rp {{ number_format($totalPemasukan,0,',','.') }}</div>
                    </div>
                    <i class="fas fa-arrow-circle-down fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Pengeluaran -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="background: linear-gradient(135deg,#4361ee,#6e8bff); border-radius:12px;">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase mb-1">Pengeluaran</div>
                        <div class="h5 mb-0 fw-bold">Rp {{ number_format($totalPengeluaran,0,',','.') }}</div>
                    </div>
                    <i class="fas fa-arrow-circle-up fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Transaksi -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="background: linear-gradient(135deg,#ffb703,#ffd36b); border-radius:12px;">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase mb-1">Total Transaksi</div>
                        <div class="h5 mb-0 fw-bold">{{ $totalTransaksi }}</div>
                    </div>
                    <i class="fas fa-clipboard-list fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Saldo -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="background: linear-gradient(135deg,#06d6a0,#7ef7d7); border-radius:12px;">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase mb-1">Saldo</div>
                        <div class="h5 mb-0 fw-bold">Rp {{ number_format($saldoAkhir,0,',','.') }}</div>
                    </div>
                    <i class="fas fa-wallet fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================== DETAIL PERSENTASE ================== -->
<div class="card mt-4 shadow-sm" style="max-height:400px;overflow-y:auto;border-radius:12px;">
    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-2 px-3">
        <h5 class="mb-0"><i class="fas fa-percentage"></i> Detail Persentase</h5>
        <span class="small">Tahun {{ $year }} {{ $month ? '- Bulan '.DateTime::createFromFormat('!m', $month)->format('F') : '' }}</span>
    </div>
    <div class="card-body p-2">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover text-center align-middle mb-0">
                <thead class="bg-light text-primary">
                    <tr>
                        <th style="width:12%">Bulan</th>
                        <th style="width:18%">Pemasukan (Rp)</th>
                        <th style="width:18%">Pengeluaran (Rp)</th>
                        <th style="width:16%">Pemasukan (%)</th>
                        <th style="width:16%">Pengeluaran (%)</th>
                        <th style="width:12%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailPersentase as $row)
                    <tr>
                        <td><strong>{{ $row['bulan'] }}</strong></td>
                        <td class="text-success fw-semibold">Rp {{ number_format($row['pemasukan'],0,',','.') }}</td>
                        <td class="text-danger fw-semibold">Rp {{ number_format($row['pengeluaran'],0,',','.') }}</td>
                        <td>
                            <div class="progress" style="height:10px;">
                                <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                    style="width: {{ $row['pemasukan_persen'] }}%;" 
                                    aria-valuenow="{{ $row['pemasukan_persen'] }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ $row['pemasukan_persen'] }}%</small>
                        </td>
                        <td>
                            <div class="progress" style="height:10px;">
                                <div class="progress-bar bg-danger progress-bar-striped" role="progressbar"
                                    style="width: {{ $row['pengeluaran_persen'] }}%;" 
                                    aria-valuenow="{{ $row['pengeluaran_persen'] }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ $row['pengeluaran_persen'] }}%</small>
                        </td>
<td>
    @if($row['status'] === 'Naik')
        <span class="badge bg-success"><i class="fas fa-arrow-up"></i> Naik</span>
    @elseif($row['status'] === 'Turun')
        <span class="badge bg-danger"><i class="fas fa-arrow-down"></i> Turun</span>
    @else
        <span class="badge" style="background-color:#e2e3e5; color:#495057;">
            <i class="fas fa-minus"></i> Stabil
        </span>
    @endif
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================== GRAFIK ================== -->
<div class="row mt-4">
    <!-- Ringkasan -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-primary text-white">
                <strong>Ringkasan Transaksi</strong>
            </div>
            <div class="card-body" style="height:350px;">
                <canvas id="transaksiChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Perbandingan -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-success text-white">
                <strong>Perbandingan Pemasukan & Pengeluaran</strong>
            </div>
            <div class="card-body" style="height:350px;">
                <canvas id="perbandinganChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Ringkasan
    new Chart(document.getElementById('transaksiChart'), {
        type: 'bar',
        data: {
            labels: ['Pemasukan','Pengeluaran','Saldo'],
            datasets: [{
                label: 'Jumlah (Rp)',
                data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}, {{ $saldoAkhir }}],
                backgroundColor: ['#4e73df','#e74a3b','#f6c23e'],
                borderRadius: 8
            }]
        },
        options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
    });

    // Grafik Perbandingan Bulanan
    new Chart(document.getElementById('perbandinganChart'), {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Pemasukan',
                    data: @json($dataPemasukan),
                    borderColor:'#1cc88a',
                    backgroundColor:'rgba(28,200,138,0.2)',
                    fill:true,
                    tension:0.3,
                    pointRadius:4,
                    pointBackgroundColor:'#1cc88a'
                },
                {
                    label: 'Pengeluaran',
                    data: @json($dataPengeluaran),
                    borderColor:'#e74a3b',
                    backgroundColor:'rgba(231,74,59,0.2)',
                    fill:true,
                    tension:0.3,
                    pointRadius:4,
                    pointBackgroundColor:'#e74a3b'
                }
            ]
        },
        options: { responsive:true, plugins:{legend:{position:'top'}}, scales:{y:{beginAtZero:true}} }
    });
</script>
@endpush
