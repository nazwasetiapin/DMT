<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Admin - Upload User
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Daftar Upload</h3>

                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Jenis</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($uploads as $upload)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $upload->user->name }}</td>
                            <td class="px-4 py-2 capitalize">{{ $upload->type }}</td>
                            <td class="px-4 py-2">
                                @if($upload->status === 'pending')
                                    <span class="text-yellow-500">Menunggu</span>
                                @elseif($upload->status === 'approved')
                                    <span class="text-green-500">Disetujui</span>
                                @elseif($upload->status === 'rejected')
                                    <span class="text-red-500">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                @if($upload->status === 'pending')
                                <form method="POST" action="{{ route('admin.uploads.approve', $upload->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('admin.uploads.reject', $upload->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Tolak</button>
                                </form>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada data upload</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
