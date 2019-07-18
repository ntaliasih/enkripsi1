<?php
class Home_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function get_list_all_home() {
        $sql = "select a.request_id, a.no_permintaan, a.tgl_permintaan, a.user_id, b.username, b.layanan_id, c.layanan, b.kab_kota, b.kantor_wilayah, a.secret_key, a.status
        from tb_request a
        inner join tb_user b on a.user_id = b.user_id
        inner join tb_layanan c on b.layanan_id = c.layanan_id
        where a.status = 0";
		$query = $this->db->query($sql);

        return $query->result_array();
    }

    function count_request() {
        $countRow = $this->db->where(['status'=> 0])->from("tb_request")->count_all_results();

        return $countRow;
    }
}
