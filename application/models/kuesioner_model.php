<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Membuat kuesioner baru
    public function create_kuesioner($data)
    {
        return $this->db->insert('kuesioner', $data);
    }

    // Mendapatkan semua kuesioner milik user
    public function get_kuesioner_by_user($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->get('kuesioner')
            ->result();
    }

    // Update kuesioner
    public function update_kuesioner($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('kuesioner', $data);
    }

    // Hapus kuesioner
    public function delete_kuesioner($id)
    {
        return $this->db->delete('kuesioner', ['id' => $id]);
    }

    // Mendapatkan detail kuesioner beserta pertanyaannya
    public function get_kuesioner_detail($id)
    {
        $kuesioner = $this->db->where('id', $id)
            ->get('kuesioner')
            ->row();

        $kuesioner->pertanyaan = $this->db->where('kuesioner_id', $id)
            ->get('pertanyaan')
            ->result();

        return $kuesioner;
    }
}
