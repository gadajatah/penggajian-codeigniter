<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->select('absensi.*, pegawai.nama as pegawai_nama');
    $this->db->from('absensi');
    $this->db->join('pegawai', 'pegawai.pegawai_id = absensi.pegawai_id');
    if ($id != null) {
      $this->db->where('absensi_id', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $params['pegawai_id'] = $post['pegawai'];
    $params['tanggal_masuk'] = $post['tanggal_masuk'];
    $params['kehadiran'] = $post['kehadiran'];
    $params['jam_masuk'] = $post['jam_masuk'];
    $params['jam_keluar'] = $post['jam_keluar'];
    $params['jumlah_hadir'] = $post['jumlah_hadir'];
    $this->db->insert('absensi', $params);
  }

  public function del($id)
  {
    $this->db->where('absensi_id', $id);
    $this->db->delete('absensi');
  }



  public function edit($post)
  {
    $params['pegawai_id'] = $post['pegawai'];
    $params['tanggal_masuk'] = $post['tanggal_masuk'];
    $params['kehadiran'] = $post['kehadiran'];
    $params['jam_masuk'] = $post['jam_masuk'];
    $params['jam_keluar'] = $post['jam_keluar'];
    $params['jumlah_hadir'] = $post['jumlah_hadir'];

    $this->db->where('absensi_id', $post['absensi_id']);
    $this->db->update('absensi', $params);
  }
}
