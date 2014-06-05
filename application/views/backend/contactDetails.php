

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
								
								
								