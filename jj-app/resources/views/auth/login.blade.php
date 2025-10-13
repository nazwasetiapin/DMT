<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://unpkg.com/tailwindcss@1.9.6/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">

<div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 uppercase">Login Akun</h2>

    {{-- Error login umum --}}
    @if ($errors->has('login'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded text-center font-semibold">
            {{ $errors->first('login') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Nomor WhatsApp --}}
        <div class="mb-4">
            <label for="no_wa" class="block text-sm text-gray-700 mb-1">Nomor WhatsApp:</label>
            <input id="no_wa" type="text" name="no_wa" value="{{ old('no_wa') }}"
                   placeholder="Nomor WhatsApp"
                   class="w-full px-4 py-2 border 
                          {{ $errors->has('no_wa') ? 'border-red-500' : 'border-gray-300' }} 
                          rounded-lg focus:outline-none focus:border-blue-500">
            @error('no_wa')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Username TikTok --}}
        <div class="mb-4">
            <label for="username" class="block text-sm text-gray-700 mb-1">Username TikTok:</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}"
                   placeholder="Username TikTok"
                   class="w-full px-4 py-2 border 
                          {{ $errors->has('username') ? 'border-red-500' : 'border-gray-300' }} 
                          rounded-lg focus:outline-none focus:border-blue-500">
            @error('username')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Login --}}
        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150">
                Login
            </button>
        </div>
    </form>

    {{-- Link ke halaman register jika login gagal --}}
    @if (session('show_register'))
        <div class="mt-6 text-center">
            <a href="{{ route('register') }}"
               class="inline-block px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition duration-150">
                Belum punya akun? Daftar Sekarang
            </a>
        </div>
    @endif

</div>

</body>
</html>
