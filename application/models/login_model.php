<?php

class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->config->load('dbtables', TRUE);
	}
	
	function loginCheck()
	{		
		$email = $this->input->post('email');
		$pw    = $this->input->post('password');		
		
		$query  = " SELECT id, user_type, email, first_name, last_name ";
		$query .= " FROM " . $this->config->item('tbl_user','dbtables');
		$query .= " WHERE email = ? and password = ? ";
		$dataBindArr = array($email, md5($pw));
				
		$res   = $this->db->query($query, $dataBindArr);
		$resArr = $res->result();	
		
		return $resArr;
	}
	
		
}	
	