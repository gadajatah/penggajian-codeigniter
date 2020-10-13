    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Search -->
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
            </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucfirst($this->fungsi->user_login()->username) ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('uploads/gambar/' .  $this->fungsi->user_login()->gambar) ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="container">
            <div class="row">
              <div class="col-md">
                <div class="card">
                  <div class="card-header text-center">
                    Form Edit Data
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm- p-2">
                        <a class="btn btn-warning" href="<?= base_url('pegawai') ?>"><i class="fas fa-undo-alt"></i> Back</a>
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col-sm">
                        <form action="" method="post">
                          <div class="form-group">
                            <input type="hidden" name="absensi_id" value="<?= $row->absensi_id ?>">
                            <label for="nama">Nama</label>
                            <?= form_dropdown(
                              'pegawai',
                              $pegawai,
                              $selectedpegawai,
                              ['class' => 'form-control', 'required' => 'required']
                            ) ?>
                          </div>
                          <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk...." value="<?= $this->input->post('tanggal_masuk') ?? $row->tanggal_masuk; ?>">
                            <?= form_error('tanggal_masuk', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
                            <label for="kehadiran">Kehadiran</label>
                            <select name="kehadiran" id="kehadiran" class="form-control">
                              <option value="hadir">Hadir</option>
                              <option value="sakit">Sakit</option>
                              <option value="izin">Izin</option>
                              <option value="absen">Absen</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="jam_masuk">Jam masuk</label>
                            <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" placeholder="Jam masuk...." value="<?= $this->input->post('jam_masuk') ?? $row->jam_masuk; ?>">
                            <?= form_error('jam_masuk', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
                            <label for="jam_keluar">Jam keluar</label>
                            <input type="time" name="jam_keluar" id="jam_keluar" class="form-control" placeholder="Jam keluar...." value="<?= $this->input->post('jam_keluar') ?? $row->jam_keluar; ?>">
                            <?= form_error('jam_keluar', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
                            <label for="jumlah_hadir">Jumlah Kehadiran</label>
                            <input type="text" name="jumlah_hadir" id="jumlah_hadir" class="form-control" placeholder="jumlah kehadiran" value="<?= $this->input->post('jumlah_hadir') ?? $row->jumlah_hadir; ?>">
                            <?= form_error('jumlah_hadir', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i> Submit</button>
                          <button type="reset" class="btn btn-danger"><i class="fas fa-trash-restore-alt"></i> Reset</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; jhon_grsng <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Tekan Logout dibawah jika anda ingin keluar.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
          </div>
        </div>
      </div>
    </div>