<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php 

//Process Seo array
//$seoTitle 		= empty($seoArr['title'])? "Project-name" : $seoArr['title'] ;
//$seoKeywords 	= empty($seoArr['keywords'])? "Project-name" : $seoArr['keywords'] ;
//$seoDescription = empty($seoArr['description'])? "Project-name" : $seoArr['description'] ;	

?>


<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<title><?php //echo $seoTitle; ?></title>

		<meta name="keywords" content="<?php //echo $seoKeywords; ?>" />

		<meta name="description" content="<?php //echo $seoDescription; ?>" />
		
		<!-- ################  include CSS -->
		<link href="<?php echo $this->config->item('base_url'); ?>/css/default.css" rel="stylesheet" type="text/css" media="screen" />
		
		<!-- ###############  include JavaScripts -->		
		 <script src="<?php echo $this->config->item('base_url'); ?>/js/jquery.js" type="text/javascript"></script>  	

		 <script src="<?php echo $this->config->item('base_url'); ?>/js/dynamic_fields.js" type="text/javascript"></script>  	
		 					
	    <style type="text/css">
<!--
#blank {
	height: 25px;
}
-->
        </style>
</head>

<body>

	<!-- start: main-page -->
	<div id="wrapper">
	
		<!-- Start above header -->
		<div id="header-top-wrapper">
			<div id="header-top">
				<div id="header-top-left"><strong>5th August 2011</strong></div>
				<div class="form_add_heading" id="header-top-right"><strong>Codebase Framework - Admin Panel </strong></div>
			</div>
		</div>  			
		<!-- End above header -->
	
		
		<!-- start header -->
		
		<?php if ( $this->common_method->isAdminLogged() == true ){		?>
		
			<!-- Display Admin links  -->
			<?php include_once 'adminmenulinks.php'; ?>			
		
		<?php }else { ?>

			<!-- Display Portal Message  -->
			<div id="menu-wrapper">
				<div id="menu">
					 <table width="100%" align="center">
					 	<tr height="5"><td></td></tr>
					 <tr><td align="center" class="text1">							 	 
	                   This is sample project.
	                    </td>
					 </tr></table>
				</div>
			</div>			  
		
		<?php } ?>

	  <!-- end header -->
	  
	  
	  
	  