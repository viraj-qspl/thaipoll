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

<!-- Include Header -->
<?php $this->load->view('includes/adminheader');?>

<!-- Load Dynamic View Page -->
<?php 
if($this->session->userdata('session_id') != "" )// if logged in
{
	$this->load->view('backend/'.$viewPage);
} 
else //if dynamic view is not supplied, load default page
{	
	$this->load->view('backend/login');
}?>


<!-- Include  Footer -->
<?php $this->load->view('includes/adminfooter');?>
