<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_laporan');
    }


    public function index()
    {
        $data = array(
            'title' => 'Laporan Penjualan',
            'isi' => 'v_laporan',
        );
        $this->load->view('layout/v_wrapper_back', $data, FALSE);
    }

    public function l_harian()
    {
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = array(
            'title' => 'Laporan Penjualan Harian',
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->m_laporan->l_harian($tanggal, $bulan, $tahun),
            'isi' => 'v_l_harian',
        );
        $this->load->view('layout/v_wrapper_back', $data, FALSE);
    }
}

/* End of file Laporan.php */
