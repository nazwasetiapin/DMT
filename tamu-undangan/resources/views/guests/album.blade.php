<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Tamu Undangan Wedding</title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>

    /* Biar scrollbar selalu ada → layout nggak geser */
html {
  overflow-y: scroll;
}

/* Pastikan table tetap di tengah */
.table-container table {
  margin-left: auto;
  margin-right: auto;
  text-align: left; /* default isi ke kiri */
}
    h1 {
      font-family: 'Great Vibes', cursive;
      font-size: 3rem;
      margin-top: 40px;
      text-align: center;
      color: #5a3825;
    }
    /* Scrollbar */
    .table-container {
      position: relative; 
      overflow: hidden;
    }
    .table-container::-webkit-scrollbar {
      height: 8px;
    }
    .table-container::-webkit-scrollbar-track {
      background: #f5f5dc;
    }
    .table-container::-webkit-scrollbar-thumb {
      background: #8b6b3f;
      border-radius: 4px;
    }
    /* Modal */
    .modal { display: none; }
    .modal.active { display: flex; }
  </style>
</head>
<body class="bg-gradient-to-r from-[#fdf6e3] via-[#f5deb3] to-[#d2b48c] min-h-screen flex items-center justify-center p-6 font-sans">

 <div class="max-w-6xl w-full bg-white rounded-xl shadow-lg overflow-hidden relative">
  
  <!-- 🌸 Bunga background -->
  <img src="images/putihh.png" 
       class="absolute bottom-0 right-0 w-72 opacity-40 pointer-events-none select-none z-0" />

  <!-- Konten di atas bunga -->
  <div class="relative z-10">
    <h1 class="text-3xl font-semibold text-center py-6 border-b border-gray-200 bg-[#f5deb3]">
      Data Tamu Undangan Wedding
    </h1>

   <!-- Form Pencarian -->
   <div class="bg-[#f5deb3] px-4 py-3 border-b border-gray-200">
    <form method="GET" action="{{ route('guests.album') }}" 
          class="flex flex-col sm:flex-row gap-2 sm:gap-0 justify-start">
      <input type="text" name="search" placeholder="Cari nama tamu..."
        value="{{ request('search') }}"
        class="border rounded px-4 py-2 w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-[#8b6b3f]">
      <button type="submit"
        class="bg-[#8b6b3f] text-white px-4 py-2 rounded hover:bg-[#a0784d] transition">
        Cari
      </button>
    </form>
   </div>

    <!-- Table -->
    <div class="table-container overflow-x-auto">
      <table class="min-w-full table-auto border-collapse text-sm sm:text-base">
        <thead class="bg-gradient-to-r from-[#d2b48c] to-[#8b6b3f] text-white">
          <tr>
            <th class="p-2 sm:p-4 text-left rounded-tl-lg">Foto</th>
            <th class="p-2 sm:p-4 text-left">Nama</th>
            <th class="p-2 sm:p-4 text-left rounded-tr-lg">Pesan</th>
          </tr>
        </thead>
        <tbody id="guest-list" class="divide-y divide-gray-200 text-xs sm:text-base">
          @include('guests.partials.album-rows', ['guests' => $guests])
        </tbody>
      </table>
    </div>

    <!-- Pagination / Loader -->
    <div id="load-more" class="text-center py-4 text-gray-500 hidden">
      Loading...
    </div>

    <!-- Modal Zoom Foto -->
    <div id="photo-modal" class="modal fixed inset-0 bg-black bg-opacity-70 justify-center items-center z-50">
      <span id="close-modal" class="absolute top-6 right-6 text-white text-3xl cursor-pointer">&times;</span>
      <img id="modal-img" src="" alt="Zoom Foto" class="max-w-[90%] max-h-[90%] rounded-lg shadow-lg border-4 border-white" />
    </div>
  </div>
 </div>

  <script>
    // Zoom foto
    document.addEventListener('click', e => {
      if (e.target.classList.contains('zoomable')) {
        const modal = document.getElementById('photo-modal');
        const modalImg = document.getElementById('modal-img');
        modalImg.src = e.target.src;
        modal.classList.add('active');
      }
    });
    document.getElementById('close-modal').addEventListener('click', () => {
      document.getElementById('photo-modal').classList.remove('active');
    });
    document.getElementById('photo-modal').addEventListener('click', (e) => {
      if (e.target === e.currentTarget) {
        e.currentTarget.classList.remove('active');
      }
    });

    // Infinite scroll
    let page = 1;
    let loading = false;
    let hasMore = true;

    function scrollHandler() {
      if (!hasMore) return;
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
        loadMore();
      }
    }
    window.addEventListener('scroll', scrollHandler);

    async function loadMore() {
      if (loading || !hasMore) return;
      loading = true;

      const nextPage = page + 1;
      const loader = document.getElementById('load-more');
      loader.classList.remove('hidden');
      loader.innerText = "Loading...";

      try {
        const res = await fetch(`?page=${nextPage}`, {
          headers: { 
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "application/json"
          }
        });

        const json = await res.json();

        if (json.html && json.html.trim() !== "") {
          document.getElementById('guest-list').insertAdjacentHTML('beforeend', json.html);
          page = nextPage;
        }

        hasMore = json.hasMore;

        if (!hasMore) {
          loader.innerText = "✨ Semua tamu sudah ditampilkan.";
          window.removeEventListener('scroll', scrollHandler);
        } else {
          loader.classList.add('hidden');
        }
      } catch (err) {
        console.error(err);
        loader.innerText = "❌ Terjadi error.";
      } finally {
        loading = false;
      }
    }
  </script>
</body>
</html>
