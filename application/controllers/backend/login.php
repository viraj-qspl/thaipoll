<?php

class Login extends CI_Controller { 
//Class names must have the first letter capitalized with the rest of the name lowercase. The filename will be a lower case version of your class name.

    public function __construct() //default constructor
    {
        parent::__construct(); //call to default constructor of CI_Controller
		$this->load->helper('url');		
		$this->load->library('session');		
		$this->load->library('common_method'); //user defined class					
		
		$this->load->model('login_model'); //frontend model is used for validation	
		
		//Define array that will store values to be sent to view page
		$passArg = array();	    		
    }

    function index()
	{			
		$passArg['viewPage'] = "login";
		$this->load->view('backend/layout', $passArg);		
	}
	
	
 	function loginCheck()
	{		
		
		$resArr = $this->login_model->loginCheck();
		
 		if(count($resArr)>0){ // Login Correct
			
			foreach ($resArr as $row){
				$sessArr= array(
						   'userId'  	=> $row->id,	
						   'userType'   => $row->user_type,							   
						   'email'     	=> $row->email,
						   'firstName' => $row->first_name,
						   'lastName'  => $row->last_name
							);
				$this->session->set_userdata($sessArr);
				redirect($this->config->item('dashboardBeAction'), 'refresh');
			}
		}else{ // Login In-correct
			$passArg['viewPage']	= "login";
			$passArg['errorMsg']	= $this->config->item('beInvalidLogin','messages');
			$this->load->view('backend/layout',$passArg);
			$this->session->sess_destroy();			
		} 
	}	

	function logout(){
		$this->session->sess_destroy();
		redirect($this->config->item('loginBeAction'), 'refresh');
	}	
		
	
}
