<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('jabatan');
    if ($id != null) {
      $this->db->where('jabatan_id', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $params = [
      'name' => $post['name']
    ];
    $this->db->insert('jabatan', $params);
  }

  public function del($id)
  {
    $this->db->where('jabatan_id', $id);
    $this->db->delete('jabatan');
  }

  public function edit($post)
  {
    $params = [
      'name' => $post['name'],
      'updated' => date('Y-m-d H:i:s')
    ];
    $this->db->where('jabatan_id', $post['jabatan_id']);
    $this->db->update('jabatan', $params);
  }
}
