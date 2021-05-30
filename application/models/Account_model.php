<?php 

class Account_model extends CI_Model{
	public function login($username,$password,$table)
	{
		return $this->db->query("SELECT * FROM $table WHERE username = '$username' AND password = '$password'")->result();
	}

	public function register($table,$data)
	{
		$this->db->insert($table,$data);
	}
}

 ?>