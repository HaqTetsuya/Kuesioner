<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(['Kuesioner_model', 'Pertanyaan_model']);
    }

    // Halaman isi kuesioner untuk responden
    public function isi($kuesioner_id) {
        $data['kuesioner'] = $this->Kuesioner_model->get_kuesioner_detail($kuesioner_id);
        
        $this->load->view('layout/header');
        $this->load->view('kuesioner/isi_kuesioner', $data);
        $this->load->view('layout/footer');
    }

    // Proses submit jawaban kuesioner
    public function submit() {
        $kuesioner_id = $this->input->post('kuesioner_id');
        $pertanyaan = $this->input->post('pertanyaan');
        $nilai = $this->input->post('nilai');
        $komentar = $this->input->post('komentar');

        // Validasi dan simpan jawaban
        foreach ($pertanyaan as $pertanyaan_id => $teks) {
            $jawaban_data = [
                'pertanyaan_id' => $pertanyaan_id,
                'responden_id' => $this->session->userdata('user_id'), // Atau generate unique ID
                'nilai' => $nilai[$pertanyaan_id],
                'komentar' => $komentar[$pertanyaan_id] ?? null
            ];

            $this->db->insert('jawaban', $jawaban_data);
        }

        // Redirect dengan pesan sukses
        $this->session->set_flashdata('success', 'Kuesioner berhasil diisi');
        redirect('kuesioner/terima_kasih');
    }

    // Halaman terima kasih
    public function terima_kasih() {
        $this->load->view('layout/header');
        $this->load->view('kuesioner/terima_kasih');
        $this->load->view('layout/footer');
    }
}