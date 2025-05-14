<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kuesioner_model');
        $this->load->model('account_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');

        if (!$this->session->userdata('status')) {
            redirect('auth/login');
        }
    }

    private function render($view, $data = [])
    {
        $user_id= $this->session->userdata('id');
        $data['user'] = $this->account_model->getUserById($user_id);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
    }

    public function index()
    {
        $user_id = $this->session->userdata('id');
        $data = [
            'title'     => 'Beranda',
            'page'      => 'home',
            'user'      => $this->account_model->getUserById($user_id),
            'statistik' => $this->kuesioner_model->get_statistik_jawaban()
        ];
        $this->render('dashboard/index', $data);
    }

    public function pertanyaan()
    {
        $data['pertanyaan'] = $this->kuesioner_model->get_all_pertanyaan();
        $this->render('dashboard/pertanyaan/index', $data);
    }

    public function tambah_pertanyaan()
    {
        $this->render('dashboard/pertanyaan/tambah');
    }

    public function simpan_pertanyaan()
    {
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('dashboard/pertanyaan/tambah');
        } else {
            $data = [
				'type' => $this->input->post('tipe'),
                'pertanyaan' => $this->input->post('pertanyaan'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->kuesioner_model->tambah_pertanyaan($data);
            $this->session->set_flashdata('success', 'Pertanyaan berhasil ditambahkan');
            redirect('dashboard/pertanyaan');
        }
    }

    public function edit_pertanyaan($id)
    {
        $data['pertanyaan'] = $this->kuesioner_model->get_pertanyaan($id);
        $this->render('dashboard/pertanyaan/edit', $data);
    }

    public function update_pertanyaan($id)
    {
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['pertanyaan'] = $this->kuesioner_model->get_pertanyaan($id);
            $this->render('dashboard/pertanyaan/edit', $data);
        } else {
            $data = [
                'pertanyaan' => $this->input->post('pertanyaan'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->kuesioner_model->update_pertanyaan($id, $data);
            $this->session->set_flashdata('success', 'Pertanyaan berhasil diperbarui');
            redirect('dashboard/pertanyaan');
        }
    }

    public function hapus_pertanyaan($id)
    {
        $this->kuesioner_model->hapus_pertanyaan($id);
        $this->session->set_flashdata('success', 'Pertanyaan berhasil dihapus');
        redirect('dashboard/pertanyaan');
    }

    public function hasil()
    {
        $data['responden'] = $this->kuesioner_model->get_hasil_jawaban();
        $this->render('dashboard/hasil/index', $data);
    }

	public function detail_jawaban($responden_id)
	{
		$all_jawaban = $this->kuesioner_model->get_detail_jawaban($responden_id);

		$jawaban_likert = [];
		$jawaban_tekstual = [];

		foreach ($all_jawaban as $j) {
			if ($j->type === 'likert') {
				$jawaban_likert[] = $j;
			} elseif ($j->type === 'text') {
				$jawaban_tekstual[] = $j;
			}
		}

		$data = [
			'responden'         => $this->db->get_where('responden', ['id' => $responden_id])->row(),
			'jawaban_likert'    => $jawaban_likert,
			'jawaban_tekstual'  => $jawaban_tekstual
		];

		$this->render('dashboard/hasil/detail', $data);
	}
	
	public function detail_pertanyaan($pertanyaan_id)
	{
		// Validasi ID pertanyaan
		if(!is_numeric($pertanyaan_id)) {
			$this->session->set_flashdata('error', 'ID pertanyaan tidak valid');
			redirect('dashboard/hasil');
		}
		
		// Ambil detail pertanyaan dan jawaban
		$data = $this->kuesioner_model->get_detail_by_pertanyaan($pertanyaan_id);
		
		if (!$data) {
			$this->session->set_flashdata('error', 'Data pertanyaan tidak ditemukan');
			redirect('dashboard/hasil');
		}
		
		// Load view dengan data
		$this->render('dashboard/hasil/detail_pertanyaan', $data);
	}
	
	public function detail_pertanyaan_text($pertanyaan_id)
	{
		// Validasi ID pertanyaan
		if(!is_numeric($pertanyaan_id)) {
			$this->session->set_flashdata('error', 'ID pertanyaan tidak valid');
			redirect('dashboard/hasil');
		}
		
		// Ambil detail pertanyaan dan jawaban
		$data = $this->kuesioner_model->get_detail_by_pertanyaan($pertanyaan_id);
		
		if (!$data) {
			$this->session->set_flashdata('error', 'Data pertanyaan tidak ditemukan');
			redirect('dashboard/hasil');
		}
		
		// Load view dengan data
		$this->render('dashboard/hasil/detail_pertanyaan_text', $data);
	}


    /*public function statistik()
    {
        $data['statistik'] = $this->kuesioner_model->get_statistik_jawaban();
        $this->render('dashboard/statistik', $data);
    }*/
}
