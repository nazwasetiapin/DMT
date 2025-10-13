<x-app-layout>
   

    <div class="py-10">

<div class="flex justify-end max-w-4xl mx-auto mb-4">
            <a href="{{ route('dashboard') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                &larr; Kembali
            </a>
        </div>

        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mb-7 ">
            Pilih Jenis Upload JJ :
        </h1>

        
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Upload Foto -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Upload Foto</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Biaya: <strong class="text-blue-600 dark:text-blue-400">Rp 15.000</strong></p>
                <a href="{{ route('jj.create.foto') }}" class="inline-block bg-blue-600 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition">
                    Pilih Upload Foto
                </a>
            </div>

            <!-- Upload Video -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Upload Video</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Biaya: <strong class="text-blue-600 dark:text-blue-400">Rp 10.000</strong></p>
                <a href="{{ route('jj.create.video') }}" class="inline-block bg-blue-600 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition">
                    Pilih Upload Video
                </a>
            </div>
           <!-- Upload Video Gratis -->
<div class="md:col-span-2 flex justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center w-full md:w-1/2">
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Upload Video Gratis!!</h3>

        <a href="{{ route('jj.create.video.gratis') }}" class="inline-block bg-blue-600 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition">
            Pilih Upload Video Gratis!!
        </a>
        <p class="text-s text-gray-800 dark:text-white mt-4">* Syarat dan Ketentuan Berlaku</p>
    </div>
</div>

        </div>
    </div>
</x-app-layout>
