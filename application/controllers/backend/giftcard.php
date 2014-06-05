<?php

class Giftcard extends CI_Controller {
	
	/** 
	 * 
	 * This is default constructor
	 */    
	function __construct() 
    {
        // Write to log file
 		log_message('info', '--------------> User - construct() called');		
    	
    	// Call to Controller constructor
        parent::__construct();     
            		
        // Load helpers, models and library - autoload.php has defined common loads
		$this->load->library(array('giftcard_obj', 'giftcard_list'));
		$this->load->model('giftcard_model');
/**		
		$this->load->model('country_model');	
		$this->load->model('state_model');				// OLD CODE NOT NEEDED //
		$this->load->model('city_model');	
		$this->load->model('area_model');	
**/		
 		// Check for admin login, this function will automatically redirect to admin login page
		$this->common_method->adminAuthentication();	
				
		// Define array that will store values to be sent to view page
		$viewArr = array();		
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
		$listDataObj	= $this->giftcard_list->getInstance($argData);
		
		$dataArr 		= $this->giftcard_model->getList($listDataObj);
		// set values	
		$listDataObj->setDbDataArr($dataArr['dbDataArr']);
		$listDataObj->setTotalRecords($dataArr['totalRecords']);
		
		// Set Pagination
		$pageDataArr = $this->giftcard_list->getPaginationArray();	
		$this->pagination->initialize($pageDataArr);
						
		// Pass values to View				
		$viewArr['listDataObj']		= $listDataObj;	 //This object will have everything that template/view is required	
				
		// Display output page		
		$viewArr['viewPage'] 	= "giftcard";
		$this->load->view('backend/layout', $viewArr);
        
		// Write to log file	
		log_message('info', 'Listing - displayed'); 			
	}	

	
	/** 
	 * 
	 * This function performs Search functionality
	 */

	
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
	 * This function displays form to Add or Edit record
	 */
	 
	 
	function addEditForm($argRecordObj = null)
	{		
		// Get data object and execute query
		$listDataObj		= $this->giftcard_list->getInstance();	
		
		// Check if this function is called from form-validation with parameter
		if (is_object($argRecordObj) && $argRecordObj != NULL ){
			// call from Validation form
			$recordObj		= $argRecordObj;					
		}else{
			// New call for either Add or Edit data
			$recordObj		= $this->giftcard_model->getRecords($listDataObj->getId());
		}		

		// Based on recordObj set other parameters		
		if ($recordObj == NULL){ // Add operation
			$dataArr['oprType'] = OPR_ADD;
			$recordObj = new $this->giftcard_obj;					 					
		}else { // Edit operation	
			$dataArr['oprType'] = OPR_EDIT;							
		}			
		
		// Set values in dataObj
		$listDataObj->setOprType($dataArr['oprType']);
		$listDataObj->setDbDataArr(array($recordObj));		
				
		// Pass data to view/template
		$viewArr['listDataObj']			= $listDataObj;
		
/**		// Get objects for Country-State-City-Area values
		$objArr = $this->common_method->getCountryStateCityAreaObjects($recordObj);				// OLD CODE NOT NEEDED

		
		$viewArr['countryObjArr'] 	= $objArr['countryObjArr'];
		$viewArr['stateObjArr']		= $objArr['stateObjArr'];
		$viewArr['cityObjArr']		= $objArr['cityObjArr'];
		$viewArr['areaObjArr']		= $objArr['areaObjArr'];
		
**/				

 		// Display output page		
		$viewArr['viewPage'] 	= "giftcard_add_edit";
		$this->load->view('backend/layout', $viewArr);
        
		// Write to log file	
		log_message('info', 'Add/Edit Form - displayed'); 								
	}
	
	/**
	 * 
	 * This function will upload images related to buy/sell
	 * @param $argRecordObj
	 */
	

	function uploadImageForm(){
		// Read parameters
		// Get data object - read the parameter using URI segments
		$listDataObj		= $this->user_list->getInstance();
		
		// Get record object using Id
		$recordObjArr		= $this->user_model->getRecords(array("id" => $listDataObj->getId()));
		$recordObj			= $recordObjArr[0]; // get the first element
		
		// Get images details if already uploaded for listing
		$imageDetailsArr	= $this->image_gallery_model->getRecords($this->config->item('tbl_user_image','dbtables'),  $listDataObj->getId());
				
		// Pass the recordObj to view for displaying data
		$viewArr['listDataObj']		= $listDataObj;		
		$viewArr['recordObj']		= $recordObj;
		$viewArr['imageDetailsArr']	= $imageDetailsArr;		
		
 		// Display output page		
		$viewArr['viewPage'] 	= "user_upload_image";
		$this->load->view('backend/layout', $viewArr);
        
		// Write to log file	
		log_message('info', 'Upload Image Form - displayed'); 								
				
	}
	
