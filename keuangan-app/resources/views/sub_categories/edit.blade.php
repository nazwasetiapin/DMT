@extends('layouts.app')

@section('title', 'Edit Sub Category')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Edit Sub Category</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('sub-categories.update', $subCategory->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name">Nama Sub Category</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subCategory->name) }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
