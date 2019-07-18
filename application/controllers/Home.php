<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();

		if ($this->session->userdata('user_id')) {
			$this->load->model('Home_model');
		} else {
			redirect('login', 'refresh');
		}
	}

	function index() {
		$data['title'] = "Aplikasi Enkripsi RC4 dan Base64 PT Infokes";
		$data['js_to_load'] = "home.js";
		$data['pesan'] = "";
		$data['count_request'] = $this->Home_model->count_request();
		$data['home'] = $this->Home_model->get_list_all_home();

		if ($this->session->userdata('role_id') == 1) {
			$this->load->view('home', $data);
		} else {
			$this->load->view('home_client', $data);
		}
	}
}
