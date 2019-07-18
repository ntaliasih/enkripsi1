<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	function __construct() {
		parent::__construct();

		if ($this->session->userdata('user_id')) {
            $this->load->model('Download_model');
		} else {
			redirect('login', 'refresh');
		}
	}

	function index() {
		$data['title'] = "Aplikasi Enkripsi RC4 dan Base64 PT Infokes";
		$data['js_to_load'] = "download.js";
        $data['message'] = "";
        $data['error_id'] = 99;
        $data['count_request'] = $this->Download_model->count_request();
        
        if ($this->session->userdata('role_id') == 1) {
            $data['download'] = $this->Download_model->get_list_all_download();
        } else {
            $data['download'] = $this->Download_model->get_list_download_peruser($this->session->userdata('user_id'));
        }

		$this->load->view('download', $data);
    }

	function do_download() {
        $this->load->library('rc4');
        $this->load->library('base64');
        $this->load->helper('download');

        $this->form_validation->set_rules('secretkey','Secret Key','required');

        if ($this->form_validation->run() != false) {
			$kdRequest = $this->input->post('kdRequest', TRUE);
            $secretkey = $this->input->post('secretkey', TRUE);

            $dataDownload = $this->Download_model->get_data_download($kdRequest);

            foreach($dataDownload as $item) {
                if (base64_encode($item['secret_key']) == $secretkey) {
                    $thisFile = $item['path'] . $item['filename'];

                    if (pathinfo($item['filename'], PATHINFO_EXTENSION) == 'Ifk') {
                        $file_to_decrypt = file_get_contents($thisFile);

                        if (base64::isValid($file_to_decrypt, true)) {
                            list($tf, $tfe) = explode('|', $file_to_decrypt );

                            if (!empty($tf)) {
                                $bf = $this->base64->decode(trim($tf));
                                $ef = $this->rc4->rc4enc($item['secret_key'], $bf);
                                
                                $filename = pathinfo($item['filename'], PATHINFO_FILENAME) . '.' .$this->base64->decode($tfe);
                                
                                file_put_contents($item['path'] . $filename, $ef);

                                $data['message'] = "Data berhasil diunduh.";
                                $data['url'] = site_url($item['path'] . $filename);
                                $data['file'] = $filename;
                                $data['error_id'] = 0;

                                echo json_encode($data);
                            }
                        }
                        else {
                            $data['message'] = "Tidak dapat membuka file enkripsi.";
                            $data['error_id'] = 1;

                            echo json_encode($data);
                        }
                    } else {
                        $data['message'] = "Tidak dapat membuka file enkripsi.";
                        $data['error_id'] = 1;

                        echo json_encode($data);
                    }
                } else {
                    $data['message'] = "Key yang Anda masukkan salah.";
			        $data['error_id'] = 1;

			        echo json_encode($data);
                }
            }
        } else {
			$data['message'] = "Data tidak boleh kosong.";
			$data['error_id'] = 2;

			echo json_encode($data);
		}
    }
}
