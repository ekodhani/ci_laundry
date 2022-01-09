<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
    public function get_where($where,$table)
    {
        return $this->db->get_where($table,$where);
    }
}
