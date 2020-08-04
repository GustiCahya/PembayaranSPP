<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('user')){
			redirect('auth');
		}
	}

	public function index()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_index');
		$this->load->view('dashboard/v_footer');
	}

	public function siswa()
	{
		$this->load->model('siswa');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'create':
				$this->form_validation->set_rules('nisn', 'NISN', 'required|trim');
				$this->form_validation->set_rules('nis', 'NIS', 'required|trim');
				$this->form_validation->set_rules('nama', 'NAMA', 'required|trim');
				$this->form_validation->set_rules('id_kelas', 'ID kelas', 'required|trim');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
				$this->form_validation->set_rules('no_telp', 'No. telp.', 'required|trim');
				$this->form_validation->set_rules('id_spp', 'ID SPP', 'required|trim');

				if($this->form_validation->run() == false){
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_siswa/create');
					$this->load->view('dashboard/v_footer');
				}else{
					$insertData = [
						'nisn' => $this->input->post('nisn'),
						'nis' => $this->input->post('nis'),
						'nama' => $this->input->post('nama'),
						'id_kelas' => $this->input->post('id_kelas'),
						'alamat' => $this->input->post('alamat'),
						'no_telp' => $this->input->post('no_telp'),
						'id_spp' => $this->input->post('id_spp')
					];
					$this->siswa->insert($insertData);
					redirect('dashboard/siswa');
				}
			break;
			case 'update':
				$this->form_validation->set_rules('nis', 'NIS', 'required|trim');
				$this->form_validation->set_rules('nama', 'NAMA', 'required|trim');
				$this->form_validation->set_rules('id_kelas', 'ID kelas', 'required|trim');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
				$this->form_validation->set_rules('no_telp', 'No. telp.', 'required|trim');
				$this->form_validation->set_rules('id_spp', 'ID SPP', 'required|trim');
				if($this->form_validation->run() == false){
					$key = $this->input->get('key');
					$data = $this->siswa->findOne($key);
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_siswa/update', $data);
					$this->load->view('dashboard/v_footer');
				}else{
					$updateData = [
						'nis' => $this->input->post('nis'),
						'nama' => $this->input->post('nama'),
						'id_kelas' => $this->input->post('id_kelas'),
						'alamat' => $this->input->post('alamat'),
						'no_telp' => $this->input->post('no_telp'),
						'id_spp' => $this->input->post('id_spp')
					];
					$this->siswa->update($this->input->get('key'), $updateData);
					redirect('dashboard/siswa');
				}
			break;
			case 'delete':
				$key = $this->input->get('key');
				$this->siswa->delete($key);
				redirect('dashboard/siswa');
			break;
			default:
				//konfigurasi pagination
				$config['base_url'] = site_url('dashboard/siswa/index'); //site url
				$config['total_rows'] = $this->db->count_all('siswa'); //total row
				$config['per_page'] = 5;  //show record per halaman
				$config["uri_segment"] = 4;  // uri parameter
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice);
		 
				// Membuat Style pagination Matrialize
			  	$config['first_link']       = 'First';
				$config['last_link']        = 'Last';
				$config['next_link']        = 'Next';
				$config['prev_link']        = 'Prev';
				$config['full_tag_open']    = '<ul class="pagination">';
				$config['full_tag_close']   = '</ul>';
				$config['num_tag_open']     = '<li class="waves-effect"><a>';
				$config['num_tag_close']    = '</a></li>';
				$config['cur_tag_open']     = '<li class="active"><a>';
				$config['cur_tag_close']    = '</a></li>';
				$config['next_tag_open']    = '<li class="waves-effect"><a>';
				$config['next_tagl_close']  = '<i class="material-icons">chevron_right</i></a></li>';
				$config['prev_tag_open']    = '<li class="waves-effect"><a>';
				$config['prev_tagl_close']  = '<i class="material-icons">chevron_left</i></a></li>';
				$config['first_tag_open']   = '<li class="waves-effect"><a>';
				$config['first_tagl_close'] = '</li>';
				$config['last_tag_open']    = '<li class="waves-effect"><a>';
				$config['last_tagl_close']  = '</li>';
		 
				$this->pagination->initialize($config);

				$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data['siswa'] = $this->siswa->findList($config["per_page"], $data['page']);           
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_siswa/index', $data);
				$this->load->view('dashboard/v_footer');
			break;
		}
	}

	public function petugas()
	{
		$this->load->model('petugas');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'create':
				$this->form_validation->set_rules('id_petugas', 'ID Petugas', 'required|trim');
				$this->form_validation->set_rules('username', 'Username', 'required|trim');
				$this->form_validation->set_rules('password', 'Password', 'required|trim');
				$this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim');
				$this->form_validation->set_rules('level', 'Level', 'required|trim');

				if($this->form_validation->run() == false){
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_petugas/create');
					$this->load->view('dashboard/v_footer');
				}else{
					$insertData = [
						'id_petugas' => $this->input->post('id_petugas'),
						'username' => $this->input->post('username'),
						'password' => PASSWORD_HASH($this->input->post('password'), PASSWORD_DEFAULT),
						'nama_petugas' => $this->input->post('nama_petugas'),
						'level' => $this->input->post('level'),
					];
					$this->petugas->insert($insertData);
					redirect('dashboard/petugas');
				}
			break;
			case 'update':
				$this->form_validation->set_rules('username', 'Username', 'required|trim');
				$this->form_validation->set_rules('password', 'Password', 'required|trim');
				$this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim');
				$this->form_validation->set_rules('level', 'Level', 'required|trim');

				if($this->form_validation->run() == false){
					$key = $this->input->get('key');
					$data = $this->petugas->findOne($key);
					$data['password'] = '';
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_petugas/update', $data);
					$this->load->view('dashboard/v_footer');
				}else{
					$updateData = [
						'username' => $this->input->post('username'),
						'password' => PASSWORD_HASH($this->input->post('password'), PASSWORD_DEFAULT),
						'nama_petugas' => $this->input->post('nama_petugas'),
						'level' => $this->input->post('level'),
					];
					$this->petugas->update($this->input->get('key'), $updateData);
					redirect('dashboard/petugas');
				}
			break;
			case 'delete':
				$key = $this->input->get('key');
				$this->petugas->delete($key);
				redirect('dashboard/petugas');
			break;
			default:
				//konfigurasi pagination
				$config['base_url'] = site_url('dashboard/petugas/index'); //site url
				$config['total_rows'] = $this->db->count_all('petugas'); //total row
				$config['per_page'] = 5;  //show record per halaman
				$config["uri_segment"] = 4;  // uri parameter
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice);

				// Membuat Style pagination Matrialize
			  	$config['first_link']       = 'First';
				$config['last_link']        = 'Last';
				$config['next_link']        = 'Next';
				$config['prev_link']        = 'Prev';
				$config['full_tag_open']    = '<ul class="pagination">';
				$config['full_tag_close']   = '</ul>';
				$config['num_tag_open']     = '<li class="waves-effect"><a>';
				$config['num_tag_close']    = '</a></li>';
				$config['cur_tag_open']     = '<li class="active"><a>';
				$config['cur_tag_close']    = '</a></li>';
				$config['next_tag_open']    = '<li class="waves-effect"><a>';
				$config['next_tagl_close']  = '<i class="material-icons">chevron_right</i></a></li>';
				$config['prev_tag_open']    = '<li class="waves-effect"><a>';
				$config['prev_tagl_close']  = '<i class="material-icons">chevron_left</i></a></li>';
				$config['first_tag_open']   = '<li class="waves-effect"><a>';
				$config['first_tagl_close'] = '</li>';
				$config['last_tag_open']    = '<li class="waves-effect"><a>';
				$config['last_tagl_close']  = '</li>';
		 
				$this->pagination->initialize($config);

				$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data['petugas'] = $this->petugas->findList($config["per_page"], $data['page']);           
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_petugas/index', $data);
				$this->load->view('dashboard/v_footer');
			break;
		}

	}
}
