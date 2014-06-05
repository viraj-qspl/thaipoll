<?php

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		//Load all required classes		
		$this->load->library('common_method'); //user defined class

		//Check for admin login, this function will automatically redirect to admin login page
		$this->common_method->adminAuthentication();
				
		//Define array that will store values to be sent to view page
		$passArg = array();		
	}
	
	function index()
	{
 		$passArg['viewPage'] = "dashboard";
		$this->load->view('backend/layout', $passArg);	 
		
		//echo "Welcome to our site!";
	}		
	
}
