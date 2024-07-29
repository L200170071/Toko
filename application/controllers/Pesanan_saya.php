<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_pesanan_masuk');
    }


    public function index()
    {
        $data = array(
            'title' => 'Pesanan Saya',
            'belum_bayar' => $this->m_transaksi->belum_bayar(),
            'diproses' => $this->m_transaksi->diproses(),
            'dikirim' => $this->m_transaksi->dikirim(),
            'selesai' => $this->m_transaksi->selesai(),
            'isi' => 'v_pesanan_saya',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function bayar($id_transaksi)
    {
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required', array(
            'required' => '%s Tidak Boleh Kosong!'
        ));


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/bukti_bayar/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2000';
            $this->upload->initialize($config);
            $field_name = 'bukti_bayar';
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Pembayaran',
                    'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
                    'rekening' => $this->m_transaksi->rekening(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'v_bayar',
                );
                $this->load->view('layout/v_wrapper_front', $data, FALSE);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/bukti_bayar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_transaksi' => $id_transaksi,
                    'atas_nama' => $this->input->post('atas_nama'),
                    'nama_bank' => $this->input->post('nama_bank'),
                    'no_rek' => $this->input->post('no_rek'),
                    'status_bayar' => 1,
                    'bukti_bayar' => $upload_data['uploads']['file_name'],
                );
                $this->m_transaksi->upload_buktibayar($data);
                $this->session->set_flashdata('pesan', 'Bukti Pembayaran berhasil di Upload!');
                redirect('pesanan_saya');
            }
        }
        $data = array(
            'title' => 'Pembayaran',
            'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
            'rekening' => $this->m_transaksi->rekening(),
            'isi' => 'v_bayar',
        );
        $this->load->view('layout/v_wrapper_front', $data, FALSE);
    }

    public function diterima($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '3',
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan telah diterima');
        redirect('pesanan_saya');
    }

    public function cetak_pdf($no_order)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006f', PDF_HEADER_STRING);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);	
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf = new TCPDF('P', 'mm', array(87, 500));
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetFont('times', '', 10);
        $pdf->setMargins(5, 15, 10, true);
        $pdf->AddPage();

        $pdf->SetFont('times', '', 8);
        $pdf->Cell(29, 4, "Faktur pesanan ini sudah di sesuaikan dengan pesanan anda", '', 0, 'L');
        
        $pdf->ln(10);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(29, 4, "No Pesanan: $no_order", '', 0, 'L');

        $pdf->ln(10);

        $jumlah = 0;
        $tanggal = '';
        $grand_total = 0;
        $ongkir = 0;
        $estimasi = '';
        $sql = "SELECT * FROM transaksi WHERE no_order = '$no_order'";
        $data = $this->db->query($sql);
        foreach ($data->result() as $ok) {
            $jumlah = $ok->total_bayar;
            $tanggal = $ok->tanggal;
            $grand_total = $ok->grand_total;
            $ongkir = $ok->ongkir;
            $estimasi = $ok->estimasi;
        }

        $pdf->SetFont('times', '', 10);
        $pdf->Cell(29, 4, "Total Pembayaran", '', 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(29, 4, "$jumlah", '', 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('times', '', 10);
        $pdf->Cell(29, 4, "Tanggal Pembayaran", '', 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(29, 4, "$tanggal", '', 0, 'L');
        $pdf->ln(5);

        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(29, 4, "Rincian Pemesanan", '', 0, 'L');
        $pdf->ln(8);
        $pdf->SetFont('times', '', 10);
        $pdf->Cell(29, 4, "Subtotal untuk produk", '', 0, 'L');
        $pdf->Cell(29, 4, "Rp $grand_total", '', 0, 'R');
        $pdf->ln(5);
        $pdf->Cell(29, 4, "Ongkos kirim", '', 0, 'L');
        $pdf->Cell(29, 4, "Rp $ongkir", '', 0, 'R');
        $pdf->ln(5);
        $pdf->Cell(29, 4, "Estimasi", '', 0, 'L');
        $pdf->Cell(29, 4, "$estimasi", '', 0, 'R');

        $pdf->Output('cetak_nota.pdf');
    }
}

/* End of file Pesanan_saya.php */
