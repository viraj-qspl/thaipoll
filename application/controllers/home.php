<?php

class Home extends CI_Controller { 
//Class names must have the first letter capitalized with the rest of the name lowercase. The filename will be a lower case version of your class name.

	function __construct() 
    {
    	// Call to Controller constructor
        parent::__construct(); 
		
		$this->load->library('session');
		$this->load->helper('url');		
		
		//Define array that will store values to be sent to view page
		$passArg = array();	
	}
	
	function index()
	{
		$passArg['viewPage'] = "home";
		$this->load->view('layout', $passArg);		
	}
	
	function login()
	{	
	
		$this->load->model('login_model');
		$resArr = $this->login_model->loginCheck();
		
 		if(count($resArr)>0)
		{ 
			//echo "login correct"; exit;
			// Login Correct
			$this->session->sess_create();
			foreach ($resArr as $row)
			{
				$sessArr= array(
						   'user_id'  	=> $row->id,				
						   'email'     	=> $row->email,
						   'first_name' => $row->first_name,
						   'last_name'  => $row->last_name,
						   'user_type'  => "user"
						);
				$this->session->set_userdata($sessArr);
				redirect($this->config->item('userHomeAction'), 'refresh');
			}
		}else
		{ 
			//echo "login in-correct"; exit;
			// Login In-correct
			$passArg['viewPage'] = "home";
			$passArg['errorMsg']  = "Invalid login. Please try again.";
			$this->load->view('layout',$passArg);
			$this->session->sess_destroy();			
		} 
	}	

	function signup()
	{
		$this->load->model('user_model');
		$ins_flag = $this->user_model->add_user();	
		if($ins_flag === 1){
			$this->login();
		}else {
			$this->index();
		}
		
	}		
	
}
