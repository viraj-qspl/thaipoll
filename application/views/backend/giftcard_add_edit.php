
	<!-- start page -->
	<div id="page">
		<div id="page-bgtop">
		  <div id="admin_main_contents1" >
			<table width="100%" cellpadding="2" cellspacing="2" border="0">
			
				<tr> 
				 <td> 
				 	<div id="adm_list_head_wrap" >
						<div style="float:left; width:400" ><strong class="form_add_heading3">
						 <?php echo $listDataObj->getBreadCrumb(); ?>
						&gt; <?php echo ($listDataObj->getOprType() == OPR_ADD)? "Add" : (($listDataObj->getOprType() == OPR_EDIT)? "Edit" : "" ); ?> <?php echo $this->lang->line('lable.user'); ?> 
						</strong></div>
					</div>
				 </td> 
				</tr>
				
				<!--  display validation errors -->
				<tr><td colspan="5" >
						<?php echo validation_errors(); ?>
				</td></tr>
										
				<tr>
				 <td> 
					
					<!-- Compute action URL  -->
					<?php 
						// Get record object
						$recordObjArr 	= $listDataObj->getDbDataArr();
						$recordObj		= $recordObjArr[0];
						$actionURL = $this->config->item('giftcardSaveBeAction')."/".$listDataObj->getUrlParams(); 											
					?>
					
					<!-- add/edit form start -->                    		
					
					<form name="form" action="<?php echo $actionURL; ?>" method="post">
									
					<!--start: row -->											
					<div id="add_row_data_wrap">
						<table width="100%"> 
							<tr> <td class="add_section_heading"> <?php echo $this->lang->line('lable.giftcard'); ?> details 		</td> </tr> 
						</table>
					</div>
					<!--end: row -->	

				<!--start: row -->											
				<div id="add_row_data_wrap">
					<table width="100%" >
					 	<tr> 					
							<td width="15%" align="right"><b>*Title:</b>  </td> 
							<td width="20%"><input type="text" id="title" name="title" value="<?php echo set_value('email', $recordObj->getTitle()); ?>" size="30" /> </td>
						</tr> 
					 	<tr> 					
							<td width="15%" align="right"><b>*Description:</b>  </td> 
							<td width="20%">
								<textarea rows="20" cols="50" name="descp" id="descp"><?php echo set_value('descp', $recordObj->getDesc()); ?></textarea>
							</td>
						</tr> 						
					 	<tr> 					
							<td width="15%" align="right"><b>*Value:</b>  </td> 
							<td width="20%"><input type="text" id="value" name="value" value="<?php echo set_value('value', $recordObj->getValue()); ?>" size="30" /> </td>
						</tr>
					 	<tr> 					
							<td width="15%" align="right"><b>*Points:</b>  </td> 
							<td width="20%"><input type="text" id="points" name="points" value="<?php echo set_value('points', $recordObj->getPoints()); ?>" size="30" /> </td>
						</tr> 
					 	<tr> 					
							<td width="15%" align="right"><b>*Status:</b>  </td> 
							<td width="20%">
								<?php  $gf_status = $recordObj->getStatus();
									echo form_dropdown('status',array('ACTIVE'=>'Active','INACTIVE'=>'InActive'),'',"id='status' value='set_status(\"status\",\"$gf_status\")'");
								?>
							</td>
						</tr> 						
						
 						
						
					



					</table>

				</div>
				<!--end: row -->	

						<!--start: row -->											
						<div id="add_row_data_wrap">
							<table width="100%"> 
								<tr align="center"> 
									<td class="add_section_heading"> <input type="submit" value="Submit">	</td> 
								</tr>
		
							 </table>
						</div>
						<!--end: row -->					
													                    		
					<!--  Send hidden parameters -->
                    <input type="hidden" name="id" value="<?php echo set_value('id', $recordObj->getId()); ?>" />
                    <input type="hidden" name="oprType" value="<?php echo $listDataObj->getOprType(); ?>" />

                    </form>

					<!--  add/edit form end -->                    		
                    		
 				 </td>
				</tr>				

			</table>		  		  
		  </div>
		  
		  <div style="clear: both;">&nbsp;</div>
		
	  </div>
	
	</div>
	<!-- end page -->
	
	
	
	<!-- ################	define js script here	 ################### -->	
	
	<!--  add js that has country-state-city-area code  
	<?   /* include_once ($this->config->item('base_path') .'/js/countryStateCityArea.js.php'); */	
	?>	
-->	
	<script>
	function doCancel(){
		// simply reload the Buy / Sell page
		window.location.href = "<?php echo $this->config->item('giftcardBeAction');  ?>";
		
	}		
	</script>
	
	
