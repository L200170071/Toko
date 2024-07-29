<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
    }

    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('home');
        }
        $data = array(
            'title' => 'Karanjang',
            'isi' => 'v_belanja',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name' => $this->input->post('name'),
        );
        $this->cart->insert($data);
        redirect($redirect_page, 'refresh');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        redirect('belanja');
    }

    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty' => $this->input->post($i . '[qty]'),
            );
            $this->cart->update($data);
            $i++;
        }
        $this->session->set_flashdata('pesan', 'Pesanan berhasil diubah');
        redirect('belanja');
    }

    public function clear()
    {
        $this->cart->destroy();
        redirect('belanja');
    }

    function cekout()
    {
        $this->login_akun->proteksi_halaman();

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));
        $this->form_validation->set_rules('expedisi', 'Kurir', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));
        $this->form_validation->set_rules('paket', 'Paket', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));


        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Bayar Belanja',
                'isi' => 'v_cekout',
            );
            $this->load->view('layout/v_wrapper_front', $data, FALSE);
        } else {
            //simpan ke table transaksi
            $data = array(
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'no_order' => $this->input->post('no_order'),
                'tanggal' => date('Y-m-d'),
                'nama_penerima' => $this->input->post('nama_penerima'),
                'hp_penerima' => $this->input->post('hp_penerima'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'expedisi' => $this->input->post('expedisi'),
                'paket' => $this->input->post('paket'),
                'estimasi' => $this->input->post('estimasi'),
                'ongkir' => $this->input->post('ongkir'),
                'grand_total' => $this->input->post('grand_total'),
                'berat' => $this->input->post('berat'),
                'total_bayar' => $this->input->post('total_bayar'),
                'status_bayar' => '0',
                'status_order' => '0',
            );
            $this->m_transaksi->simpan_transaksi($data);
            //simpan ke tabel rincian
            $i = 1;
            foreach ($this->cart->contents() as $item) {
                $data_rincian = array(
                    'no_order' => $this->input->post('no_order'),
                    'id_barang' => $item['id'],
                    'qty' => $this->input->post('qty' . $i++),
                );
                $this->m_transaksi->simpan_rincian($data_rincian);
            }
            $this->session->set_flashdata('pesan', 'Pesanan berhasil diproses');
            $this->cart->destroy();
            redirect('pesanan_saya');
        }
    }
}
