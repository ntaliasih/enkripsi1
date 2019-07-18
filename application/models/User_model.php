<?php
class User_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function get_list_all_user() {
        $sql = "select a.user_id, a.username, a.password, a.nama, a.email, a.layanan_id, c.layanan, a.kab_kota, a.kantor_wilayah, a.role_id, b.role, a.foto 
        from tb_user a
		inner join tb_role b on a.role_id = b.role_id
		inner join tb_layanan c on a.layanan_id = c.layanan_id";
		$query = $this->db->query($sql);

        return $query->result_array();
    }

    function insert_data($data, $table) {
		$this->db->insert($table, $data);
	}

    function update_data($where, $data, $table) {
	    $this->db->update($table, $data, $where);
		return $this->db->affected_rows();
    }
    
    public function delete_data($table, $field, $id) {
		$this->db->where($field, $id);
		$this->db->delete($table);
	}

    public function get_max_id($table, $field) {
		$this->db->select($field);
		$this->db->from($table);
		$this->db->order_by($field, 'desc');
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row();
    }

	public function get_by_id($id) {
		$sql = "select a.user_id, a.username, a.password, a.nama, a.email, a.layanan_id, c.layanan, a.kab_kota, a.kantor_wilayah, a.role_id, b.role, a.foto 
        from tb_user a
		inner join tb_role b on a.role_id = b.role_id
		inner join tb_layanan c on a.layanan_id = c.layanan_id
        where user_id = ?";

		$query = $this->db->query($sql, $id);
		return $query->row();
	}

	public function get_fieldname($table) {
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();

		return $query->result_array();
	}

	function count_request() {
        $countRow = $this->db->where(['status'=> 0])->from("tb_request")->count_all_results();

        return $countRow;
    }
}
