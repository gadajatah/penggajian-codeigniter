<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model(['absensi_m', 'pegawai_m']);
  }
  public function index()
  {
    $data['row'] = $this->absensi_m->get();
    $data['title'] = "Data Absensi";
    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('absensi/absensi_data', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    $query_pegawai = $this->pegawai_m->get();
    $pegawai[null] = '- Pilih -';
    foreach ($query_pegawai->result() as $pgw) {
      $pegawai[$pgw->pegawai_id] = $pgw->nama;
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
    $this->form_validation->set_rules('kehadiran', 'Kehadiran', 'required');
    $this->form_validation->set_rules('jam_masuk', 'Jam masuk', 'required');
    $this->form_validation->set_rules('jam_keluar', 'Jam keluar', 'required');
    $this->form_validation->set_rules('jumlah_hadir', 'Jumlah kehadiran', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
      $data = ['pegawai' => $pegawai, 'selectedpegawai' => null];
      $data['title'] = "Tambah Data Absensi";

      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('absensi/tambah_data', $data);
      $this->load->view('template/footer');
    } else {
      $post = $this->input->post(null, TRUE);
      $this->absensi_m->add($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          Data berhasil disimpan!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('absensi');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          Data gagal disimpan!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('absensi');
      }
    }
  }

  public function del()
  {
    $id = $this->input->post('absensi_id');
    $this->absensi_m->del($id);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          Data berhasil dihapus!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
      redirect('absensi');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          Data gagal dihapus!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
      redirect('absensi');
    }
  }

  public function edit($id)
  {
    $query_pegawai = $this->pegawai_m->get();
    $pegawai[null] = '- Pilih -';
    foreach ($query_pegawai->result() as $pgw) {
      $pegawai[$pgw->pegawai_id] = $pgw->nama;
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
    $this->form_validation->set_rules('kehadiran', 'Kehadiran', 'required');
    $this->form_validation->set_rules('jam_masuk', 'Jam masuk', 'required');
    $this->form_validation->set_rules('jam_keluar', 'Jam keluar', 'required');
    $this->form_validation->set_rules('jumlah_hadir', 'Jumlah kehadiran', 'required|numeric');
    if ($this->form_validation->run() == FALSE) {
      $query = $this->absensi_m->get($id);
      if ($query->num_rows() > 0) {
        $data = ['pegawai' => $pegawai, 'selectedpegawai' => null];
        $data['row'] = $query->row();
        $data['title'] = "Edit Data Absensi";

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('absensi/edit_data', $data);
        $this->load->view('template/footer');
      } else {
        echo "<script>
          alert('data tidak ditemukan!');
          window.location = '" . base_url('absensi') . "';
        </script>";
      }
    } else {
      $post = $this->input->post(null, TRUE);
      $this->absensi_m->edit($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          Data berhasil diedit!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('absensi');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          Data Gagal diedit!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('absensi');
      }
    }
  }

  public function print_data()
  {
    $data['row'] = $this->absensi_m->get();
    $html = $this->load->view('print/data_absensi', $data, true);
    $this->fungsi->PdfGenerator($html, 'Data_absensi', 'A4', 'potrait');
  }
}
