<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model('jabatan_m');
  }

  public function index()
  {
    $data['row'] = $this->jabatan_m->get();
    $data['title'] = "Data Jabatan";
    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('jabatan/jabatan_data', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules(
      'name',
      'Jabatan',
      'trim|required|is_unique[jabatan.name]',
      ['is_unique' => 'Data %s sudah ada']
    );

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = "Tambah data";
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('jabatan/tambah_data');
      $this->load->view('template/footer');
    } else {
      $post = $this->input->post(null, TRUE);
      $this->jabatan_m->add($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
      }
      redirect('jabatan');
    }
  }

  public function del()
  {
    $id = $this->input->post('jabatan_id');
    $this->jabatan_m->del($id);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('error', 'Data berhasil dihapus!');
    }
    redirect('jabatan');
  }

  public function edit($id)
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules(
      'name',
      'Jabatan',
      'trim|required|is_unique[jabatan.name]',
      ['is_unique' => 'Data %s sudah ada']
    );

    if ($this->form_validation->run() == FALSE) {
      $query = $this->jabatan_m->get($id);
      if ($query->num_rows() > 0) {
        $data['row'] = $query->row();
        $data['title'] = "Edit Data";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('jabatan/edit_data', $data);
        $this->load->view('template/footer');
      } else {
        echo "<script>
          alert('data tidak ditemukan!');
          window.location = '" . base_url('jabatan') . "';
        </script>";
      }
    } else {
      $post = $this->input->post(null, TRUE);
      $this->jabatan_m->edit($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data berhasil diubah!');
      }
      redirect('jabatan');
    }
  }
}
