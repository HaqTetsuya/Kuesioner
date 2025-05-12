<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $this->load->model('Question_model');
        $this->load->model('Survey_model');
        $this->load->library('form_validation');
    }

    public function index($survey_id) {
        $data['title'] = 'Kelola Pertanyaan';
        $data['survey'] = $this->Survey_model->get_survey($survey_id);
        $data['questions'] = $this->Question_model->get_questions($survey_id);
        
        if (empty($data['survey'])) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('questions/index', $data);
        $this->load->view('templates/footer');
    }

    public function create($survey_id) {
        $data['title'] = 'Tambah Pertanyaan';
        $data['survey'] = $this->Survey_model->get_survey($survey_id);
        
        if (empty($data['survey'])) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('surveys');
        }
        
        $this->form_validation->set_rules('question_text', 'Pertanyaan', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('questions/create', $data);
            $this->load->view('templates/footer');
        } else {
            $max_order = $this->Question_model->get_max_order($survey_id);
            
            $question_data = array(
                'survey_id' => $survey_id,
                'question_text' => $this->input->post('question_text'),
                'question_order' => $max_order + 1
            );
            
            $this->Question_model->create_question($question_data);
            $this->session->set_flashdata('success', 'Pertanyaan berhasil ditambahkan!');
            redirect('questions/index/' . $survey_id);
        }
    }

    public function edit($id) {
        $data['question'] = $this->Question_model->get_question($id);
        
        if (empty($data['question'])) {
            $this->session->set_flashdata('error', 'Pertanyaan tidak ditemukan!');
            redirect('surveys');
        }
        
        $data['title'] = 'Edit Pertanyaan';
        $data['survey'] = $this->Survey_model->get_survey($data['question']->survey_id);
        
        $this->form_validation->set_rules('question_text', 'Pertanyaan', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('questions/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $question_data = array(
                'question_text' => $this->input->post('question_text')
            );
            
            $this->Question_model->update_question($id, $question_data);
            $this->session->set_flashdata('success', 'Pertanyaan berhasil diperbarui!');
            redirect('questions/index/' . $data['question']->survey_id);
        }
    }

    public function delete($id) {
        $question = $this->Question_model->get_question($id);
        
        if (empty($question)) {
            $this->session->set_flashdata('error', 'Pertanyaan tidak ditemukan!');
            redirect('surveys');
        }
        
        $survey_id = $question->survey_id;
        $this->Question_model->delete_question($id);
        $this->session->set_flashdata('success', 'Pertanyaan berhasil dihapus!');
        redirect('questions/index/' . $survey_id);
    }
    
    public function reorder() {
        $question_ids = $this->input->post('question_ids');
        
        foreach ($question_ids as $order => $id) {
            $this->Question_model->update_question($id, array('question_order' => $order + 1));
        }
        
        echo json_encode(array('status' => 'success'));
    }
}