  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Undangan Digital</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;500&display=swap" rel="stylesheet">

  <style>
    body {
      background:
        linear-gradient(rgba(245, 240, 223, 0.9), rgba(248, 245, 225, 0.9)),
        url("images/pink.png") repeat;
      background-size: 250px;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      position: relative;
      z-index: 1;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.9) url("images/bunga2.png") center top no-repeat;
      background-size: cover;
      background-position: center;
      padding: 30px;
      border-radius: 15px;
      border: 2px solid rgba(212, 175, 55, 0.8);
      box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
      max-width: 600px;
      width: 100%;
      text-align: center;
    }

    .judul-utama {
      font-family: 'Great Vibes', cursive;
      color: rgba(65, 21, 2, 0.9);
      font-size: 3rem;
      margin-bottom: 20px;
    }

    .btn-outline-brown {
      border: 2px solid #8b4513;
      color: #8b4513;
      background: transparent;
      transition: 0.3s;
    }

    .btn-outline-brown:hover {
      background: #5a2d1a;
      color: #fff;
    }

    label {
      font-family: 'Poppins', sans-serif;
      font-weight: 500;
      color: #4a2e2e;
    }

    .form-control,
    .form-select {
      background: rgba(255, 255, 255, 0.7);
      border: 1px solid rgba(90, 45, 26, 0.3);
    }

    .btn-submit {
      background: #5a2d1a;
      border: none;
      font-weight: 500;
      transition: all 0.3s ease;
      color: white;
      border-radius: 10px;
    }

    .btn-submit:hover {
      background: rgba(120, 60, 40, 0.95);
      transform: scale(1.03);
    }

   /* ✅ Responsive khusus HP */
@media (max-width: 1000px) {
  .form-container {
    max-width: 90% !important;
    font-size: 2.3rem;
    border-radius: 20px;  
    padding: 35px;
  }

  .btn-outline-brown {
    font-size: 1.6rem;
    padding: 15px 25px;
    min-height: 60px; 
    border-radius: 12px;   /* tombol sudut halus */
  }


  .form-control,
  .form-select,
  textarea {
    font-size: 2.0rem;
    padding: 50px 52px;   /* tinggi banget */
    min-height: 20px;     /* input / select jadi tinggi */
  }

  textarea {
    min-height: 400px;    /* area ucapan lebih besar */
  }

   .btn-outline-primary {
    font-size: 2.0rem;
    padding: 35px 35px;
    min-height: 90px; 
    border-radius: 12px; 
   }

  .btn-submit {
    font-size: 2.3rem;
    padding: 22px;
    margin-top: 5px;
    min-height: 120px;     /* tombol besar banget */
     border-radius: 12px;
  }

  .judul-utama {
    font-size: 5rem;
    margin-bottom: 35px;
  }
}


  </style>


  </head>

  <body>
  <div class=""></div>  <!-- ✅ Background dipisah -->

    <div class="form-container">
    <div class="mb-3">
  <h1 class="judul-utama text-center">
    Tamu Undangan
  </h1>
    <div class="d-flex justify-content-end mt-4">
      <a href="/album" class="btn btn-outline-brown">
        Lihat data tamu undangan
      </a>
    </div>
  </div>
    <form action="{{ route('guests.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3 text-start">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" required>
    </div>

    <div class="mb-3 text-start">
    <label class="form-label">Nomor WhatsApp</label>
    <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" 
          placeholder="Masukkan nomor WhatsApp" required>

    @error('whatsapp')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

    <div class="mb-3 text-start">
      <label class="form-label">Alamat</label>
      <input type="text" name="address" class="form-control" placeholder="Masukkan alamat" required>
    </div>

    <div class="mb-3 text-start">
      <label class="form-label">Ucapan</label>
      <textarea name="message" class="form-control" placeholder="Tulis ucapan untuk pengantin" required></textarea>
    </div>

    <div class="mb-3 text-start">
    <label class="form-label">Jenis Hadiah</label>
    <select name="gift_type" id="gift_type" class="form-select" required>
      <option value="">Pilih...</option>
      <option value="transfer">Transfer</option>
      <option value="cash">Cash</option>
      <option value="barang">Barang</option>
    </select>
  </div>

  <!-- ✅ Pilihan barang -->
<div class="mb-3 text-start d-none" id="barang-options">
  <label class="form-label">Barang yang ingin dikirim</label>
  <input type="text" name="barang_name" id="barang_name" class="form-control" placeholder="Contoh: Bunga, Baju, dll">
</div>

 <!-- ✅ Pilihan cash -->
<div class="mb-3 text-start d-none" id="cash-options">
  <label class="form-label">Masukkan Nominal Cash</label>
  <input type="text" name="cash_amount" id="cash_amount" class="form-control" placeholder="Masukkan nominal (Rp)">
