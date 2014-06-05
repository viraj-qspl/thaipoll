<?php


class Giftcard_obj {

	var $id;
	var $descp;
	var $title;
	var $points;
	var $value;
	var $status;

	
	function __construct(){	}

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id;	}
	
	function setDescp($descp){ $this->descp = $descp; }
	function getDescp(){ return $this->descp;	}
	
	function setTitle($title){ $this->title = $title; }
	function getTitle(){ return $this->title;	}	
	
	function setPoints($points){ $this->points = $points; }
	function getPoints(){ return $this->points;	}
	
	function setValue($value){ $this->value = $value; }
	function getValue(){ return $this->value;	}

	function setStatus($status){ $this->status = $status; }
	function getStatus(){ return $this->status;	}	
	


	
}
/*end of file*/