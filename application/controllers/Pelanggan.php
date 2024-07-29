<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggan');
        $this->load->model('m_auth');
    }

    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[pelanggan.email]', array(
            'required' => '%s Tidak Boleh Kosong!',
            'is_unique' => '% Email Sudah Terdaftar'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]', array(
            'required' => '%s Tidak Boleh Kosong!',
            'matches' => '%s Password Tidak Sama'
        ));


        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Daftar',
                'isi' => 'v_register',
            );
            $this->load->view('layout/v_wrapper_front', $data, FALSE);
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );
            $this->m_pelanggan->daftar($data);
            $this->session->set_flashdata('pesan', 'Akun berhasil didaftarkan');
            redirect('pelanggan/daftar');
        }
    }

    public function login()
    {

        $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->login_akun->login($email, $password);
        }

        $data = array(
            'title' => 'Login',
            'isi' => 'v_login',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function logout()
    {
        $this->login_akun->logout();
    }

    public function akun()
    {
        $this->login_akun->proteksi_halaman();
        $data = array(
            'title' => 'Akun Saya',
            'isi' => 'v_akun',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }
}
