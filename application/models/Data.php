<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  data model for table data
 */
class Data extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }
  public function getall()
  {
    return $this->db->get('datas')->result_array();
  }
  public function tambah($data = array())
  {
    $this->db->insert('datas',$data);
    return TRUE;
  }
  public function getLimit($from,$to)
  {
    $this->db->select("*")->from('datas');
    $this->db->order_by('id',"DESC");
    $this->db->limit($to,$from);
    return $this->db->get()->result_array();
  }
  public function delete($id)
  {
    $this->db->delete('datas',$id);

  }

  public function edit($id,$data)
  {
    $this->db->set($data);
    $this->db->where('id',$id);
    $this->db->update("datas");
    
  }
  public function getLike($like,$from,$to)
  {
    $this->db->select('*')->from('datas');
    $this->db->like('name',$like);
    $this->db->limit($to,$from);

    return $this->db->get()->result_array();
  }
}
