<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->load->model('Dashboard_model', 'dashboard');
		$this->user = $this->ion_auth->user()->row();
	}

	public function admin_box()
	{
		$box = [
			[
				'box' 		=> 'light-blue-active',
				'total' 	=> $this->dashboard->total('jurusan'),
				'title'		=> 'Jurusan',
				'icon'		=> 'graduation-cap'
			],
			[
				'box' 		=> 'olive-active',
				'total' 	=> $this->dashboard->total('matkul'),
				'title'		=> 'Mata Pelajaran',
				'icon'		=> 'list'
			],
			[
				'box' 		=> 'blue-active',
				'total' 	=> $this->dashboard->total('mahasiswa'),
				'title'		=> 'Mahasiswa',
				'icon'		=> 'user'
			],
			[
				'box' 		=> 'yellow',
				'total' 	=> $this->dashboard->total('tb_soal'),
				'title'		=> 'Latihan Soal',
				'icon'		=> 'tasks'
			],
		];
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}

	public function index()
	{
		$user = $this->user;
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Dashboard',
			'subjudul'	=> 'Data Aplikasi',
		];

		if ( $this->ion_auth->is_admin() ) {
			$data['info_box'] = $this->admin_box();
		}else{
			$join = [
				'jurusan c'	=> 'a.jurusan_id = c.id_jurusan'
			];
			$data['mahasiswa'] = $this->dashboard->get_where('mahasiswa a', 'nim', $user->username, $join)->row();
		}

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('dashboard');
		$this->load->view('_templates/dashboard/_footer.php');
	}
}