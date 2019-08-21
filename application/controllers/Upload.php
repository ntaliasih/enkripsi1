<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	function __construct() {
		parent::__construct();

		if ($this->session->userdata('user_id') && $this->session->userdata('role_id') == 1) {
            $this->load->model('Upload_model');
		} else {
			redirect('login', 'refresh');
		}
	}

	function index() {
		$data['title'] = "Aplikasi Enkripsi RC4 dan Base64 PT Infokes";
		$data['js_to_load'] = "upload.js";
        $data['message'] = "";
        $data['error_id'] = 99;
        $data['count_request'] = $this->Upload_model->count_request();

        $data['upload'] = $this->Upload_model->get_list_all_upload();
        $data['get_role'] = $this->Upload_model->get_fieldname('tb_role');
        $data['get_layanan'] = $this->Upload_model->get_fieldname('tb_layanan');

		$this->load->view('upload', $data);
		
    }

	public function do_upload() {
		$config['allowed_types'] = 'sql|gz';
        $config['upload_path'] = './uploads/file/';

		$this->load->library('upload', $config);
        $this->upload->initialize($config);
		
        $this->load->library('rc4');
        $this->load->library('base64');
		
        $this->form_validation->set_rules('kdUpload', 'Kode Upload', 'required');
	
        if ($this->upload->do_upload('database')){
            if ($this->form_validation->run() != false) {

                $kdUpload = $this->input->post('kdUpload', TRUE);
                $secretkey = $this->input->post('secretkey', TRUE);
                $path = './uploads/db/';

                if (!empty($_FILES['database']) && !empty($_FILES['database']['name'])) {
                    $file_to_encrypt = file_get_contents($_FILES['database']['tmp_name']);
                    $file_rc4 = $this->rc4->rc4enc($secretkey, $file_to_encrypt);

                    $file_rc4_base64 = $this->base64->encode($file_rc4);

                    $filename = pathinfo($_FILES['database']['name'], PATHINFO_FILENAME) . '.Ifk';
                    $content = $file_rc4_base64 . '|' . $this->base64->encode(pathinfo($_FILES['database']['name'], PATHINFO_EXTENSION));

                    file_put_contents($path . $filename, $content);

                    $data = array(
                        'path'       => $path,
                        'filename'   => $filename,
                        'status'     => 1
                    );

                    if ($this->Upload_model->update_data(array('request_id' => $kdUpload), $data, 'tb_request')) {
                        $data['message'] = "Data berhasil diunggah.";
                        $data['error_id'] = 0;

                        echo json_encode($data);
                    } else {
                        $data['message'] = "Terjadi kesalahan saat mengunggah data.";
                        $data['error_id'] = 1;

                        echo json_encode($data);
                    }
                } else {
                    $data['message'] = "Data tidak boleh kosong.";
                    $data['error_id'] = 2;

                    echo json_encode($data);
                }
            } else {
                $data['message'] = "Data tidak boleh kosong.";
                $data['error_id'] = 2;

                echo json_encode($data);
            }
        } else {
            $error = array('error' => $this->upload->display_errors());

            $data['error_id'] = 1;
            $data['message'] = $error['error'];

            echo json_encode($data);
        }
	}
	public function ajax_edit($id) {
		$data = $this->Upload_model->get_by_id($id);

		echo json_encode($data);
	}
}
