<?php


class Poll_obj {

	var $id;
	var $pollQuestion_id;
	var $answer;
	var $label;
	var $text;
	
	private $data = array();
	

	
	function __construct(){	}
	
	public function __set($index,$value)
	{
		$this->$index = $value;
	
	}

	public function __get($index)
	{
		return $this->$index;
	}
}
/*end of file*/