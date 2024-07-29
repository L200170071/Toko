<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
    public function l_harian($tanggal, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('rincian');
        $this->db->join('transaksi', 'transaksi.no_order = rincian.no_order', 'left');
        $this->db->join('barang', 'barang.id_barang = rincian.id_barang', 'left');
        $this->db->where('DATE(transaksi.tanggal)', $tanggal);
        $this->db->where('MONTH(transaksi.tanggal)', $bulan);
        $this->db->where('YEAR(transaksi.tanggal)', $tahun);
        return $this->db->get()->result();
    }
}

/* End of file M_laporan.php */
