@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h2 fw-bold text-primary">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </h1>
        <a href="{{ route('report.generate') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Pemasukan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2"
                style="background: linear-gradient(135deg,#4361ee,#6e8bff); border-radius:12px;">
                <div class="card-body text-white">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-uppercase mb-1">Pemasukan</div>
                            <div class="h5 mb-0 font-weight-bold">
                                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-circle-down fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- Pengeluaran -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2"
                style="background: linear-gradient(135deg,#ff6b6b,#ff8fab); border-radius:12px;">
                <div class="card-body text-white">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-uppercase mb-1">Pengeluaran</div>
                            <div class="h5 mb-0 font-weight-bold">
                                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-circle-up fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2"
                style="background: linear-gradient(135deg,#ffb703,#ffd36b); border-radius:12px;">
                <div class="card-body text-white">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-uppercase mb-1">Total Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold">
                                {{ $totalTransaksi }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo Akhir -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2"
                style="background: linear-gradient(135deg,#06d6a0,#7ef7d7); border-radius:12px;">
                <div class="card-body text-white">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-uppercase mb-1">Saldo</div>
                            <div class="h5 mb-0 font-weight-bold">
                                Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row">
        <!-- Grafik Transaksi -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white">
                    <strong>Ringkasan Transaksi</strong>
                </div>
                <div class="card-body" style="height: 350px;">
                    <canvas id="transaksiChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Perbandingan Per Bulan -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                    <strong>Perbandingan Pemasukan & Pengeluaran</strong>
                    <!-- Dropdown filter tahun -->
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-0 ms-2">
                        <select name="year" class="form-control form-control-sm" onchange="this.form.submit()">
                            @for($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div class="card-body" style="height: 350px;">
                    <canvas id="perbandinganChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Transaksi
    new Chart(document.getElementById('transaksiChart'), {
        type: 'bar',
        data: {
            labels: ['Pemasukan', 'Pengeluaran', 'Saldo'],
            datasets: [{
                label: 'Jumlah (Rp)',
                data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}, {{ $saldoAkhir }}],
                backgroundColor: ['#4e73df', '#e74a3b', '#06d6a0'],
                borderRadius: 8
            }]
        },
        options: { 
            responsive: true,
            plugins: { legend: { display: false }},
            scales: { y: { beginAtZero: true }}
        }
    });

    // Grafik Perbandingan Per Bulan
    new Chart(document.getElementById('perbandinganChart'), {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Pemasukan',
                    data: @json($dataPemasukan),
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28,200,138,0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#1cc88a'
                },
                {
                    label: 'Pengeluaran',
                    data: @json($dataPengeluaran),
                    borderColor: '#e74a3b',
                    backgroundColor: 'rgba(231,74,59,0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#e74a3b'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' }},
            scales: { y: { beginAtZero: true }}
        }
    });
</script>
@endpush
