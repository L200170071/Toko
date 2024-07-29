<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Foto extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_foto');
        $this->load->model('m_barang');
    }


    public function index()
    {
        $data = array(
            'title' => 'Foto barang',
            'foto' => $this->m_foto->get_all_data(),
            'isi' => 'fotobarang/v_index',
        );
        $this->load->view('layout/v_wrapper_back', $data, FALSE);
    }

    public function add($id_barang)
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan Foto', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/foto/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Add Foto Barang',
                    'error_upload' => $this->upload->display_errors(),
                    'barang' => $this->m_barang->get_data($id_barang),
                    'foto' => $this->m_foto->get_gambar($id_barang),
                    'isi' => 'fotobarang/v_add',
                );
                $this->load->view('layout/v_wrapper_back', $data, FALSE);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/foto/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_barang' => $id_barang,
                    'keterangan' => $this->input->post('keterangan'),
                    'gambar' => $upload_data['uploads']['file_name'],
                );
                $this->m_foto->add($data);
                $this->session->set_flashdata('pesan', 'Foto Telah Ditambahkan!');
                redirect('foto/add/' . $id_barang);
            }
        }

        $data = array(
            'title' => 'Add Foto barang',
            'barang' => $this->m_barang->get_data($id_barang),
            'foto' => $this->m_foto->get_gambar($id_barang),
            'isi' => 'fotobarang/v_add',
        );
        $this->load->view('layout/v_wrapper_back', $data, FALSE);
    }

    //Delete one item
    public function delete($id_barang, $id_gambar)
    {
        //hapus gambar pada folder
        $foto = $this->m_foto->get_data($id_gambar);
        if ($foto->gambar != "") {
            unlink('./assets/foto/' . $foto->gambar);
        }
        //end
        $data = array('id_gambar' => $id_gambar);
        $this->m_foto->delete($data);
        $this->session->set_flashdata('pesan', 'Foto Telah Dihapus!');
        redirect('foto/add/' . $id_barang);
    }
}
