
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
						$actionURL = $this->config->item('userSaveBeAction')."/".$listDataObj->getUrlParams(); 											
					?>
					
					<!-- add/edit form start -->                    		
					
					<form name="form" action="<?php echo $actionURL; ?>" method="post">
									
					<!--start: row -->											
					<div id="add_row_data_wrap">
						<table width="100%"> 
							<tr> <td class="add_section_heading"> <?php echo $this->lang->line('lable.user'); ?> details 		</td> </tr> 
						</table>
					</div>
					<!--end: row -->	
				
					<!--start: row -->											
					<div id="add_row_data_wrap">
						<table width="100%"> 			
							<tr> 
								<td > 
								 	<?php // check for default checked
									$user = ($recordObj->getUserType() == USER )? "checked" : "" ;
									$admin  = ($recordObj->getUserType() == ADMIN )? "checked" : "" ;
									if (empty($user) && empty($admin)){
										$user = "checked";  //default
									}
								 	?>
									<b>User Type:</b>									
									<input type="radio" value="<?php echo USER ?>" name="userType" <?php echo $user; ?> />User
									<input type="radio" value="<?php echo ADMIN ?>" name="userType" <?php echo $admin; ?> />Admin				
								</td>		
							 </tr> 			 
						</table>
					</div>
					<!--end: row -->	
					

				
				<!--start: row -->											
				<div id="add_row_data_wrap">
					<table width="100%" >
					 	<tr> 					
							<td width="15%" align="right"><b>*Email:</b>  </td> 
							<td width="20%"><input type="text" id="email" name="email" value="<?php echo set_value('email', $recordObj->getEmail()); ?>" size="30" /> </td>
							<td width="15%" align="right"><b>*Password:</b> </td> 
							<td width="20%"><input type="password" id="password" name="password" value="<?php echo set_value('password', $recordObj->getPassword()); ?>" size="15" /> </td> 							 
							<td width="15%" align="right"><b>*Re-enter Password:</b> </td> 
							<td width="20%"><input type="password" id="password2" name="password2" value="<?php echo set_value('password', $recordObj->getPassword()); ?>" size="15" /> </td> 
						</tr> 
					 	<tr> 					
							<td align="right"><b>*First Name:</b>  </td> 
							<td ><input type="text" id="firstName" name="firstName" value="<?php echo set_value('firstName', $recordObj->getFirstName()); ?>" size="20" /> </td>
							<td align="right"><b>*Last Name:</b> </td> 
							<td ><input type="text" id="lastName" name="lastName" value="<?php echo set_value('lastName', $recordObj->getLastName()); ?>" size="15" /> </td> 							 
							<td align="right"><b>Facebook Id:</b> </td> 
							<td ><input type="text" id="facebookId" name="facebookId" value="<?php echo set_value('facebookId', $recordObj->getFacebookId()); ?>" size="15" /> </td> 
						</tr> 
					 	<tr> 					
							<td align="right"><b>Display Name:</b>  </td> 
							<td ><input type="text" id="displayName" name="displayName" value="<?php echo set_value('displayName', $recordObj->getDisplayName()); ?>" size="20" /> </td>
							<td align="right"><b>Gender:</b> </td> 
							<td > 
								 	<?php // check for default checked
									$male = ($recordObj->getGender() == MALE )? "checked" : "" ;
									$female  = ($recordObj->getGender() == FEMALE )? "checked" : "" ;
									if (empty($male) && empty($male)){
										$male = "checked";  //default
									}
								 	?>
									<input type="radio" value="<?php echo MALE ?>" name="gender" <?php echo $male; ?> />Male
									<input type="radio" value="<?php echo FEMALE ?>" name="gender" <?php echo $female; ?> />Female				
							</td>
							<td align="right"><b>Birth date:</b> </td> 
							<td ><input type="text" id="birthDate" name="birthDate" value="<?php echo set_value('birthDate', $recordObj->getBirthDate()); ?>" size="15" /> </td> 
						</tr> 

					</table>

				</div>
				<!--end: row -->	
																	
						<!--start: row -->											
						<div id="add_row_data_wrap">
							<BR/>
						</div>
						<!--end: row -->								
						
						<!--start: row -->											
						<div id="add_row_data_wrap">
							<table width="100%"> <tr> <td class="add_section_heading">  
								Contact details
							</td> </tr> </table>
						</div>
						<!--end: row -->	
						
						<!--start: row -->
						<div id="add_row_data_wrap">
							<table width="100%" border="0" cellspacing="8">
							
								<!--  Display country-state-city-area-address and landmark over here  -->

							    <tr>
								    <td width="12%"><div align="right"><strong>*Country:</strong></div></td> 
								    <td width="34%">
								    	<select id="countryId" name="countryId" >
											<option value="0" > -Select-  </option>																										
											<?php foreach($countryObjArr as $ind => $aObj){ 
												//Check for default selected item
												$selected = "";
												if ($recordObj->getCountryId() == $aObj->getId()){ 	$selected = " SELECTED "; 	}												
											?>
											<option value="<?php echo $aObj->getId(); ?>" <?php echo $selected; ?> ><?php echo $aObj->getName(); ?></option>
											<?php } ?>
										</select>
																
										&nbsp;&nbsp;														
										<strong>*State:</strong>
										<select id="stateId" name="stateId" >
											<option value="0" > -Select-  </option>		
											<?php foreach ($stateObjArr as $ind => $aObj){ 
												//Check for default selected item
												$selected = "";
												if ($recordObj->getStateId() == $aObj->getId()){ 	$selected = " SELECTED "; 	}
											?>
											<option value="<?php echo $aObj->getId(); ?>" <?php echo $selected; ?> ><?php echo $aObj->getName(); ?></option>																					
											<?php } ?>
										</select>
								    </td> 
									<td width="1%">&nbsp;</td> 							
									<td width="8%"><div align="right"><strong>*City: </strong></div></td> 
									<td>
										<select id="cityId" name="cityId" >
											<option value="0" > -Select-  </option>																										
											<?php foreach($cityObjArr as $ind => $aObj){ 
												//Check for default selected item
												$selected = "";
												if ($recordObj->getCityId() == $aObj->getId()){ 	$selected = " SELECTED "; 	}												
											?>
											<option value="<?php echo $aObj->getId(); ?>" <?php echo $selected; ?> ><?php echo $aObj->getName(); ?></option>
											<?php } ?>
										</select>
																
										&nbsp;&nbsp;														
										<strong>*Area:</strong>
										<select id="areaId" name="areaId" >
											<option value="0" > -Select-  </option>		
											<?php foreach ($areaObjArr as $ind => $aObj){ 
												//Check for default selected item
												$selected = "";
												if ($recordObj->getAreaId() == $aObj->getId()){ 	$selected = " SELECTED "; 	}
											?>
											<option value="<?php echo $aObj->getId(); ?>" <?php echo $selected; ?> ><?php echo $aObj->getName(); ?></option>																					
											<?php } ?>
																									
										</select>
									</td>																						
								</tr>
								
								<tr>
									<td ><div align="right"><strong>Address: </strong></div></td> 
									<td ><input type="text" name="address" value="<?php echo set_value('address', $recordObj->getAddress()); ?>" size="40" /></td>
									<td width="1%">&nbsp;</td> 														
									<td><div align="right"><strong>Landmark:</strong></div></td> 
									<td><input type="text" name="landmark" value="<?php echo set_value('landmark', $recordObj->getLandmark()); ?>" size="40" />
										<span id="add_row_tip">Eg: Near Ganesh temple.</span> </td>				
								</tr>
								
								<tr>
									<td><div align="right"><strong>Pincode:</strong></div></td>
									<td><input type="text" name="pincode" value="<?php echo set_value('pincode', $recordObj->getPincode()); ?>" size="10" /></td>
									<td width="1%">&nbsp;</td>	
									<td><div align="right"><strong>Phone No(s):</strong></div></td> 
									<td><input type="text" name="phone" value="<?php echo set_value('phone', $recordObj->getPhone()); ?>" size="40" />
										<span id="add_row_tip">Eg: 9822012345,9822012345</span> 
									</td>				
								</tr>								
																			
								<tr>
									<td colspan="5">
																																	
									</td>
								</tr>																
																						
							</table>
						</div>
						<!--end: row -->			
													
						<!--start: row -->											
						<div id="add_row_data_wrap">
							<BR/><BR/>
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
	
	<!--  add js that has country-state-city-area code  -->
	<?php  include_once $this->config->item('base_path') . '/js/countryStateCityArea.js.php'; ?>	
	
	<script>
	function doCancel(){
		// simply reload the Buy / Sell page
		window.location.href = "<?php echo $this->config->item('userBeAction');  ?>";
		
	}		
	</script>
	
	
