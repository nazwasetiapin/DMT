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
          <select name="type_id" class="form-control" required>
            @foreach($types as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Category</label>
          <select name="category_id" id="category_id" class="form-control" required>
            <option value="">-- Pilih Category --</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Sub Category</label>
          <select name="sub_category_id" id="sub_category_id" class="form-control">
            <option value="">-- Pilih Sub Category --</option>
          </select>
        </div>

        <div class="form-group">
          <label>Nominal</label>
          <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control"
            value="{{ old('tanggal', isset($trx) ? $trx->tanggal->format('Y-m-d') : '') }}" required>
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

@push('scripts')
  <script>
    document.getElementById('category_id').addEventListener('change', function () {
      let categoryId = this.value;
      let subCategorySelect = document.getElementById('sub_category_id');

      // reset pilihan
      subCategorySelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';

      if (categoryId) {
        fetch(`/get-subcategories/${categoryId}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(sub => {
              let option = document.createElement('option');
              option.value = sub.id;
              option.textContent = sub.name;
              subCategorySelect.appendChild(option);
            });
          });
      }
    });
  </script>
@endpush