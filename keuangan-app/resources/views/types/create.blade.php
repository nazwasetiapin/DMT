@extends('layouts.app')

@section('content')
<h1>Tambah Tipe</h1>
<form action="{{ route('types.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Tipe</label>
        <input type="text" name="name" class="form-control" required>
    </div>

   

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
