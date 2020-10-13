<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model(['pegawai_m', 'jabatan_m']);
  }

  public function index()
  {
    $data['row'] = $this->pegawai_m->get();
    $data['title'] = "Data Pegawai";
    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('pegawai/pegawai_data', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    $config['upload_path']   = './uploads/gambar/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 20480;
    $config['file_name']     = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
    $this->load->library('upload', $config);

    $query_jabatan = $this->jabatan_m->get();
    $jabatan[null] = '- Pilih -';
    foreach ($query_jabatan->result() as $jbt) {
      $jabatan[$jbt->jabatan_id] = $jbt->name;
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('jenkel', 'Jenis kelamin', 'trim|required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
    $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $data = ['jabatan' => $jabatan, 'selectedjabatan' => null];
      $data['title'] = "Tambah Data";
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('pegawai/tambah_data', $data);
      $this->load->view('template/footer');
    } else {
      $post = $this->input->post(null, TRUE);
      if (@$_FILES['gambar']['name'] != null) {
        if ($this->upload->do_upload('gambar')) {
          $post['gambar'] = $this->upload->data('file_name');
          $this->pegawai_m->add($post);
          if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
          }
          redirect('pegawai');
        } else {
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('erorrr', $error);
          redirect('pegawai/add');
        }
      } else {
        $post['gambar'] = null;
        $this->pegawai_m->add($post);
        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        }
        redirect('pegawai');
      }
    }
  }

  public function edit($id)
  {
    $config['upload_path']   = './uploads/gambar/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 20480;
    $config['file_name']     = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
    $this->load->library('upload', $config);

    $query_jabatan = $this->jabatan_m->get();
    $jabatan[null] = '- Pilih -';
    foreach ($query_jabatan->result() as $jbt) {
      $jabatan[$jbt->jabatan_id] = $jbt->name;
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('jenkel', 'Jenis kelamin', 'trim|required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
    $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $query = $this->pegawai_m->get($id);
      if ($query->num_rows() > 0) {
        $data = ['jabatan' => $jabatan, 'selectedjabatan' => null];
        $data['row'] = $query->row();
        $data['title'] = "Edit Data";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('pegawai/edit_data', $data);
        $this->load->view('template/footer');
      } else {
        echo "<script>
          alert('data tidak ditemukan!');
          window.location = '" . base_url('pegawai') . "';
        </script>";
      }
    } else {
      $post = $this->input->post(null, TRUE);
      if (@$_FILES['gambar']['name'] != null) {
        if ($this->upload->do_upload('gambar')) {

          $pegawai = $this->pegawai_m->get($post['pegawai_id'])->row();
          if ($pegawai->gambar != null) {
            $target_file = './uploads/gambar/' . $pegawai->gambar;
            unlink($target_file);
          }

          $post['gambar'] = $this->upload->data('file_name');
          $this->pegawai_m->edit($post);
          if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
          }
          redirect('pegawai');
        } else {
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('erorrr', $error);
          redirect('pegawai/add');
        }
      } else {
        $post['gambar'] = null;
        $this->pegawai_m->edit($post);
        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('success', 'Data berhasil diubah!');
        }
        redirect('pegawai');
      }
    }
  }

  public function del()
  {
    $id = $this->input->post('pegawai_id');
    $pegawai = $this->pegawai_m->get($id)->row();
    if ($pegawai->gambar != null) {
      $target_file = './uploads/gambar/' . $pegawai->gambar;
      unlink($target_file);
    }

    $this->pegawai_m->del($id);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('error', 'Data berhasil hapus!');
    }
    redirect('pegawai');
  }

  public function print_data()
  {
    $data['row'] = $this->pegawai_m->get();
    $html = $this->load->view('print/data_pegawai', $data, true);
    $this->fungsi->PdfGenerator($html, 'Data_pegawai', 'A4', 'potrait');
  }
}
