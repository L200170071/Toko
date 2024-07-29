<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hero extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_hero');
    }

    public function index()
    {
        $data = array(
            'title' => 'Hero',
            'hero' => $this->m_hero->get_all_data(),
            'isi' => 'hero/v_hero',
        );
        $this->load->view('layout/v_wrapper_back', $data, FALSE);
    }

    public function update_status()
    {
        $id_hero = $this->input->post('id_hero');
        $status_foto = $this->input->post('status_foto');
        $data = array(
            'status_foto' => $status_foto,
        );
        $where = array(
            'id_hero' => $id_hero,
        );
        $this->m_hero->update_data($where, $data, 'hero');
        redirect('hero');
    }

    public function add()
    {
        $config['upload_path'] = './assets/slider/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2000';
        $this->upload->initialize($config);
        $field_name = "gambar";
        if (!$this->upload->do_upload($field_name)) {
            $data = array(
                'title' => 'Add Hero',
                'hero' => $this->m_hero->get_all_data(),
                'error_upload' => $this->upload->display_errors(),
                'isi' => 'hero/v_add',
            );
            $this->load->view('layout/v_wrapper_back', $data, FALSE);
        } else {
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/slider/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);
            $data = array(
                'status_foto' => 'belum_disetujui',
                'file_foto' => $upload_data['uploads']['file_name'],
            );
            $this->m_hero->add($data);
            $this->session->set_flashdata('pesan', 'Data Telah Ditambahkan!');
            redirect('hero');
        }

        $data = array(
            'title' => 'Hero',
            'hero' => $this->m_hero->get_all_data(),
            'isi' => 'hero/v_add',
        );
        $this->load->view('layout/v_wrapper_back', $data, FALSE);
    }

    public function delete($id_hero = NULL)
    {
        //hapus gambar pada folder
        $hero = $this->m_hero->get_data($id_hero);
        if ($hero->file_foto != "") {
            unlink('./assets/slider/' . $hero->file_foto);
        }
        //end
        $data = array('id_hero' => $id_hero);
        $this->m_hero->delete($data);
        $this->session->set_flashdata('pesan', 'Data Telah Dihapus!');
        redirect('hero');
    }
}

/* End of file Hero.php */
