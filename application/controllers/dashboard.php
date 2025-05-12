<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        // Pastikan hanya user yang sudah login yang bisa akses
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model(['Kuesioner_model', 'Pertanyaan_model']);
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['kuesioner'] = $this->Kuesioner_model->get_kuesioner_by_user($user_id);

        $this->load->view('layout/header');
        $this->load->view('dashboard/index', $data);
        $this->load->view('layout/footer');
    }

    public function tambah_kuesioner() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('dashboard/tambah_kuesioner');
            $this->load->view('layout/footer');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'user_id' => $this->session->userdata('user_id')
            ];

            $this->Kuesioner_model->create_kuesioner($data);
            redirect('dashboard');
        }
    }

    public function edit_kuesioner($id) {
        $data['kuesioner'] = $this->Kuesioner_model->get_kuesioner_detail($id);

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('dashboard/edit_kuesioner', $data);
            $this->load->view('layout/footer');
        } else {
            $update_data = [
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            $this->Kuesioner_model->update_kuesioner($id, $update_data);
            redirect('dashboard');
        }
    }

    public function hapus_kuesioner($id) {
        $this->Kuesioner_model->delete_kuesioner($id);
        redirect('dashboard');
    }
}