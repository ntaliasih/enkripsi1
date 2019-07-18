<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
	function __construct() {
		parent::__construct();

		if ($this->session->userdata('user_id') && $this->session->userdata('role_id') == 2) {
            $this->load->model('Request_model');
		} else {
			redirect('login', 'refresh');
		}
	}

	function index() {
		$data['title'] = "Aplikasi Enkripsi RC4 dan Base64 PT Infokes";
		$data['js_to_load'] = "request.js";
        $data['message'] = "";
        $data['error_id'] = 99;
        
        $data['kdRequest'] = $this->get_id();
        $data['noPermintaan'] = 'REQ/' . date('Ymd') . '/IFK/' . rand(100000, 999999);

		$this->load->view('request', $data);
    }
    
    function do_tambah() {
		$this->form_validation->set_rules('secretkey','Secret Key','trim|required|min_length[8]');
		
		if ($this->form_validation->run() != false) {
            $kdRequest = $this->input->post('kdRequest', TRUE);
            $noPermintaan = $this->input->post('noPermintaan', TRUE);
            $tglPermintaan = (int)date("Ymd");
            $kdUser = $this->session->userdata('user_id');
            $secretkey = $this->input->post('secretkey', TRUE);
            $cipherkey = base64_encode($secretkey);

            $dataUser = $this->Request_model->get_data_user($kdUser);
            
            $data = array(
                'request_id'        => $kdRequest,
                'no_permintaan'     => $noPermintaan,
                'tgl_permintaan'    => $tglPermintaan,
                'user_id'           => $kdUser,
                'secret_key'        => $secretkey,
                'status'            => 0
            );

            if (!$this->Request_model->insert_data($data, 'tb_request')) {
                $data['message'] = "Permintaan database telah berhasil dilakukan. Silakan cek email Anda.";
                $data['error_id'] = 0;

                require 'vendor/autoload.php';
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->Username = "ddi.infokes@gmail.com";
                $mail->Password = "DDI12345";
                $mail->SetFrom('ddi.infokes@gmail.com', 'Divisi Data & Infrastruktur PT Infokes');
                $mail->isHTML(true);
                $mail->Subject    = "Permintaan Database";

                $message = '<html><body>';
                $message .= " Anda telah melakukan permintaan database dengan rincian: <br><br>";
                $message .= " Nomor Permintaan : ".strip_tags($noPermintaan)."<br>";
                $message .= " Username : ".strip_tags($dataUser->username)."<br>";
                $message .= " Layanan : ".strip_tags($dataUser->layanan)."<br>";
                $message .= " Kab/Kota : ".strip_tags($dataUser->kab_kota)."<br>";
                $message .= " Kantor Wilayah : ".strip_tags($dataUser->kantor_wilayah)."<br><br>";
                $message .= " Permintaan anda dapat diunduh di enkripsi.infokes.id. Gunakan key: <b>$cipherkey</b><br>";
                $message .= " Maksimal database akan tersedia  1x24 jam setelah adanya permintaan. <br><br>";
                $message .= " Terima kasih. <br><br>";
                $message .= "</body></html>";

                $mail->Body = $message;
                
                $mail->AddAddress($dataUser->email);

                $mail->Send();

                echo json_encode($data);
            } else {
                $data['message'] = "Terjadi kesalahan saat melakukan request data.";
                $data['error_id'] = 1;

                echo json_encode($data);
            }
		} else {
			$data['message'] = "Data tidak boleh kosong ataupun kurang dari 8 karakter.";
			$data['error_id'] = 2;

			echo json_encode($data);
		}
    }

    public function get_id() {
		$data = $this->Request_model->get_max_id('tb_request', 'request_id');

		if (!isset($data) || $data == null) {
			$data = new \stdClass();
			$data->request_id = 0;
		}
		
		return $data;
	}
}
