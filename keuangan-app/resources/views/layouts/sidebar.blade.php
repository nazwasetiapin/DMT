<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">My App</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ url('/dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu Utama
  </div>

  <!-- Nav Item - Home -->
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">
      <i class="fas fa-fw fa-home"></i>
      <span>Home</span>
    </a>
  </li>

  <!-- Nav Item - About -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-info-circle"></i>
      <span>About</span>
    </a>
  </li>

  <!-- Nav Item - Contact -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-envelope"></i>
      <span>Contact</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Nav Item - Settings -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-cog"></i>
      <span>Settings</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
