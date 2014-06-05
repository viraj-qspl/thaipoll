<?php


/**
 * Enter description here ...
 * @author Admin
 *
 */
class Sub_category_list extends Base_list {

	// Define parameters specific to this class
	private $categoryObj;
	
	function __construct(){}

	// ---- Define getter
	function getCategoryObj(){ return $this->categoryObj; }	
	
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
		parent::setActionUrl($CI->config->item('subCategoryListingBeAction'));
		parent::setSearchFieldArr($CI->config->item('subCategorySearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('subCategoryDbFieldBeArr'));
		parent::setBreadCrumb($this->createBreadCrumb());
		
		// Now, since all properties are defined - store value for sortFieldArr 
		parent::computeSortFieldArr();
		
		// Return the object
		return $this; 
	}		
	
	
	function assignMoreData($argData = array()){	
		// Store values in properties defined for this class
		
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		// read the value from URI and store it in class variable		
		$categoryId = $CI->uri->segment(URI_OTHER_PARAMS); // Presently only one parameter (categoryId) is sent using OTHER PARAMs		
		if ($categoryId == null){					
			if (is_array($argData) && isset($argData["categoryId"])){
				$categoryId = 	$argData["categoryId"];					
			}else{			
				// Set it to default
				$categoryId = DEFAULT_CATEGORY_ID;					
			}
		}

        // Write to log file
 		log_message('info', '--------------> Sub_category_list,  categoryId = ' . $categoryId);		
		
		//Using $categoryId, get the category object and store it in this class for future reference
		$this->categoryObj = $CI->category_model->getRecords($categoryId);
							
	}		
	
	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		return $this->getCategoryObj()->getId();
	}	
	
	// This method will create required breadCrumb (lable with link)	
	function createBreadCrumb(){
	
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Category > selected-category-name > List

		$breadCrumb .= "<a href='".$CI->config->item('categoryBeAction')."' >";
		$breadCrumb .= "Category";
		$breadCrumb .= "</a>";
		
		$breadCrumb .= " > ";
				
		$breadCrumb .= "<a href='".$CI->config->item('subCategoryListingBeAction')."/".$this->getUrlParams()."' >";
		$breadCrumb .= "".$this->getCategoryObj()->getName();
		$breadCrumb .= "</a>";
			
		return $breadCrumb;
		
	}

	
}
/*end of file*/