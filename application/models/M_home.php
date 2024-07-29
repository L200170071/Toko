<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
        $this->db->order_by('id_barang', 'desc');
        return $this->db->get()->result();
    }

    public function get_all_data_kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->order_by('id_kategori', 'desc');
        return $this->db->get()->result();
    }

    public function detail_barang($id_barang)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();
    }

    public function gambar_barang($id_barang)
    {
        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->result();
    }

    public function kategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->get()->row();
    }

    public function get_all_data_barang($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
        $this->db->where('barang.id_kategori', $id_kategori);
        return $this->db->get()->result();
    }

    public function getHero()
    {
        $this->db->select('*');
        $this->db->from('hero');
        $this->db->where('status_foto', 'disetujui');
        return $this->db->get()->result_array();
    }

    public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->like('nama_barang', $keyword);
        return $this->db->get()->result();
    }

    public function get_range($minimal, $maksimal)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('harga >=', $minimal);
        $this->db->where('harga <=', $maksimal);
        return $this->db->get()->result();
    }
}
