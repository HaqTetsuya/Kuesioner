<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_all_pertanyaan()
    {
        return $this->db->get_where('pertanyaan')->result();
    }

    public function get_pertanyaan_likert()
    {
        return $this->db->get_where('pertanyaan', ['type' => 'likert'])->result();
    }

    public function get_pertanyaan_text()
    {
        return $this->db->get_where('pertanyaan', ['type' => 'text'])->result();
    }

    public function get_pertanyaan($id)
    {
        return $this->db->get_where('pertanyaan', ['id' => $id])->row();
    }

    public function tambah_pertanyaan($data)
    {
        $this->db->insert('pertanyaan', $data);
        return $this->db->insert_id();
    }

    public function update_pertanyaan($id, $data)
    {
        $this->db->update('pertanyaan', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function hapus_pertanyaan($id)
    {
        $this->db->delete('pertanyaan', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function tambah_responden($data)
    {
        $this->db->insert('responden', [
            'user_id' => $data['responden'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'tanggal' => date('Y-m-d H:i:s')
        ]);
    }
    // Fungsi untuk jawaban responden
    public function simpan_jawaban_likert($responden_id, $data_likert)
    {
        foreach ($data_likert['jawaban'] as $pertanyaan_id => $nilai) {
            $this->db->insert('jawaban_likert', [
                'responden_id' => $responden_id,
                'pertanyaan_id' => $pertanyaan_id,
                'nilai' => $nilai
            ]);
        }
    }

    public function simpan_jawaban_text($responden_id, $data_text)
    {
        foreach ($data_text['jawaban_text'] as $pertanyaan_id => $jawaban) {
            $this->db->insert('jawaban_tekstual', [
                'responden_id' => $responden_id,
                'pertanyaan_id' => $pertanyaan_id,
                'jawaban' => $jawaban
            ]);
        }
    }


    // Mendapatkan hasil jawaban
    public function get_hasil_jawaban()
    {
        $this->db->select('r.id, r.nama, r.email, r.tanggal');
        $this->db->from('responden r');
        return $this->db->get()->result();
    }
    /*
    public function get_detail_jawaban($responden_id) {
        $this->db->select('p.pertanyaan, j.nilai');
        $this->db->from('jawaban j');
        $this->db->join('pertanyaan p', 'p.id = j.pertanyaan_id');
        $this->db->where('j.responden_id', $responden_id);
        return $this->db->get()->result();
    } */

    public function get_detail_jawaban($responden_id)
    {
        // Query for likert answers
        $this->db->select('p.pertanyaan, j.nilai as jawaban, p.type');
        $this->db->from('jawaban_likert j');
        $this->db->join('pertanyaan p', 'p.id = j.pertanyaan_id');
        $this->db->where('j.responden_id', $responden_id);
        $query_likert = $this->db->get()->result();

        // Query for textual answers
        $this->db->select('p.pertanyaan, j.jawaban as jawaban, p.type');
        $this->db->from('jawaban_tekstual j');
        $this->db->join('pertanyaan p', 'p.id = j.pertanyaan_id');
        $this->db->where('j.responden_id', $responden_id);
        $query_textual = $this->db->get()->result();

        // Combine both results
        return array_merge($query_likert, $query_textual);
    }

	public function get_statistik_jawaban() {
		$query = $this->db->query('
			SELECT p.id, p.pertanyaan, 
				   AVG(j.nilai) as rata_rata, 
				   COUNT(j.id) as jumlah_jawaban
			FROM pertanyaan p
			LEFT JOIN jawaban_likert j ON p.id = j.pertanyaan_id
			WHERE p.type = "likert"
			GROUP BY p.id, p.pertanyaan
		');

		return $query->result();
	}


    /* Mendapatkan statistik hasil jawaban
    public function get_statistik_jawaban() {
		$query = $this->db->query('
			SELECT p.id, p.pertanyaan, 
				   AVG(j.nilai) as rata_rata, 
				   COUNT(j.id) as jumlah_jawaban,
				   SUM(CASE WHEN j.nilai = 1 THEN 1 ELSE 0 END) as nilai_1,
				   SUM(CASE WHEN j.nilai = 2 THEN 1 ELSE 0 END) as nilai_2,
				   SUM(CASE WHEN j.nilai = 3 THEN 1 ELSE 0 END) as nilai_3,
				   SUM(CASE WHEN j.nilai = 4 THEN 1 ELSE 0 END) as nilai_4,
				   SUM(CASE WHEN j.nilai = 5 THEN 1 ELSE 0 END) as nilai_5
			FROM pertanyaan p
			LEFT JOIN jawaban_likert j ON p.id = j.pertanyaan_id
			WHERE p.type = "likert"
			GROUP BY p.id, p.pertanyaan
		');
		return $query->result();
	}
	*/

}
