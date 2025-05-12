<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Respondent extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Survey_model');
        $this->load->model('Question_model');
        $this->load->model('Response_model');
        $this->load->library('form_validation');
    }

    public function survey($survey_id) {
        $data['survey'] = $this->Survey_model->get_survey($survey_id);
        
        // Cek apakah kuesioner ada dan aktif
        if (empty($data['survey']) || $data['survey']->status != 'active') {
            show_404();
        }
        
        $data['title'] = $data['survey']->title;
        $data['questions'] = $this->Question_model->get_questions($survey_id);
        $data['likert_scales'] = $this->Survey_model->get_likert_scales($survey_id);
        
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        // Tambahkan validasi untuk setiap pertanyaan
        foreach ($data['questions'] as $question) {
            $this->form_validation->set_rules('answer[' . $question->id . ']', 'Pertanyaan #' . $question->question_order, 'required');
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('public/survey_form', $data);
        } else {
            // Simpan data responden
            $respondent_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'additional_info' => $this->input->post('additional_info')
            );
            
            $respondent_id = $this->Response_model->add_respondent($respondent_data);
            
            // Simpan response
            $response_data = array(
                'survey_id' => $survey_id,
                'respondent_id' => $respondent_id
            );
            
            $response_id = $this->Response_model->add_response($response_data);
            
            // Simpan detail jawaban
            $answers = $this->input->post('answer');
            
            foreach ($answers as $question_id => $answer_value) {
                $answer_data = array(
                    'response_id' => $response_id,
                    'question_id' => $question_id,
                    'answer_value' => $answer_value
                );
                
                $this->Response_model->add_answer_detail($answer_data);
            }
            
            redirect('respondent/thank_you/' . $survey_id);
        }
    }
    
    public function thank_you($survey_id) {
        $data['survey'] = $this->Survey_model->get_survey($survey_id);
        
        if (empty($data['survey'])) {
            show_404();
        }
        
        $data['title'] = 'Terima Kasih';
        $this->load->view('public/thank_you', $data);
    }
}