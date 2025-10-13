
<x-app-layout>
    

    <div class="py-12 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
                <div class="flex items-center justify-between mb-10">
    <h2 class="text-2xl font-bold text-white border-b-2 border-blue-500 inline-block pb-1">
        Buat JJ
    </h2>

    <a href="{{ route('jj.select') }}"
        class="bg-blue-600 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition">
        &larr; Kembali
    </a>
</div>
            

            <!-- Form Upload -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl p-8">
            <div class="py-10">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Unggah Video</h3>

                <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                     <div>
    <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Jenis Upload</label>
    <div class="w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-gray-800 dark:bg-gray-700 dark:text-white">
        Video
    </div>
    <input type="hidden" name="type" value="video">
    <input type="hidden" name="is_free" value="1"> <!-- ✅ Tambahkan baris ini -->
</div>


                 <!-- File Input -->
            <div>
                <label for="file" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Pilih File Video</label>
                <input type="file" name="file" id="file" accept="video/*"
                    class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded p-2 text-sm text-gray-700 dark:text-gray-200"
                    required>
                <small class="text-red-500 text-sm mt-1" id="fileError"></small>
                <div id="preview" class="mt-4"></div>
            </div>

<!-- Script Validasi Durasi & Ukuran -->
<script>
    document.getElementById('file').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        const fileError = document.getElementById('fileError');
        preview.innerHTML = '';
        fileError.textContent = '';

        if (!file) return;

        // Validasi ukuran maksimal 2MB
        const maxSizeMB = 2;
        if (file.size > maxSizeMB * 1024 * 1024) {
            fileError.textContent = 'Ukuran video maksimal 2 MB.';
            e.target.value = '';
            return;
        }

        // Validasi durasi maksimal 25 detik
        const video = document.createElement('video');
        video.preload = 'metadata';
        video.src = URL.createObjectURL(file);
        video.onloadedmetadata = function () {
            URL.revokeObjectURL(video.src);
            const duration = video.duration;
            if (duration > 25) {
                fileError.textContent = 'Durasi video maksimal 25 detik.';
                e.target.value = '';
            } else {
                video.controls = true;
                video.className = 'w-64 h-40 object-cover rounded border border-gray-300';
                preview.appendChild(video);
            }
        };
    });
</script>



                   <div class="grid grid-cols-1 gap-4">

    <div class="md:col-span-1">
        <!-- Biaya Upload -->
        <label class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">Biaya Upload</label>
        <div id="harga" class="text-lg font-semibold text-blue-600 dark:text-blue-400">Rp 0 (Gratis!!)</div>
        
      <!-- Syarat & Ketentuan -->
<div class="mt-4">
    <label class="block mb-2 text-xl font-semibold text-gray-700 dark:text-gray-300">
        Syarat & Ketentuan (S&K) :
    </label>
    <ul class="list-decimal pl-5 text-x text-gray-700 dark:text-gray-300">
        <li>Maksimal ukuran video adalah 2MB</li>
        <li>Durasi video maksimal 25 detik</li>
    </ul>
</div>


 <!-- Tombol Submit -->
        <div class="mt-4 text-right">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow ">
                Unggah Sekarang
            </button>
        </div>
    </div>
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




