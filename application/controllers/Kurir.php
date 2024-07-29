<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
    }

    private $api_key = 'c2547a5314e93d1c21d1d8389f291a04';
    public function provinsi()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //echo $response;
            $array_response = json_decode($response, TRUE);
            /*echo "<pre>";
            print_r($array_response['rajaongkir']['results']);
            echo "</pre>";*/
            $data_provinsi = $array_response['rajaongkir']['results'];
            echo "<option value=''>-----Pilih Provinsi-----</option>";
            foreach ($data_provinsi as $key => $v) {
                echo "<option values='" . $v['province'] . "' id_provinsi='" . $v['province_id'] . "'>" . $v['province'] . "</option>";
            }
        }
    }

    public function kota()
    {
        $id_provinsi_terpilih = $this->input->post('id_provinsi');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, TRUE);
            $data_kota = $array_response['rajaongkir']['results'];
            echo "<option value=''>-----Pilih Kota-----</option>";
            foreach ($data_kota as $key => $v) {
                echo "<option value='" . $v['city_name'] . "' id_kota='" . $v['city_id'] . "'>" . $v['city_name'] . "</option>";
            }
        }
    }

    public function expedisi()
    {
        echo '<option value="">---Pilih Expedisi---</option>';
        echo '<option value="jne">JNE</option>';
        echo '<option value="tiki">TIKI</option>';
        echo '<option value="pos">POS Indonesia</option>';
    }

    public function paket()
    {
        $toko = $this->m_admin->data_toko()->lokasi;
        $expedisi = $this->input->post('expedisi');
        $id_kota = $this->input->post('id_kota');
        $berat = $this->input->post('berat');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $toko . "&destination=" . $id_kota . "&weight=" . $berat . "&courier=" . $expedisi,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //echo $response;
            $array_response = json_decode($response, TRUE);
            //echo "<pre>";
            //print_r($array_response['rajaongkir']['results'][0]['costs']);
            //echo "</pre>";
            $data_paket = $array_response['rajaongkir']['results'][0]['costs'];
            echo "<option value=''>---Pilih Paket---</option>";
            foreach ($data_paket as $key => $value) {
                echo "<option value='" . $value['service'] . "' ongkir='" . $value['cost'][0]['value'] . "' estimasi='" . $value['cost'][0]['etd'] . " Hari'>";
                echo $value['service'] . " | Rp." . $value['cost'][0]['value'] . " | " . $value['cost'][0]['etd'] . "Hari";
                echo "</option>";
            }
        }
    }
}

/* End of file Kurir.php */
