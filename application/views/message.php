<?php if ($this->session->has_userdata('success')) : ?>
  <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    Data berhasil disimpan !
    <?= $this->session->set_flashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>
<?php if ($this->session->has_userdata('error')) : ?>
  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    Data berhasil hapus !
    <?= $this->session->set_flashdata('error') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>
<?php if ($this->session->has_userdata('eror')) : ?>
  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    Barcode yang anda isi sudah digunakan !
    <?= $this->session->set_flashdata('error') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

<?php if ($this->session->has_userdata('erorrr')) : ?>
  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    File yang anda upload bukan gambar atau file yang anda upload ukurannya terlalu besar!
    <?= $this->session->set_flashdata('error') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>