<?php

class Base_master_abstract{
	// define empty class to load below defined abstract class
}

abstract class Base_master {

	var $id;
	var $name;
	var $createdDate;
	var $updatedDate;
	var $status;	
	
	function __construct(){ }

	function setId($id){$this->id = $id; }
	function getId(){ return $this->id; }
	
	function setName($name){ $this->name = $name; }
	function getName(){ return $this->name; }

	function setCreatedDate($createdDate){ $this->createdDate = $createdDate; }
	function getCreatedDate(){ return $this->createdDate; }
	
	function setUpdatedDate($updatedDate){ $this->updatedDate = $updatedDate; }
	function getUpdatedDate(){ return $this->updatedDate; }
	
	function setStatus($status){ $this->status = $status; }
	function getStatus(){ return $this->status; }	
		
}
/*end of file*/