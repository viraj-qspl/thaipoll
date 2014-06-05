<?php

/**
 * Class that holds common properties with respect to listing records of all entity objects like Category, Member etc
 *
 * @author Sandeep Raul
 * @version 1.5
 * @since 20 Feb 2012
 *
 */

class Base_list_abstract {
	// This is a dummy class so that below abstract class is loaded into memory.
}

/* Define main abstract class that will contain common properties and methods */

abstract class Base_list {

	/* define all common properties for all entity objects */
	
	private $id; // Id of the record 		
	private $otherParams; // Added 21Oct12. To accomodate 'N' number of additional parameters like parent-id, type etc.
						  // Values would be combined using "-" separater. E.g.: 101, 101-203, 101-203-104 etc
	
	// Operations
	private $oprType;
	private $oprStatus;
	private $oprMessage;
	
	// Listing data fields and values
	private $actionUrl; // This holds the action url to Listing page
	private $dbFieldArr; // This holds the listing fields (database-table-name and their equivalent descriptive name)
	private $dbDataArr; // This holds listing object data values
	
	// Search
	private $searchFieldArr; // This holds the search fields
	private $searchFlag;
	private $searchField;
	private $searchText;
	private $searchDefaultText;	

	// Sorting
	private $sortFieldArr;  // This holds the listing fields with links for sorting
	private $sortFieldIndex; 
	private $sortOrder;
	
	// Limit
	private $limitRows;
	private $limitOffset; // This property should be always last, as it is the last on URI
			
	// Other
	private $totalRecords;	
	
	/**
	 * This variable holds the paramertes sent over URL. Which includes, id, otherParams, sorting fields, etc
	 * CodeIgnitor's pagination plugin automatically adds limit-offset, hence we are not adding the limit offset value to the string.
	 * Note that, there can be extra parameters on the URL depending upon feature. The limit offset has to be always at the end.
	 * @var $urlParams
	 */
	private $urlParams; 
		
	
	private $breadCrumb; // Added 20oct12, This will store breadCrumb on listing page

	
	// --------- Define all Getter Methods --------------------
	
	public function getId(){ return $this->id; }
	
	public function getOtherParams(){ return $this->otherParams; }
	
	public function getOprType(){ return $this->oprType; }
	
	public function getOprStatus(){ return $this->oprStatus; }
	
	public function getOprMessage(){ return $this->oprMessage; }
	
	public function getOprMessageFormated(){ 
		$msg = "";
		
		// Check for any message
		if(!empty($this->oprMessage) && !empty($this->oprStatus)) {				
			// format message with success div
			if ($this->oprStatus == OPR_SUCCESS){
				$msg = "<div id='successMsg' >" . $this->oprMessage . "</div>";		
			}							
			// format message with error div			
			if ($this->oprStatus == OPR_FAILED){
				$msg = "<div id='errorMsg' >" . $this->oprMessage . "</div>";		
			}				
		}				
		return $msg; 	
	}	
		
	public function getActionUrl(){ return $this->actionUrl; }	
	
	public function getDbFieldArr(){ return $this->dbFieldArr; }
			
	public function getDbDataArr(){ return $this->dbDataArr; }
	
	public function getSearchFieldArr(){ return $this->searchFieldArr; }	
	
	public function getSearchFlag(){ return $this->searchFlag; }

	public function getSearchField(){ return $this->searchField; }

	public function getSearchText(){ return $this->searchText; }
	
	public function getSearchDefaultText(){
		$this->searchDefaultText = "";
		if($this->searchFlag == SEARCH_FLAG_TRUE){
			$this->searchDefaultText = $this->searchText;
		}		
		return $this->searchDefaultText;	
	}	
			
	public function getSortFieldArr(){ return $this->sortFieldArr; }
	
	public function getSortFieldIndex(){ return $this->sortFieldIndex; }

	public function getSortOrder(){ return $this->sortOrder; }	
		
