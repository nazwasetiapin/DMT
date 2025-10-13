<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitor Buku Tamu Wedding</title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
 <style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f8f5e1;
    margin: 0;
    padding: 0;
    overflow: hidden;
  }

  h2 {
    font-family: 'Great Vibes', cursive;
    font-size: 3rem;
    text-align: center;
    margin: 20px 0;
    color: #5a3825;
  }

  .card {
    width: 90%;
    max-width: 1100px;
    height: 550px;
    margin: 40px auto 0;
    display: flex;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    overflow: hidden;
  }

  /* Foto bagian kiri */
  .photo {
    flex: 1;
    background: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transform: translateY(100%);
    transition: all 1s ease-in-out;
  }

  .photo img.active {
    opacity: 1;
    transform: translateY(0);
    z-index: 2;
  }

  .photo img.prev {
    opacity: 0;
    transform: translateY(-100%);
    z-index: 1;
  }

  /* Teks bubble bagian kanan */
  .text-section {
    flex: 1;
    background: #fefbf5;
    padding: 20px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
  }

  .bubbles {
    display: flex;
    flex-direction: column;
    gap: 15px;
    animation: slideUp 300s linear infinite;
  }

  @keyframes slideUp {
    0% { transform: translateY(100%); }
    100% { transform: translateY(-500%); }
  }

  .bubble {
  background: #fff;
  border-radius: 20px;
  padding: 12px 16px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  max-width: 90%;
  display: flex;
  align-items: center;
  gap: 12px;

  /* muncul cepat */
  opacity: 0;
  transform: translateY(20px);
  animation: fadeInUp 3.0s ease-out forwards; /* lebih cepat */
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}


  .bubble .avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%; /* bulat */
    object-fit: cover;
    flex-shrink: 0;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }

  .bubble-content {
    display: flex;
    flex-direction: column;
  }

  .bubble-content h4 {
    margin: 0;
    font-size: 1.1rem;
    color: #5a3825;
  }

  .bubble-content p {
    margin: 4px 0 0;
    font-size: 0.95rem;
    color: #444;
  }

  /* Dekorasi bunga */
  .flower-top-left {
    position: fixed;
    top: 10px;
    left: 10px;
    width: 220px;
    opacity: 0.7;
    z-index: 5;
  }

  .flower-bottom-right {
    position: fixed;
    bottom: 10px;
    right: 10px;
    width: 220px;
    opacity: 0.7;
    z-index: 5;
  }
</style>

</head>
<body>
  <h2>Special Greeting</h2>

  <div class="card">
    <!-- Slideshow Foto tamu -->
    <div class="photo">
      @foreach($guests as $index => $guest)
        @if($guest->photo)
          <img src="{{ asset('storage/'.$guest->photo) }}" 
               alt="Foto {{ $guest->name }}" 
               class="{{ $index === 0 ? 'active' : '' }}">
        @else
          <img src="https://ui-avatars.com/api/?name={{ urlencode($guest->name) }}&background=8b4513&color=fff" 
               alt="Avatar {{ $guest->name }}" 
               class="{{ $index === 0 ? 'active' : '' }}">
        @endif
      @endforeach
    </div>

    <!-- List ucapan -->
    <div class="text-section">
      <div class="bubbles">
  @foreach($guests as $guest)
    <div class="bubble">
      <img class="avatar" src="{{ $guest->photo ? asset('storage/'.$guest->photo) : 'https://ui-avatars.com/api/?name='.urlencode($guest->name).'&background=8b4513&color=fff' }}" alt="Foto {{ $guest->name }}">
      <div class="bubble-content">
        <h4>{{ $guest->name }}</h4>
        <p>{{ $guest->message }}</p>
      </div>
    </div>
  @endforeach

  <!-- duplikat buat loop halus -->
  @foreach($guests as $guest)
    <div class="bubble">
      <img class="avatar" src="{{ $guest->photo ? asset('storage/'.$guest->photo) : 'https://ui-avatars.com/api/?name='.urlencode($guest->name).'&background=8b4513&color=fff' }}" alt="Foto {{ $guest->name }}">
      <div class="bubble-content">
        <h4>{{ $guest->name }}</h4>
        <p>{{ $guest->message }}</p>
      </div>
    </div>
  @endforeach
</div>

    </div>
  </div>

  <!-- Dekorasi bunga -->
  <img src="images/bungaputih.png" class="flower-top-left">
  <img src="images/bungaedit.png" class="flower-bottom-right">

  <!-- Script slideshow -->
  <script>
    let photos = document.querySelectorAll('.photo img');
    let current = 0;

    function showNextPhoto() {
      let prev = current;
      photos[prev].classList.remove('active');
      photos[prev].classList.add('prev');

      current = (current + 1) % photos.length;

      photos[current].classList.remove('prev');
      photos[current].classList.add('active');
    }

    setInterval(showNextPhoto, 4000); // ganti foto tiap 4 detik
  </script>
</body>
</html>