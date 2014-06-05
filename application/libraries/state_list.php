<?php


/**
 * Enter description here ...
 * @author Admin
 *
 */
class State_list extends Base_list {

	// Define parameters specific to this class
	private $countryObj;
		
	function __construct(){	}

	// ---- Define getter methods
	
	function getCountryObj(){ return $this->countryObj; }	
	
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
		parent::setActionUrl($CI->config->item('stateListingBeAction'));
		parent::setSearchFieldArr($CI->config->item('stateSearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('stateDbFieldBeArr'));
		parent::setBreadCrumb($this->creatBreadCrumb());
		
		// Now, since all properties are defined - store value for sortFieldArr 
		parent::computeSortFieldArr();
		
		// Return the object		
		return $this; 
	}		
	
	
	function assignMoreData($argData = array()){	
		// Store values in properties defined for this class
		
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		// read the value from URI and store it in class variable		
		$countryId = $CI->uri->segment(URI_OTHER_PARAMS);		
		if ($countryId == null){					
			if (is_array($argData) && isset($argData["countryId"])){
				$countryId = 	$argData["countryId"];					
			}else{			
				// Set it to default
				$countryId = DEFAULT_COUNTRY_ID;					
			}
		}
		
        // Write to log file
 		log_message('info', '--------------> Sub_category_list,  categoryId = ' . $countryId);		
		
		//Using $categoryId, get the category object and store it in this class for future reference
		$this->countryObj = $CI->country_model->getRecords($countryId);
		
					
	}
	
	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		
		return $this->getCountryObj()->getId();
		
	}	
	
	
	// This method will create required breadCrumb (lable with link)	
	function creatBreadCrumb(){
	
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Category > selected-country-name > List

		$breadCrumb .= "<a href='".$CI->config->item('countryBeAction')."' >";
		$breadCrumb .= "".$CI->lang->line('lable.locations');
		$breadCrumb .= "</a>";
		
		$breadCrumb .= " > ";
		
		$breadCrumb .= "<a href='".$CI->config->item('stateListingBeAction')."/".$this->getUrlParams()."' >";
		$breadCrumb .= "".$this->getCountryObj()->getName();
		$breadCrumb .= "</a>";
			
		return $breadCrumb;
		
	}

	
}
/*end of file*/