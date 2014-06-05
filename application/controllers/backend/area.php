<?php

/**
 * 
 * This class is on area entity
 * @author Sandeep Raul
 *
 */

class Area extends CI_Controller {
	
	/** 
	 * 
	 * This is default constructor
	 */    
	function __construct() 
    {
        // Write to log file
 		log_message('info', '--------------> Area - construct() called');		
    	
    	// Call to Controller constructor
        parent::__construct();     
            		
        // Load helpers, models and library - autoload.php has defined common loads
		$this->load->library(array('area_obj', 'area_list'));
		$this->load->model('country_model');	
		$this->load->model('state_model');	
		$this->load->model('city_model');	
		$this->load->model('area_model');	
		
 		// Check for admin login, this function will automatically redirect to admin login page
		$this->common_method->adminAuthentication();	
				
		// Define array that will store values to be sent to view page
		$viewArr = array();	
 		
        // Write to log file
 		log_message('info', 'object created...');		
	}

	/** 
	 * 
	 * This is default function
	 */
	function index()
	{	
		// Display listing 		
		$this->listing();			
	}
			
	/** 
	 * This function displays list of categories
	 * Function argument $argDataArr will hold any data that is required to be processed by this function
	 * @param $argData
	 */
	
	function listing($argData = array())
	{			
		// Get data for query
		$listDataObj	= $this->area_list->getInstance($argData);
		
		$dataArr 		= $this->area_model->getList($listDataObj);
		// set values	
		$listDataObj->setDbDataArr($dataArr['dbDataArr']);
		$listDataObj->setTotalRecords($dataArr['totalRecords']);
		
		// Set Pagination
		$pageDataArr = $this->area_list->getPaginationArray();	
		$this->pagination->initialize($pageDataArr);
						
		// Pass values to View				
		$viewArr['listDataObj']		= $listDataObj;	 //This object will have everything that template/view is required	
				
		// Display output page		
		$viewArr['viewPage'] 	= "area";
		$this->load->view('backend/layout', $viewArr);
        
		// Write to log file	
		log_message('info', 'Listing - displayed'); 			
	}		
	
	function search()
	{		
		// Read input and sent it to query through array
		$querydataArr['searchField']    = $this->input->post("searchField");
		$querydataArr['searchText']  	= $this->input->post("searchText"); //need to clean this data
		
		// Check for non-empty, to avoid overwriting values ---  problme in Chrome browser
		if ( !empty($querydataArr['searchField']) && !empty($querydataArr['searchText'])  ){					
			//Store search data in session for paging
			$this->session->set_userdata("searchDataArr", $querydataArr);		
		}
		
		// Send it to view array
		$viewArr["searchDataArr"] 	= $querydataArr;
		
		// Show listing page, send the $viewArr for further processing
		$this->listing($viewArr);			
	}	
		
	
/**
 * 
 * This function performs add edit operations
 * @param unknown_type $argRecordObj
 */
	
