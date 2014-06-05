<?php

/**
 * 
 * This is a common class used by all listing types like (Buy-Sell, events, services for storing gallery image details
 * the entityId represents a general id of any type of above table.
 * However, to distribute load evenly, different tables (specific to group type) are created to store gallery images
 * @author Admin
 *
 */

class Image_gallery_obj {

	var $id;
	var $entityId; //id of the listing of buy-sell, event, services etc that holds gallery images. 
	var $filename;
	var $isMainImage;
	
	function __construct(){
	}

	function setId($id){
		$this->id = $id;		
	}
	function getId(){
		return $this->id;		
	}

	function setEntityId($entityId){
		$this->entityId = $entityId;		
	}
	function getEntityId(){
		return $this->entityId;		
	}
	
	function setFilename($filename){
		$this->filename = $filename;		
	}
	function getFilename(){
		return $this->filename;		
	}
	
	function setIsMainImage($isMainImage){
		$this->isMainImage = $isMainImage;		
	}
	function getIsMainImage(){
		return $this->isMainImage;		
	}	
}
/*end of file*/