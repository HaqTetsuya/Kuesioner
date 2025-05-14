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
        $this->db->select('p.id, p.pertanyaan, j.nilai as jawaban, p.type');
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
			SELECT 
				p.id, 
				p.pertanyaan,
				p.type,
				CASE 
					WHEN p.type = "likert" THEN AVG(jl.nilai)
					ELSE NULL
				END as rata_rata,
				CASE 
					WHEN p.type = "likert" THEN COUNT(jl.id)
					WHEN p.type = "text" THEN COUNT(jt.id)
					ELSE 0
				END as jumlah_jawaban
			FROM pertanyaan p
			LEFT JOIN jawaban_likert jl ON p.id = jl.pertanyaan_id
			LEFT JOIN jawaban_tekstual jt ON p.id = jt.pertanyaan_id
			GROUP BY p.id, p.pertanyaan, p.type
			ORDER BY p.id;

		');

		return $query->result();
}
	
	public function get_detail_by_pertanyaan($pertanyaan_id)
	{
		// Ambil data pertanyaan
		$pertanyaan = $this->db->get_where('pertanyaan', ['id' => $pertanyaan_id])->row();
		if (!$pertanyaan) {
			return false;
		}
		
		// Data dasar
		$data = [
			'pertanyaan' => $pertanyaan,
			'title' => 'Detail Jawaban Pertanyaan'
		];
		
		// Jika tipe pertanyaan adalah likert
		if($pertanyaan->type == 'likert') {
			// Query untuk mendapatkan semua jawaban likert untuk pertanyaan ini
			$this->db->select('jawaban_likert.*, responden.nama as responden_nama');
			$this->db->from('jawaban_likert');
			$this->db->join('responden', 'responden.id = jawaban_likert.responden_id', 'left');
			$this->db->where('jawaban_likert.pertanyaan_id', $pertanyaan_id);
			$data['jawaban_likert'] = $this->db->get()->result();
			
			// Hitung distribusi jawaban (untuk chart)
			$data['distribusi'] = [
				1 => 0, // Sangat Tidak Setuju
				2 => 0, // Tidak Setuju  
				3 => 0, // Netral
				4 => 0, // Setuju
				5 => 0  // Sangat Setuju
			];
			
			foreach($data['jawaban_likert'] as $jawaban) {
				$data['distribusi'][$jawaban->nilai]++;
			}
		} 
		else if($pertanyaan->type == 'text') {
			// Logic untuk jawaban text jika diperlukan
			// ...
			$this->db->select('jawaban_tekstual.*, responden.nama as responden_nama');
			$this->db->from('jawaban_tekstual');
			$this->db->join('responden', 'responden.id = jawaban_tekstual.responden_id', 'left');
			$this->db->where('jawaban_tekstual.pertanyaan_id', $pertanyaan_id);
			$data['jawaban_text'] = $this->db->get()->result();
			
			// Tambahkan analisis sederhana jawaban text
			$data['total_jawaban'] = count($data['jawaban_text']);
			$data['kata_kunci'] = $this->analisis_kata_kunci($data['jawaban_text']);
				}
				
		return $data;
	}

	private function analisis_kata_kunci($jawaban_array)
	{
		$all_text = '';
		foreach($jawaban_array as $jawaban) {
			$all_text .= ' ' . strtolower($jawaban->jawaban);
		}
		
		// Hapus karakter khusus dan angka
		$all_text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $all_text);
		
		// Pisahkan kata-kata
		$words = preg_split('/\s+/', $all_text, -1, PREG_SPLIT_NO_EMPTY);
		
		// Kata-kata yang akan diabaikan (stopwords)
		$stopwords = ['dan', 'atau', 'yang', 'di', 'ke', 'dari', 'untuk', 'pada', 'adalah', 'ini', 'itu', 'dengan', 'saya', 'kamu', 'anda', 'mereka', 'kami', 'kita', 'akan', 'sudah', 'telah', 'sedang', 'belum', 'tidak', 'bukan', 'oleh'];
		
		// Hitung frekuensi kata
		$word_count = [];
		foreach($words as $word) {
			if(!in_array($word, $stopwords) && strlen($word) > 2) {
				if(isset($word_count[$word])) {
					$word_count[$word]++;
				} else {
					$word_count[$word] = 1;
				}
			}
		}
		
		// Urutkan berdasarkan frekuensi (terbanyak di atas)
		arsort($word_count);
		
		// Ambil 20 kata teratas
		return array_slice($word_count, 0, 20, true);
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
