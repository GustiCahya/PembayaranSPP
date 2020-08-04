<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if($this->session->userdata('user')){
			redirect('dashboard');
		}	
		$this->load->view('v_login');
	}

	public function login()
	{
		if($this->session->userdata('user')){
			redirect('dashboard');
		}	
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run() == false){
			$this->load->view('v_login');
		}else{
			$this->load->model('petugas');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->petugas->findOne(['username' => $username]);
			if(password_verify($password, $user['password'])){
				$this->session->set_userdata('user', $user['username']);
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('message', '<div class="left red" style="padding: 3px 5px">Username atau Password salah</div>');
				redirect('auth');
			}	
		}
	}

	public function login_siswa(){
		if($this->session->userdata('user')){
			redirect('dashboard');
		}	

		$this->load->model('siswa');
		$this->form_validation->set_rules('nisn', 'NISN', 'trim|required');
		$this->form_validation->set_rules('nis', 'nis', 'trim|required');

		if($this->form_validation->run() == false){
			$this->load->view('v_login_siswa');
		}else{
			$nisn = $this->input->post('nisn');
			$nis = $this->input->post('nis');
			$user = $this->siswa->findOne($nisn);
			if(isset($user['nisn']) && isset($user['nis']) ){
				if($user['nisn'] == $nisn && $user['nis'] == $nis){
					$this->session->set_userdata('user', intval($user['nisn']));
					redirect('dashboard/pembayaran');
				}else{
					$this->session->set_flashdata('message', 
					'<div class="left red" style="padding: 3px 5px">NISN atau NIS salah</div>');
					redirect('auth/login_siswa');
				}
			}else{
				$this->session->set_flashdata('message', 
				'<div class="left red" style="padding: 3px 5px">NISN atau NIS salah</div>');
				redirect('auth/login_siswa');
			}
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect('auth');
	}
}
