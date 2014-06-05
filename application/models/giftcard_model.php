<?php

class Giftcard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('giftcard_obj');					
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
		$fromTable		= " FROM " . $this->config->item('tbl_giftcard','dbtables');		
		$queryStmt 		= $selectStmt . $fromTable;		
				
		$sortFieldIndex	= $argDataObj->getSortFieldIndex();
	    $sortOrder 		= $argDataObj->getSortOrder();		  
	    $searchField 	= $argDataObj->getSearchField();
	    $searchText 	= $argDataObj->getSearchText();		    			
	    $limitRows 		= $argDataObj->getLimitRows();
	    $limitOffset 	= $argDataObj->getLimitOffset();	    	    
	    
	    // Add WHERE condition		
	    $queryStmt 		.=  " WHERE (1) "; 
	    
		// Add Search condition if any
		if ($searchField != "" && $searchText != ""){
			// Query Example: SELECT id, name, city_id, STATUS FROM mp_city WHERE city_id =0 AND name LIKE 'buy%' 			
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
		
		// Execute Query once again
	    $queryResult =  $this->db->query($queryStmt, $queryDataArr); 

	    
	    // Define array to store result
	     $dataObjArr = array();
	    
	    if($queryResult->num_rows() > 0){	
 		   foreach ($queryResult->result() as $row)
		   {
	      		$dataObj = new $this->giftcard_obj;			   	
	      		
				$dataObj->setId($row->id);	
				$dataObj->setTitle($row->title);				
				$dataObj->setDescp($row->descp);
				$dataObj->setValue($row->value);
				$dataObj->setPoints($row->points);
				$dataObj->setStatus($row->status);
				
				$dataObjArr[] = $dataObj;					
		   }
	    } 	
	    
		// Add array of objects to return array		    
	    $returnArr['dbDataArr'] = $dataObjArr;
	    		
	   //return array
	   return $returnArr;
		    
	}


	
	function getRecords($id = null, $status = null)
	{ 				

		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
				
		// SELECT and FROM table
		$selectStmt 	= " SELECT * ";
		$fromTable		= " FROM " . $this->config->item('tbl_giftcard','dbtables');		
		$queryStmt 		= $selectStmt . $fromTable;		
		 $queryStmt 	.= " WHERE (1) ";
		
		// Getting only ONE row
		if ($id != null){
		    $queryStmt 		.= " AND id = ? "; 
			$queryDataArr[]	= $id;			
		}
		
		if($status != null){
		    $queryStmt 		.= " AND status = ? "; 
			$queryDataArr[]	= $status;			
		}
				
	    // Add order by clause
	    $queryStmt 		.= " ORDER BY id ";	    
		
		// Execute query
	    $queryResult = $this->db->query($queryStmt, $queryDataArr);
	    	    
	    if( $queryResult->num_rows() > 0 ){
	       
	       $dataObjArr	= array();
	       		   	
 		   foreach ($queryResult->result() as $row)
		   {
	      		$dataObj = new $this->giftcard_obj;			   	
	      		
				$dataObj->setId($row->id);
				$dataObj->setTitle($row->title);
				$dataObj->setDesc($row->desc);
				$dataObj->setValue($row->value);						
				$dataObj->setPoints($row->points);
				$dataObj->setStatus($row->status);				
				
				$dataObjArr[] = $dataObj;			   	
		   }

		   if ($id != null && count($dataObjArr)>0){
		   	return $dataObjArr[0];
		   }
		   
		   return $dataObjArr;
		      
	    } else {	    
	      return null;   // None
	    }			

	}	
	
	function getName($id){
		$qry = "SELECT id, first_name, last_name FROM " . $this->config->item('tbl_user','dbtables') . " WHERE id=?";
		
		$dataBindArr[] =  $id;	
		
		$queryResult = $this->db->query($qry, $dataBindArr);		
	    
		$name = "";
 		if ($queryResult->num_rows() > 0){ 			
 		 	foreach ($queryResult->result() as $row){
					$name = $row->first_name ." ". $row->last_name;
			   }	
		}

		return $name;
		
	}
	
	function getTotalRecords(){		
		return $this->db->count_all($this->config->item('tbl_user','dbtables'));
	}
	
	//check for duplicate email
	function isEmailPresent($argEmail)
	{		
		
		$qry = "SELECT id FROM " . $this->config->item('tbl_user','dbtables') . " WHERE email = ? ";
		$dataBindArr[] =  $argEmail;						
		
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
				   'title' => $argRecordObj->getTitle(),
				   'descp' => $argRecordObj->getDescp(),
				   'points' => $argRecordObj->getPoints(),
				   'value' => $argRecordObj->getValue(),
				   'status' => $argRecordObj->getStatus()
				);
						
		// Check operation type based on Id					
		if ($argRecordObj->getId() == NULL){ // Add operation

			$queryResult = $this->db->insert($this->config->item('tbl_giftcard','dbtables'), $data);			  						
		
		} else if ($argRecordObj->getId() > 0){ // Edit Operation
			
			$this->db->where('id', $argRecordObj->getId());
			$queryResult = $this->db->update($this->config->item('tbl_giftcard','dbtables'), $data);
			  						
		}
		
		// write to log if update operation was not processed
		if ($queryResult == FALSE){
			log_message("info", "Failed to perform Add/Edit operation on:" . $argRecordObj->getName());			
		}
				
		return $queryResult;
	
	}		
	

	//Delete record
	function delete($argIds){
		$queryResult = $this->db->query( "DELETE FROM " . $this->config->item('tbl_giftcard','dbtables') . " WHERE id IN (" . $argIds . ")" );
		return $queryResult;
	}
	
		
}	
/*end of file*/	