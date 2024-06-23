<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		$this->load->database();
    }

    public function insert_user($data) {
        // Insert data into 'users' table
        $this->db->insert('users', $data);
        // Return the ID of the inserted record
        return $this->db->insert_id();
    }

	public function get_user_list() {
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $query;
	}

	public function get_user($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query;
	}
	
	public function update_by_user_id($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update('users');
	}
	
	public function delete_user($id) {
		$id_arr = explode(',', $id);
		for($i = 0; $i < count($id_arr); $i++) {
			$this->db->where('id', $id_arr[$i]);
			$this->db->delete('users');
		}
		return true;
	}
}
?>
