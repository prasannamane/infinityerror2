<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmodel extends CI_model {

	public function check_login_details($email,$pwd)
	{
		$query = $this->db->select('*')
		         ->from('users')
		         ->where(array("email"=>$email, "password"=>$pwd))
		         ->get();

		return $query->row();
	}


	public function check_login($email)
	{
		$query = $this->db->select('*')
		         ->from('admin')
		         ->where(array("admin_email"=>$email))
		         ->get();

		return $query->row();
	}


}
?>
