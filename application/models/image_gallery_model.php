<?php

/**
 * 
 * THis class is created to store photo gallery images and to get list of gallery images from respective tables  
 * @author Admin
 *
 */

class Image_gallery_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('image_gallery_obj');
		$this->config->load('dbtables', TRUE);
	}
		

	
	// This function returns image details 	
	function getRecords($tableName, $entityId) 
	{ 			
		
		// Prepare Query - using Query Binding concept from CodeIgnitor
		$queryDataArr 	= array(); //used for data binding
				
		// SELECT and FROM table
		$selectStmt 	= " SELECT ";
		$selectStmt 	.= " `id`, `entity_id`, `filename`, `is_main_image`  ";
		$fromTable		= " FROM " . $tableName;
				
		$queryStmt 		= $selectStmt . $fromTable;		
				
		// Getting only ONE row
		if (!empty($argArr["entityId"])){
		    $queryStmt 		= $queryStmt . " WHERE entity_id = ? "; 
			$queryDataArr[]	= $entityId;
		}
		
	    // Execute query
	    $queryResult = $this->db->query($queryStmt, $queryDataArr); // this may return 1 or many rows
	    	    
	    if( $queryResult->num_rows() > 0 ){
	       
		   $dataObjArr = array();
		   	 
 		   foreach ($queryResult->result() as $row)
		   {
			   $dataObj = new $this->image_gallery_obj;	 		
		   	
				$dataObj->setId($row->id);
				$dataObj->setEntityId($row->entity_id);
				$dataObj->setFilename($row->filename);
				$dataObj->setIsMainImage($row->is_main_image);
				
				$dataObjArr[] = $dataObj;			
		   }
		   
		   return $dataObjArr;
		      
	    } else {	    
	      return null;   // None
	    }			

	}
	
	
	/**
	 * 
	 * THis function saves the image details in particular table
	 * @param unknown_type $argImageObj
	 */
	
	function save($tableName, $argImageObj)
	{			
		
		//Create common data array for Add/Edit
		$data = array( // table-field => value        == other than primary key			
				   'id' => $argImageObj->getId(),
				   'entity_id' => $argImageObj->getEntityId(),
				   'filename' => $argImageObj->getFilename(),
				   'is_main_image' => $argImageObj->getIsMainImage() 
				);

		// insert into table
		$queryResult = $this->db->insert($tableName, $data);			  						
			
		return $queryResult;
		
	}
	
	
	//Delete record
	function delete($tableName, $argIds){
		// delete from buy_sell_image table		
		$queryResult = $this->db->query( "DELETE FROM " . $tableName . " WHERE entity_id IN (" . $argIds . ")" );
		
		return $queryResult; 
	}
	
	

		
}	
/*end of file*/	