<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();

		if ($this->session->userdata('user_id') && $this->session->userdata('role_id') == 1) {
            $this->load->model('User_model');
		} else {
			redirect('login', 'refresh');
		}
	}

	function index() {
		$data['title'] = "Aplikasi Enkripsi RC4 dan Base64 PT Infokes";
		$data['js_to_load'] = "user.js";
        $data['message'] = "";
        $data['error_id'] = 99;
        $data['count_request'] = $this->User_model->count_request();
        
        $data['user'] = $this->User_model->get_list_all_user();
        $data['get_role'] = $this->User_model->get_fieldname('tb_role');
        $data['get_layanan'] = $this->User_model->get_fieldname('tb_layanan');

		$this->load->view('user', $data);
    }
    
    function do_tambah() {
		$this->form_validation->set_rules('kdUser','Kode User','required');
		$this->form_validation->set_rules('username','Username','required|alpha_numeric');
		$this->form_validation->set_rules('nama','Nama','required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('layanan','Layanan','required');
        $this->form_validation->set_rules('kabkota','Kab/Kota','required|alpha_numeric_spaces');
        $this->form_validation->set_rules('kantorwilayah','Kantor Wilayah','required|alpha_numeric_spaces');
		$this->form_validation->set_rules('role','Role','required');

		if ($this->form_validation->run() != false) {
			$kdUser = $this->input->post('kdUser', TRUE);
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $nama = $this->input->post('nama', TRUE);
            $email = $this->input->post('email', TRUE);
            $layanan = $this->input->post('layanan', TRUE);
            $kabkota = $this->input->post('kabkota', TRUE);
            $kantorwilayah = $this->input->post('kantorwilayah', TRUE);
            $role = $this->input->post('role', TRUE);
            $foto = './assets/img/' . $_FILES['foto']['name'];

            $config['upload_path'] = "./assets/img/";
            $config['file_name'] = $_FILES['foto']['name'];
            $config['allowed_types'] = "jpg|png|jpeg";
            $config['overwrite'] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $foto = './assets/img/default.png';

                $data = array(
                    'user_id'           => $kdUser,
                    'username'          => $username,
                    'password'          => md5($password),
                    'nama'              => $nama,
                    'email'             => $email,
                    'layanan_id'        => $layanan,
                    'kab_kota'          => $kabkota,
                    'kantor_wilayah'    => $kantorwilayah,
                    'role_id'           => $role,
                    'foto'              => $foto
                );

                if (!$this->User_model->insert_data($data, 'tb_user')) {
                    $data['message'] = "Data telah berhasil ditambahkan.";
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
                    $mail->Subject    = "Konfirmasi Enkripsi";

                    $message = '<html><body>';
                    $message .= " Untuk melakukan permintaan database, silakan login ke https://enkripsi.infokes.id <br><br>";
                    $message .= " Username : ".strip_tags($username)."<br>";
                    $message .= " Password : ".strip_tags($password)."<br><br>";
                    $message .= " Setelah login, pilih menu REQUEST, lalu masukkan secret key pada kolom yang disediakan. Cek kotak masuk pada email Anda untuk instruksi berikutnya.<br><br>";
                    $message .= " Terima kasih. <br><br>";
                    $message .= "</body></html>";

                    $mail->Body = $message;
                    
                    $mail->AddAddress($email);

                    $mail->Send();

                    echo json_encode($data);
                } else {
                    $data['message'] = "Terjadi kesalahan saat menambahkan data.";
                    $data['error_id'] = 1;

                    echo json_encode($data);
                }
            } else {
                $data = array(
                    'user_id'           => $kdUser,
                    'username'          => $username,
                    'password'          => $password,
                    'nama'              => $nama,
                    'email'             => $email,
                    'layanan_id'        => $layanan,
                    'kab_kota'          => $kabkota,
                    'kantor_wilayah'    => $kantorwilayah,
                    'role_id'           => $role,
                    'foto'              => $foto
                );

                if (!$this->User_model->insert_data($data, 'tb_user')) {
                    $data['message'] = "Data telah berhasil ditambahkan.";
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
                    $mail->Subject    = "Konfirmasi Enkripsi";

                    $message = '<html><body>';
                    $message .= " Untuk melakukan permintaan database, silakan login ke https://enkripsi.infokes.id <br><br>";
                    $message .= " Username : ".strip_tags($username)."<br>";
                    $message .= " Password : ".strip_tags($password)."<br><br>";
                    $message .= " Disarankan untuk terlebih dahulu melakukan pengubahan password. <br><br>";
                    $message .= " Terima kasih. <br><br>";
                    $message .= "</body></html>";

                    $mail->Body = $message;
                    
                    $mail->AddAddress($email);

                    $mail->Send();

                    echo json_encode($data);
                } else {
                    $data['message'] = "Terjadi kesalahan saat menambahkan data.";
                    $data['error_id'] = 1;

                    echo json_encode($data);
                }
            }
		} else {
			$data['message'] = "Data tidak boleh kosong. Pastikan Anda memasukkan data sesuai format.";
			$data['error_id'] = 2;

			echo json_encode($data);
		}
    }

	public function do_edit() {
		$this->form_validation->set_rules('kdUser','Kode User','required');
		$this->form_validation->set_rules('username','Username','required|alpha_numeric');
		$this->form_validation->set_rules('nama','Nama','required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('layanan','Layanan','required');
        $this->form_validation->set_rules('kabkota','Kab/Kota','required|alpha_numeric_spaces');
        $this->form_validation->set_rules('kantorwilayah','Kantor Wilayah','required|alpha_numeric_spaces');
		$this->form_validation->set_rules('role','Role','required');

		if ($this->form_validation->run() != false) {
			$kdUser = $this->input->post('kdUser', TRUE);
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $nama = $this->input->post('nama', TRUE);
            $email = $this->input->post('email', TRUE);
            $layanan = $this->input->post('layanan', TRUE);
            $kabkota = $this->input->post('kabkota', TRUE);
            $kantorwilayah = $this->input->post('kantorwilayah', TRUE);
            $role = $this->input->post('role', TRUE);
            $foto = './assets/img/' . $_FILES['foto']['name'];

            $config['upload_path'] = "./assets/img/";
            $config['file_name'] = $_FILES['foto']['name'];
            $config['allowed_types'] = "jpg|png|jpeg";
            $config['overwrite'] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $foto = './assets/img/default.png';

                $data = array(
                    'user_id'           => $kdUser,
                    'username'          => $username,
                    'password'          => $password,
                    'nama'              => $nama,
                    'email'             => $email,
                    'layanan_id'        => $layanan,
                    'kab_kota'          => $kabkota,
                    'kantor_wilayah'    => $kantorwilayah,
                    'role_id'           => $role,
                    'foto'              => $foto
                );

                if ($this->User_model->update_data(array('user_id' => $kdUser), $data, 'tb_user')) {
                    $data['message'] = "Data telah berhasil diubah.";
                    $data['error_id'] = 0;
    
                    echo json_encode($data);
                } else {
                    $data['message'] = "Terjadi kesalahan saat mengubah data.";
                    $data['error_id'] = 1;
    
                    echo json_encode($data);
                }
            } else {
                $data = array(
                    'user_id'           => $kdUser,
                    'username'          => $username,
                    'password'          => $password,
                    'nama'              => $nama,
                    'email'             => $email,
                    'layanan_id'        => $layanan,
                    'kab_kota'          => $kabkota,
                    'kantor_wilayah'    => $kantorwilayah,
                    'role_id'           => $role,
                    'foto'              => $foto
                );

                if ($this->User_model->update_data(array('user_id' => $kdUser), $data, 'tb_user')) {
                    $data['message'] = "Data telah berhasil diubah.";
                    $data['error_id'] = 0;
    
                    echo json_encode($data);
                } else {
                    $data['message'] = "Terjadi kesalahan saat mengubah data.";
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

	public function do_hapus($id) {
        if (!$this->User_model->delete_data('tb_user', 'user_id', $id)) {
            $data['message'] = "Data telah berhasil dihapus.";
            $data['error_id'] = 0;

            echo json_encode($data);
        } else {
            $data['message'] = "Terjadi kesalahan saat menghapus data.";
            $data['error_id'] = 1;

            echo json_encode($data);
        }
	}

	public function ajax_edit($id) {
		$data = $this->User_model->get_by_id($id);

		echo json_encode($data);
	}

	public function get_id() {
		$data = $this->User_model->get_max_id('tb_user', 'user_id');

		if (!isset($data) || $data == null) {
			$data = new \stdClass();
			$data->user_id = 0;
		}
		
		echo json_encode($data);
	}
}
