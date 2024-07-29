<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
    public function daftar($data)
    {
        $this->db->insert('pelanggan', $data);
    }
}

/* End of file M_pelanggan.php */
