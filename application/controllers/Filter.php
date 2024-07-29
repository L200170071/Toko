<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Filter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
        $this->load->model('m_barang');
    }


    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data = array(
            'title' => 'Search',
            'barang' => $this->m_home->get_keyword($keyword),
            'isi' => 'v_search',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function harga()
    {

        $minimal = $this->input->post('minimal');
        $maksimal = $this->input->post('maksimal');
        $data = array(
            'title' => 'Harga',
            'barang' => $this->m_home->get_range($minimal, $maksimal),
            'isi' => 'v_harga',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }
}

/* End of file Filter.php */
