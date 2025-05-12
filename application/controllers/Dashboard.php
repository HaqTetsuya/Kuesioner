<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        $this->load->model('Survey_model');
        $this->load->model('Response_model');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['total_surveys'] = $this->Survey_model->count_surveys();
        $data['active_surveys'] = $this->Survey_model->count_surveys('active');
        $data['total_responses'] = $this->Response_model->count_responses();
        $data['recent_surveys'] = $this->Survey_model->get_recent_surveys(5);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}