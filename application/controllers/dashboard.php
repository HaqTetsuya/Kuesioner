<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('kuesioner_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        // Cek login status (asumsikan auth sudah ada)
        if (!$this->session->userdata('status')) {
            redirect('auth/login');
        }
    }
    
    // Dashboard utama
    public function index() {
        $data = [
            'title' => 'Beranda',
            'page' => 'home'
        ];
        $data['statistik'] = $this->kuesioner_model->get_statistik_jawaban();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layout/footer', $data);
        
    }
    
    // === CRUD PERTANYAAN ===
    
    // Daftar semua pertanyaan
    public function pertanyaan() {
        $data['pertanyaan'] = $this->kuesioner_model->get_all_pertanyaan();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/pertanyaan/index', $data);
        $this->load->view('layout/footer', $data);
    }
    
    // Halaman tambah pertanyaan
    public function tambah_pertanyaan() {
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/pertanyaan/tambah');
        $this->load->view('layout/footer', $data);
    }
    
    // Proses simpan pertanyaan baru
    public function simpan_pertanyaan() {
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('dashboard/pertanyaan/tambah');
            $this->load->view('layout/footer', $data);
        } else {
            $data = [
                'pertanyaan' => $this->input->post('pertanyaan'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->kuesioner_model->tambah_pertanyaan($data);
            $this->session->set_flashdata('success', 'Pertanyaan berhasil ditambahkan');
            redirect('dashboard/pertanyaan');
        }
    }
    
    // Halaman edit pertanyaan
    public function edit_pertanyaan($id) {
        $data['pertanyaan'] = $this->kuesioner_model->get_pertanyaan($id);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/pertanyaan/edit', $data);
        $this->load->view('layout/footer', $data);
    }
    
    // Proses update pertanyaan
    public function update_pertanyaan($id) {
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['pertanyaan'] = $this->kuesioner_model->get_pertanyaan($id);
            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('dashboard/pertanyaan/edit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = [
                'pertanyaan' => $this->input->post('pertanyaan'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->kuesioner_model->update_pertanyaan($id, $data);
            $this->session->set_flashdata('success', 'Pertanyaan berhasil diperbarui');
            redirect('dashboard/pertanyaan');
        }
    }
    
    // Proses hapus pertanyaan
    public function hapus_pertanyaan($id) {
        $this->kuesioner_model->hapus_pertanyaan($id);
        $this->session->set_flashdata('success', 'Pertanyaan berhasil dihapus');
        redirect('dashboard/pertanyaan');
    }
    
    // === HASIL JAWABAN ===
    
    // Daftar semua responden
    public function hasil() {
        $data['responden'] = $this->kuesioner_model->get_hasil_jawaban();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/hasil/index', $data);
        $this->load->view('layout/footer', $data);
    }
    
    // Detail jawaban per responden
    public function detail_jawaban($responden_id) {
        $data['responden'] = $this->db->get_where('responden', ['id' => $responden_id])->row();
        $data['jawaban'] = $this->kuesioner_model->get_detail_jawaban($responden_id);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/hasil/detail', $data);
        $this->load->view('layout/footer', $data);
    }
    
    // Laporan statistik
    public function statistik() {
        $data['statistik'] = $this->kuesioner_model->get_statistik_jawaban();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/statistik', $data);
        $this->load->view('layout/footer', $data);
    }
}