	<!-- start page -->	
	<div id="page">
		<div id="page-bgtop">
		  <div id="admin_main_contents1"  >
			<table width="100%" cellpadding="2" cellspacing="2" border="0">
						
				<tr> 
				 <td> 
				 	<div id="adm_list_head_wrap"  >
				 	
						<!--  Page heading and breadcumb -->										 	
						<div style="float:left; width:400" >
							<strong class="form_add_heading3">
	 							<?php echo $listDataObj->getBreadCrumb();  ?>	 							
								&gt;
								<?php echo $this->lang->line('lable.list');  ?>	 													
							</strong>
						</div>
						
					</div>
				 </td> 
				</tr>

				<tr>
				 <td> 
					<!-- display listing: start -->
					<table width="100%" border="0" cellpadding="2" cellspacing="2">

						<tr>
						   <td colspan="5" ><?php  echo $listDataObj->getOprMessageFormated(); ?></td>
						</tr>		
											
						<!--  Search option -->													
						<tr><td colspan="5"> 
							<table width="100%" border="0"><tr>
								<td width="50%" align="left" > <a id ="deleteSelected" href="javascript:void()" onClick="deleteAllSelectedRecords()" title="Delete selected records" >Delete Selected</a>  
								|  <a href="<?php echo $this->config->item('countryAddBeAction')."/".$listDataObj->getUrlParams(PARAM_ADD); ?>"> <?php echo $this->lang->line('link.add'); ?></a> 
								</td>															
								<td width="50%" align="right"> 						
									<form name="searchForm" action="<?php echo $this->config->item('countrySearchBeAction')."/".$listDataObj->getUrlParams(); ?>" method="post">								
										<select name="searchField">
										
										<?php 
											$searchFields = $listDataObj->getSearchFieldArr();
											foreach($searchFields as $field => $label){ 
												$defaultSelected = ($field == set_value('searchField', "")) ? " SELECTED " : ""; 
										?>
											
											<option value="<?php echo $field; ?>" <?php echo $defaultSelected; ?> ><?php echo $label; ?></option>
											
										<?php } ?>
																																
										</select>						
										<input type="text" name="searchText" value="<?php echo set_value('searchText', $listDataObj->getSearchDefaultText()); ?>" />
										<input type="submit" value="<?php echo $this->lang->line('button.search'); ?>" />							
									</form>							 
								</td>							
							</tr></table>
						 </td></tr>
											
					
						<!--  Listing columns -->	
						<?php 
							$sortFieldArr = $listDataObj->getSortFieldArr(); // This holds the listing fields with links for sorting						
						?>
						<tr class="form_add_heading4">
							<td width="5%" align="center"> <input type="checkbox" id="headCheckbox" value="" onClick="doSelectAllRecords(this);" > </td>							
							<td width="40%" align="left"><?php echo $sortFieldArr["name"]; ?></td>
							<td width="30%" align="left"><?php echo $sortFieldArr["status"]; ?></td>														
							<td width="10%" align="center"><?php echo $this->lang->line('lable.action'); ?></td>
						</tr>
						

						<!--  Listing data -->							
						<tr><td colspan="5"> <div class="adm_border1" ></div> </td></tr>
						
						<?php 
						$listArr = $listDataObj->getDbDataArr();
						$editAction = $deleteAction  = $manageAction = "";
						foreach ($listArr as $ind => $countryObj) { 
							//Store the id of each record
							$listDataObj->setId($countryObj->getId());
																
							$editAction 		= $this->config->item('countryEditBeAction')."/".$listDataObj->getUrlParams();	
							$deleteAction 		= $this->config->item('countryDeleteBeAction')."/".$listDataObj->getUrlParams();
							$manageAction		= $this->config->item('stateListingBeAction')."/".$listDataObj->getUrlParams(PARAM_LISTING);
						?>					
											
						<tr class="adm_highlight_row" id="<?php echo $countryObj->getId(); ?>" onmouseover="this.className = 'highlight_row';" onmouseout="this.className = 'adm_highlight_row';"   >
							<td align="center"> <input type="checkbox" name="rowCheckbox" value="<?php echo $countryObj->getId(); ?>" > </td>
							<td align="left"><a href="<?php echo $manageAction; ?>"><?php echo $countryObj->getName(); ?></a></td>
							<td align="left"><?php echo ucfirst($countryObj->getStatus()); ?></td>							
							<td align="center"> <a href="javascript:void()" onClick="editRecord('<?php echo $countryObj->getId(); ?>', '<?php echo $editAction ?>')"><img title="Edit" src="<?php echo $this->config->item('editImage'); ?>" /></a> </td>
				        </tr>

						<?php } ?>
						
						<!--  If listArr is empty - show no records found -->
						<?php if (empty($listArr)){ ?>
						
							<tr><td colspan="5"> There are no records to display </td></tr>
						
						<?php } else { ?>

							<!-- Display Pagination -->
							<tr><td colspan="5"> 
								<table width="100%" border="0">
									<tr height="40" valign="middle">
										<td width="50%" align="left" >Total Records: <?php  echo $listDataObj->getTotalRecords(); ?></td>
										<td width="50%" align="right" ><?php  echo $this->pagination->create_links(); ?></td>
									</tr>
								</table>																						
							</td></tr>
													
						<?php } ?>

				   </table>
					<!-- display listing: end -->				
				 </td>
				</tr>

			</table>		  		  
		  </div>
		  
		  <div style="clear: both;">&nbsp;</div>
		
	  </div>
	
	</div>
	<!-- end page -->
	
	<form id="hiddenForm" name="deleteRecordsForm" action="<?php echo $deleteAction; ?>" method="post" >
	<?php if(!empty($deleteAction)){ ?>				
				<!-- define hidden fields  -->
				<input type="hidden" id="selectedIds" name="selectedIds" value="" />	
				<input type="hidden" id="recordListedOnPage" name="recordListedOnPage" value="<?php echo count($listArr);?>" />								
	<?php } ?>
	</form>									
	
	
	<!-- ################	define js script here	 ################### -->	
	<script>
	
	//define array having id and name, to be used to delete record
	var nameArray = new Array();
	<?php foreach ($listArr as $ind => $countryObj) { ?>
		nameArray[<?php echo $countryObj->getId(); ?>] = "<?php echo $countryObj->getName() ?>" ;
	<?php } ?>
	

	function deleteRecord(id, action){
		res = confirm("Delete - " + nameArray[id] + "?" );
		if (res == true){
			 window.location.href =	action;
		}else{
			return false;
		}		
	}

	function editRecord(id, action){
		 window.location.href =	action;
	}

	function changeRowColor(color, ID) {
		document.getElementById(ID).bgColor = "#" + color;
	}	

	function doSelectAllRecords(headCheckbox) {
		//select all checkboxes
		rowCheckboxArr = document.getElementsByName('rowCheckbox');
		for(var i=0; i<rowCheckboxArr.length; i++){
			if (headCheckbox.checked){
				rowCheckboxArr[i].checked = true;							
			}else{
				rowCheckboxArr[i].checked = false;							
			}
		}				
	}

	function deleteAllSelectedRecords(){

		// Proceed to delete selected records		
		// Get id of each checbox which is selected
		selectedIds = "";
		rowCheckboxArr = document.getElementsByName('rowCheckbox');
		for(var i=0; i<rowCheckboxArr.length; i++){
			if (rowCheckboxArr[i].checked){
				selectedIds = selectedIds + rowCheckboxArr[i].value + "," ;
			}
		}
		//Note: At the end of this loop; selectedIds will have value ending with comma. For example: 123,124,125, 
				
		if (selectedIds == ""){
			alert ("Please select record(s) to delete.");
		}
		else{
			//remove the last comma from the selectedIds			
			selectedIds = selectedIds.substring(0, (selectedIds.length -1));						
			
			// Confirm deleting records from user
			var confirmDel = confirm("Delete selected record(s)?");
			
			if (confirmDel == true){
				//store value in hidden field
				document.getElementById("selectedIds").value = selectedIds;

				//submit the form
				document.deleteRecordsForm.submit();				
			}else{
				return;				
			}
			
		}
							
	}


	</script>	