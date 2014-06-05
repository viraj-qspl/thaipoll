<?php

class Sub_category_type_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('sub_category_type_obj');					
		$this->config->load('dbtables', TRUE);
	}
		
	// Get all categories
	// This will return array with two elements, 1st element will have count (total records without limit for paging), 2nd element will have list of records (with limit)
	function getList($argDataObj = null)
	{					
		// Define return array variable
		$returnArr = array();
		
		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
		
		// SELECT and FROM table
		$selectStmt 	= " SELECT * ";
		$fromTable		= " FROM " . $this->config->item('tbl_sub_category_type','dbtables');		
		$queryStmt 		= $selectStmt . $fromTable;		
				
		$sortFieldIndex	= $argDataObj->getSortFieldIndex();
	    $sortOrder 		= $argDataObj->getSortOrder();		  
	    $searchField 	= $argDataObj->getSearchField();
	    $searchText 	= $argDataObj->getSearchText();		    			
	    $limitRows 		= $argDataObj->getLimitRows();
	    $limitOffset 	= $argDataObj->getLimitOffset();	
		// read url more parameter
	    $categoryId 	= $argDataObj->getCategoryObj()->getId();	
	    $subCategoryId 	= $argDataObj->getSubCategoryObj()->getId();	
	    
	    
	    // Add WHERE condition		
	    $queryStmt 		= $queryStmt . " WHERE (1) "; 
	    
		// Add Category condition if any
	    if ($subCategoryId != null ){ 
	    	$queryStmt 		= $queryStmt . " AND sub_category_id = ? "; 	
			$queryDataArr[]	= $subCategoryId; 				    	
		}	    
	    
		// Add Search condition if any
		if ($searchField != "" && $searchText != ""){
			// Query Example: SELECT id, name, category_id, STATUS FROM mp_sub_category_type WHERE category_id =0 AND name LIKE 'buy%' 			
	    	$queryStmt 		= $queryStmt . " AND {$searchField} LIKE ? "; 	
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

	
	/**
	 * 
	 * This function returnd one or more records
	 * @param unknown_type $argDataObj
	 * @param unknown_type $categoryId
	 * @param unknown_type $status
	 */
	function getRecords($subCategoryTypeId = null, $subCategoryId = null, $status = null)	
	{ 
		//First, check if id is null or < 1, if yes, then return null
		if ( $subCategoryTypeId == null || $subCategoryTypeId < 1){
			return null; 
		}
				
		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
				
		// SELECT and FROM table
		$selectStmt 	= " SELECT * ";
		$fromTable		= " FROM " . $this->config->item('tbl_sub_category_type','dbtables');		
		$queryStmt 		= $selectStmt . $fromTable . " WHERE (1) ";	
		
		// if id is sent
		if ($subCategoryTypeId != null ){// note: for Add operation, id=-1 which is correct condition.			
			$queryStmt 		= $queryStmt . " AND id = ? "; 
			$queryDataArr[]	= $subCategoryTypeId;			
		}

		if ($subCategoryId != null && $subCategoryId > 0 ){ 
	    	$queryStmt 		= $queryStmt . " AND sub_category_id = ? "; 	
			$queryDataArr[]	= $subCategoryId; 				    	
		}
		
		if ($status != null){
		    $queryStmt 		= $queryStmt . " AND status = ? ";
			$queryDataArr[]	= $status; 				    				
		}
	    	    
	    // Add order by clause
	    $queryStmt 		= $queryStmt . " ORDER BY priority_number ";	    
   
	    // Execute query
	    $queryResult = $this->db->query($queryStmt, $queryDataArr);
	    	    	    
	    if( $queryResult->num_rows() > 0 ){
	       
	       $dataObjArr = array();
		   	
 		   foreach ($queryResult->result() as $row)
		   {
				$dataObjArr[] = $this->getEntityObject($row);		   	
		   }
		   
		   if ($subCategoryTypeId != null && count($dataObjArr)>0 ){
		   	return $dataObjArr[0];		   	
		   }
		    
		   return $dataObjArr;
		      
	    } else {
	    		
	    	// if no results found based on condition 
	      	return null;  
	      
	    }			

	}
	
	
	function getTypesForSubcategory($subCategoryId)	
	{ 				
		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
				
		// SELECT and FROM table
		$queryStmt = "";
		$queryStmt  .= " SELECT * "; 	// select all the fields so that object can be populated else the commonly used function will throw error		
		$queryStmt  .= " FROM cb_sub_category_type "; 			
		$queryStmt  .= " WHERE sub_category_id = ? "; 			
		
		$queryDataArr[]	= $subCategoryId;			
	    	    
	    // Add order by clause
	    $queryStmt 		= $queryStmt . " ORDER BY name ";	    
    
		//echo $queryStmt;
		log_message('info', '=================>' . $queryStmt);				
	    	    
	    // Execute query
	    $queryResult = $this->db->query($queryStmt, $queryDataArr);
	    	    
	    
	    if( $queryResult->num_rows() > 0 ){
	       
	       $dataObjArr = array();
		   	
 		   foreach ($queryResult->result() as $row)
		   {
				$dataObjArr[] = $this->getEntityObject($row); // this will store only id and name		   	
		   }
		   
		   return $dataObjArr;
		      
	    } else {	    
	      return null;   // None
	    }			

	}
	
	// This returns the name of sub_category_type using id	
	function getName($id){
		$qry = "SELECT id, name FROM " . $this->config->item('tbl_sub_category_type','dbtables') . " WHERE id=? ";
		
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
	
	
	// This function returns total number of records	
	function getTotalRecords(){		
		return $this->db->count_all($this->config->item('tbl_sub_category_type','dbtables'));
	}
	
	
	//check for duplicate name for add and edit operations. $argName is used for "add", $argOldName for "edit"
	function isNamePresent($argName, $argOldName="", $subCategoryId)
	{		
		/* SELECT * FROM `gz_sub_category_type` where `name` = "newname" and name != 'oldname' */		
		$con = "";
		
		// add categoryId condition
		$con .= " sub_category_id = {$subCategoryId}   AND ";
		
		if (empty($argOldName)){
			$con .= " `name` = ? ";
			$dataBindArr[] =  $argName;			
		}else{
			$con .= " `name` = ? and name != ? ";
			$dataBindArr[] =  $argName;			
			$dataBindArr[] =  $argOldName;			
		}
		
		$qry = "SELECT id, name FROM " . $this->config->item('tbl_sub_category_type','dbtables') . " WHERE " . $con;
		$queryResult = $this->db->query($qry, $dataBindArr);		
	    $flag = false;
 		if ($queryResult->num_rows() > 0){
	    	$flag = true;			
		} 

		return $flag;	
	}
	
	// This function does save (insert/update) operation
	function save($argRecordObj)
	{			
		$queryResult = FALSE;
		
		//Create common data array for Add/Edit
		$data = array( // field => value pair - other than primary key
				   'name' => $argRecordObj->getName(),
				   'sub_category_id' => $argRecordObj->getSubCategoryId(),
				   'created_date' => $argRecordObj->getCreatedDate(),
				   'updated_date' => $argRecordObj->getUpdatedDate(),
				   'status' => $argRecordObj->getStatus()
				);
						
		// Check operation type based on Id					
		if ($argRecordObj->getId() == NULL){ // Add operation

			$queryResult = $this->db->insert($this->config->item('tbl_sub_category_type','dbtables'), $data);			  						
		
		} else if ($argRecordObj->getId() > 0){ // Edit Operation
			
			$this->db->where('id', $argRecordObj->getId());
			$queryResult = $this->db->update($this->config->item('tbl_sub_category_type','dbtables'), $data);
			  						
		}
		
		// write to log if update operation was not processed
		if ($queryResult == FALSE){
			log_message("info", "Failed to perform Add/Edit operation on:" . $argRecordObj->getName());			
		}
				
		return $queryResult;
	
	}		
	

	// This function deletes the record
	function delete($argIds){
		$queryResult = $this->db->query( "DELETE FROM " . $this->config->item('tbl_sub_category_type','dbtables') . " WHERE id IN (" . $argIds . ")" );
		return $queryResult;
	}
	
	function getEntityObject($row){
		
	    $dataObj = new $this->sub_category_type_obj;	 		
   	
		$dataObj->setId($row->id);
		$dataObj->setName($row->name);
		$dataObj->setSubCategoryId($row->sub_category_id);		
		$dataObj->setStatus($row->status);
		$dataObj->setCreatedDate($row->created_date);
		$dataObj->setUpdatedDate($row->updated_date);

		return $dataObj;
	}
	
	
		
}	
/*end of file*/	