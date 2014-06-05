<?php

class State_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('state_obj');					
		$this->config->load('dbtables', TRUE);
	}
		
	// Get single or all categories
	// This will return array with two elements, 1st element will have count (total records without limit for paging), 2nd element will have list of records (with limit)
	function getList($argDataObj = null)
	{					
		// Define return array variable
		$returnArr = array();
		
		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
		
		// SELECT and FROM table
		$selectStmt 	= " SELECT * ";
		$fromTable		= " FROM " . $this->config->item('tbl_state','dbtables');		
		$queryStmt 		= $selectStmt . $fromTable;		
				
		$sortFieldIndex	= $argDataObj->getSortFieldIndex();
	    $sortOrder 		= $argDataObj->getSortOrder();		  
	    $searchField 	= $argDataObj->getSearchField();
	    $searchText 	= $argDataObj->getSearchText();		    			
	    $limitRows 		= $argDataObj->getLimitRows();
	    $limitOffset 	= $argDataObj->getLimitOffset();	    
	    $countryId		= $argDataObj->getCountryObj()->getId();		
	    
	    
	    // Add WHERE condition		
	    $queryStmt 		.= " WHERE (1) "; 

		// Add Parent Id
		if ($countryId != NULL){
	    	$queryStmt 		.= " AND country_id = ? "; 	
			$queryDataArr[]	= $countryId; 			
		}
	    
	    
		// Add Search condition if any
		if ($searchField != "" && $searchText != ""){
			// Query Example: SELECT id, name, state_id, STATUS FROM mp_state WHERE state_id =0 AND name LIKE 'buy%' 			
	    	$queryStmt 		.= " AND {$searchField} LIKE ? "; 	
			$queryDataArr[]	= $searchText  . "%"; // Add % symbol at the end of data itself			
		}
		
		// Execute query, pass the data to query parameters and get result set			
		$queryResult =  $this->db->query($queryStmt, $queryDataArr); 

	    // Add count to returnArr
	    $returnArr['totalRecords'] = $queryResult->num_rows();
		
	    // Now add Order by, limit and run the query again
		// Add ORDER BY - field and order
		$sortFieldArr 	= $argDataObj->getSortFieldArr();
		
		// Get only the key values
		$sortFieldNameArr	=	array_keys($sortFieldArr);
		
		$queryStmt 		= $queryStmt . " ORDER  BY ".$sortFieldNameArr[$sortFieldIndex]." ".$sortOrder." "; 					
	    		    
		// Add LIMIT 
		if ($limitRows>0){		
			$queryStmt 		= $queryStmt . " LIMIT {$limitOffset}, {$limitRows} "; 					
		}			

		//echo $queryStmt;
		//print_r($queryDataArr);		
		//exit;
		
		// Execute Query once again
	    $queryResult =  $this->db->query($queryStmt, $queryDataArr); 

	    
	    // Define array to store result
	     $dataObjArr = array();
	    
	    if($queryResult->num_rows() > 0){	
 		   foreach ($queryResult->result() as $row)
		   {
				$dataObjArr[] = $this->getEntityObject($row);
		   }
	    } 	
	    
		// Add array of objects to return array		    
	    $returnArr['dbDataArr'] = $dataObjArr;
	    		
	   //return array
	   return $returnArr;
		    
	}

	
	
	function getRecords($stateId = null, $countryId = null, $status = null)
	{ 				
		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
				
		// SELECT and FROM table
		$selectStmt 	= " SELECT * ";
		$fromTable		= " FROM " . $this->config->item('tbl_state','dbtables');		
		$queryStmt 		= $selectStmt . $fromTable;		
		$queryStmt 		.= " WHERE (1) ";
 				
		// Getting only ONE row
		if ($stateId != null){
		    $queryStmt 		.= " AND id = ? "; 
			$queryDataArr[]	= $stateId;			
		}
		if ($countryId != null){
		    $queryStmt 		.= " AND country_id = ? "; 
			$queryDataArr[]	= $countryId;			
		}
		if ($status != null){
		    $queryStmt 		.= " AND status = ? "; 
			$queryDataArr[]	= $status;			
		}
		
	    // Add order by clause
	    $queryStmt 		= $queryStmt . " ORDER BY name ";	    		
		
	    // Execute query
	    $queryResult = $this->db->query($queryStmt, $queryDataArr);
	    	    
	    if( $queryResult->num_rows() > 0 ){
	       
	    	// One row, match!
		   	$dataObjArr = array();
		   	
 		   foreach ($queryResult->result() as $row)
		   {
				$dataObjArr[] = $this->getEntityObject($row);
		   }
		   
		   if ($stateId != null && count($dataObjArr)>0 ){
		   	return $dataObjArr[0];
		   }
		   
		   return $dataObjArr;
		      
	    } else {	    
	      return null;   // None
	    }			

	}	
	
	function getName($id){
		$qry = "SELECT id, name FROM " . $this->config->item('tbl_state','dbtables') . " WHERE id=?";
		
		$dataBindArr[] =  $id;	
		$queryResult = $this->db->query($qry, $dataBindArr);		
	    
		$name = "";
 		if ($queryResult->num_rows() > 0){ 			
 		 	foreach ($queryResult->result() as $row){
					$name = $row->name;
			   }	
		}

		return $name;
		
	}
	
	// Using stateId get country object (having id, name and status)	
	function getCountry($stateId){
		
		// SELECT c.* FROM `cb_state` s, cb_country c WHERE s.country_id = c.id and s.id=1
		$qry = "SELECT c.* FROM " . $this->config->item('tbl_state','dbtables') . " s, ";
		$qry .= "" . $this->config->item('tbl_country','dbtables') ." c ";
		$qry .= " WHERE s.country_id = c.id and s.id = ?  ";
				
		$dataBindArr[] =  $stateId;	
		$queryResult = $this->db->query($qry, $dataBindArr);		
	    
 		if ($queryResult->num_rows() > 0){ 			
 		 	foreach ($queryResult->result() as $row){
				return	$this->getCountryObject($row);
 		 	}	
		}

		return null;
		
		
	}
	
	function getTotalRecords(){		
		return $this->db->count_all($this->config->item('tbl_state','dbtables'));
	}
	
	//check for duplicate name for add and edit operations. $argName is used for "add", $argOldName for "edit"
	function isNamePresent($argName, $argOldName="")
	{		
		/* SELECT * FROM `gz_state` where `name` = "newname" and name != 'oldname' */		
		$con = "";
		if (empty($argOldName)){
			$con = " `name` = ? ";
			$dataBindArr[] =  $argName;			
		}else{
			$con = " `name` = ? and name != ? ";
			$dataBindArr[] =  $argName;			
			$dataBindArr[] =  $argOldName;			
		}
		
		$qry = "SELECT id, name FROM " . $this->config->item('tbl_state','dbtables') . " WHERE " . $con;				
		$queryResult = $this->db->query($qry, $dataBindArr);		
	    $flag = false;
 		if ($queryResult->num_rows() > 0){
	    	$flag = true;			
		} 

		return $flag;	
	}
	
	// save (insert/update) record
	function save($argRecordObj)
	{			
		$queryResult = FALSE;
		
		//Create common data array for Add/Edit
		$data = array( // field => value pair - other than primary key
				   'name' => $argRecordObj->getName(),
					'country_id' => $argRecordObj->getCountryId(),
				   'created_date' => $argRecordObj->getCreatedDate(),
				   'updated_date' => $argRecordObj->getUpdatedDate(),
				   'status' => $argRecordObj->getStatus()		
				);
						
		// Check operation type based on Id					
		if ($argRecordObj->getId() == NULL){ // Add operation

			$queryResult = $this->db->insert($this->config->item('tbl_state','dbtables'), $data);			  						
		
		} else if ($argRecordObj->getId() > 0){ // Edit Operation
			
			$this->db->where('id', $argRecordObj->getId());
			$queryResult = $this->db->update($this->config->item('tbl_state','dbtables'), $data);
			  						
		}
		
		// write to log if update operation was not processed
		if ($queryResult == FALSE){
			log_message("info", "Failed to perform Add/Edit operation on:" . $argRecordObj->getName());			
		}
				
		return $queryResult;
	
	}		
	

	//Delete record
	function delete($argIds){
		$queryResult = $this->db->query( "DELETE FROM " . $this->config->item('tbl_state','dbtables') . " WHERE id IN (" . $argIds . ")" );
		return $queryResult;
	}
	
	function getEntityObject($row){
		
	    $dataObj = new $this->state_obj;	 		
   	
		$dataObj->setId($row->id);
		$dataObj->setName($row->name);
		$dataObj->setCountryId($row->country_id);
		$dataObj->setStatus($row->status);
		$dataObj->setCreatedDate($row->created_date);
		$dataObj->setUpdatedDate($row->updated_date);

		return $dataObj;
	}
	
	function getCountryObject($row){
		
	    $dataObj = new $this->country_obj;	 		
   	
		$dataObj->setId($row->id);
		$dataObj->setName($row->name);
		$dataObj->setStatus($row->status);
		$dataObj->setCreatedDate($row->created_date);
		$dataObj->setUpdatedDate($row->updated_date);

		return $dataObj;
	}	
	
}	
/*end of file*/	