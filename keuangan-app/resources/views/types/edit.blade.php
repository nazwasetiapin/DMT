@extends('layouts.app')

@section('content')
<h1>Edit Tipe</h1>
<form action="{{ route('types.update', $type->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Tipe</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $type->name) }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('types.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
