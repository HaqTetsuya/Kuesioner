<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        // Pastikan hanya user yang sudah login yang bisa akses
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model('Pertanyaan_model');
        $this->load->model('Kuesioner_model');
    }

    // Halaman tambah pertanyaan untuk kuesioner tertentu
    public function tambah() {
        $this->form_validation->set_rules('teks_pertanyaan', 'Teks Pertanyaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('dashboard/tambah_pertanyaan', $data);
            $this->load->view('layout/footer');
        } else {
            $data_pertanyaan = [
                'teks_pertanyaan' => $this->input->post('teks_pertanyaan')
            ];
            $this->Pertanyaan_model->create_pertanyaan($data_pertanyaan);            
            $this->session->set_flashdata('success', 'Pertanyaan berhasil ditambahkan');
            redirect('dashboard/tambah_pertanyaan');
        }
    }

    // Halaman edit pertanyaan
    public function edit($pertanyaan_id) {
        $data['pertanyaan'] = $this->Pertanyaan_model->get_pertanyaan_detail($pertanyaan_id);

        $this->form_validation->set_rules('teks_pertanyaan', 'Teks Pertanyaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('dashboard/edit_pertanyaan', $data);
            $this->load->view('layout/footer');
        } else {
            $update_data = [
                'teks_pertanyaan' => $this->input->post('teks_pertanyaan')
            ];

            $this->Pertanyaan_model->update_pertanyaan($pertanyaan_id, $update_data);
            
            $this->session->set_flashdata('success', 'Pertanyaan berhasil diupdate');
            redirect('dashboard/edit_kuesioner/'.$data['pertanyaan']->kuesioner_id);
        }
    }

    // Hapus pertanyaan
    public function hapus($pertanyaan_id) {
        $pertanyaan = $this->Pertanyaan_model->get_pertanyaan_detail($pertanyaan_id);
        $kuesioner_id = $pertanyaan->kuesioner_id;

        $this->Pertanyaan_model->delete_pertanyaan($pertanyaan_id);
        
        $this->session->set_flashdata('success', 'Pertanyaan berhasil dihapus');
        redirect('dashboard/edit_kuesioner/'.$kuesioner_id);
    }

    // Halaman hasil kuesioner
    public function hasil($kuesioner_id) {
        $data['kuesioner'] = $this->Kuesioner_model->get_kuesioner_detail($kuesioner_id);
        
        // Hitung statistik sederhana
        foreach ($data['kuesioner']->pertanyaan as &$pertanyaan) {
            $jawaban = $this->db->where('pertanyaan_id', $pertanyaan->id)
                                ->get('jawaban')
                                ->result();
            
            $total_jawaban = count($jawaban);
            $rata_rata = $total_jawaban > 0 
                ? array_sum(array_column($jawaban, 'nilai')) / $total_jawaban 
                : 0;
            
            $pertanyaan->total_jawaban = $total_jawaban;
            $pertanyaan->rata_rata = round($rata_rata, 2);
            $pertanyaan->jawaban = $jawaban;
        }

        $this->load->view('layout/header');
        $this->load->view('dashboard/hasil_kuesioner', $data);
        $this->load->view('layout/footer');
    }
}