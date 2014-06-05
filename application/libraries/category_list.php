<?php

/**
 * Enter description here ...
 * @author Admin
 *
 */
class Category_list extends Base_list {
		
	function __construct(){
        // Write to log file
 		log_message('info', '--------------> Category_list - construct() called');		
	}

	// ---------------------------- Define other methods	
	
	// Implement all abstract methods defined in parent class
	function getInstance($argData = array()){
        // Write to log file
 		log_message('info', '--------------> Category_list - getInstance() called');		
				
		// Call parent method and set the values to the object
		parent::assignData($argData);	
				
		// Set values for properties defined in this class
		$this->assignMoreData($argData);
		
		// Set values specific to this feature
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		parent::setOtherParams($this->createOtherParams()); 	
		parent::setActionUrl($CI->config->item('categoryListingBeAction'));		
		parent::setSearchFieldArr($CI->config->item('categorySearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('categoryDbFieldBeArr'));
		parent::setBreadCrumb($this->createBreadCrumb());
		
		// Now, since all properties are defined - store value for sortFieldArr
		parent::computeSortFieldArr();
		
		// Return the object
		return $this; 
	}		
	
	function assignMoreData($argData = array()){	
        // Write to log file
 		log_message('info', '--------------> Category_list - assignMoreData() called');									
	}
	
	
	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		return DEFAULT_OTHER_PARAMS; // for category, other parameters are not requried, so set it default.
	}
	
	// This method will create required breadCrumb (lable with link)	
	function createBreadCrumb(){
	    // Write to log file
 		log_message('info', '--------------> Category_list - creatBreadCrumb() called');		
		
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Category > selected-category-name

		$breadCrumb .= "<a href='".$CI->config->item('categoryBeAction')."' >";
		$breadCrumb .= "Category";
		$breadCrumb .= "</a>";
			
		return $breadCrumb;
		
	}
	
	
}
/*end of file*/