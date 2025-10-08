@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
  <div class="section">
    <div class="section-header"></div>

    <div class="section-body">
      <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
          <h4 class="mb-0 h4 font-weight-bold">
            <i class="fas fa-edit mr-2"></i> Edit Transaksi
          </h4>
        </div>

        <div class="card-body p-4">
          <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
              <!-- Tipe Transaksi -->
              <div class="form-group col-md-6">
                <label><i class="fas fa-random mr-1 text-primary"></i> Tipe Transaksi</label>
                <select name="type_id" class="form-control shadow-sm @error('type_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Tipe --</option>
                  @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $transaction->type_id == $type->id ? 'selected' : '' }}>
                      {{ $type->name }}
                    </option>
                  @endforeach
                </select>
                @error('type_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Periode -->
              <div class="form-group col-md-6">
                <label><i class="fas fa-calendar-alt mr-1 text-info"></i> Periode</label>
                <select name="category_id" id="category_id"
                  class="form-control shadow-sm @error('category_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Periode Transaksi --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
                @error('category_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <!-- Jenis Transaksi -->
              <div class="form-group col-md-6">
                <label><i class="fas fa-list-ul mr-1 text-warning"></i> Jenis Transaksi</label>
                <select name="sub_category_id" id="sub_category_id"
                  class="form-control shadow-sm @error('sub_category_id') is-invalid @enderror">
                  <option value="">-- Pilih Jenis Transaksi --</option>
                  @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}" {{ $transaction->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                      {{ $subCategory->name }}
                    </option>
                  @endforeach
                </select>
                @error('sub_category_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Nominal -->
              <div class="form-group col-md-6">
                <label><i class="fas fa-money-bill-wave mr-1 text-success"></i> Nominal</label>
                <input type="number" name="amount" class="form-control shadow-sm @error('amount') is-invalid @enderror"
                  placeholder="Masukkan jumlah" value="{{ old('amount', $transaction->amount) }}" required>
                @error('amount')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Tanggal -->
            <div class="form-row">
              <div class="form-group col-md-12">
                <label><i class="fas fa-calendar-day mr-1 text-danger"></i> Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                  class="form-control shadow-sm @error('tanggal') is-invalid @enderror"
                  value="{{ old('tanggal', \Carbon\Carbon::parse($transaction->tanggal)->format('Y-m-d')) }}" required>
                @error('tanggal')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Deskripsi -->
            <div class="form-row">
              <div class="form-group col-md-12">
                <label><i class="fas fa-pencil-alt mr-1 text-secondary"></i> Deskripsi</label>
                <textarea name="deskripsi" class="form-control shadow-sm @error('deskripsi') is-invalid @enderror"
                  rows="3" placeholder="Tuliskan keterangan...">{{ old('deskripsi', $transaction->deskripsi) }}</textarea>
                @error('deskripsi')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <a href="{{ route('transactions.index') }}" class="btn btn-light border mr-2">
                <i class="fas fa-times mr-1"></i> Batal
              </a>
              <button type="submit" class="btn btn-primary shadow-sm">
                <i class="fas fa-save mr-1"></i> Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.getElementById('category_id').addEventListener('change', function () {
      let categoryId = this.value;
      let subCategorySelect = document.getElementById('sub_category_id');

      subCategorySelect.innerHTML = '<option value="">Memuat data...</option>';

      if (categoryId) {
        fetch(`/get-subcategories/${categoryId}`)
          .then(response => response.json())
          .then(data => {
            subCategorySelect.innerHTML = '<option value="">-- Pilih Jenis Transaksi --</option>';
            data.forEach(sub => {
              let option = document.createElement('option');
              option.value = sub.id;
              option.textContent = sub.name;
              subCategorySelect.appendChild(option);
            });
          })
          .catch(() => {
            subCategorySelect.innerHTML = '<option value="">Gagal memuat data</option>';
          });
      } else {
        subCategorySelect.innerHTML = '<option value="">-- Pilih Jenis Transaksi --</option>';
      }
    });
  </script>
@endpush