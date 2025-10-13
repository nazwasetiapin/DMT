<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

          <!-- Info Kontak (Toggle Editable) -->
<div x-data="{ editMode: false }" class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl p-6 w-full sm:w-1/2 md:w-1/3">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Informasi Akun</h3>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('akun.update') }}">
        @csrf

       <!-- WhatsApp -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor WhatsApp:</label>

    <div x-show="!editMode">
          <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
            <span class="pl-3 pr-2 text-green-500 dark:text-green-300">
                <i class="fab fa-whatsapp"></i>
            </span>
            <input type="text" name="no_wa" value="{{ old('no_wa', Auth::user()->no_wa) }}"
                class="flex-1 pr-4 py-2 bg-transparent text-gray-800 dark:text-gray-100 focus:outline-none" />
        </div>
    </div>

    <div x-show="editMode">
        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
            <span class="pl-3 pr-2 text-green-500 dark:text-green-300">
                <i class="fab fa-whatsapp"></i>
            </span>
            <input type="text" name="no_wa" value="{{ old('no_wa', Auth::user()->no_wa) }}"
                class="flex-1 pr-4 py-2 bg-transparent text-gray-800 dark:text-gray-100 focus:outline-none" />
        </div>
    </div>
</div>


       <!-- TikTok 1 -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username Tiktok 1:</label>

    <!-- Mode tampilan -->
    <div x-show="!editMode">
          <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
            <span class="pl-3 pr-2 text-gray-500 dark:text-gray-300">
                <i class="fab fa-tiktok"></i>
            </span>
            <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                class="flex-1 pr-4 py-2 bg-transparent text-gray-800 dark:text-gray-100 focus:outline-none" />
        </div>
    </div>

    <!-- Mode edit -->
    <div x-show="editMode">
        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
            <span class="pl-3 pr-2 text-gray-500 dark:text-gray-300">
                <i class="fab fa-tiktok"></i>
            </span>
            <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                class="flex-1 pr-4 py-2 bg-transparent text-gray-800 dark:text-gray-100 focus:outline-none" />
        </div>
    </div>
</div>

        <!-- TikTok 2 -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username Tiktok (opsional) 2:</label>

    <!-- Mode tampilan -->
    <div x-show="!editMode">
          <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
            <span class="pl-3 pr-2 text-gray-500 dark:text-gray-300">
                <i class="fab fa-tiktok"></i>
            </span>
            <input type="text" name="username2" value="{{ old('username2', Auth::user()->username2) }}"
                class="flex-1 pr-4 py-2 bg-transparent text-gray-800 dark:text-gray-100 focus:outline-none" />
        </div>
    </div>

    <!-- Mode edit -->
    <div x-show="editMode">
        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
            <span class="pl-3 pr-2 text-gray-500 dark:text-gray-300">
                <i class="fab fa-tiktok"></i>
            </span>
            <input type="text" name="username2" value="{{ old('username2', Auth::user()->username2) }}"
                class="flex-1 pr-4 py-2 bg-transparent text-gray-800 dark:text-gray-100 focus:outline-none" />
        </div>
    </div>
</div>


        <!-- Tombol -->
        <div class="flex gap-2">
            <!-- Tombol Edit -->
            <button type="button"
                    x-show="!editMode"
                    @click="editMode = true"
                    class="px-4 py-2 bg-slate-500 hover:bg-slate-700





 text-white rounded">
                Edit
            </button>

            <!-- Tombol Simpan -->
            <button type="submit"
                    x-show="editMode"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                Simpan
            </button>

            <!-- Tombol Batal -->
            <button type="button"
                    x-show="editMode"
                    @click="editMode = false"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                Batal
            </button>
        </div>
    </form>
</div>


            <!-- Tombol Buat JJ -->
            <div class="w-full">
                <a href="{{ route('jj.select') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow">
                    Buat JJ Sekarang
                </a>
            </div>

            <!-- Daftar Upload -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl p-8">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Riwayat Upload Anda</h3>

                @if ($uploads->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Jenis</th>
                                    <th class="px-4 py-2">Tanggal Upload</th>
                                    <th class="px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($uploads as $index => $upload)
                                    <tr>
                                        <td class="px-4 py-2 font-medium">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ ucfirst($upload->type) }}</td>
                                        <td class="px-4 py-2">{{ $upload->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-4 py-2">
                                            @if ($upload->status === 'pending')
                                                <span class="text-yellow-600 font-semibold">Menunggu Proses</span>
                                            @elseif ($upload->status === 'approved')
                                                <span class="text-green-600 font-semibold">Disetujui ✅</span>
                                            @elseif ($upload->status === 'rejected')
                                                <span class="text-red-600 font-semibold">Ditolak ❌</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-300">Belum ada data upload.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
