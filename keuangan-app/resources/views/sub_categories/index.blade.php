@extends('layouts.app')

@section('title', 'Sub Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0 text-gray-800">Daftar Jenis Transaksi</h1>
        <a href="{{ route('sub-categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Jenis
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($subCategories->isEmpty())
        <div class="alert alert-info">Belum ada data.</div>
    @else
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Transksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subCategories as $index => $subCategory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $subCategory->name }}</td>
                                <td>
                                    <a href="{{ route('sub-categories.edit', $subCategory->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-form-{{ $subCategory->id }}"
                                        action="{{ route('sub-categories.destroy', $subCategory->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $subCategory->id }})"
                                            class="btn btn-danger btn-sm">
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
    @endif
@endsection