<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveys extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $this->load->model('Survey_model');
        $this->load->model('Question_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Kelola Kuesioner';
        $data['surveys'] = $this->Survey_model->get_surveys();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('surveys/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Buat Kuesioner Baru';
        
        $this->form_validation->set_rules('title', 'Judul Kuesioner', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal Selesai', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('surveys/create', $data);
            $this->load->view('templates/footer');
        } else {
            $survey_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'status' => 'draft',
                'created_by' => $this->session->userdata('user_id')
            );
            
            $survey_id = $this->Survey_model->create_survey($survey_data);
            
            // Buat skala likert default (1-5)
            $scale_labels = array(
                1 => 'Sangat Tidak Setuju',
                2 => 'Tidak Setuju',
                3 => 'Netral',
                4 => 'Setuju',
                5 => 'Sangat Setuju'
            );
            
            foreach ($scale_labels as $value => $label) {
                $scale_data = array(
                    'survey_id' => $survey_id,
                    'scale_value' => $value,
                    'scale_label' => $label
                );
                $this->Survey_model->add_likert_scale($scale_data);
            }
            
            $this->session->set_flashdata('success', 'Kuesioner berhasil dibuat! Silakan tambahkan pertanyaan.');
            redirect('questions/index/' . $survey_id);
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Kuesioner';
        $data['survey'] = $this->Survey_model->get_survey($id);
        $data['likert_scales'] = $this->Survey_model->get_likert_scales($id);
        
        if (empty($data['survey'])) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        $this->form_validation->set_rules('title', 'Judul Kuesioner', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal Selesai', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('surveys/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $survey_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date')
            );
            
            $this->Survey_model->update_survey($id, $survey_data);
            
            // Update skala likert
            $scale_values = $this->input->post('scale_value');
            $scale_labels = $this->input->post('scale_label');
            $scale_ids = $this->input->post('scale_id');
            
            foreach ($scale_ids as $key => $scale_id) {
                $scale_data = array(
                    'scale_value' => $scale_values[$key],
                    'scale_label' => $scale_labels[$key]
                );
                $this->Survey_model->update_likert_scale($scale_id, $scale_data);
            }
            
            $this->session->set_flashdata('success', 'Kuesioner berhasil diperbarui!');
            redirect('surveys');
        }
    }

    public function delete($id) {
        $survey = $this->Survey_model->get_survey($id);
        
        if (empty($survey)) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        $this->Survey_model->delete_survey($id);
        $this->session->set_flashdata('success', 'Kuesioner berhasil dihapus!');
        redirect('surveys');
    }
    
    public function change_status($id, $status) {
        $survey = $this->Survey_model->get_survey($id);
        
        if (empty($survey)) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        // Cek apakah ada pertanyaan
        $questions = $this->Question_model->get_questions($id);
        if (empty($questions) && $status == 'active') {
            $this->session->set_flashdata('error', 'Tidak dapat mengaktifkan kuesioner tanpa pertanyaan!');
            redirect('surveys');
        }
        
        $this->Survey_model->update_survey($id, array('status' => $status));
        $this->session->set_flashdata('success', 'Status kuesioner berhasil diubah!');
        redirect('surveys');
    }
    
    public function preview($id) {
        $data['title'] = 'Preview Kuesioner';
        $data['survey'] = $this->Survey_model->get_survey($id);
        $data['questions'] = $this->Question_model->get_questions($id);
        $data['likert_scales'] = $this->Survey_model->get_likert_scales($id);
        
        if (empty($data['survey'])) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('surveys/preview', $data);
        $this->load->view('templates/footer');
    }
    
    public function share($id) {
        $survey = $this->Survey_model->get_survey($id);
        
        if (empty($survey)) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        $data['title'] = 'Bagikan Kuesioner';
        $data['survey'] = $survey;
        $data['survey_url'] = base_url('respondent/survey/' . $id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('surveys/share', $data);
        $this->load->view('templates/footer');
    }
}
