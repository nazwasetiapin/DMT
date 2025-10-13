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
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Unggah Foto</h3>

                <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
    <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Jenis Upload</label>
    
    <div class="w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-gray-800 dark:bg-gray-700 dark:text-white">
        Foto
    </div>

    <input type="hidden" name="type" value="foto">
</div>

<!-- Upload Banyak Foto -->
<div>
    <label for="file" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Pilih File Foto</label>
    <input type="file" name="file[]" id="file" accept="image/*" multiple
        class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded p-2 text-sm text-gray-700 dark:text-gray-200" required>
    <div id="preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl font-bold hover:text-red-400">&times;</button>
    <img id="lightbox-img" src="" class="max-h-[80vh] max-w-[90vw] rounded shadow-lg">
</div>

<script>
    const inputFile = document.getElementById('file');
    const preview = document.getElementById('preview');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightboxImg.src = '';
    }

    inputFile.addEventListener('change', function () {
        preview.innerHTML = '';
        const files = Array.from(this.files);
        const dt = new DataTransfer();

        files.forEach((file) => {
            if (!file.type.startsWith('image/')) {
                alert(`File "${file.name}" bukan gambar.`);
                return;
            }

            // TIDAK ADA LAGI BATASAN SIZE

            dt.items.add(file);
            const reader = new FileReader();

            reader.onload = function (e) {
                const container = document.createElement('div');
                container.className = 'relative group';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-40 object-cover rounded border border-gray-300 cursor-pointer';

                img.onclick = () => {
                    lightboxImg.src = e.target.result;
                    lightbox.classList.remove('hidden');
                };

                const filename = document.createElement('p');
                filename.textContent = file.name;
                filename.className = 'mt-1 text-xs text-center text-gray-600 dark:text-gray-300 truncate';

                const removeBtn = document.createElement('button');
                removeBtn.textContent = '✕';
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 text-xs hidden group-hover:block';

                removeBtn.onclick = () => {
                    container.remove();
                    const newDt = new DataTransfer();
                    Array.from(dt.files).forEach(f => {
                        if (f.name !== file.name) newDt.items.add(f);
                    });
                    inputFile.files = newDt.files;
                };

                container.appendChild(img);
                container.appendChild(removeBtn);
                container.appendChild(filename);
                preview.appendChild(container);
            };

            reader.readAsDataURL(file);
        });

        inputFile.files = dt.files;
    });
</script>

                    <div class="grid grid-cols-1 gap-4">

                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">Biaya Upload</label>
                            <div id="harga" class="text-lg font-semibold text-blue-600 dark:text-blue-400">Rp 15.000</div>
                    
                        </div>

                        

                    <div>
                        <label for="request_note" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Request Tambahan</label>
                        <textarea name="request_note" rows="3" class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white" placeholder="Contoh: Minta diedit cerah, tambahkan musik..."></textarea>
                    </div>

                    
                  <!-- Bagian HTML -->
<div>
    <label for="bukti" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
        Bukti Pembayaran (foto)
    </label>
    <input type="file" name="bukti" id="bukti" accept="image/*"
        class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded p-2 text-sm text-gray-700 dark:text-gray-200"
        required>
    <div id="buktiPreview" class="mt-4"></div>
</div>

<!-- Modal preview untuk foto full -->
<div id="modalBukti" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80">
    <div class="relative">
        <button id="closeModalBukti" class="absolute top-2 right-2 text-white text-2xl font-bold">&times;</button>
        <img id="modalBuktiImage" src="" class="max-w-full max-h-screen rounded-lg shadow-lg" alt="Full Preview">
    </div>
</div>

<!-- Script JavaScript -->
<script>
    const buktiInput = document.getElementById('bukti');
    const buktiPreview = document.getElementById('buktiPreview');
    const modalBukti = document.getElementById('modalBukti');
    const modalBuktiImage = document.getElementById('modalBuktiImage');
    const closeModalBukti = document.getElementById('closeModalBukti');

    buktiInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        buktiPreview.innerHTML = '';

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview Bukti';
                img.classList.add('w-40', 'rounded', 'shadow', 'cursor-pointer');

                img.addEventListener('click', () => {
                    modalBuktiImage.src = img.src;
                    modalBukti.classList.remove('hidden');
                    modalBukti.classList.add('flex');
                });

                buktiPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    closeModalBukti.addEventListener('click', () => {
        modalBukti.classList.remove('flex');
        modalBukti.classList.add('hidden');
        modalBuktiImage.src = '';
    });

    // Tutup modal jika klik luar gambar
    modalBukti.addEventListener('click', (e) => {
        if (e.target === modalBukti) {
            modalBukti.classList.remove('flex');
            modalBukti.classList.add('hidden');
            modalBuktiImage.src = '';
        }
    });
</script>
                        <!-- button unggah -->
                    <div class="mt-4 text-right">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow ">
                Unggah Sekarang
            </button>
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
