<?php


/**
 * Enter description here ...
 * @author Admin
 *
 */
class Sub_category_type_list extends Base_list {

	// Define parameters specific to this class
	private $categoryObj;
	private $subCategoryObj;
		
	function __construct(){	}

	// --------- Define Getter methods
	
	function getCategoryObj(){ return $this->categoryObj; }		
	function getSubCategoryObj(){ return $this->subCategoryObj; }	
	
	// --------- Define other methods
		
	// Implement all abstract methods defined in parent class
	function getInstance($argData = array()){

		// Call parent method and set the values to the object
		parent::assignData($argData);	
				
		// Set values for properties defined in this class
		$this->assignMoreData($argData);
		
		// Set values specific to this feature
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		parent::setOtherParams($this->createOtherParams()); 					
		parent::setActionUrl($CI->config->item('subCategoryTypeListingBeAction'));
		parent::setSearchFieldArr($CI->config->item('subCategoryTypeSearchFieldBeArr'));
		parent::setDbFieldArr($CI->config->item('subCategoryTypeDbFieldBeArr'));
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
		$subCategoryId = $CI->uri->segment(URI_OTHER_PARAMS);		
		if ($subCategoryId == null){					
			if (is_array($argData) && isset($argData["subCategoryId"])){
				$subCategoryId = 	$argData["subCategoryId"];					
			}else{			
				// Set it to default
				$subCategoryId = DEFAULT_SUB_CATEGORY_ID;					
			}
		}

		//Using $subCategoryId, get the category object and store it in this class for future reference
		$this->subCategoryObj = $CI->sub_category_model->getRecords($subCategoryId);
		
		if ($this->subCategoryObj != null){
			$this->categoryObj = $CI->category_model->getRecords($this->subCategoryObj->getCategoryId());			
		} 
		
	}
		
	// Method that will compute Other parameters to be sent over URL
	function createOtherParams(){
		
		return $this->getSubCategoryObj()->getId();
		
	}	
	
	// This method will create required breadCrumb (lable with link)	
	function creatBreadCrumb(){
	
		$CI =& get_instance(); 		// Get reference to CodeIgniter instance		
		
		$breadCrumb = "";
		// BreadCrumb format required: Category > selected-category-name > selected-sub-category-name > List

		$breadCrumb .= "<a href='".$CI->config->item('categoryBeAction')."' >";
		$breadCrumb .= "Category";
		$breadCrumb .= "</a>";
		
		$breadCrumb .= " > ";		
		
		$urlParams = "".DEFAULT_ID."/".$this->getCategoryObj()->getId()."/".DEFAULT_SORT_ORDER."/".DEFAULT_SORT_FIELD."/".DEFAULT_SEARCH_FLAG;
		$breadCrumb .= "<a href='".$CI->config->item('subCategoryListingBeAction')."/".$urlParams."' >";
		$breadCrumb .= "".$this->getCategoryObj()->getName();
		$breadCrumb .= "</a>";
		
		$breadCrumb .= " > ";		
		
		$breadCrumb .= "<a href='".$CI->config->item('subCategoryTypeListingBeAction')."/".$this->getUrlParams()."' >";
		$breadCrumb .= "".$this->getSubCategoryObj()->getName();
		$breadCrumb .= "</a>";	
		
			
		return $breadCrumb;
		
	}
	
	
	
}
/*end of file*/