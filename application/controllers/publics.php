<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publics extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('kuesioner_model');
        $this->load->model('account_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    // Halaman utama untuk mengisi kuesioner
    public function index() {
        $user_id= $this->session->userdata('id');
        $data['user'] = $this->account_model->getUserById($user_id);
		$data['user_id'] = $user_id;
        //$data['pertanyaan'] = $this->kuesioner_model->get_all_pertanyaan();		
		$data['pertanyaan'] = $this->kuesioner_model->get_pertanyaan_likert();
		$data['pertanyaan_text'] = $this->kuesioner_model->get_pertanyaan_text();		
        $this->load->view('layout/header', $data);
        $this->load->view('public/kuesioner_form', $data);
        $this->load->view('layout/footer', $data);
    }
    
    // Proses simpan jawaban kuesioner
	public function submit() {
        // Get all questions for validation
        $pertanyaan_likert = $this->kuesioner_model->get_pertanyaan_likert();
        $pertanyaan_text = $this->kuesioner_model->get_pertanyaan_text();
        
        // Validasi form untuk pertanyaan likert
        foreach ($pertanyaan_likert as $p) {
            $this->form_validation->set_rules('jawaban_likert['.$p->id.']', 'Jawaban Pertanyaan '.$p->id, 'required|integer|greater_than[0]|less_than[6]');
        }
        
        // Validasi form untuk pertanyaan text
        foreach ($pertanyaan_text as $p) {
            $this->form_validation->set_rules('jawaban_text['.$p->id.']', 'Jawaban Pertanyaan Text '.$p->id, 'required|trim');
        }
        
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form dengan error message
            $data['pertanyaan'] = $pertanyaan_likert;
            $data['pertanyaan_text'] = $pertanyaan_text;
            $data['user'] = $this->user_model->get_user_data();
            
            $this->load->view('template/header');
            $this->load->view('public/kuesioner_form', $data);
            $this->load->view('template/footer');
        } else {
			
			$data = [
                'responden' => $this->input->post('responden'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
            ];
			$this->kuesioner_model->tambah_responden($data);
			$responden_id = $this->db->insert_id();

            // Simpan jawaban likert
            $data_likert = [
                'jawaban' => $this->input->post('jawaban_likert')
            ];           
            // Simpan jawaban text
            $data_text = [
                'jawaban_text' => $this->input->post('jawaban_text')
            ];
            
            // Simpan ke database	
            $this->kuesioner_model->simpan_jawaban_likert($responden_id, $data_likert);
            $this->kuesioner_model->simpan_jawaban_text($responden_id, $data_text);
            
            redirect('publics/thank_you');
        }
    }
    
    // Halaman terima kasih setelah submit
    public function thank_you() {
        $user_id= $this->session->userdata('id');
        $data['user'] = $this->account_model->getUserById($user_id);
        $data['message'] = 'Terima kasih telah mengisi kuesioner.';
        $this->load->view('layout/header', $data);
        $this->load->view('public/thank_you', $data);
        $this->load->view('layout/footer', $data);
    }
}