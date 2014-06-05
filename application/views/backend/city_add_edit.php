

	<!-- start page -->
	<div id="page">
		<div id="page-bgtop">
		  <div id="admin_main_contents1" >
			<table width="100%" cellpadding="2" cellspacing="2" border="0">
			
				<tr> 
				 <td> 
				 	<div id="adm_list_head_wrap"  >
						<div style="float:left; width:400" ><strong class="form_add_heading3">
						<?php echo $listDataObj->getBreadCrumb();  ?>	 						
						&gt;  
						<?php echo ($listDataObj->getOprType()==OPR_ADD)? "Add" : (($listDataObj->getOprType()==OPR_EDIT)? "Edit" : "" ); ?> City 
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
					<!-- display listing: start -->
					
					<!-- Compute action URL  -->
					<?php 
						// Get record object
						$recordObjArr 	= $listDataObj->getDbDataArr();
						$recordObj		= $recordObjArr[0];					
						$actionURL = $this->config->item('citySaveBeAction')."/".$listDataObj->getUrlParams(); 					
						
					?>
					
					<form name="form" action="<?php echo $actionURL; ?>" method="post">
										
					<table width="100%" border="0">
					
                      <tr>
                        <td width="20%"><div align="right">*City Name:</div></td>
                        <td width="80%"><input type="text" name="name" value="<?php echo set_value('name', $recordObj->getName()); ?>" />                        
                        </td>
                        
                      </tr>
                      
                      <tr>
                        <td><div align="right">Status</div></td>
                        <td>
                          <input name="status" type="radio" value="active" checked="checked" /> Active
                          <input name="status" type="radio" value="inactive" /> Inactive
						</td>
                      </tr>
                      <tr>
                        <td><div align="right"></div></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right"></div></td>
                        <td>                        
                          <input type="submit" name="Submit" value="Save" />
                          <input type="button" name="Cancel" value="Cancel" onClick="doCancel()" />
                        </td>
                      </tr>
                      <tr>
                        <td><div align="right"></div></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>	

						<!--  Send hidden parameters -->
	                    <input type="hidden" name="id" value="<?php echo set_value('id', $recordObj->getId()); ?>" />
	                    <input type="hidden" name="oldName" value="<?php echo set_value('name', $recordObj->getName()); ?>" />
	                    <input type="hidden" name="oprType" value="<?php echo $listDataObj->getOprType(); ?>" />
	                    <input type="hidden" name="stateId" value="<?php echo $listDataObj->getStateObj()->getId(); ?>" />

                    </form>
                    				
					<!-- display listing: end -->				
				 </td>
				</tr>
				
				

			</table>		  		  
		  </div>
		  
		  <div style="clear: both;">&nbsp;</div>
		
	  </div>
	
	</div>
	<!-- end page -->
	
	
	
	<!-- ################	define js script here	 ################### -->	
	<script>
	function doCancel(){
		// simply reload the City page
		window.location.href = "<?php echo $this->config->item('cityBeAction');  ?>";
		
	}

	
	</script>
	
	