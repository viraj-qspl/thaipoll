<?php


class Ques_obj {

	var $id;
	var $poll_id;
	var $question;
	var $required;
	var $allow_text;
	var $type;
	var $status;
	var $filter_ques;
	
	
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