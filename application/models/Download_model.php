<?php
class Download_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function get_list_all_download() {
        $sql = "select a.request_id, a.no_permintaan, a.tgl_permintaan, a.user_id, b.username, b.layanan_id, c.layanan, b.kab_kota, b.kantor_wilayah, a.secret_key, a.path, a.filename, a.status
        from tb_request a
        inner join tb_user b on a.user_id = b.user_id
        inner join tb_layanan c on b.layanan_id = c.layanan_id
        where a.status = 1";
		$query = $this->db->query($sql);

        return $query->result_array();
    }

    function get_list_download_peruser($id) {
        $sql = "select a.request_id, a.no_permintaan, a.tgl_permintaan, a.user_id, b.username, b.layanan_id, c.layanan, b.kab_kota, b.kantor_wilayah, a.secret_key, a.path, a.filename, a.status
        from tb_request a
        inner join tb_user b on a.user_id = b.user_id
        inner join tb_layanan c on b.layanan_id = c.layanan_id
        where a.status = 1 and a.user_id = ?";
		$query = $this->db->query($sql, $id);

        return $query->result_array();
    }

    function get_data_download($id) {
        $sql = "select * from tb_request a where a.status = 1 and a.request_id = ?";
		$query = $this->db->query($sql, $id);

        return $query->result_array();
    }
    
    function count_request() {
        $countRow = $this->db->where(['status'=> 0])->from("tb_request")->count_all_results();

        return $countRow;
    }
}
