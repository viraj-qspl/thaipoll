<?php

class User_home extends CI_Controller {

	function __construct() 
    {
        parent::__construct();   
			
		//Define array that will store values to be sent to view page
		$passArg = array();	
	}
	
	function index()
	{
 		$passArg['viewPage'] = "user_home";
		$this->load->view('layout', $passArg);	 
		
		//echo "Welcome to our site!";
	}
	
		
	
}
