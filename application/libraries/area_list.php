<?php


/**
 * Enter description here ...
 * @author Admin
 *
 */
class Area_list extends Base_list {

	// Define parameters specific to this class which can be part of URL
	private $countryObj;
	private $stateObj;
	private $cityObj; 
	
		
	function __construct(){	}

	// ---- Define getter methods
	function getCountryObj(){ return $this->countryObj; }
	function getStateObj(){ return $this->stateObj; }
	function getCityObj(){ return $this->cityObj; }
	
	
	// Implement all abstract methods defined in parent class
	function getInstance($argData = array()){

		// Call parent method and set the values to the object
		parent::assignData($argData);	
				
		// Set values for properties defined in this class
		$this->assignMoreData($argData);
		
		// Set values specific to this feature
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		parent::setOtherParams($this->createOtherParams());
		parent::setActionUrl($CI->config->item('areaListingBeAction'));
		parent::setSearchFieldArr($CI->config->item('areaSearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('areaDbFieldBeArr'));
		parent::setBreadCrumb($this->creatBreadCrumb());
		
		// Now, since all properties are defined - store value for sortFieldArr 
		parent::computeSortFieldArr();
		
		// Return the object		
		return $this; 
	}		
	
	function assignMoreData($argData = array()){	
		// Store values in properties defined for this class
		
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$cityId = $CI->uri->segment(URI_OTHER_PARAMS);		
		if ($cityId == null){					
			if (is_array($argData) && isset($argData["cityId"])){
				$cityId = 	$argData["cityId"];					
			}else{			
				// Set it to default (main) parentId
				$cityId = 	DEFAULT_CITY_ID;					
			}
		}

		// Once you obtain City-id, now get its state details and assign to the object, subsequently you can get country details
		$this->cityObj = $CI->city_model->getRecords($cityId);
		
		if ($this->cityObj != null){

			$this->stateObj 	= $CI->state_model->getRecords($this->cityObj->getStateId());
			
			if ($this->stateObj != null){
				$this->countryObj = $CI->country_model->getRecords($this->stateObj->getCountryId());				
			}
		}
				
	}

	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		
		return $this->getCityObj()->getId();
		
	}		

	// This method will create required breadCrumb (lable with link)	
	function creatBreadCrumb(){
	
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Locations > selected-country-name > List

		$breadCrumb .= "<a href='".$CI->config->item('countryBeAction')."' >";
		$breadCrumb .= "".$CI->lang->line('lable.locations');
		$breadCrumb .= "</a>";
		
		$breadCrumb .= " > ";
		
		$urlParams = "".DEFAULT_ID."/".$this->getStateObj()->getId()."/".DEFAULT_SORT_ORDER."/".DEFAULT_SORT_FIELD."/".DEFAULT_SEARCH_FLAG;
		$breadCrumb .= "<a href='".$CI->config->item('stateListingBeAction')."/".$urlParams."' >";
		$breadCrumb .= "".$this->getCountryObj()->getName();
		$breadCrumb .= "</a>";
			
		$breadCrumb .= " > ";		
		
		$urlParams = "".DEFAULT_ID."/".$this->getCityObj()->getId()."/".DEFAULT_SORT_ORDER."/".DEFAULT_SORT_FIELD."/".DEFAULT_SEARCH_FLAG;
		$breadCrumb .= "<a href='".$CI->config->item('cityListingBeAction')."/".$urlParams."' >";
		$breadCrumb .= "".$this->getStateObj()->getName();
		$breadCrumb .= "</a>";
			
		$breadCrumb .= " > ";		
		
		$breadCrumb .= "<a href='".$CI->config->item('areaListingBeAction')."/".$this->getUrlParams()."' >";
		$breadCrumb .= "".$this->getCityObj()->getName();
		$breadCrumb .= "</a>";
		
		return $breadCrumb;
		
	}	

	
}
/*end of file*/