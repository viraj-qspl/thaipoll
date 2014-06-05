<?php

class City_obj extends Base_master {

	var $stateId;
	
	function __construct(){
	}
			
	function setStateId($id){ $this->stateId = $id;	}
	function getStateId(){ return $this->stateId; }
	
}

/*end of file*/