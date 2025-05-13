<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load model jika diperlukan
        // $this->load->model('book_model');
    }
    
    public function index() {
        // Data untuk halaman
        $data = [
            'title' => 'Beranda',
            'page' => 'home'
        ];
        
        // Load view dengan template
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/content', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function books() {
        // Data untuk halaman
        $data = [
            'title' => 'Daftar Buku',
            'page' => 'books'
        ];
        
        // Load view dengan template
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('books/index', $data); // Ganti content dengan view spesifik
        $this->load->view('layout/footer', $data);
    }
    
    // Fungsi lainnya...
}