@extends('layouts.app')

@section('title', 'Daftar Types')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800">Daftar Tipe</h1>
    <a href="{{ route('types.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Tipe
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($types->isEmpty())
    <div class="alert alert-info">Belum ada data type.</div>
@else
    <div class="card shadow">
        <div class="card-body">
              <table class="table table-bordered table-hover custom-table" id="dataTable" width="100%" cellspacing="0">

                    <tr>
                        <th>No</th>
                        <th>Nama Tipe</th>
                        
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $index => $type)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $type->name }}</td>
                          
                            <td>
                                <a href="{{ route('types.edit', $type->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> 
                                </a>
                                <form id="delete-form-{{ $type->id }}" action="{{ route('types.destroy', $type->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $type->id }})" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> 
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
