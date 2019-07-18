<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
	}

	function index() {
		$data['title'] = "Aplikasi Enkripsi RC4 dan Base64 PT Infokes";
		$data['js_to_load'] = "login.js";
		$data['pesan'] = "";

		$this->load->view('login', $data);
	}

	public function auth() {
		# Need to filled with something
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run() != false) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$pesan = "";
			$data_login = $this->Login_model->get_login($username, md5($password));

			if (sizeof($data_login) > 0) {
				$user_id 	    = $data_login[0]['user_id'];
				$username 		= $data_login[0]['username'];
				$email 			= $data_login[0]['email'];
				$nama 			= $data_login[0]['nama'];
				$role_id 		= $data_login[0]['role_id'];
				$role 			= $data_login[0]['role'];
				$foto 			= $data_login[0]['foto'];

				$sessdata = array(
					'user_id' 		=> $user_id,
					'username' 		=> $username,
					'email' 		=> $email,
					'nama' 			=> $nama,
					'role_id' 		=> $role_id,
					'role' 			=> $role,
					'foto' 			=> $foto
				);

				$this->session->set_userdata($sessdata);
				
				redirect(site_url('home'));
			} else {
				$pesan = "Username atau Password yang Anda masukkan salah!";
				$data['js_to_load'] = "login.js";
			}
		} else {
			$pesan = "Username / Password masih kosong.";
		}

		$data['pesan'] = $pesan;
		$this->load->view('login', $data);
	}

    public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}