	function addEditForm($argRecordObj = null)
	{		
		// Get data object and execute query
		$listDataObj		= $this->area_list->getInstance();	
		
		// Check if this function is called from form-validation with parameter
		if (is_object($argRecordObj) && $argRecordObj != NULL ){
			// call from Validation form
			$recordObj		= $argRecordObj;					
		}else{
			// New call for either Add or Edit data
			$recordObj	= $this->area_model->getRecords($listDataObj->getId());
		}		

		// Based on recordObj set other parameters		
		if ($recordObj == NULL){ // Add operation
			$dataArr['oprType'] = OPR_ADD;
			$recordObj = new $this->area_obj;					 					
		}else { // Edit operation	
			$dataArr['oprType'] = OPR_EDIT;							
		}			
						
		// Set values in dataObj
		$listDataObj->setOprType($dataArr['oprType']);
		$listDataObj->setDbDataArr(array($recordObj));		
				
		// Pass data to view/template
		$viewArr['listDataObj']		= $listDataObj;
		
 		// Display output page		
		$viewArr['viewPage'] 	= "area_add_edit";
		$this->load->view('backend/layout', $viewArr);
        
		// Write to log file	
		log_message('info', 'Add/Edit Form - displayed'); 								
	}
	
	
	/** 
	 * 
	 * This function performs add and edit operations. For add operation, record will be inserted while for edit operation, record will be updated.
	 */
	function save()
	{
		// Load form validation library 
		$this->load->library('form_validation');
				
		// Set operation type
		$dataArr['oprType'] = $this->input->post('oprType'); //Add or Edit

		// Set validation rules		
		$this->setFormValidationRules($dataArr);
		
		// Create area object based on user input
		$recordObj = $this->createRecordObj();
				
		// Validate data 		
		if ($this->form_validation->run() == FALSE)	{ //Validation failed					
			// Show add/edit form with recordObj
			$this->addEditForm($recordObj);						
		}
		else  // Validation successful
		{				
			// Call model function to add/edit record
			$queryFlag = $this->area_model->save($recordObj);
			
			$dataArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED; // oprStatus is used to apply CSS formating when message (success/failed) is shown to user
			$dataArr['oprMessage'] 	= $this->common_method->getMessage($dataArr['oprType'], $queryFlag); // Operation message, eg: Add Success or Edit Success etc
			
			// Show listing page, send the $dataArr for further processing
			$this->listing($dataArr);
		}				
			
	}
	
	
	/**
	 * This function creates area object having data provided by user.
	 */	
	function createRecordObj(){
		// Create area object, set values
		$recordObj = new $this->area_obj;		
		
		// Check if id is "X", which is for Add operation. If "X", set id to NULL.
		$id = ($this->input->post('id') == "X") ? NULL : $this->input->post('id');
		$recordObj->setId($id);
		$recordObj->setName($this->input->post('name'));
		$recordObj->setStatus($this->input->post('status'));
		$recordObj->setCityId($this->input->post('cityId'));		
		
		return $recordObj;
	}
	
	
	
	
	/** 
	 * This function deletes the user selected record
	 */
	function delete()	
	{	
		// Read inputs
		$ids = $this->input->post("selectedIds");  //ids will be comma separated. For example: 123,124,125
				
		if (!empty($ids)){
			// Execute query
			$queryFlag = $this->area_model->delete($ids);
			
			// Send status and message to view
			$dataArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED;		
			$dataArr['oprMessage'] 	= ($queryFlag == true) ? $this->lang->line('success.delete') : $this->lang->line('error.delete');		
							
			// Write operation details to log file	
			log_message('info', ( $queryFlag == true ? "Delete successful" : "Delete failed" ) ); 
		}
			
		// Set operation type
		$dataArr['oprType'] = OPR_DELETE;		

		// Get data object
		$listDataObj		= $this->area_list->getInstance($dataArr);				
		
		// Read URI parameters and sent them to view for listing
		$dataArr['searchFlag'] 	= $listDataObj->getSearchFlag();
		$dataArr['limitOffset'] = $this->common_method->getLimitOffsetAfterDelete($ids, $listDataObj);
		
		// Show listing page, send the $viewArr for further processing
		$this->listing($dataArr);
						
	}	
		
		
	/**
	 * 
	 * This function sets all validation rules on user input (form data)
	 * @param $argViewArr
	 */
	function setFormValidationRules($argViewArr){

		// For Edit operation, user is allowed to change area-name. Check if name is changed, if yes, perform unique validation within the city
		if( $argViewArr['oprType'] == OPR_EDIT && (trim($this->input->post('name')) == $this->input->post('oldName')) ){
			// No change in name, therefore no need to check for uniqueness
			$this->form_validation->set_rules('name', 'Area Name', 'trim|required|min_length['.NAME_MIN_LENGTH.']|max_length['.NAME_MAX_LENGTH.']|xss_clean');	
		}else{
			// for Add operation OR name changed, check for uniqueness
			$this->form_validation->set_rules('name', 'Area Name', 'trim|required|min_length['.NAME_MIN_LENGTH.']|max_length['.NAME_MAX_LENGTH.']|xss_clean|callback_isUniqueName[name]');	
		}		
		
		// Add more form validation rules here...

		// Set the error delims to a nice styled red hint under the fields
		$this->form_validation->set_error_delimiters('<div id="errorMsg">', '</div>');
	
	}

	
		
	/**
	 * 
	 *This function checks for unique area name
	 * @param $argName
	 */
	function isUniqueName($argName){
		
		$cityId = $this->input->post('cityId');
		
		// Check whether name is present or not by calling method from Model		
		$presentFlag = $this->area_model->isNamePresent($argName, $cityId);
		
		// Check the flag
		if ($presentFlag == true){
			// Name found in database
			$this->form_validation->set_message('isUniqueName', $this->lang->line('info.duplicate.area'));
			return false;			
		}else{
			// Name is unique - not found in database
			return true;						
		}		
	}
		
	
	/**
	 * 
	 * This method is called by ajaxCall
	 */
		
	function getList(){
		//get list of areas 
		$areaId 	= null;	
		$cityId = $this->input->post('cityId'); // Note that this parameter is sent by AJAX call
		
		$areaArr 	= $this->area_model->getRecords($areaId, $cityId, ACTIVE); 
		echo json_encode($areaArr);
		exit;
	}	
	
}
/*end of file*/
	