</div>

  <!-- ✅ Pilihan transfer -->
  <div class="mb-3 text-start d-none" id="transfer-options">
    <label class="form-label">Pilih Nominal</label>
    <div class="d-flex flex-wrap gap-2">
      <button type="button" class="btn btn-outline-primary nominal-btn" data-value="50000">50.000</button>
      <button type="button" class="btn btn-outline-primary nominal-btn" data-value="100000">100.000</button>
      <button type="button" class="btn btn-outline-primary nominal-btn" data-value="150000">150.000</button>
    </div>

    <div class="mt-3">
  <label class="form-label">Atau Masukkan Nominal Sendiri</label>
  <input type="text" name="transfer_amount" id="transfer_amount" class="form-control" placeholder="Masukkan nominal (Rp)">
</div>

    <!-- ✅ Pilih metode transfer -->
    <div class="mt-3">
      <label class="form-label">Metode Transfer</label>
      <select name="transfer_method" id="transfer_method" class="form-select">
        <option value="">Pilih...</option>
        <option value="bca">BCA</option>
        <option value="bri">BRI</option>
        <option value="mandiri">Mandiri</option>
        <option value="dana">DANA</option>
        <option value="ovo">OVO</option>
        <option value="gopay">Gopay</option>
      </select>
    </div>

    <!-- ✅ Info rekening otomatis -->
    <div class="mt-3 d-none" id="rekening-info">
      <div class="alert alert-warning p-2" id="rekening-text"></div>
    </div>

    <!-- ✅ Upload bukti transfer -->
    <div class="mt-3">
      <label class="form-label">Upload Bukti Transfer</label>
      <input type="file" name="proof" class="form-control" accept="image/*">
    </div>
  </div>


    <div class="mb-3 text-start">
      <label class="form-label">Foto kamu saat sedang di acara</label>
      <input type="file" name="photo" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-lg w-100 btn-submit">
      Kirim
    </button>
  </form>
    </div>
<script>
  const giftType = document.getElementById('gift_type');
  const transferOptions = document.getElementById('transfer-options');
  const nominalButtons = document.querySelectorAll('.nominal-btn');
  const transferInput = document.getElementById('transfer_amount');
  const transferMethod = document.getElementById('transfer_method');
  const rekeningInfo = document.getElementById('rekening-info');
  const rekeningText = document.getElementById('rekening-text');
  const cashOptions = document.getElementById('cash-options'); 
  const cashAmount = document.getElementById('cash_amount');   
  const barangOptions = document.getElementById('barang-options'); 
  const barangName = document.getElementById('barang_name');       

  // ✅ Tampilkan pilihan sesuai gift_type
  giftType.addEventListener('change', function() {
    if (this.value === 'transfer') {
      transferOptions.classList.remove('d-none');
      cashOptions.classList.add('d-none');
      barangOptions.classList.add('d-none');
      cashAmount.value = "";
      barangName.value = "";
    } else if (this.value === 'cash') {
      cashOptions.classList.remove('d-none');
      transferOptions.classList.add('d-none');
      barangOptions.classList.add('d-none');
      transferInput.value = '';
      transferMethod.value = '';
      rekeningInfo.classList.add('d-none');
      barangName.value = "";
    } else if (this.value === 'barang') {
      barangOptions.classList.remove('d-none');
      cashOptions.classList.add('d-none');
      transferOptions.classList.add('d-none');
      transferInput.value = '';
      transferMethod.value = '';
      rekeningInfo.classList.add('d-none');
      cashAmount.value = "";
    } else {
      transferOptions.classList.add('d-none');
      cashOptions.classList.add('d-none');
      barangOptions.classList.add('d-none');
      transferInput.value = '';
      transferMethod.value = '';
      rekeningInfo.classList.add('d-none');
      cashAmount.value = "";
      barangName.value = "";
    }
  });

  // ✅ Kalau tombol nominal dipilih
  nominalButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      transferInput.value = formatRupiah(this.dataset.value);
    });
  });

  // ✅ Pilih metode transfer → tampilkan rekening
  transferMethod.addEventListener('change', function () {
    let info = "";
    switch (this.value) {
      case "bca":
        info = "BCA - 1234567890 a.n. Satrio";
        break;
      case "bri":
        info = "BRI - 9876543210 a.n. Nama Pengantin";
        break;
      case "mandiri":
        info = "Mandiri - 1122334455 a.n. Nama Pengantin";
        break;
      case "dana":
        info = "DANA - 081234567890 a.n. Nama Pengantin";
        break;
      case "ovo":
        info = "OVO - 081234567890 a.n. Nama Pengantin";
        break;
      case "gopay":
        info = "Gopay - 081234567890 a.n. Nama Pengantin";
        break;
      default:
        info = "";
    }

    if (info !== "") {
      rekeningText.textContent = info;
      rekeningInfo.classList.remove("d-none");
    } else {
      rekeningInfo.classList.add("d-none");
    }
  });

  // ✅ Fungsi format Rupiah
  function formatRupiah(angka) {
    let numberString = angka.replace(/[^,\d]/g, '').toString(),
        split = numberString.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
  }

  // ✅ Format otomatis saat ketik nominal cash
  cashAmount.addEventListener('input', function() {
    this.value = formatRupiah(this.value);
  });

  // ✅ Format otomatis saat ketik nominal transfer
  transferInput.addEventListener('input', function() {
    this.value = formatRupiah(this.value);
  });
</script>




  </body>

  </html>
