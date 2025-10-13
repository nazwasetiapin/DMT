<!DOCTYPE html>
<html>
<head>
  <title>Terima Kasih</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Import font kaligrafi -->
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

  <style>
       body {
  background: 
    linear-gradient(rgba(245, 240, 223, 0.9), rgba(248, 245, 225, 0.9)), /* overlay krem transparan */
    url("images/pink.png") repeat;  /* pattern */
  background-size: 250px;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  z-index: 1;
}


    .thankyou-box {
      background: url("images/bunga4.png") center center repeat;
      background-size: contain; /* coba contain dulu biar motifnya pas */
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      animation: fadeIn 1.5s ease-in-out;

      /* kasih layer putih transparan biar teks kebaca */
      position: relative;
      overflow: hidden;
    }

    .thankyou-box::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(255,255,255,0.8); /* putih transparan */
      border-radius: 20px;
      z-index: 1;
    }

    .thankyou-box * {
      position: relative;
      z-index: 2;
    }

    h2 {
      font-family: 'Great Vibes', cursive;
      font-size: 60px;   /* lebih besar dari 42px */
      color: #5c3a2e;
      margin-bottom: 30px;
      animation: fadeInUp 2s;
    }

    p {
      font-size: 24px;   /* lebih besar dari 18px */
      color: #555;
      font-style: italic;
    }

   .btn-outline-brown {
  border: 2px solid #5c3a2e;       /* coklat tua */
  color: #fff8f0;                  /* putih krem untuk teks */
  background-color: #764e30ff;       /* coklat hangat */
  border-radius: 15px;             /* biar lebih soft */
  padding: 10px 24px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-outline-brown:hover {
  background-color: #5c3a2e;       /* lebih gelap saat hover */
  border-color: #5c3a2e;
  color: #ffffff;
  transform: translateY(-2px);     /* sedikit naik saat hover */
  box-shadow: 0 6px 12px rgba(92, 58, 46, 0.3);
}


    /* Animasi Fade */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="d-flex vh-100 justify-content-center align-items-center">
  <div class="text-center">
    <div class="thankyou-box">
      <h2> Terima Kasih sudah mengisi Buku Tamu </h2>
      <p>Ucapan & doamu sangat berarti bagi kami ❤️</p>
    </div>

    <!-- Tombol di bawah card -->
    <div class="mt-4">
      <a href="/album" class="btn btn-outline-brown">
        Lihat data tamu undangan
      </a>
    </div>
  </div>
</body>

</html>
