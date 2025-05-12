<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $this->load->model('Survey_model');
        $this->load->model('Question_model');
        $this->load->model('Response_model');
        $this->load->model('Report_model');
        $this->load->helper('download');
    }

    public function index() {
        $data['title'] = 'Laporan Kuesioner';
        $data['surveys'] = $this->Survey_model->get_surveys();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('reports/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($survey_id) {
        $data['survey'] = $this->Survey_model->get_survey($survey_id);
        
        if (empty($data['survey'])) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('reports');
        }
        
        $data['title'] = 'Laporan: ' . $data['survey']->title;
        $data['questions'] = $this->Question_model->get_questions($survey_id);
        $data['likert_scales'] = $this->Survey_model->get_likert_scales($survey_id);
        $data['total_responses'] = $this->Response_model->count_survey_responses($survey_id);
        $data['summary'] = $this->Report_model->get_survey_summary($survey_id);
        $data['question_averages'] = $this->Report_model->get_question_averages($survey_id);
        $data['responses'] = $this->Response_model->get_survey_responses($survey_id, 10);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('reports/detail', $data);
        $this->load->view('templates/footer');
    }
    
    public function export_csv($survey_id) {
        $survey = $this->Survey_model->get_survey($survey_id);
        
        if (empty($survey)) {
            $this->session->set_flashdata('error', 'Kuesioner tidak ditemukan!');
            redirect('reports');
        }
        
        $questions = $this->Question_model->get_questions($survey_id);
        $responses = $this->Response_model->get_all_survey_responses($survey_id);
        
        // Buat header CSV
        $csv_data = "Responden ID,Nama,Email,Telepon,Tanggal Respons";
        foreach ($questions as $question) {
            $csv_data .= ',"' . str_replace('"', '""', $question->question_text) . '"';
        }
        $csv_data .= "\n";
        
        // Tambahkan data respons
        foreach ($responses as $response) {
            $csv_data .= $response->respondent_id . ',';
            $csv_data .= '"' . str_replace('"', '""', $response->name) . '",';
            $csv_data .= '"' . $response->email . '",';
            $csv_data .= '"' . $response->phone . '",';
            $csv_data .= '"' . date('Y-m-d H:i:s', strtotime($response->created_at)) . '"';
            
            // Tambahkan jawaban
            foreach ($questions as $question) {
                $answer_value = $this->Response_model->get_answer_value($response->response_id, $question->id);
                $csv_data .= ',' . $answer_value;
            }
            
            $csv_data .= "\n";
        }
        
        $filename = 'survey_' . $survey_id . '_results_' . date('Ymd') . '.csv';
        force_download($filename, $csv_data);
    }
}