	function uploadImage(){	
		
		$config['upload_path'] 		= $this->config->item('userUploadOrgPath'); 		
		$config['allowed_types'] 	= $this->config->item('imageTypes'); 
		$config['max_size']			= $this->config->item('imageMaxSize');
		$config['file_name']		= strtotime("now"); // date-timestamp
		$config['overwrite']	    = FALSE; // If set to false, a number will be appended to the filename if another with the same name exists.
						
		/*$config['max_width']  	= $this->config->item('imageMaxWidth');
		$config['max_height']  		= $this->config->item('imageMaxHeight'); */

		//read post parameters
		
		$entityId	= $this->input->post("id");
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			echo '<div id="status">error</div>';
			echo '<div id="message">'. $this->upload->display_errors() .'</div>';
		}
		else
		{
			// get the uploaded file details
			$data = array('upload_data' => $this->upload->data());
		    
			// create thumbnails
			$this->createThumbnail($data['upload_data']['file_name'], THUMB_SMALL_SIZE);
			//$this->createThumbnail($data['upload_data']['file_name'], THUMB_MEDIUM_SIZE);
						
			// written output to ajax call
			echo '<div id="status">success</div>';
			echo '<div id="message">'. $data['upload_data']['file_name'] .' Successfully uploaded.</div>';
			
			//create listingimage obj and insert record in database
			$entityImageObj = new $this->image_gallery_obj;
			$entityImageObj->setId(null);
			$entityImageObj->setEntityId($entityId);
			$entityImageObj->setFilename($data['upload_data']['file_name']);
			$entityImageObj->setIsMainImage(false);

			$oprResult		= $this->image_gallery_model->save($this->config->item('tbl_user_image','dbtables'), $entityImageObj);
						
			if ($oprResult){			
				//Now, pass the data to js
				echo '<div id="upload_data">'. json_encode($data) . '</div>';
			}else{
				echo '<div id="message">'. "Error in saving image data". '</div>';
			}
						
		}
	}

	
 	function createThumbnail($uploadedFilename, $thumbSize){
			$thumbFileName 		= $thumbSize ."_". $uploadedFilename ; // prefix thumbsize (so that you dont loose file extension) to filename to distinguish thumbs
			$orgFileWithPath 	= $this->config->item('userUploadOrgPath') ."/". $uploadedFilename; 
			$thumbFileWithPath 	= $this->config->item('userUploadThumbPath') ."/". $thumbFileName; 
			
		    $imageObj 	= new $this->image_obj;		    
		    $status 	= $imageObj->getThumbnail($orgFileWithPath, $thumbFileWithPath, $thumbSize);
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

		// Create buy_sell object based on user input
		$recordObj = $this->createRecordObj();
				
		// Validate data 		
		if ($this->form_validation->run() == FALSE)	{ //Validation failed					
			// Show add/edit form with recordObj
			$this->addEditForm($recordObj);						
		}
		else  // Validation successful
		{				
			// Call model function to add/edit record
			$queryFlag = $this->giftcard_model->save($recordObj);
			
			$dataArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED; // oprStatus is used to apply CSS formating when message (success/failed) is shown to user
			$dataArr['oprMessage'] 	= $this->common_method->getMessage($dataArr['oprType'], $queryFlag); // Operation message, eg: Add Success or Edit Success etc
			
			// Show listing page, send the $dataArr for further processing
			$this->listing($dataArr);
		}				
			
	}

	
	/**
	 * This function creates buy_sell object having data provided by user.
	 */	
	function createRecordObj(){
		// Create buy_sell object, set values
		$recordObj = new $this->giftcard_obj;		
		
		// Check if id is "X", which is for Add operation. If "X", set id to NULL.
		$id = ($this->input->post('id') == "X") ? NULL : $this->input->post('id');		
		$recordObj->setId($id);		
		$recordObj->setDescp($this->input->post('descp'));
		$recordObj->setTitle($this->input->post('title'));
		$recordObj->setValue($this->input->post('value'));
		$recordObj->setPoints($this->input->post('points'));
		$recordObj->setStatus($this->input->post('status'));
		

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
			$queryFlag = $this->giftcard_model->delete($ids);
			
			// Send status and message to view
			$dataArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED;		
			$dataArr['oprMessage'] 	= ($queryFlag == true) ? $this->lang->line('success.delete') : $this->lang->line('error.delete');		
							
			// Write operation details to log file	
			log_message('info', ( $queryFlag == true ? "Delete successful" : "Delete failed" ) ); 
		}
			
		// Set operation type
		$dataArr['oprType'] = OPR_DELETE;		

		// Get data object
		$listDataObj		= $this->giftcard_list->getInstance($dataArr);				
		
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
				
		// Check for non-empty, min and max length;		
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length['.NAME_MIN_LENGTH.']|max_length['.NAME_MAX_LENGTH.']|xss_clean');	
		$this->form_validation->set_rules('desc', 'Description', 'xss_clean');
		$this->form_validation->set_rules('points', 'Points', 'required|numeric');
		$this->form_validation->set_rules('value', 'value', 'required|numeric');			
		
		// Add more form validation rules here...
		// Set the error delims to a nice styled red hint under the fields
		$this->form_validation->set_error_delimiters('<div id="errorMsg">', '</div>');
	
	}

	function isValidCategory($argValue){				
		// Check, if the option value is ZERO
		if ($argValue == 0){
			$this->form_validation->set_message('isValidCategory', "Please Select Category.");			
			return false;									
		}else{
			return true;									
		}		
	}
	
	function isValidSubCategory($argValue){				
		// Check, if the option value is ZERO
		if ($argValue == 0){
			$this->form_validation->set_message('isValidSubCategory', "Please Select Sub-category.");			
			return false;									
		}else{
			return true;									
		}		
	}
	
	

	
}
/*end of file*/
	


