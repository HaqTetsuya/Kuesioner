<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function get_all_pertanyaan() {
		return $this->db->get_where('pertanyaan')->result();
	}
	
	public function get_pertanyaan_likert() {
		return $this->db->get_where('pertanyaan', ['type' => 'likert'])->result();
	}
	
	public function get_pertanyaan_text() {
		return $this->db->get_where('pertanyaan', ['type' => 'text'])->result();
	}
    
    public function get_pertanyaan($id) {
        return $this->db->get_where('pertanyaan', ['id' => $id])->row();
    }
    
    public function tambah_pertanyaan($data) {
        $this->db->insert('pertanyaan', $data);
        return $this->db->insert_id();
    }
    
    public function update_pertanyaan($id, $data) {
        $this->db->update('pertanyaan', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function hapus_pertanyaan($id) {
        $this->db->delete('pertanyaan', ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    // Fungsi untuk jawaban responden
    public function simpan_jawaban_likert($data) {
        $this->db->insert('responden', [
			'user_id' => $data['responden'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'tanggal' => date('Y-m-d H:i:s')
        ]);
        
        $responden_id = $this->db->insert_id();
        
        foreach ($data['jawaban'] as $pertanyaan_id => $nilai) {
            $this->db->insert('jawaban', [
                'responden_id' => $responden_id,
                'pertanyaan_id' => $pertanyaan_id,
                'nilai' => $nilai
            ]);
        }
        
        return $responden_id;
    }
    
    // Mendapatkan hasil jawaban
    public function get_hasil_jawaban() {
        $this->db->select('r.id, r.nama, r.email, r.tanggal');
        $this->db->from('responden r');
        return $this->db->get()->result();
    }
    
    public function get_detail_jawaban($responden_id) {
        $this->db->select('p.pertanyaan, j.nilai');
        $this->db->from('jawaban j');
        $this->db->join('pertanyaan p', 'p.id = j.pertanyaan_id');
        $this->db->where('j.responden_id', $responden_id);
        return $this->db->get()->result();
    }
    
    // Mendapatkan statistik hasil jawaban
    public function get_statistik_jawaban() {
        $query = $this->db->query('
            SELECT p.id, p.pertanyaan, 
                   AVG(j.nilai) as rata_rata, 
                   COUNT(j.id) as jumlah_jawaban
            FROM pertanyaan p
            LEFT JOIN jawaban j ON p.id = j.pertanyaan_id
            GROUP BY p.id, p.pertanyaan
        ');
        
        return $query->result();
    }
}