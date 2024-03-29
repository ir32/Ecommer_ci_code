<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_model extends CI_Model
{
    private $table = 'products';
    private $id = 'products.id';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
{
    $this->db->from($this->table);
    $this->db->where($this->id, $id);
    $query = $this->db->get();
    return $query->row();
}
   public function get_cart_id($id)
{
    $this->db->from($this->table);
    $this->db->where($this->id, $id);
    $query = $this->db->get();
    
    // $lastQuery = $this->db->last_query();
    // echo $lastQuery;
    // die();
    return $query->result_array();
}


    public function update($data, $id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}


