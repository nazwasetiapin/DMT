@extends('layouts.app')

@section('title', 'Status Upload Saya')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Status Upload Saya</h1>
    </div>

    <div class="section-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Tipe</th>
                        <th>File Dikirim</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Hasil (jika ada)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($uploads as $upload)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($upload->type) }}</td>
                        <td><a href="{{ asset('storage/'.$upload->file) }}" target="_blank">Lihat File</a></td>
                        <td>
                            @if($upload->status === 'pending')
                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                            @elseif($upload->status === 'proses')
                                <span class="badge badge-info">Sedang Diproses</span>
                            @elseif($upload->status === 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $upload->request_note ?? '-' }}</td>
                        <td>
                            @if($upload->status === 'selesai' && $upload->processed_file)
                                <a href="{{ asset('storage/'.$upload->processed_file) }}" class="btn btn-success btn-sm" target="_blank">Download Hasil</a>
                            @else
                                <span class="text-muted">Belum tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data upload.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
