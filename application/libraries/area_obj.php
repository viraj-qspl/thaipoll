<?php


class Area_obj extends Base_master {

	var $cityId;
	
	function __construct(){
	}
		
	function getCityId(){ return $this->cityId; }
	function setCityId($id){ $this->cityId = $id; }
	
}
/*end of file*/