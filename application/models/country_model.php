<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->tbl_name = 'Country';
        $this->primary_Id = 'Id';
    }

    public function insertData($data) {
        $this->db->insert($this->tbl_name, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    
    public function getAllData($where = "") {
        if ($where != "") {
            $this->db->where($where);
        }
        $data = '';
        $query = $this->db->get_where($this->tbl_name, array());
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

  public function updateData($where = array(), $data = array()) {
        $this->db->where($where);
        $this->db->update($this->tbl_name, $data);
    }

    public function selectData_By_Name($array) {
        $data='';
        $this->db->like($array);
        $query = $this->db->get($this->tbl_name);
        
        
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

}
