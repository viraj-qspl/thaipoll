<?php

/**
 * 
 * This class will hold all commonly used functions across the application
 * @author Sandeep Raul
 * @since 5 Aug 2011
 *
 */
class Common_method {
	
	function __construct(){			
			
		$CI =& get_instance();						
		
		$CI->load->library('session');	//Load session or create session only once.
		$CI->load->helper('url');			
	}
	

	function getUserIdFromSession(){
		$CI =& get_instance();						
				
		return $CI->session->userdata("userId");
	}
	
	
	function isAdminLogged(){
		$CI =& get_instance(); //This is required as common is a custom class and not codeIgnitors controller or model						
		
		// Get data from session
		if( $CI->session->userdata("session_id") != "" ){
				if ($CI->session->userdata("userId") != "" && 
					$CI->session->userdata("userType") == SUPER_ADMIN ){
					return true;
				}		
		}
		return false;
	}
	
	
	function adminAuthentication(){
		$CI =& get_instance(); //This is required as common is a custom class and not codeIgnitors controller or model				
		
						
		//check if admin has logged in or not
		if( $this->isAdminLogged() == true ){ 
			;//ok
		}else{
			//take user to login page
			redirect($CI->config->item('loginBeAction'), 'refresh');		
		}	
	}

	
	function getMessage($argOprType, $argQueryFlag ){
		$CI =& get_instance(); //This is required as common is a custom class and not codeIgnitors controller or model				
		
		$message = "";
		if ($argOprType == OPR_ADD){
				$message 	= ($argQueryFlag == true) ? $CI->lang->line('success.add') : $CI->lang->line('error.add')  ;				
		}
		if ($argOprType == OPR_EDIT){
				$message 	= ($argQueryFlag == true) ? $CI->lang->line('success.edit') : $CI->lang->line('error.edit')  ;				
		}
		if ($argOprType == OPR_DELETE){
				$message 	= ($argQueryFlag == true) ? $CI->lang->line('success.delete') : $CI->lang->line('error.delete')  ;				
		}
		return $message;
	}	
	
	function getDateInDMY($dateTimeInYMD){// example input: 2012-06-16 22:44:27
		if (empty($dateTimeInYMD)){
			return "";
		}else{
			//first separate date and time 
			$dateTime = explode(" ",$dateTimeInYMD );
			if (count($dateTime)!=2){
				return "";
			}else{
				$dateArr = explode("-", $dateTime[0]);
				if(count($dateArr)!=3){
					return "";	
				}else{
					//re-arrange date values and return date in DMY format
					return $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];
				}
			}
		}
		
	}
	
	function getCountryStateCityAreaObjects($recordObj){
		
		$CI =& get_instance(); //This is required as common is a custom class and not codeIgnitors controller or model				
		
		// Country List
		$objArr['countryObjArr']		= $CI->country_model->getRecords(null, ACTIVE); // all active countries
		
		// State List
		$stateObjArr 	= array();
		// if countryId is present, then show state list, else show Default-country state list		
		if ($recordObj->getCountryId() != null && $recordObj->getCountryId() > 0){
			$stateObjArr	= $CI->state_model->getRecords(null, $recordObj->getCountryId(), ACTIVE);								
		}
		else{
			$recordObj->setCountryId(DEFAULT_COUNTRY_ID);
			$stateObjArr	= $CI->state_model->getRecords(null, DEFAULT_COUNTRY_ID, ACTIVE);			
		}
		$objArr['stateObjArr']	= $stateObjArr;
				
		// City List
		$cityObjArr 	= array();
		// if stateId is present, then show city list, else show Default-state city list		
		if ($recordObj->getStateId() != null && $recordObj->getStateId() > 0){
			$cityObjArr	=  $CI->city_model->getRecords(null, $recordObj->getStateId(), ACTIVE);				
		}
		else{	
			$recordObj->setStateId(DEFAULT_STATE_ID);
			$cityObjArr	=  $CI->city_model->getRecords(null, DEFAULT_STATE_ID, ACTIVE);										
		}		
		$objArr['cityObjArr']		= $cityObjArr;

		// Area List
		$areaObjArr 	= array();
		// if cityId is present, then show area list, else show Default-city area list		
		if ($recordObj->getCityId() != null && $recordObj->getCityId()>0){
			$areaObjArr	= $CI->area_model->getRecords(null, $recordObj->getCityId(), ACTIVE);					
		}else{
			$recordObj->setCityId(DEFAULT_CITY_ID);
			$areaObjArr	= $CI->area_model->getRecords(null, DEFAULT_CITY_ID, ACTIVE);								
		}
		$objArr['areaObjArr']	= $areaObjArr;
		
		return $objArr;
		
	}
	
	
	/** 
	 * This function calculates the limitOffset based on delete page context
	 * @param $argStrIds
	 */
	function getLimitOffsetAfterDelete($argStrIds, $argDataObj){
		
		$CI =& get_instance(); //This is required as common is a custom class and not codeIgnitors controller or model				
		
		$retLimitOffset = 0;
		
		$recordListedOnPage = $CI->input->post("recordListedOnPage");  // Will have total number of records displayed on page

		// Converts $argStrIds to array of Ids
		$idArr = explode(",", $argStrIds);				
		
		// If total number of Ids is same as RECORDS_PER_PAGE, that means all records on the page are to be deleted, in such case, list records from previous page 
		if ( (count($idArr) == $recordListedOnPage)  || (count($idArr) == RECORDS_PER_PAGE_BE) ) {
			// While decreasing offset take care of -ve calculation
			$retLimitOffset = ($argDataObj->getLimitOffset() >= RECORDS_PER_PAGE_BE) ? $argDataObj->getLimitOffset() -  RECORDS_PER_PAGE_BE : RECORDS_PER_PAGE_BE ; // For example: 15 - 5 = 10, delete on limit 15, then list with limit 10			
		} else {
			$retLimitOffset = $argDataObj->getLimitOffset();
		}
		
		return $retLimitOffset;
		
	}
	
	
	
}
/*end of file*/