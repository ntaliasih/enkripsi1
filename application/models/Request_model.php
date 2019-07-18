<?php
class Request_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function insert_data($data, $table) {
		$this->db->insert($table, $data);
	}

    function get_data_user($id) {
        $sql = "select a.*, b.layanan from tb_user a 
        inner join tb_layanan b on a.layanan_id = b.layanan_id 
        where a.user_id = ?";
		$query = $this->db->query($sql, $id);

        return $query->row();
    }

    public function get_max_id($table, $field) {
		$this->db->select($field);
		$this->db->from($table);
		$this->db->order_by($field, 'desc');
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row();
    }
}
