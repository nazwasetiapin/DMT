<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #eef3f9;
            height: 100vh;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .form-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .form-subtitle {
            font-size: 14px;
            color: #888;
        }

        .input-group-text {
            background-color: #fff;
        }

        .register-link a {
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <h4 class="text-center form-title">Registrasi Akun Baru</h4>
                    <p class="text-center form-subtitle">Masukkan data lengkapmu</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nomor WhatsApp --}}
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">Nomor WhatsApp:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                                <input type="text" name="no_wa" id="no_wa" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_wa') }}" required>
                            </div>
                            @error('no_wa')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Username TikTok 1 (wajib) --}}
                        <div class="mb-3">
                            <label for="username" class="form-label">Username TikTok 1:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-tiktok text-dark"></i></span>
                                <input type="text" name="username" id="username" class="form-control" placeholder="@tiktokkamu" value="{{ old('username') }}" required>
                            </div>
                            @error('username')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Username TikTok 2 (opsional) --}}
                        <div class="mb-3">
                            <label for="username2" class="form-label">Username TikTok 2 (opsional):</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-tiktok text-dark"></i></span>
                                <input type="text" name="username2" id="username2" class="form-control" placeholder="Boleh dikosongkan" value="{{ old('username2') }}">
                            </div>
                            @error('username2')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Daftar Sekarang
                        </button>

                        <div class="text-center mt-3 register-link">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            <a href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelector("form").addEventListener("submit", function (e) {
        e.target.querySelector("button[type='submit']").disabled = true;
    });
</script>


</body>
</html>
