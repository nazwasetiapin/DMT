<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

 <!-- Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-coins"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Keuangan Perusahaan</div>
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

<!-- Nav Item - Transaksi -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransactions"
        aria-expanded="false" aria-controls="collapseTransactions">
        <i class="fas fa-exchange-alt"></i>
        <span>Transactions</span>
    </a>
    <div id="collapseTransactions" class="collapse" aria-labelledby="headingTransactions" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/transactions') }}">Semua Data</a>
            <a class="collapse-item" href="{{ url('/transactions/pemasukan') }}">Pemasukan</a>
            <a class="collapse-item" href="{{ url('/transactions/pengeluaran') }}">Pengeluaran</a>
        </div>
    </div>
</li>

<!-- Nav Item - Tambah data -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAddData"
        aria-expanded="false" aria-controls="collapseAddData">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Data</span>
    </a>
    <div id="collapseAddData" class="collapse" aria-labelledby="headingAddData" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/types') }}">Tipe</a>
            <a class="collapse-item" href="{{ url('/categories') }}">Category</a>
            <a class="collapse-item" href="{{ url('/sub-categories') }}">Sub Category</a>
        </div>
    </div>
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

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
