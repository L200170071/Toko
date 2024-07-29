<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_hero extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('hero');
        $this->db->order_by('id_hero', 'desc');
        return $this->db->get()->result();
    }

    public function getHero()
    {
        $this->db->select('*');
        $this->db->from('hero');
        $this->db->where('status_foto', 'disetujui');
        return $this->db->get()->result();
    }


    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function add($data)
    {
        $this->db->insert('hero', $data);
    }

    public function get_data($id_hero)
    {
        $this->db->select('*');
        $this->db->from('hero');
        $this->db->where('id_hero', $id_hero);
        return $this->db->get()->row();
    }

    public function delete($data)
    {
        $this->db->where('id_hero', $data['id_hero']);
        $this->db->delete('hero', $data);
    }
}

/* End of file M_hero.php */
