<?php


/**
 * Enter description here ...
 * @author Admin
 *
 */
class City_list extends Base_list {

	// Define parameters specific to this class which can be part of URL
	private $countryObj; 
	private $stateObj;

	function __construct(){	}

	// ---- Define getter methods
	
	function getCountryObj(){ return $this->countryObj; }
	function getStateObj(){ return $this->stateObj; }	

	// ---- Define other methods
	
	// Implement all abstract methods defined in parent class
	function getInstance($argData = array()){

		// Call parent method and set the values to the object
		parent::assignData($argData);	
				
		// Set values for properties defined in this class
		$this->assignMoreData($argData);
		
		// Set values specific to this feature
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		parent::setOtherParams($this->createOtherParams());
		parent::setActionUrl($CI->config->item('cityListingBeAction'));
		parent::setSearchFieldArr($CI->config->item('citySearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('cityDbFieldBeArr'));
		parent::setBreadCrumb($this->creatBreadCrumb());
		
		// Now, since all properties are defined - store value for sortFieldArr 
		parent::computeSortFieldArr();
		
		// Return the object		
		return $this; 
	}		
	
	// Store values in properties defined for this class
	function assignMoreData($argData = array()){	
						
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$stateId = $CI->uri->segment(URI_OTHER_PARAMS);		
		if ($stateId == null){					
			if (is_array($argData) && isset($argData["stateId"])){
				$stateId = 	$argData["stateId"];					
			}else{			
				// Set it to default (main) parentId
				$stateId = 	DEFAULT_STATE_ID;					
			}
		}
		
		// Once you obtain State-id, get state object and then get country object
		$this->stateObj 	= $CI->state_model->getRecords($stateId);
		
		if ($this->stateObj != null){
			$this->countryObj 	= $CI->country_model->getRecords($this->stateObj->getCountryId());		
		}
					
	}
	
	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		
		return $this->getStateObj()->getId();
		
	}	
	
	
	// This method will create required breadCrumb (lable with link)	
	function creatBreadCrumb(){
	
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Locations > selected-country-name > State-name > List

		$breadCrumb .= "<a href='".$CI->config->item('countryBeAction')."' >";
		$breadCrumb .= "".$CI->lang->line('lable.locations');
		$breadCrumb .= "</a>";
		
		$breadCrumb .= " > ";
		
		$urlParams = "".DEFAULT_ID."/".$this->getStateObj()->getId()."/".DEFAULT_SORT_ORDER."/".DEFAULT_SORT_FIELD."/".DEFAULT_SEARCH_FLAG;
		$breadCrumb .= "<a href='".$CI->config->item('stateListingBeAction')."/".$urlParams."' >";
		$breadCrumb .= "".$this->getCountryObj()->getName();
		$breadCrumb .= "</a>";
			
		$breadCrumb .= " > ";		
		
		$breadCrumb .= "<a href='".$CI->config->item('cityListingBeAction')."/".$this->getUrlParams()."' >";
		$breadCrumb .= "".$this->getStateObj()->getName();
		$breadCrumb .= "</a>";
		
		
		return $breadCrumb;
		
	}	
	

	
}
/*end of file*/