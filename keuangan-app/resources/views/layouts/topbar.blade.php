<!-- layouts/topbar.blade.php -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Tombol Menu (Garis Tiga) di kiri -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Spacer biar kanan & kiri terpisah -->
  <div class="ml-auto"></div>

  <!-- Bagian kanan (Notifikasi + User Info) -->
  <ul class="navbar-nav">

    <!-- Notifikasi -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <span class="badge badge-danger badge-counter">3+</span>
      </a>
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">Notifikasi</h6>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt text-white"></i>
            </div>
          </div>
          <div>
            <span class="small text-gray-500">Hari ini</span>
            Ada laporan baru masuk.
          </div>
        </a>
        <a class="dropdown-item text-center small text-gray-500" href="#">Lihat semua notifikasi</a>
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- User Info -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          {{ Auth::user()->name ?? 'Guest' }}
        </span>
        <img class="img-profile rounded-circle"
          src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=random" />
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profil
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Pengaturan
        </a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dropdown-item" type="submit">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </button>
        </form>
      </div>
    </li>

  </ul>
</nav>
