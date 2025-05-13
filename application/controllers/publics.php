<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publics extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('kuesioner_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    // Halaman utama untuk mengisi kuesioner
    public function index() {
        $data['pertanyaan'] = $this->kuesioner_model->get_all_pertanyaan();
        $this->load->view('layout/header', $data);
        $this->load->view('public/kuesioner_form', $data);
        $this->load->view('layout/footer', $data);
    }
    
    // Proses simpan jawaban kuesioner
    public function submit() {
        // Validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        // Get semua pertanyaan untuk validasi jawaban
        $pertanyaan = $this->kuesioner_model->get_all_pertanyaan();
        foreach ($pertanyaan as $p) {
            $this->form_validation->set_rules('jawaban['.$p->id.']', 'Jawaban Pertanyaan '.$p->id, 'required|integer|greater_than[0]|less_than[6]');
        }
        
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form
            $data['pertanyaan'] = $pertanyaan;
            $this->load->view('public/kuesioner_form', $data);
        } else {
            // Simpan jawaban
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'jawaban' => $this->input->post('jawaban')
            ];
            
            $responden_id = $this->kuesioner_model->simpan_jawaban($data);
            
            // Tampilkan halaman terima kasih
            $data['message'] = 'Terima kasih telah mengisi kuesioner.';
            $this->load->view('public/thank_you', $data);
        }
    }
    
    // Halaman terima kasih setelah submit
    public function thank_you() {
        $data['message'] = 'Terima kasih telah mengisi kuesioner.';
        $this->load->view('public/thank_you', $data);
    }
}