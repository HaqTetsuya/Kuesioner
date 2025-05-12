<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Tambah pertanyaan baru ke kuesioner
    public function create_pertanyaan($data) {
        return $this->db->insert('pertanyaan', $data);
    }

    // Dapatkan semua pertanyaan untuk suatu kuesioner
    public function get_pertanyaan_by_kuesioner($kuesioner_id) {
        return $this->db->where('kuesioner_id', $kuesioner_id)
                        ->get('pertanyaan')
                        ->result();
    }

    // Update pertanyaan
    public function update_pertanyaan($id, $data) {
        return $this->db->where('id', $id)
                        ->update('pertanyaan', $data);
    }

    // Hapus pertanyaan
    public function delete_pertanyaan($id) {
        return $this->db->delete('pertanyaan', ['id' => $id]);
    }

    // Dapatkan detail pertanyaan dengan jawaban
    public function get_pertanyaan_detail($id) {
        $pertanyaan = $this->db->where('id', $id)
                               ->get('pertanyaan')
                               ->row();
        
        $pertanyaan->jawaban = $this->db->where('pertanyaan_id', $id)
                                        ->get('jawaban')
                                        ->result();
        
        return $pertanyaan;
    }
}