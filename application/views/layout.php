<?php
/*
* Page Name: layout.php
* Purpose: Displays header- dynamic midsection - footer and all other common files
*/
?>

<!-- load session library -->
<?php
$this->load->library('session'); 
$this->load->helper('array');
?>

<!-- Load Header -->
<?php $this->load->view('includes/header');?>

<!-- Load Dynamic View Page -->
<?php 

if($this->session->userdata('session_id') != "" )// if logged in
{
	

	if(!isset($viewArr))
		$viewArr = array();
	
	$this->load->view($viewPage,$viewArr);
} 
else //if dynamic view is not supplied, load default page
{	
	$this->load->view('home');
}?>


<!-- Load  Footer -->
<?php $this->load->view('includes/footer');?>