	// This method is used in all models
	public function getLimitRows($appType = APP_FRONTEND){
		$recPerPage = ($appType == APP_FRONTEND)? RECORDS_PER_PAGE : RECORDS_PER_PAGE_BE ;		
		return isset($this->limitRows) ? $this->limitRows : $recPerPage;						
	}
	
	// This method is used in all models. Limit offset URI segment will vary depending upon controller
	public function getLimitOffset(){ 
		$CI =& get_instance();				
		$this->limitOffset = $CI->uri->segment(URI_LIMIT_OFFSET);					
		if ($this->limitOffset == null){ // if there is no value at specified URI segment
			$this->limitOffset  = DEFAULT_LIMIT_OFFSET;	// Set default value			
		}		
		return $this->limitOffset;		
	}	
	
	public function getTotalRecords(){ return $this->totalRecords; }
		
	public function getUrlParams($paramType = null){
		// the return the value based on paramType
		$params = "";
		if ($paramType == PARAM_LISTING){ // added 27oct12 as for all Listing links, parentId is sent as OtherParameter 
			$params = DEFAULT_ID."/".$this->id."/".$this->sortOrder."/".$this->sortFieldIndex."/".$this->searchFlag; 			
		} else if ($paramType == PARAM_ADD){ // added 27oct12 as for Add, id is always nil and other parameters can be foriegn keys
			$params = DEFAULT_ID."/".$this->otherParams."/".$this->sortOrder."/".$this->sortFieldIndex."/".$this->searchFlag; 			
		} else {
			$params = $this->id."/".$this->otherParams."/".$this->sortOrder."/".$this->sortFieldIndex."/".$this->searchFlag;
		} 
		return $params;
	}
			
	public function getBreadCrumb(){ return $this->breadCrumb; }
	
	
	
	// --------- Define all Setter Methods --------------------		
	
	function setId($id){	$this->id = $id; }	
	
	function setOtherParams($params){	$this->otherParams = $params; }	
	
	function setOprType($argOprType){ $this->oprType = $argOprType; }	
	
	function setOprStatus($argOprStatus){ $this->oprStatus = $argOprStatus; }	
	
	function setOprMessage($argOprMessage){ $this->oprMessage = $argOprMessage; }	
	
	function setActionUrl($argActionUrl){ $this->actionUrl = $argActionUrl; }
	
	function setDbFieldArr($argDbFieldArr){ $this->dbFieldArr = $argDbFieldArr; }
		
	function setDbDataArr($argDbDataArr){ $this->dbDataArr = $argDbDataArr; }
	
	function setSearchFieldArr($argSearchFieldArr){ $this->searchFieldArr = $argSearchFieldArr; }	
	
	function computeSortFieldArr(){ 				
		
		$dbFieldArr 	= $this->getDbFieldArr();		
		
		$fieldInd = 0;
		foreach ($dbFieldArr as $field	=> $label){
			// Check for sort order and replace it within the UrlParams string
			$sortOrder 			= (($this->sortFieldIndex==$fieldInd) && ($this->sortOrder == SORT_ASC_ORDER)) ? SORT_DESC_ORDER : SORT_ASC_ORDER ; 		
			$columnLink 		= $this->getActionUrl()."/".DEFAULT_ID."/".$this->otherParams."/".$sortOrder."/".$fieldInd."/".$this->searchFlag; 	
			$fieldArr[$field] 	= "<a href='".$columnLink."'>".$label."</a>";			
			$fieldInd++;
		}				
		$this->sortFieldArr = $fieldArr;
		
		
		
	}	
			
	function setTotalRecords($totalRecords){ $this->totalRecords = $totalRecords; }		
	
	function setUrlParams($argUrlParams){ $this->urlParams = $argUrlParams;	}
		
