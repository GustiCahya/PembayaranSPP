<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $user;
	private $role;
	
	public function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('user');
		if(!$user){
			redirect('auth');
		}
		if(is_integer($user)){
			$role = 'siswa';
		}else{
			$this->load->model('petugas');
			$role = $this->petugas->findOne(['username' => $user])['level'];
		}
		$this->user = $user;
		$this->role = $role;
	}

	public function index()
	{
		redirect('dashboard/pembayaran/transaksi');
	}

	public function siswa()
	{
		if($this->role != 'admin'){
			redirect('dashboard');
		}
		$this->load->model('siswa');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'create':
				$this->form_validation->set_rules('nisn', 'NISN', 'required|trim|is_unique[siswa.nisn]');
				$this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[siswa.nis]');
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
				$data['siswa'] = $this->siswa->findWithFkList($config["per_page"], 
									$data['page']);           
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_siswa/index', $data);
				$this->load->view('dashboard/v_footer');
			break;
		}
	}

	public function petugas()
	{
		if($this->role != 'admin'){
			redirect('dashboard');
		}
		$this->load->model('petugas');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'create':
				$this->form_validation->set_rules('id_petugas', 'ID Petugas', 'required|trim|is_unique[petugas.id_petugas]');
				$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[petugas.username]');
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
				$this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim');
				$this->form_validation->set_rules('level', 'Level', 'required|trim');

				if($this->form_validation->run() == false){
					$key = $this->input->get('key');
					$data = $this->petugas->findOne($key);
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_petugas/update', $data);
					$this->load->view('dashboard/v_footer');
				}else{
					$updateData = [
						'nama_petugas' => $this->input->post('nama_petugas'),
						'level' => $this->input->post('level'),
					];
					$this->petugas->update($this->input->get('key'), $updateData);
					redirect('dashboard/petugas');
				}
			break;
			case 'delete':
				$key = $this->input->get('key');
				if(!($this->session->userdata('user') == $this->petugas->findOne($key)['username'])){
					$this->petugas->delete($key);
					redirect('dashboard/petugas');
				}else{
					$this->petugas->delete($key);
					$this->session->unset_userdata('user');
					redirect('auth');
				}
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

	public function kelas()
	{
		if($this->role != 'admin'){
			redirect('dashboard');
		}
		$this->load->model('kelas');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'create':
				$this->form_validation->set_rules('id_kelas', 'ID kelas', 'required|trim|is_unique[kelas.id_kelas]');
				$this->form_validation->set_rules('nama_kelas', 'Nama kelas', 'required|trim|is_unique[kelas.nama_kelas]');
				$this->form_validation->set_rules('kompetensi_keahlian', 'Kompetensi Keahlian', 'required|trim');

				if($this->form_validation->run() == false){
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_kelas/create');
					$this->load->view('dashboard/v_footer');
				}else{
					$insertData = [
						'id_kelas' => $this->input->post('id_kelas'),
						'nama_kelas' => $this->input->post('nama_kelas'),
						'kompetensi_keahlian' => $this->input->post('kompetensi_keahlian')
					];
					$this->kelas->insert($insertData);
					redirect('dashboard/kelas');
				}
			break;
			case 'update':
				$this->form_validation->set_rules('kompetensi_keahlian', 'Kompetensi Keahlian', 'required|trim');

				if($this->form_validation->run() == false){
					$key = $this->input->get('key');
					$data = $this->kelas->findOne($key);
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_kelas/update', $data);
					$this->load->view('dashboard/v_footer');
				}else{
					$updateData = [
						'kompetensi_keahlian' => $this->input->post('kompetensi_keahlian')
					];
					$this->kelas->update($this->input->get('key'), $updateData);
					redirect('dashboard/kelas');
				}
			break;
			case 'delete':
				$key = $this->input->get('key');
				$this->kelas->delete($key);
				redirect('dashboard/kelas');
			break;
			default:
				//konfigurasi pagination
				$config['base_url'] = site_url('dashboard/kelas/index'); //site url
				$config['total_rows'] = $this->db->count_all('kelas'); //total row
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
				$data['kelas'] = $this->kelas->findList($config["per_page"], $data['page']);           
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_kelas/index', $data);
				$this->load->view('dashboard/v_footer');
			break;
		}

	}

	public function spp()
	{
		if($this->role != 'admin'){
			redirect('dashboard');
		}
		$this->load->model('spp');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'create':
				$this->form_validation->set_rules('id_spp', 'ID SPP', 'required|trim|is_unique[spp.id_spp]');
				$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim|integer|is_unique[spp.tahun]');
				$this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|integer');

				if($this->form_validation->run() == false){
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_spp/create');
					$this->load->view('dashboard/v_footer');
				}else{
					$insertData = [
						'id_spp' => $this->input->post('id_spp'),
						'tahun' => $this->input->post('tahun'),
						'nominal' => $this->input->post('nominal')
					];
					$this->spp->insert($insertData);
					redirect('dashboard/spp');
				}
			break;
			case 'update':
				$this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|integer');

				if($this->form_validation->run() == false){
					$key = $this->input->get('key');
					$data = $this->spp->findOne($key);
					$data['password'] = '';
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_spp/update', $data);
					$this->load->view('dashboard/v_footer');
				}else{
					$updateData = [
						'nominal' => $this->input->post('nominal')
					];
					$this->spp->update($this->input->get('key'), $updateData);
					redirect('dashboard/spp');
				}
			break;
			case 'delete':
				$key = $this->input->get('key');
				$this->spp->delete($key);
				redirect('dashboard/spp');
			break;
			default:
				//konfigurasi pagination
				$config['base_url'] = site_url('dashboard/spp/index'); //site url
				$config['total_rows'] = $this->db->count_all('spp'); //total row
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
				$data['spp'] = $this->spp->findList($config["per_page"], $data['page']);           
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_spp/index', $data);
				$this->load->view('dashboard/v_footer');
			break;
		}

	}

	public function pembayaran()
	{
		$this->load->model('pembayaran');
		$this->load->model('spp');
		$current_url = $this->uri->segments[count($this->uri->segments)];
		switch($current_url){
			case 'transaksi':

				if($this->role == 'siswa'){
					redirect('dashboard/pembayaran');
				}

				$this->form_validation->set_rules('id_pembayaran', 'ID Pembayaran', 
				'required|trim|is_unique[pembayaran.id_pembayaran]');
				$this->form_validation->set_rules('id_petugas', 'Petugas', 'required|trim');
				$this->form_validation->set_rules('nisn', 'NISN', 'required|trim');
				$this->form_validation->set_rules('tgl_bayar', 'Tanggal Bayar', 
				'required|trim');
				$this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|trim|integer');

				if($this->form_validation->run() == false){
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_pembayaran/transaksi');
					$this->load->view('dashboard/v_footer');
				}else{

					$daftarBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
					$tanggal = $this->input->post('tgl_bayar');
					$indexBulan = intval((new DateTime($tanggal))->format('m'));
					$tahun = (new DateTime($tanggal))->format('Y');
					$bulan = $daftarBulan[$indexBulan-1];
					$id_spp = $this->input->post('id_spp');
					$jumlah_bayar = $this->input->post('jumlah_bayar');
					$nominal = +$this->spp->findOne($id_spp)['nominal'];
					if($jumlah_bayar >= $nominal){
						$data = [
							'id_pembayaran' => $this->input->post('id_pembayaran'),
							'id_petugas' => $this->input->post('id_petugas'),
							'nisn' => $this->input->post('nisn'),
							'tgl_bayar' => $tanggal,
							'bulan_dibayar' => $bulan,
							'tahun_dibayar' => $tahun,
							'id_spp' => $id_spp,
							'jumlah_bayar' => $jumlah_bayar,
						];
						
						$this->pembayaran->insert($data);
						redirect('dashboard/pembayaran/index');
					}else{
						$this->session->set_flashdata('message', '<div class="left red white-text" style="padding: 3px 5px">Jumlah Bayar tidak boleh kurang dari '.$nominal.'</div>');
						redirect('dashboard/pembayaran/transaksi');
					}
				}

			break;
			default:
				if($this->role == 'siswa'){
					$data['history'] = $this->pembayaran->findWithFkSiswa($this->user);
				}else if($this->role == 'petugas'){
					$data['history'] = $this->pembayaran->findWithFkPetugas($this->user);
				}else{
					$data['history'] = $this->pembayaran->findWithFk();
				}
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_pembayaran/history', $data);
				$this->load->view('dashboard/v_footer');
			break;
		}
	}
}
