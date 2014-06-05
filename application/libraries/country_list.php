<?php


/**
 * Enter description here ...
 * @author Admin
 *
 */
class Country_list extends Base_list {
		
	function __construct(){	}
		
	// Implement all abstract methods defined in parent class
	function getInstance($argData = array()){

		// Call parent method and set the values to the object
		parent::assignData($argData);	
				
		// Set values for properties defined in this class
		$this->assignMoreData($argData);
		
		// Set values specific to this feature
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		parent::setOtherParams($this->createOtherParams());
		parent::setActionUrl($CI->config->item('countryListingBeAction'));
		parent::setSearchFieldArr($CI->config->item('countrySearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('countryDbFieldBeArr'));
		parent::setBreadCrumb($this->creatBreadCrumb());
		
		// Now, since all properties are defined - store value for sortFieldArr 
		parent::computeSortFieldArr();
		
		// Return the object		
		return $this; 
	}		
	
	function assignMoreData($argData = array()){	
		// Store values in properties defined for this class
		
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
							
	}
	
	// ---------------------------- Define other methods
	
	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		return DEFAULT_OTHER_PARAMS; // for category, other parameters are not requried, so set it default.
	}
	
	// This method will create required breadCrumb (lable with link)	
	function creatBreadCrumb(){
	
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Country > selected-country-name

		$breadCrumb .= "<a href='".$CI->config->item('countryBeAction')."' >";
		$breadCrumb .= "".$CI->lang->line('lable.locations');
		$breadCrumb .= "</a>";
			
		return $breadCrumb;
		
	}
	
	
}
/*end of file*/