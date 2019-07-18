<?php
class Login_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function get_login($username, $password) {
        $sql = "select a.*, b.role from tb_user a 
                inner join tb_role b on a.role_id = b.role_id
                where a.username = ? and a.password = ?";
		$query = $this->db->query($sql, array($username, $password));

        return $query->result_array();
    }
}
