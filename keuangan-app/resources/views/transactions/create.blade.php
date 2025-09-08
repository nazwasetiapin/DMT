@extends('layouts.app')

@section('title', 'Input Transaksi')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Input Transaksi</h1>

  <div class="card shadow mb-4">
    <div class="card-body">
      <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label>Tipe Transaksi</label>
          <select name="type_id" class="form-control">
            @foreach($types as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Category</label>
          <select name="category_id" class="form-control">
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Sub Category</label>
          <select name="sub_category_id" class="form-control">
            <option value="">-- Pilih Sub Category --</option>
            @foreach($subCategories as $subCategory)
              <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Nominal</label>
          <input type="number" name="amount" class="form-control">
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
@endsection
