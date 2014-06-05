<?php

class Poll extends CI_Controller {
	
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
		$this->load->library(array('poll_obj', 'poll_list','pollCategory_obj','session'));
		$this->load->helper('form');
		
		$this->load->model('poll_model');	
			//$this->load->model('country_model');	
			//$this->load->model('state_model');	
			//$this->load->model('city_model');	
			//$this->load->model('area_model');	
		
 		// Check for admin login, this function will automatically redirect to admin login page
			//$this->common_method->adminAuthentication();	
				
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
			//$this->listing();
		$this->createPoll();
			
	}
			
	/** 
	 * This function displays list of categories
	 * Function argument $argDataArr will hold any data that is required to be processed by this function
	 * @param $argData
	 */

	 
	
	function listing($argData = array())
	{			
		// Get data for query
		$listDataObj	= $this->user_list->getInstance($argData);
		
		$dataArr 		= $this->user_model->getList($listDataObj);
		// set values	
		$listDataObj->setDbDataArr($dataArr['dbDataArr']);
		$listDataObj->setTotalRecords($dataArr['totalRecords']);
		
		// Set Pagination
		$pageDataArr = $this->user_list->getPaginationArray();	
		$this->pagination->initialize($pageDataArr);
						
		// Pass values to View				
		$viewArr['listDataObj']		= $listDataObj;	 //This object will have everything that template/view is required	
				
		// Display output page		
		$viewArr['viewPage'] 	= "user";
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
		$listDataObj		= $this->user_list->getInstance();	
		
		// Check if this function is called from form-validation with parameter
		if (is_object($argRecordObj) && $argRecordObj != NULL ){
			// call from Validation form
			$recordObj		= $argRecordObj;					
		}else{
			// New call for either Add or Edit data
			$recordObj		= $this->user_model->getRecords($listDataObj->getId());
		}		

		// Based on recordObj set other parameters		
		if ($recordObj == NULL){ // Add operation
			$dataArr['oprType'] = OPR_ADD;
			$recordObj = new $this->user_obj;					 					
		}else { // Edit operation	
			$dataArr['oprType'] = OPR_EDIT;							
		}			
		
		// Set values in dataObj
		$listDataObj->setOprType($dataArr['oprType']);
		$listDataObj->setDbDataArr(array($recordObj));		
				
		// Pass data to view/template
		$viewArr['listDataObj']			= $listDataObj;
		
		// Get objects for Country-State-City-Area values
		$objArr = $this->common_method->getCountryStateCityAreaObjects($recordObj);
		$viewArr['countryObjArr'] 	= $objArr['countryObjArr'];
		$viewArr['stateObjArr']		= $objArr['stateObjArr'];
		$viewArr['cityObjArr']		= $objArr['cityObjArr'];
		$viewArr['areaObjArr']		= $objArr['areaObjArr'];
		
 		// Display output page		
		$viewArr['viewPage'] 	= "user_add_edit";
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
	 * This function deletes the user selected record
	 */
	function delete()	
	{	
		// Read inputs
		$ids = $this->input->post("selectedIds");  //ids will be comma separated. For example: 123,124,125
				
		if (!empty($ids)){
			// Execute query
			$queryFlag = $this->user_model->delete($ids);
			
			// Send status and message to view
			$dataArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED;		
			$dataArr['oprMessage'] 	= ($queryFlag == true) ? $this->lang->line('success.delete') : $this->lang->line('error.delete');		
							
			// Write operation details to log file	
			log_message('info', ( $queryFlag == true ? "Delete successful" : "Delete failed" ) ); 
		}
			
		// Set operation type
		$dataArr['oprType'] = OPR_DELETE;		

		// Get data object
		$listDataObj		= $this->user_list->getInstance($dataArr);				
		
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
	
	/**** Poll Class and new methods start here ****/
	

	
	
	 public function createPoll($action='',$id='')
	 {
	 
		 switch($action) {							// Action variable defines flow of control of the Create Poll Method
	

	
			case 'TEMPLATE':						// Create poll from template		
				break;	

				
			case 'SCRATCH' : 						// Create Poll from scratch
				$this->addPollForm();
				break;
	

			case 'CREATE' :						// Choose Add question or add dependency		
			$action = 'create';				
			$viewArr['viewArr'] = array('action'=>$action,'poll_id'=>$id);
			$viewArr['viewPage'] = 'create_poll';
			$this->load->view('layout',$viewArr);
			break;	



			case 'ADD_QUESTION' :						// Create a new question				
				$action = 'add_question';				
				$viewArr['viewArr'] = array('action'=>$action,'poll_id'=>$id);
				$viewArr['viewPage'] = 'create_poll';
				$this->load->view('layout',$viewArr);
				break;				

			default :								// Send user to select a Poll Type i.e scratch or template
		 		$action = 'select_type';				
				$viewArr['viewArr'] = array('action'=>$action);
				$viewArr['viewPage'] = 'create_poll';
				$this->load->view('layout',$viewArr);
				break;	
		 
		 
		 }
		
		
	 }
	 
	 
	function pollType($type='')
	{
		$this->poll_model->setType($type);
		$this->createPoll();
	
	}
	
	
	
	function addPollForm($argRecordObj = null)
	{		
		// Get data object and execute query
		$listDataObj		= $this->poll_list->getInstance();	
		
		// Check if this function is called from form-validation with parameter
		if (is_object($argRecordObj) && $argRecordObj != NULL ){
			// call from Validation form
			$recordObj		= $argRecordObj;					
		}else{
		
			
		
			// New call for either Add or Edit data
			$recordObj		= $this->poll_model->getRecords($listDataObj->getId());
		}		

		// Based on recordObj set other parameters		
		if ($recordObj == NULL){ // Add operation
			$dataArr['oprType'] = OPR_ADD;
			$recordObj = new $this->poll_obj;					 					
		}else { // Edit operation	
			$dataArr['oprType'] = OPR_EDIT;							
		}			
		
		// Set values in dataObj
		$listDataObj->setOprType($dataArr['oprType']);
		$listDataObj->setDbDataArr(array($recordObj));		
				
		// Pass data to view/template
		$viewArr['listDataObj']			= $listDataObj;
		

 		// Display output page	
		$action = 'poll_details';				
		$viewArr['viewArr'] = array('action'=>$action,'pollCategories'=>$this->poll_model->getPollCategories(),'recordObj'=>$recordObj,'oprType'=>$dataArr['oprType']);
		$viewArr['viewPage'] = 'create_poll';		
		$this->load->view('layout', $viewArr);
        
		// Write to log file	
		log_message('info', 'Add/Edit Form - displayed'); 								
	}
		


	function save()
	{		

		// Load form validation library 
		$this->load->library('form_validation');
		
		$dataArr = array();
				
		// Set operation type
		$dataArr['oprType'] = $this->input->post('oprType'); //Add or Edit

		// Set validation rules		
		$this->setFormValidationRules($dataArr);
		
		// Create buy_sell object based on user input
		$recordObj = $this->createRecordObj();
					
		// Validate data 		
		if ($this->form_validation->run() == FALSE)	{ //Validation failed					
			// Show add/edit form with recordObj
			if(isset($_POST['image'])) {
				if(trim($_POST['image'])!='')
					$recordObj->setImage($_POST['image']);
			}
			elseif(trim($this->input->post('upl_image'))!='')
				$recordObj->setImage($this->input->post('upl_image'));
				
			$this->addPollForm($recordObj);					
		}
		else  // Validation successful
		{				
			// Call model function to add/edit record
			
			if(isset($_POST['image'])) {
				if(trim($_POST['image'])!='')
					$recordObj->setImage($_POST['image']);
			}
			elseif(trim($this->input->post('upl_image'))!='')
				$recordObj->setImage($this->input->post('upl_image'));
			
			$queryFlag = $this->poll_model->save($recordObj);
			
			$dataArr['oprStatus'] 	= ($queryFlag == true) ? OPR_SUCCESS : OPR_FAILED; // oprStatus is used to apply CSS formating when message (success/failed) is shown to user
			$dataArr['oprMessage'] 	= $this->common_method->getMessage($dataArr['oprType'], $queryFlag); // Operation message, eg: Add Success or Edit Success etc
			
			// Show listing page, send the $dataArr for further processing
			redirect('/poll/createPoll/CREATE/'.$this->session->userdata('create_poll_id'));
		}				
			
	}

	
	/**
	 * This function creates buy_sell object having data provided by user.
	 */	
	function createRecordObj(){
		// Create buy_sell object, set values
		$recordObj = new $this->poll_obj;		
		
		// Check if id is "X", which is for Add operation. If "X", set id to NULL.
		//$id = ($this->input->post('id') == "X") ? NULL : $this->input->post('id');		
		$recordObj->setTitle($this->input->post('title'));	
		$recordObj->setDescp($this->input->post('descp'));	
		$recordObj->setPollCategory_id($this->input->post('pollCategory_id'));
		
		if(trim($_FILES['image']['name'])=='') {
			if($this->input->post('upl_image')!='')
				$recordObj->setImage( $this->input->post('upl_image')); 
		
		}

		return $recordObj;
	}

	
	
		function setFormValidationRules($argViewArr){
				
		// Check for non-empty, min and max length	
		$this->form_validation->set_rules('title', 'title', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('pollCategory_id', 'pollCategory_id', 'required');
		$this->form_validation->set_rules('descp', 'descp', 'xss_clean');
		if(isset($_FILES['image']))	
			$this->form_validation->set_rules('image', 'Image', 'callback_do_upload');	
		
		// Add more form validation rules here...
		// Set the error delims to a nice styled red hint under the fields
		$this->form_validation->set_error_delimiters('<div id="errorMsg">', '</div>');
	
	}
	
	
	 function do_upload() {
	if(trim($_FILES['image']['name']) != ''){
		
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '10000';
	   //$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = FALSE;
		$config['remove_spaces'] = TRUE;
		if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('image'))
		{
		  $this->form_validation->set_message('do_upload', $this->upload->display_errors());	  
		  return false;
		}
		else{
			$upload_data    = $this->upload->data();
			$_POST['image'] = $upload_data['file_name'];
			return true;
		}
	}
	else{
		return true;
	}
}
	public function addQuestion()
	{
		$questionType = $this->input->post('type');
		$question = $this->input->post('question');
		$ans_reqd = $this->input->post('required');
		$scale_sub_ques = array();
		$id = $this->input->post('poll_id');
		
		switch($questionType) {
		

		
			case 'SINGLE':		
				$options = $this->input->post('sng');
				$allow_text = $this->input->post('sng_allow_text');
				$options_label = array();
				$txt='NA';	
				break;
			
			case 'MULTIPLE':
				$options = $this->input->post('mlt');
				$allow_text = $this->input->post('mlt_allow_text');
				$options_label = array();
				$txt='NA';	
				break;
			
			case 'SCALE':
				$options = $this->input->post('scl');
				$options_label = $this->input->post('scl_label');
				$allow_text = 'NA';
				if($this->input->post('scl_sub_ques_count')!='' && $this->input->post('scl_sub_ques_count')!=0)
					$scale_sub_ques = $this->input->post('scl_sub_ques');
				else 
					$scale_sub_ques = array();
				$txt = 'NA';		
				break;
			
			case 'TEXT':
				$txt_type = $this->input->post('txt_type');
				$allow_text = 'NA';
				$options = array();	
				
			switch($txt_type) {
				case 'TEXT':
					$txt='Y';
					break;					
				case 'NUMBER':
					$txt = 'N';
					$min_value = $this->input->post('min_value');
					$max_value = $this->input->post('max_value');
					$min_label = MIN_VALUE;
					$max_label = MAX_VALUE;
					$options = array($min_value,$max_value);
					$options_label = array($min_label,$max_label);
					break;				
				}
			break;

		}
		
		$status = 'PUBLISHED';
		
		$this->poll_model->addQuestion($id,$questionType,$question,$allow_text,$status,$ans_reqd,$options,$allow_text,$options_label,$scale_sub_ques,$txt);
		
	
	
	
	}













	

	
}
/*end of file*/
	


