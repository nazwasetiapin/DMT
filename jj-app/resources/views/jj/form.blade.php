<x-app-layout>
    

    <div class="py-12 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
                <div>
                <h2 class="text-2xl font-bold text-white border-b-2 border-blue-500 inline-block mb-4 pb-1">
                    Buat JJ
                </h2>
                </div>
            

            <!-- Form Upload -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl p-8">
            <div class="py-10">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Unggah Foto / Video</h3>

                <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Upload</label>
                        <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white" onchange="updateHarga()">
                            <option value="foto">Foto</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <div>
                        <label for="file" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih File Foto/Video</label>
                        <input type="file" name="file[]" id="file" accept="image/*,video/*" multiple class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded p-2 text-sm text-gray-700 dark:text-gray-200" required>
                        <div id="preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Upload</label>
                            <div id="harga" class="text-lg font-semibold text-blue-600 dark:text-blue-400">Rp 15.000</div>
                    
                        </div>

                        

                    <div>
                        <label for="request_note" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Request Tambahan</label>
                        <textarea name="request_note" rows="3" class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white" placeholder="Contoh: Minta diedit cerah, tambahkan musik..."></textarea>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow">
                            Unggah Sekarang
                        </button>
                    </div>
                    <div>
                            <label for="bukti" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Pembayaran (foto)</label>
                            <input type="file" name="bukti" id="bukti" accept="image/*" class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded p-2 text-sm text-gray-700 dark:text-gray-200" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateHarga() {
            const type = document.getElementById('type').value;
            const harga = type === 'foto' ? 'Rp 15.000' : 'Rp 10.000';
            document.getElementById('harga').innerText = harga;
        }

        document.getElementById('file').addEventListener('change', function (event) {
    const previewContainer = document.getElementById('preview');
    previewContainer.innerHTML = ''; // clear existing

    Array.from(event.target.files).forEach(file => {
        const fileType = file.type;
        const reader = new FileReader();

        reader.onload = function (e) {
            const mediaElement = document.createElement(fileType.startsWith('video') ? 'video' : 'img');
            mediaElement.src = e.target.result;
            mediaElement.className = 'rounded shadow w-full';
            mediaElement.controls = fileType.startsWith('video');
            mediaElement.alt = file.name;
            previewContainer.appendChild(mediaElement);
        };

        reader.readAsDataURL(file);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('file').addEventListener('change', function (event) {
        const previewContainer = document.getElementById('preview');
        previewContainer.innerHTML = ''; // Bersihkan preview sebelumnya

        Array.from(event.target.files).forEach(file => {
            const fileType = file.type;
            const reader = new FileReader();

            reader.onload = function (e) {
                const mediaElement = document.createElement(fileType.startsWith('video') ? 'video' : 'img');
                mediaElement.src = e.target.result;
                mediaElement.className = 'rounded shadow w-full';
                if (fileType.startsWith('video')) {
                    mediaElement.controls = true;
                }
                previewContainer.appendChild(mediaElement);
            };

            reader.readAsDataURL(file);
        });
    });
});


    </script>
    @endpush
</x-app-layout>
