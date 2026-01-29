<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user-cog mr-2"></i> Profil Admin
                </h5>
            </div>

            <div class="card-body">

                {{-- FOTO PROFIL --}}
                <div class="text-center mb-4">
                    @if(auth()->user()->photo)
                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="rounded-circle shadow" width="120"
                        height="120" style="object-fit: cover;">
                    @else
                    <img src="{{ asset('sb-admin2/img/admin.png') }}" class="rounded-circle shadow" width="120"
                        height="120" style="object-fit: cover;">
                    @endif

                    <h5 class="mt-3 mb-0 font-weight-bold">
                        {{ auth()->user()->username }}
                    </h5>
                    <small class="text-muted">Admin</small>
                </div>

                <hr>

                {{-- FORM UPDATE PROFIL --}}
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="font-weight-semibold">
                            <i class="fas fa-user mr-1"></i> Username
                        </label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', auth()->user()->username) }}">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-semibold">
                            <i class="fas fa-image mr-1"></i> Foto Profil
                        </label>
                        <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                        @error('photo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ROLE --}}
                    <div class="form-group">
                        <label class="font-weight-semibold">
                            <i class="fas fa-shield-alt mr-1"></i> Role
                        </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->role }}" readonly>
                    </div>

                    <div class="text-right mt-4">
                        <button class="btn btn-primary px-4">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>