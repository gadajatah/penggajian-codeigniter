<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->select('pegawai.*, jabatan.name as jabatan_name');
    $this->db->from('pegawai');
    $this->db->join('jabatan', 'jabatan.jabatan_id = pegawai.jabatan_id');
    if ($id != null) {
      $this->db->where('pegawai_id', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $params['nama'] = $post['nama'];
    $params['jenkel'] = $post['jenkel'];
    $params['tempat_lahir'] = $post['tempat_lahir'];
    $params['tanggal_lahir'] = $post['tanggal_lahir'];
    $params['jabatan_id'] = $post['jabatan'];
    $params['gambar'] = $post['gambar'];
    $this->db->insert('pegawai', $params);
  }

  public function edit($post)
  {
    $params['nama'] = $post['nama'];
    $params['jenkel'] = $post['jenkel'];
    $params['tempat_lahir'] = $post['tempat_lahir'];
    $params['tanggal_lahir'] = $post['tanggal_lahir'];
    $params['jabatan_id'] = $post['jabatan'];
    $params['updated'] = date('Y-m-d H:i:s');
    if ($post['gambar'] != null) {
      $params['gambar'] = $post['gambar'];
    }
    $this->db->where('pegawai_id', $post['pegawai_id']);
    $this->db->update('pegawai', $params);
  }

  public function del($id)
  {
    $this->db->where('pegawai_id', $id);
    $this->db->delete('pegawai');
  }
}
