<?php


class State_obj extends Base_master {

	var $countryId;
	
	function __construct(){
	}
		
	function setCountryId($id){
		$this->countryId = $id;		
	}
	function getCountryId(){
		return $this->countryId;		
	}
	
}
/*end of file*/