	function setBreadCrumb($argBreadCrumb){ $this->breadCrumb = $argBreadCrumb;	}
	
	
	//-------------- Define other methods  ---------------

	
	// Define method that initialise the object	
	function assignData($argData = array()){
						
        // Write to log file
 		log_message('info', '--------------> Base_list - assignData() called');		
				
		$CI =& get_instance(); //This is required to get the reference to CodeIgnitor object
				
		// Check for $id
		$this->id = $CI->uri->segment(URI_ID);	  
		if ($this->id == null){
			$this->id = DEFAULT_ID;	
		} else if (isset($argData['id'])){
			$this->id = $argData['id'];	
		}
		
		// set otherParams to default value		
		$this->otherParams = DEFAULT_OTHER_PARAMS;		
		
		// set oprType
		if (isset($argData['oprType'])){
			$this->oprType = $argData['oprType'];	
		}else{
			$this->oprType = OPR_LIST; //default
		}		
		
		// set oprStatus
		if (isset($argData['oprStatus'])){
			$this->oprStatus = $argData['oprStatus'];	
		}				
		
		// set oprMessage
		if (isset($argData['oprMessage'])){
			$this->oprMessage = $argData['oprMessage'];	
		}		
		
		// Check for $sortFieldIndex
		$this->sortFieldIndex = $CI->uri->segment(URI_SORT_FIELD);		
		if ($this->sortFieldIndex == null){
			$this->sortFieldIndex = DEFAULT_SORT_FIELD;	
		}
		
		// Check for $sortOrder
		$this->sortOrder = $CI->uri->segment(URI_SORT_ORDER);		
		if ($this->sortOrder == null){
			$this->sortOrder = DEFAULT_SORT_ORDER;
		}

		// Check for search
		// set the flag to default value
		$this->searchFlag	= SEARCH_FLAG_FALSE;				
		$searchDataArr = $this->getSearchDetails($argData);		
		// extract $searchDataArr and store them in class variables
		if (!empty($searchDataArr)){
			// store values in class fields
			$this->searchFlag	= SEARCH_FLAG_TRUE;			
			$this->searchField 	= $searchDataArr["searchField"];
			$this->searchText 	= $searchDataArr["searchText"];
		}								
				
		// Set records per page		
		$this->limitRows    	= RECORDS_PER_PAGE_BE;
		
		// set Url Parameters
		$this->urlParams = $this->getUrlParams();
				
	} // end
		
	
	// Functions to process search parameters
	public function getSearchDetails($argData = array()){				
		// Write to log file
 		log_message('info', '--------------> Base_list - getSearchDetails() called');		
		
		$CI =& get_instance(); // get CI instance
		
		// define variables	
		$searchArr = array();
				
		// check if search data is directly sent to listing
		if (is_array($argData) && count($argData)>0 && !empty($argData["searchDataArr"])>0){
			// read data from array
			$searchArr		= $argData["searchDataArr"];
		}else {
			if ($CI->uri->segment(URI_SEARCH_FLAG) == SEARCH_FLAG_TRUE){
				// read data from session
				$searchArr		= $CI->session->userdata("searchDataArr"); 
			}				
		}		
		return $searchArr;
	}	
	
	
	public function getPaginationArray(){						
		$pageArr['base_url'] 			= $this->getActionUrl()."/".$this->getUrlParams()."/"; //Note: End the URL with '/'. Offset number will be auto added at the end.
		$pageArr['total_rows'] 			= $this->getTotalRecords();		
		$pageArr['per_page'] 			= RECORDS_PER_PAGE_BE; // defined in constant file  
		$pageArr['uri_segment']  		= URI_LIMIT_OFFSET; // indicates position on URI that will have limit offset value
		$pageArr['page_query_string'] 	= FALSE; 
		
		return $pageArr;
	}	
	
	
	//-------------- Define abstract methods - every subclass must define them  ----------------
	
	abstract function getInstance($data=array());	
	abstract function assignMoreData($data=array());
	//abstract function createOtherParams();	
	//abstract function createBreadCrumb();
	

}
/*end of file*/