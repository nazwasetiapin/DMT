@extends('layouts.app')

@section('title', 'Edit Upload')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Upload</h1>
  </div>

  <div class="section-body">
    <form action="{{ route('admin.uploads.update', $upload->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control" required>
          <option value="diproses" {{ $upload->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
          <option value="selesai" {{ $upload->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
      </div>

      <div class="form-group">
        <label>Upload File Hasil (Opsional)</label>
        <input type="file" name="processed_file" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</section>
@endsection
