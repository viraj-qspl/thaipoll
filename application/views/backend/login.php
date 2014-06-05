
<?php 
	
?>

	  	 	  
	  <!-- start page -->
	  <div id="page">	   
		<div id="page-bgtop">
			
		  <div id="indexSidebar1" >
		    <div id="admin_site_stats_wrap">
					<table width="100%" cellpadding="2" cellspacing="5" bgcolor="#F8F8F8">
						<tr>
						  <td colspan="2"><strong class="bigFont">Welcome to my site...</strong></td>
						</tr>


				  </table>
					
               </div>				

		  </div>
		  
			<div id="indexSidebar2" >

				<!-- Login form -->
				<div id="login_div">		
				
				<form name="login" action="<?php echo $this->config->item('loginBeAction');?>" method="post">		
				
					<table border="0" cellpadding="5" cellspacing="2">
						<tr>
							<td colspan="5" class="form_add_heading" >Login</td>
						</tr>
						
						<!--  Show message -->
						<?php if ( !empty($errorMsg) ){ ?>
						<tr>
							<td colspan="5" ><?php echo  $errorMsg;  ?></td>
						</tr>
						<?php } ?>
						
						<tr>
							<td width="150">Email</td>
							<td width="3"></td>
							<td width="156">Password</td>
							<td width="0"></td>
							<td width="139"></td>
						</tr>
						<tr>
							<td><input type="text" name="email" size="25" /></td>
							<td></td>
							<td><input type="password" name="password" size="20" /></td>
							<td></td>
							<td><input type="submit" name="login" value="Login" /></td>
						</tr>						
				  </table>	
				  	
				  </form>
				  		
				</div>
				
				
				<div id="blank" >&nbsp;</div>
				
				<!-- Join form -->
			</div>
		</div>	   
	   
	  </div>
	  <!-- end page -->		
	 
	<div style="clear: both;">&nbsp;</div>	
	
	<!-- Large blank space -->
	<div id="largeBlankSpace">&nbsp;</div>
	
