<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    check_not_login();
    check_admin();
    $this->load->model('user_m');
  }

  public function index()
  {
    $data['row'] =  $this->user_m->get();
    $data['title'] = "Data User";
    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('user/user_data', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    $config['upload_path']   = './uploads/gambar/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 20480;
    $config['file_name']     = 'user-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
    $this->load->library('upload', $config);

    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[user.username]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('address', 'Address', 'trim|required');
    $this->form_validation->set_rules('level', 'Level', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = "Tambah Data";
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('user/tambah_data');
      $this->load->view('template/footer');
    } else {
      $post = $this->input->post(null, TRUE);
      if (@$_FILES['gambar']['name'] != null) {
        if ($this->upload->do_upload('gambar')) {
          $post['gambar'] = $this->upload->data('file_name');
          $this->user_m->add($post);
          if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
          }
          redirect('user');
        } else {
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('erorrr', $error);
          redirect('user/add');
        }
      } else {
        $post['gambar'] = null;
        $this->user_m->add($post);
        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        }
        redirect('user');
      }
    }
  }

  public function edit($id)
  {
    $config['upload_path']   = './uploads/gambar/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 20480;
    $config['file_name']     = 'user-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
    $this->load->library('upload', $config);

    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|callback_username_check');
    if ($this->input->post('password')) {
      $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
      $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|matches[password]');
    }
    if ($this->input->post('passconf')) {
      $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|matches[password]');
    }
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('address', 'Address', 'trim|required');
    $this->form_validation->set_rules('level', 'Level', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $query = $this->user_m->get($id);
      if ($query->num_rows() > 0) {
        $data['row'] = $query->row();
        $data['title'] = "Edit Data";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('user/edit_data', $data);
        $this->load->view('template/footer');
      } else {
        echo "<script>
          alert('data tidak ditemukan!');
          window.location = '" . base_url('user') . "';
        </script>";
      }
    } else {
      $post = $this->input->post(null, TRUE);
      if (@$_FILES['gambar']['name'] != null) {
        if ($this->upload->do_upload('gambar')) {

          $user = $this->user_m->get($post['user_id'])->row();
          if ($user->gambar != null) {
            $target_file = './uploads/gambar/' . $user->gambar;
            unlink($target_file);
          }

          $post['gambar'] = $this->upload->data('file_name');
          $this->user_m->edit($post);
          if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
          }
          redirect('user');
        } else {
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('erorrr', $error);
          redirect('user/add');
        }
      } else {
        $post['gambar'] = null;
        $this->user_m->edit($post);
        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('success', 'Data berhasil diubah!');
        }
        redirect('user');
      }
    }
  }

  function username_check()
  {
    $post = $this->input->post(null, TRUE);
    $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
    if ($query->num_rows() > 0) {
      $this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function del()
  {
    $id = $this->input->post('user_id');
    $user = $this->user_m->get($id)->row();
    if ($user->gambar != null) {
      $target_file = './uploads/gambar/' . $user->gambar;
      unlink($target_file);
    }

    $this->user_m->del($id);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('error', 'Data berhasil hapus!');
    }
    redirect('user');
  }
}
