@extends('layouts.app')

@section('title', 'Profil CEO')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 90vh;">

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="max-width: 650px; width: 100%;">

        {{-- HEADER --}}
        <div class="card-header text-white text-center py-4 position-relative"
            style="background: linear-gradient(135deg, #4e73df, #224abe);">

            {{-- Foto profil --}}
            <div class="position-absolute top-0 start-50 translate-middle-x"
                 style="width: 110px; height: 110px; margin-top: 20px;">
                <div class="bg-white rounded-circle shadow d-flex justify-content-center align-items-center position-relative"
                     style="width: 110px; height: 110px; overflow: hidden;">

                    {{-- Gambar preview --}}
                    <img 
                        id="preview-image"
                        src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) . '?v=' . time() : asset('sb-admin2/img/admin.png') }}"
                        alt="Foto Profil"
                        class="rounded-circle"
                        style="width: 110px; height: 110px; object-fit: cover; cursor: pointer;"
                        data-bs-toggle="modal"
                        data-bs-target="#photoModal"
                    />

                    {{-- Tombol edit foto --}}
                    <label for="photo"
                        class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px; bottom: 0; right: 0; cursor: pointer; border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.2); transition: 0.3s;">
                        <i class="fas fa-camera" style="font-size: 15px;"></i>
                    </label>
                </div>
            </div>

            <h4 class="mt-5 pt-4 fw-bold"><i class="fas fa-user-tie me-2"></i>Profil CEO</h4>
            <p class="text-white-50 small mb-0">Kelola identitas CEO utama perusahaan Anda</p>
        </div>

        {{-- BODY --}}
        <div class="card-body bg-light p-5">

            {{-- DATA CEO --}}
            <div class="text-center mb-4 mt-3">
                <h5 class="fw-bold text-primary mb-1">{{ auth()->user()->username ?? 'Belum Diisi' }}</h5>
                <span class="badge bg-gradient text-white px-3 py-2"
                      style="background: linear-gradient(90deg, #1cc88a, #198754); font-size: 0.85rem;">
                      CEO Utama
                </span>
            </div>

            {{-- FORM NAMA + FOTO --}}
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="animate__animated animate__fadeIn">
                @csrf
                @method('PATCH')

                {{-- Input foto tersembunyi --}}
                <input type="file" id="photo" name="photo" class="d-none" accept="image/*" onchange="previewFile(event)">

                <div class="bg-white p-4 rounded-4 shadow-sm border-start border-4 border-primary mb-4">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="fas fa-id-card me-2"></i> Ubah Data CEO
                    </h6>

                    {{-- Input nama --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control form-control-lg"
                               value="{{ old('username', auth()->user()->username) }}"
                               placeholder="Masukkan nama lengkap CEO">
                    </div>

                    <small class="text-muted d-block">Klik ikon kamera di foto untuk mengganti foto profil.</small>
                </div>

                {{-- Tombol Simpan --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary fw-semibold px-4 py-2 rounded-3 shadow-sm"
                            style="transition: all 0.3s;"
                            onmouseover="this.style.backgroundColor='#2e59d9'"
                            onmouseout="this.style.backgroundColor='#4e73df'">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>

{{-- MODAL PREVIEW FOTO --}}
<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="modal-image"
                     src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('sb-admin2/img/admin.png') }}"
                     class="img-fluid rounded"
                     alt="Foto CEO">
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PREVIEW FOTO --}}
<script>
    // Saat memilih foto baru
    function previewFile(event) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('modal-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Supaya modal menampilkan foto terbaru dari <img>
    const previewImage = document.getElementById('preview-image');
    const modalImage = document.getElementById('modal-image');
    previewImage.addEventListener('click', () => {
        modalImage.src = previewImage.src;
    });
</script>
@endsection
