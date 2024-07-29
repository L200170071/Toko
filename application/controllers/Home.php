<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
    }

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'barang' => $this->m_home->get_all_data(),
            'hero' => $this->m_home->getHero(),
            'isi' => 'v_home',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function Kategori($id_kategori)
    {
        $kategori = $this->m_home->kategori($id_kategori);
        $data = array(
            'title' => 'Kategori ' . $kategori->nama_kategori,
            'barang' => $this->m_home->get_all_data_barang($id_kategori),
            'isi' => 'v_kategori_front',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function detail_barang($id_barang)
    {
        $data = array(
            'title' => 'Detail',
            'gambar' => $this->m_home->gambar_barang($id_barang),
            'barang' => $this->m_home->detail_barang($id_barang),
            'isi' => 'v_detail_barang',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }
}
