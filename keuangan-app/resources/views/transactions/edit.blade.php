@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
  <h1 class="h3 mb-4 text-gray-800">Edit Transaksi</h1>

  <div class="card shadow mb-4">
    <div class="card-body">
      <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
          <label>Tipe Transaksi</label>
          <select name="type_id" class="form-control">
            @foreach($types as $type)
              <option value="{{ $type->id }}" {{ $transaction->type_id == $type->id ? 'selected' : '' }}>
                {{ $type->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Kategori</label>
          <select name="category_id" class="form-control">
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Sub Kategori</label>
          <select name="sub_category_id" class="form-control">
            <option value="">-- Pilih Sub Kategori --</option>
            @foreach($subCategories as $subCategory)
              <option value="{{ $subCategory->id }}" {{ $transaction->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                {{ $subCategory->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Nominal</label>
          <input type="number" name="amount" value="{{ $transaction->amount }}" class="form-control">
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control">{{ $transaction->deskripsi }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
@endsection
