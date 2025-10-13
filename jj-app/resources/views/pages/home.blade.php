<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JJbubble Menu Homepage</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
    --primary-color: #ff6b6b;
    --secondary-color: #4ecdc4;
    --dark-color: #292f36;
    --light-color: #f7fff7;
    --accent-color: #1e90ff; /* Ubah ke biru */
}


        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: var(--dark-color);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--light-color);
        }

        .logo span {
            color: var(--accent-color);
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: transparent;
            color: white;
            border: 2px solid var(--accent-color);
        }

        .btn-login:hover {
            background-color: var(--accent-color);
        }

        .btn-register {
            background-color: var(--accent-color);
            color: var(--dark-color);
        }

        .btn-register:hover {
             background-color: #000000;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero-content p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Menu Section */
        .menu-section {
            padding: 2rem 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
            color: var(--dark-color);
        }

        .menu-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .menu-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            padding: 1rem 1.5rem;
            display: inline-block;
            max-width: 100%;
        }


        .menu-item:hover {
            transform: translateY(-5px);
        }



        .menu-details {
            padding: 1.5rem;
        }

        .menu-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .menu-price {
            font-weight: 700;
            color: var(--accent-color);
            font-size: 1.1rem;
        }

        .menu-desc {
            margin-top: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        /* About Section */
        .about-section {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0;
            margin-top: 3rem;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content p {
            margin-bottom: 1rem;
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .hero {
                height: 250px;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }

            .hero {
                height: 200px;
            }

            .hero-content h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container header-content">
            <div class="logo">JJ<span>bubble</span></div>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-login">Masuk</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang Sobat Bubble</h1>
            <p>Ayo buat video Jedag-Jedug disini</p>
        </div>
    </section>

    <section class="container menu-section">
        <h2 class="section-title">Jenis Dan Harga</h2>
        <div class="menu-grid">

            <!-- Menu Item 1 -->
             <div class="menu-item">
                <div class="menu-details">
                    <h3 class="menu-name">Video</h3>
                    <div class="menu-price">Rp 0 (GRATIS!!!)</div>
                    <p class="menu-desc">Syarat JJ Gratis : Kirim Video Berdurasi </p>
                    <p class="menu-desc">1 Hingga 25 Detik Dan Maksimal 2 mb</p>
                </div>
            </div>
            
            <!-- Menu Item 2 -->
            <div class="menu-item">
                <div class="menu-details">
                    <h3 class="menu-name">Photo</h3>
                    <div class="menu-price">RP 15.000</div>
                    <p class="menu-desc">Kirim Foto Anda Yang Ingin Di Buatkan Video Jedag-jedug</p>
                </div>
            </div>
            
            <!-- Menu Item 3 -->
            <div class="menu-item">
                <div class="menu-details">
                    <h3 class="menu-name">Video</h3>
                    <div class="menu-price">RP 10.000</div>
                    <p class="menu-desc">Kirim Video Jedag-Jedug Anda Yang Ingin Di Posting</p>
                </div>
            </div>

        </div>
    </section>

    <section class="about-section">
        <div class="container about-content">
            <h2>JJ Bubble</h2>
            <p>Saat anda memberikan gift pada host Bubble maka video dengan efek Jedag-jedug kekinian akan muncul, disini lah tempat untuk melakukan pengajuan pembuatan Video Jedag-jedug. Silahkan daftar terlebih dulu lalu Login untuk pembuatan Video</p>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 JJBubble. Mahakarya Agency.</p>
        </div>
    </footer>

</body>

</html>