@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detail Transaksi</h4>
    <p><strong>No:</strong> {{ $transaction->id }}</p>
    <p><strong>Tanggal:</strong> {{ $transaction->tanggal }}</p>
    <p><strong>Jumlah:</strong> Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
    <p><strong>Kategori:</strong> {{ $transaction->category->name ?? '-' }}</p>
    <p><strong>Tipe:</strong> {{ $transaction->type->name ?? '-' }}</p>
    <p><strong>Deskripsi:</strong> {{ $transaction->deskripsi }}</p>
</div>
@endsection
