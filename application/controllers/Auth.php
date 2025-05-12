<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        // Redirect ke dashboard jika sudah login
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        
        $this->load->view('templates/header');
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $user = $this->User_model->check_login($username, $password);
            
            if ($user) {
                $user_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'name' => $user->name,
                    'role' => $user->role,
                    'logged_in' => TRUE
                );
                
                $this->session->set_userdata($user_data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}