<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-fw fa-calculator"></i>
    </div>
    <div class="sidebar-brand-text mx-3">PT DIA KITA</div>
  </a>

  <!-- Pembagi -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item  -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Pembagi -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface
  </div>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('jabatan'); ?>">
      <i class="fas fa-fw fa-user-plus"></i>
      <span>Data Jabatan</span></a>
  </li>

  <li class="nav-item atas">
    <a class="nav-link" href="<?= base_url('pegawai'); ?>">
      <i class="fas fa-fw fa-people-carry"></i>
      <span>Data Pegawai</span></a>
  </li>

  <li class="nav-item atas">
    <a class="nav-link" href="<?= base_url('absensi'); ?>">
      <i class="fas fa-fw fa-book-open"></i>
      <span>Data Absensi</span></a>
  </li>

  <?php if ($this->fungsi->user_login()->level == 1) { ?>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
      Settings
    </div>

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('user'); ?>">
        <i class="fas fa-fw fa-users"></i>
        <span>User</span></a>
    </li>
  <?php } ?>

  <div class="text-center d-none d-md-inline mt-5">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->